<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Team extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $team = Post::where('post_type_id','team')->where('post_status',1)->paginate(3,['*']);
        return view('livewire.home.team',['team'=>$team]);
    }
}
