<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Handlers\Website\Blog\IndexHandler as BlogIndexHandler;
use App\Handlers\Website\Blog\SingleHandler as BlogSingleHandler;
use App\Handlers\Website\Blog\CommentHandler as BlogCommentHandler;

class BlogController extends \App\Http\Controllers\Controller
{
    public $api = false;

    public function __construct() {
        // $this->middleware(['auth']);
        parent::__construct();
    }

    /**
     * Display a listing of the Account Orders.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category_id = null)
    {
        return BlogIndexHandler::handler($request, $category_id, $this->api);
    }

    /**
     * Display a listing of the Account Orders.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $post_id = null)
    {
        return BlogSingleHandler::handler($request, $post_id, $this->api);
    }

    /**
     * Display a listing of the Account Orders.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $post_id = null)
    {
        return BlogCommentHandler::handler($request, $post_id, $this->api);
    }
}
