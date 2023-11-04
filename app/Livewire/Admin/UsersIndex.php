<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{


    use WithPagination;

    public $search;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $searchTerm = '%'.$this->search.'%';
        $users = User::where('name', 'LIKE', $searchTerm)
        ->orWhere('email', 'LIKE', $searchTerm)
                    ->paginate(3);

        return view('livewire.admin.users-index',compact('users'));
    }
}
