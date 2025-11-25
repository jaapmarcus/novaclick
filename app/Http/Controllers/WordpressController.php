<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wizard;
use Illuminate\Support\Facades\Http;

class WordpressController extends Controller
{
    function login($id = null)
    {
        if(empty($id)){
            //get user id from current user
            $id = auth()->user()->id;
        }
        $user = \App\Models\User::findOrFail($id);
        //generate a wordpress login url for this user
        $wordpressUrl = config('services.wordpress.url');
        $token = md5($user->email . 'secret_salt'); //simple token generation for example purposes
        $loginUrl = $wordpressUrl . '/wp-login.php?user=' . urlencode($user->email) . '&token=' . $token;

        return redirect($loginUrl);
    }

    public function wizardInfo(){
        //get user id from auth
        $user = auth()->user();
        //get wizard info view
        $wizard = Wizard::where('user_id', $user->id)->get();
        $data = [];
        foreach($wizard as $item){
            if($item['key'] == 'transfer_token'){
                continue;
            }
           $data[$item -> key] = $item->value;
        }
        return response()->json($data);
    }

    public function placesInfo(Request $request){
        //get place id from user auth request
        $user = auth()->user();
        $placeId = $user -> places_id;
        if(empty($placeId)){
            return response()->json(['error' => 'No place ID found for user'], 404);
        }
        $apiKey = config('services.google_places.api_key');
        $response = Http::withHeaders([
            'X-Goog-Api-Key' => $apiKey,
            'X-Goog-FieldMask' => '*',
        ])
        ->get('https://places.googleapis.com/v1/places/'.$placeId.'?languageCode=nl-NL');

        $data = json_decode($response, true);

        return response()->json($data);
    }

}
