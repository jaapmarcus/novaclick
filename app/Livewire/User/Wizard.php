<?php

namespace App\Livewire\User;

use Livewire\Component;

class Wizard extends Component
{
    public $user_id = null;

    //info fields
    public $website_available = '';
    public $website_present = '';
    public $domain_name = '';
    public $transfer_token = '';
    public $logo_available = false;
    public $search_text = '';
    public $target_audience = '';
    public $website_goals = '';
    public $desired_pages = '';
    public $text_images = '';
    public $contact_form = '';
    public $has_places = null;
    public $place_id = '';
    public $additional_info='';
    public $services_offered='';
    public $x_handle = '';
    public $facebook_handle = '';
    public $instagram_handle = '';
    public $tiktok_handle = '';
    public $linkedin_handle = '';
    public $youtube_handle = '';
    public $whatsapp_handle = '';



    public $text_color = '#000000';
    public $background_color = '#ffffff';
    public $primary_color = '#0000ff';

    public $text_color_picker = '#000000';
    public $background_color_picker = '#ffffff';
    public $primary_color_picker = '#0000ff';

    public $files = [];

    public function mount($id){
        //get user id from request
        $this -> user_id = $id;
        $wizard = \App\Models\Wizard::where('user_id', $this -> user_id)->get();
        $this -> files = \App\Models\Files::where('user_id', $this -> user_id)->get();
        //loop trough the wizard info an set the public variables
        foreach($wizard as $info){
            $this -> {$info -> key} = $info -> value;
        }
    }
    public function render()
    {
        // get wizard info from database
        return view('livewire.user.wizard');
    }
}
