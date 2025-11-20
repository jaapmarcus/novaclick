<?php

namespace App\Livewire\Invoice;

use Livewire\Component;

class Show extends Component
{

    public $invoiceId = null;

    public function mount($invoiceId){
        $this -> invoiceId = $invoiceId;
        dd($this -> invoiceId);
    }

    public function render()
    {

        return view('livewire.invoice.show');
    }
}
