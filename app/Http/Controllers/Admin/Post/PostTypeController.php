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

use App\Models\PostType;
use Illuminate\Http\Request;

use App\Handlers\Admin\Post\PostType\IndexHandler as PostTypeIndexHandler;
use App\Handlers\Admin\Post\PostType\CreateHandler as PostTypeCreateHandler;
use App\Handlers\Admin\Post\PostType\StoreHandler as PostTypeStoreHandler;
use App\Handlers\Admin\Post\PostType\ShowHandler as PostTypeShowHandler;
use App\Handlers\Admin\Post\PostType\EditHandler as PostTypeEditHandler;
use App\Handlers\Admin\Post\PostType\UpdateHandler as PostTypeUpdateHandler;
use App\Handlers\Admin\Post\PostType\DeleteHandler as PostTypeDeleteHandler;

class PostTypeController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Post Types controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Post Types.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PostTypeIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Post Types.
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
     * Show the form for creating a new Post Types.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return PostTypeCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Post Types in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return PostTypeStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Post Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return PostTypeShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Post Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return PostTypeEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Post Types in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return PostTypeUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Post Types from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return PostTypeDeleteHandler::handler($request, $id, $this->api);
    }
}
