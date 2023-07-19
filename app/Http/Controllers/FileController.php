<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileController extends Controller
{

    public function index()
    {
        $files = File::orderBy('name', 'DESC')->get();
        return view('index', compact('files'));

    }

    public function upload()
    {
        return view('upload');

    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|file',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->back();
        }

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $path = $file->store('uploads');

        File::create([
            'name' => $filename ,
            'extension' => $extension,
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

        return response()->download($filePath, $file->name);
    }


}
