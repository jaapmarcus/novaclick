<?php

namespace App\Livewire;

use Livewire\Component;

class Plan extends Component
{

    public function render()
    {
        return view('livewire.plan');
    }

    public function selectPlan($plan) {
        //store in session
        session(['selected_plan' => $plan]);
        //redirect to signup page
        return redirect()->route('signup');
    }
}
