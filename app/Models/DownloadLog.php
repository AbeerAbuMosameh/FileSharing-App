<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    use HasFactory;

    protected $table = 'download_logs';

    protected $fillable = [
        'file_id',
        'ip_address',
        'user_agent',
        'downloaded_at',
    ];
}
