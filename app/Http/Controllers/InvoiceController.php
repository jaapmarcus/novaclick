<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download($invoiceNumber)
    {
       //check if the authenticated user has access to this invoice
         $user = auth()->user();
         $order = $user->findInvoiceOrFail($invoiceNumber);
        //get all orders aswell
        $orders = $user->orders()->where('number', $invoiceNumber)->first();


        return Pdf::loadView('invoices.invoice', [
            'invoice' => $order,
            'client' => $user,
            'total_order' => $orders,
            'svg' => \Illuminate\Support\Facades\File::get(resource_path('views/components/app-logo.blade.php'))
        ])->stream();
    }
}
