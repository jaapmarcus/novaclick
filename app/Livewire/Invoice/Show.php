<?php

namespace App\Livewire\Invoice;

use Livewire\Component;

class Show extends Component
{

    public $invoiceId = null;

    public function mount($invoice)
    {
        $this->invoiceId = $invoice;

    }

    public function render()
    {
        //look up invoice by id and user
        $user = auth()->user();
        $invoice = $user->findInvoiceOrFail($this->invoiceId);
        dd($invoice);
        return view('livewire.invoice.show');
    }
}
