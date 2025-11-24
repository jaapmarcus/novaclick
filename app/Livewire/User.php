<?php

namespace App\Livewire;

use Livewire\Component;
use \Livewire\WithPagination;

class User extends Component
{

    public $user = [];
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $page = 0;

    public function render()
    {
        return view('livewire.user');
    }

    public function sort($column) {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'desc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function users()
    {
        return \App\Models\User::orderBy($this->sortBy, $this->sortDirection)
            ->paginate(20, ['*'], 'page', $this->page);
    }

    public function gotoPage($page)
    {
        $this->page = $page;
    }
    public function nextPage()
    {
        $this->page++;
    }
    public function previousPage()
    {
        $this->page--;
    }
}
