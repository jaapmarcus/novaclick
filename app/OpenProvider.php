<?php

namespace App;
use Illuminate\Support\Facades\Http;

class OpenProvider
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public static function whois($domain_name){
        //authenticate
        $token = (new OpenProvider())->auth();

        //call whois api
        $temp = explode('.', $domain_name, 2);
        $data = ['extension' => $temp[1], 'name' => $temp[0]];

        $response = Http::withToken($token)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://api.openprovider.eu/v1beta/domains/check', [
                'domains' => [$data],
                'with_price' => false
            ]);
        if ($response->successful()) {
            $result = $response->json();
            return $result['data']['results'][0]['status'] === 'free';
        } else {
            throw new \Exception('Whois check failed: ' . $response->body());
        }
    }

    public function auth(){
        //authenticate with openprovider api
        $serverIp = $_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname());

        $response = Http::post('https://api.openprovider.eu/v1beta/auth/login', [
            'username' => config('services.openprovider.username'),
            'password' => config('services.openprovider.password'),
            'ip_address' => $serverIp
        ]);

        if ($response->successful()) {
            return $response->json()['data']['token'];
        } else {
            throw new \Exception('Authentication failed: ' . $response->body());
        }
    }
}
