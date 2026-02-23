<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Clients extends Component 
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $clients = Post::where('post_type_id','client')->where('post_status',1)->paginate(6,['*']);
        return view('livewire.home.clients',['clients'=>$clients]);
    }
}
