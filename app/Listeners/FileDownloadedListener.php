<?php

namespace App\Listeners;

use App\Models\DownloadLog;
use App\Models\File;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FileDownloadedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Log the download details in the database
        DownloadLog::create([
            'file_id' => $event->fileId,
            'ip_address' => $event->ipAddress,
            'user_agent' => $event->userAgent,
            'downloaded_at' => now(),
        ]);

        // Update the downloads_count in the files table
        $file = File::find($event->fileId);
        $file->increment('downloads_count');
    }
}
