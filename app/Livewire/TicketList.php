<?php

namespace App\Livewire;

use Livewire\Component;

class TicketList extends Component
{


    public function render()
    {
        return view('livewire.ticket-list');
    }



    public function tickets()
    {
        if( auth() -> user() -> is_admin ){
            return \App\Models\Ticket::orderBy('created_at', 'desc')-> get();
        }
        return \App\Models\Tickets::where( 'user_id', auth() -> user() -> id )-> orderBy('created_at', 'desc')-> get();
    }
}
