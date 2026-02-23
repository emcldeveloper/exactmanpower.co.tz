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
namespace App\Http\Controllers\Admin\Tag;

use App\Models\TagType;
use Illuminate\Http\Request;

use App\Handlers\Admin\Tag\TagType\IndexHandler as TagTypeIndexHandler;
use App\Handlers\Admin\Tag\TagType\CreateHandler as TagTypeCreateHandler;
use App\Handlers\Admin\Tag\TagType\StoreHandler as TagTypeStoreHandler;
use App\Handlers\Admin\Tag\TagType\ShowHandler as TagTypeShowHandler;
use App\Handlers\Admin\Tag\TagType\EditHandler as TagTypeEditHandler;
use App\Handlers\Admin\Tag\TagType\UpdateHandler as TagTypeUpdateHandler;
use App\Handlers\Admin\Tag\TagType\DeleteHandler as TagTypeDeleteHandler;

class TagTypeController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Tag Types controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Tag Types.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return TagTypeIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Tag Types.
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
     * Show the form for creating a new Tag Types.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return TagTypeCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Tag Types in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return TagTypeStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Tag Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return TagTypeShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Tag Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return TagTypeEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Tag Types in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return TagTypeUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Tag Types from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return TagTypeDeleteHandler::handler($request, $id, $this->api);
    }
}
