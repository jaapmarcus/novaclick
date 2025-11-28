<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    function download(Request $request, $id, $file){
        //check if file is in database
        $file = Files::where('id', $id)->first();
        //check if the file belongs to the user or user is admin
        if($file -> user_id != $request -> user() -> id && !$request -> user() -> role == 'admin'){
            abort(403);
        }
        //keep the original file name
        $originalFileName = $file -> original_name;
        return Storage::download($file -> file_path, $originalFileName);

    }
}
