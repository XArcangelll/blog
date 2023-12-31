<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()   {

        $searchTerm = '%'.$this->search.'%';

        if(auth()->user()->roles->pluck("id")->contains(1)){
            $posts = Post::where('name', 'LIKE', $searchTerm)->latest('id')->paginate(8);
        }else{
            
        $posts = Post::where('user_id',auth()->user()->id)->where('name', 'LIKE', $searchTerm)->latest('id')->paginate(8);
        }




        return view('livewire.admin.posts-index',compact('posts'));
    }
}
