<?php

namespace App\Livewire\Invoice;

use Livewire\Component;

class Show extends Component
{
    public function render()
    {
        dd( 'invoice show' );
        return view('livewire.invoice.show');
    }
}
