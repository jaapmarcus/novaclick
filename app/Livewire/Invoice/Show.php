<?php

namespace App\Livewire\Invoice;

use Livewire\Component;

class Show extends Component
{

    public $invoiceId = null;

    public function mount($invoice)
    {
        dd($invoice);
        $this->invoiceId = $invoice;

    }

    public function render()
    {

        return view('livewire.invoice.show');
    }
}
