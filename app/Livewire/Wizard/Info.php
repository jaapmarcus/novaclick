<?php

namespace App\Livewire\Wizard;

use Livewire\Component;
use App\OpenProvider;
use App\Models\Wizard;
use App\Models\Files;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Info extends Component
{
    use WithFileUploads;
    public $step = 1;
    public $totalSteps = 8;

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



    public $text_color = '#000000';
    public $background_color = '#ffffff';
    public $primary_color = '#0000ff';

    public $text_color_picker = '#000000';
    public $background_color_picker = '#ffffff';
    public $primary_color_picker = '#0000ff';


    #[Validate('max:10240')] // 10MB Max
    public $logo = [];
    #[Validate('max:10240')] // 10MB Max
    public $files = [];

    public $places = [];

    public function mount(){
        $this->search_text = auth()->user()->company_name . ' ' . auth()->user()->city;
    }


    public function whois(){
        //check if domain extension is allowed
        $allowed_extensions = ['.com', '.be', '.de', '.nl', '.eu',  '.fr', '.org','.it','.ch', '.at'];
        $extension = substr($this->domain_name, strrpos($this->domain_name, '.'));
        if(!in_array($extension, $allowed_extensions)){
            $this->website_available = 'not_allowed';
            return;
        }
        //check if the domain is free via whois api
        $this->website_available = OpenProvider::whois($this->domain_name);

    }

    public function removeLogo($filename){
        $this->logo = collect($this->logo)->filter(function($file) use ($filename) {
            return $file->getClientOriginalName() !== $filename;
        })->toArray();
    }

    public function removeFile($filename){
        $this->files = collect($this->files)->filter(function($file) use ($filename) {
            return $file->getClientOriginalName() !== $filename;
        })->toArray();
    }


    public function render()
    {
        return view('livewire.wizard.info');
    }

    public function nextStep()
    {
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    function placeSearch(){
        //use google places api to search for the company
        $apiKey = config('services.google_places.api_key');
        $searchText = urlencode($this->search_text);
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query={$searchText}&key={$apiKey}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $this -> places = $data['results'];
        return;
    }

    public function SaveWizard()
    {
        //save all wizard data to database
        $user = auth()->user();

        //save wizard steps to wizard table
        $wizardData = [
            'website_available' => $this->website_available,
            'website_present' => $this->website_present,
            'domain_name' => $this->domain_name,
            'transfer_token' => $this->transfer_token,
            'logo_available' => $this->logo_available,
            'search_text' => $this->search_text,
            'target_audience' => $this->target_audience,
            'website_goals' => $this->website_goals,
            'desired_pages' => $this->desired_pages,
            'text_images' => $this->text_images,
            'contact_form' => $this->contact_form,
            'has_places' => $this->has_places,
            'place_id' => $this->place_id,
            'additional_info' => $this->additional_info,
            'services_offered' => $this->services_offered,
            'text_color' => $this->text_color,
            'background_color' => $this->background_color,
            'primary_color' => $this->primary_color,
        ];

        foreach($wizardData as $key => $value){
            Wizard::updateOrCreate(
                ['user_id' => $user->id, 'key' => $key],
                ['value' => $value]
            );
        }

        //store uploaded files
        foreach($this->logo as $file){
            $file->store('wizard/'.$user->id.'/logo');
            //save file info to files table
            Files::create([
                'user_id' => $user->id,
                'file_path' => 'wizard/'.$user->id.'/logo/'.$file->hashName(),
                'file_type' => 'logo',
                'original_name' => $file->getClientOriginalName(),
            ]);
        }
        foreach($this->files as $file){
            $file->store('wizard/'.$user->id.'/files');
            //save file info to files table
            Files::create([
                'user_id' => $user->id,
                'file_path' => 'wizard/'.$user->id.'/files/'.$file->hashName(),
                'file_type' => 'file',
                'original_name' => $file->getClientOriginalName(),
            ]);
        }

        //mark wizard as completed
        $user->wizard = 'completed';
        $user->places_id = $this->place_id;
        $user->domain = $this->domain_name;
        $user->save();

        //redirect to dashboard or another page
        // For now, just move to the final step
        $this->step = 7;

    }

}
