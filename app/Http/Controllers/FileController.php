<?php

namespace App\Http\Controllers;

use App\Events\FileDownloaded;
use App\Models\File;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileController extends Controller
{

    public function index()
    {
        $files = File::orderBy('created_at', 'DESC')->get();
        $downloadUrls = [];

        foreach ($files as $file) {
            $downloadUrls[$file->id] = URL::temporarySignedRoute('file.download.signed', now()->addHour(), ['link' => $file->download_link]);
        }

        return view('index', compact('files', 'downloadUrls'));
    }

    public function upload()
    {
        return view('upload');

    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|file',
            'title' => 'required|string',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->back();
        }

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $path = $file->store('uploads');



        File::create([
            'extension' => $extension,
            'title' => $request->title,
            'path' => $path,
            'download_link' => Str::random(16),
        ]);

        toastr()->success('File Uploaded Successfully');
        return redirect()->route('home');
    }

    public function download($link)
    {
        $file = File::where('download_link', $link)->firstOrFail();
        $filePath = Storage::path($file->path);

        $url = URL::temporarySignedRoute('file.download.signed', now()->addHour(), ['link' => $file->download_link]);

        // Trigger the FileDownloaded event
        event(new FileDownloaded($file->id, request()->ip(), request()->userAgent()));

        return response()->download($filePath, $file->name);
    }


    public function delete(File $file)
    {
        $file->delete();

    }

}
