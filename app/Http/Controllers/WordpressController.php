<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordpressController extends Controller
{
    function login($id = auth()->id())
    {
        $user = \App\Models\User::findOrFail($id);
        //generate a wordpress login url for this user
        $wordpressUrl = config('services.wordpress.url');
        $token = md5($user->email . 'secret_salt'); //simple token generation for example purposes
        $loginUrl = $wordpressUrl . '/wp-login.php?user=' . urlencode($user->email) . '&token=' . $token;

        return redirect($loginUrl);
    }
}
