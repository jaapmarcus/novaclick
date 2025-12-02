<?php

namespace App\Livewire;

use Livewire\Component;

class Invoices extends Component
{
    public function render()
    {
        return view('livewire.invoices');
    }

     #[\Livewire\Attributes\Computed]
    public function orders(){
        return auth() -> user() -> orders;
    }
}
