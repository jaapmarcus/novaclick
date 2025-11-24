<?php

namespace App\Livewire\User;

use Livewire\Component;

class Edit extends Component
{
    public $user;
    public $company_name;
    public $name;
    public $last_name;
    public $email;
    public $address;
    public $house_number;
    public $house_number_suffix;
    public $postal_code;
    public $city;
    public $country;
    public $phone_number;
    public $vat_number;
    public $places_id;
    public $domain;
    public $server_id;
    public $username;
    public $sftp_password;
    public $application_password;
    public $x_handle;
    public $facebook_handle;
    public $instagram_handle;
    public $tiktok_handle;
    public $linkedin_handle;
    public $youtube_handle;
    public $whatsapp_handle;

    public $api_key = null;

    public function mount($id)
    {
        $this->user = \App\Models\User::findOrFail($id);
        $this->company_name = $this->user->company_name;
        $this->name = $this->user->name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->address = $this->user->address;
        $this->house_number = $this->user->house_number;
        $this->house_number_suffix = $this->user->house_number_suffix;
        $this->postal_code = $this->user->postal_code;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
        $this->phone_number = $this->user->phone_number;
        $this->vat_number = $this->user->vat_number;
        $this -> domain = $this -> user -> domain;
        $this -> places_id = $this -> user -> places_id;
        $this -> server_id = $this -> user -> server_id;
        $this -> username = $this -> user -> username;
        $this -> sftp_password = $this -> user -> sftp_password;
        $this -> application_password = $this -> user -> application_password;
        $this->x_handle = $this->user->x_handle;
        $this->facebook_handle = $this->user->facebook_handle;
        $this->instagram_handle = $this->user->instagram_handle;
        $this->tiktok_handle = $this->user->tiktok_handle;
        $this->linkedin_handle = $this->user->linkedin_handle;
        $this->youtube_handle = $this->user->youtube_handle;
        $this->whatsapp_handle = $this->user->whatsapp_handle;

    }

    public function save(){
        //update domain, places_id, server_id, username, sftp_password, application_password
        $this -> user -> domain = $this -> domain;
        $this -> user -> places_id = $this -> places_id;
        $this -> user -> server_id = $this -> server_id;
        $this -> user -> username = $this -> username;
        $this -> user -> sftp_password = $this -> sftp_password;
        $this -> user -> application_password = $this -> application_password;
        $this -> user -> x_handle = $this -> x_handle;
        $this -> user -> facebook_handle = $this -> facebook_handle;
        $this -> user -> instagram_handle = $this -> instagram_handle;
        $this -> user -> tiktok_handle = $this -> tiktok_handle;
        $this -> user -> linkedin_handle = $this -> linkedin_handle;
        $this -> user -> youtube_handle = $this -> youtube_handle;
        $this -> user -> whatsapp_handle = $this -> whatsapp_handle;
        $this -> user -> save();
    }

    public function generateApiKey(){
        $this->api_key = $this->user->createToken('API Token')->plainTextToken;
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
