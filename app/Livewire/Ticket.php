<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tickets;
use Flux\Flux;

class Ticket extends Component
{

    public $subject;
    public $message;
    public $department;


    public $showCreateTicketForm = false;

    public function render()
    {
        return view('livewire.ticket');
    }

    public function createTicket()
    {
        // Validate input
        $this->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'department' => 'required|string|max:100',
        ]);
        // Create the ticket
        Tickets::create([
            'user_id' => auth()->user()->id,
            'subject' => $this->subject,
            'message' => $this->message,
            'department' => $this->department,
            'status' => 'open',
        ]);
        // Reset input fields

        $this->reset(['subject', 'message', 'department']);
        $this->showCreateTicketForm = false;
        Flux::toast(
            heading: 'Ticket is aangemaakt',
            text: 'Uw support ticket is succesvol aangemaakt.',
            variant: 'success'
        );
    }

    public function showCreateTicket()
    {
        $this->showCreateTicketForm = true;
    }

}
