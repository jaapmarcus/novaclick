<?php

namespace App\Livewire\Invoice;

use Livewire\Component;

class Show extends Component
{

    public $invoice_Id = null;

    public function mount($invoice_Id){
        $this -> invoice_Id = $invoice_Id;
        dd($this -> invoice_Id);
    }

    public function render()
    {

        return view('livewire.invoice.show');
    }
}
