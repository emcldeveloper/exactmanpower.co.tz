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
namespace App\Http\Controllers\Admin\Setting;

use App\Models\Tag;
use Illuminate\Http\Request;

use App\Handlers\Admin\Setting\Tag\IndexHandler as TagIndexHandler;
use App\Handlers\Admin\Setting\Tag\CreateHandler as TagCreateHandler;
use App\Handlers\Admin\Setting\Tag\StoreHandler as TagStoreHandler;
use App\Handlers\Admin\Setting\Tag\ShowHandler as TagShowHandler;
use App\Handlers\Admin\Setting\Tag\EditHandler as TagEditHandler;
use App\Handlers\Admin\Setting\Tag\UpdateHandler as TagUpdateHandler;
use App\Handlers\Admin\Setting\Tag\DeleteHandler as TagDeleteHandler;

class TagController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Tags controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Tags.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return TagIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Tags.
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
     * Show the form for creating a new Tags.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return TagCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Tags in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return TagStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Tags.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return TagShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Tags.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return TagEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Tags in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return TagUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Tags from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return TagDeleteHandler::handler($request, $id, $this->api);
    }
}
