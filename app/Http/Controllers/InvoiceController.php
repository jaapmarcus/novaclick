<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download($invoiceNumber)
    {
       //check if the authenticated user has access to this invoice
         $user = auth()->user();
         $order = $user->findInvoiceOrFail($invoiceNumber);
         dd( $order);
    }
}
