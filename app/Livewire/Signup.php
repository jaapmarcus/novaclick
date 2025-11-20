<?php

namespace App\Livewire;

use Danielebarbaro\LaravelVatEuValidator\Facades\VatValidatorFacade as VatValidator;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Signup extends Component
{
    public $companies = null;
    public $company_name = '';
    public $address = '';
    public $house_number = '';
    public $house_number_suffix = '';
    public $postal_code = '';
    public $city = '';
    public $country = '';
    public $vat_number = '';
    public $phone_number = '';

    public $countries = [
        'NL' => 'Netherlands',
        'BE' => 'Belgium',
        // Add more countries as needed
    ];

    public function mount(){
        //get user
        $user = auth()->user();
        //pre-fill company data if available
        $this->company_name = $user->company_name;
        $this->address = $user->address;
        $this->house_number = $user->house_number;
        $this->house_number_suffix = $user->house_number_suffix;
        $this->postal_code = $user->postal_code;
        $this->city = $user->city;
        $this->country = $user->country;
        $this->phone_number = $user->phone_number;
        $this->vat_number = $user->vat_number;



    }

    public function render()
    {
        return view('livewire.signup');
    }

    public function submitForm(){
        //validate user input
        $this->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'house_number_suffix' => 'nullable|string|max:10',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'vat_number' => 'nullable|string|max:50|vat_number',
        ]);
        // update user with new data
        $user = auth()->user();
        $user->company_name = $this->company_name;
        $user->address = $this->address;
        $user->house_number = $this->house_number;
        $user->house_number_suffix = $this->house_number_suffix;
        $user->postal_code = $this->postal_code;
        $user->city = $this->city;
        $user->country = $this->country;
        $user->phone_number = $this->phone_number;
        $user->vat_number = $this->vat_number;
        $user->save();

        //redirect to payment page
        return redirect()->route('subscribe');
    }
}
