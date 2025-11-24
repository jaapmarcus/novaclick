<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
        'user_id',
        'file_path',
        'file_type',
        'original_name',
    ];
}
