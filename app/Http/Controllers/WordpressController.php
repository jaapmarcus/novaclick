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
        //get domain
        if(auth()->user()->role == 'admin'){
            $wp_user_id = 1;
        }else{
            $wp_user_id = 2;
        }
        $application_password = str_replace(' ','',$user -> application_password);
        $domain = 'https://'.$user -> domain.'/wp-json/wprl/reset-code';
        $response = Http::withBasicAuth('novaclick', $application_password)
            ->post($domain, [
                'user_id' => $wp_user_id,
            ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to log in to WordPress'], $response->status());
        }

        $loginUrl = 'https://'.$user -> domain.'/wp-json/wprl/login-with-reset-code?user_id='.$wp_user_id.'&reset_code='.$response->json()['reset_code'];

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
        $cacheKey = 'places_info_' . $placeId;
        $cacheTTL = now()->addHours(6); // Cache for 6 hours

        if (cache()->has($cacheKey)) {
            $data = cache()->get($cacheKey);
        } else {
            $apiKey = config('services.google_places.api_key');
            $response = Http::withHeaders([
            'X-Goog-Api-Key' => $apiKey,
            'X-Goog-FieldMask' => '*',
            ])
            ->get('https://places.googleapis.com/v1/places/'.$placeId.'?languageCode=nl-NL');

            $data = json_decode($response, true);

            if ($response->successful()) {
            cache()->put($cacheKey, $data, $cacheTTL);
            } else {
            return response()->json(['error' => 'Failed to fetch place information'], $response->status());
            }
        }

        $data = json_decode($response, true);

        return response()->json($data);
    }

}
