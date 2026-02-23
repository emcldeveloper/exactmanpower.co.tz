<?php
/**
 * App is un application where user can upload pictures 
 * for printing and will be deliverd to there location
 *
 * PHP version 7
 *
 * @category Application
 * @package  App
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 */        
namespace App\Http\Controllers\Admin\Post;

use App\Models\PostComment;
use Illuminate\Http\Request;

use App\Handlers\Admin\Post\PostComment\IndexHandler as PostCommentIndexHandler;
use App\Handlers\Admin\Post\PostComment\CreateHandler as PostCommentCreateHandler;
use App\Handlers\Admin\Post\PostComment\StoreHandler as PostCommentStoreHandler;
use App\Handlers\Admin\Post\PostComment\ShowHandler as PostCommentShowHandler;
use App\Handlers\Admin\Post\PostComment\EditHandler as PostCommentEditHandler;
use App\Handlers\Admin\Post\PostComment\UpdateHandler as PostCommentUpdateHandler;
use App\Handlers\Admin\Post\PostComment\DeleteHandler as PostCommentDeleteHandler;

class PostCommentController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Post Comments controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Post Comments.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PostCommentIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Post Comments.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function api_index(Request $request)
    {
        // get data from index method on this class
        return $this->index($request, true);
    }

    /**
     * Show the form for creating a new Post Comments.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return PostCommentCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Post Comments in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return PostCommentStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Post Comments.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return PostCommentShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Post Comments.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return PostCommentEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Post Comments in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return PostCommentUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Post Comments from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return PostCommentDeleteHandler::handler($request, $id, $this->api);
    }
}
