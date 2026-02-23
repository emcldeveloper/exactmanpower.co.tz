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
namespace App\Http\Controllers\Admin\ManageUser;

use App\Models\Log;
use Illuminate\Http\Request;

use App\Handlers\Admin\ManageUser\Log\IndexHandler as LogIndexHandler;
use App\Handlers\Admin\ManageUser\Log\CreateHandler as LogCreateHandler;
use App\Handlers\Admin\ManageUser\Log\StoreHandler as LogStoreHandler;
use App\Handlers\Admin\ManageUser\Log\ShowHandler as LogShowHandler;
use App\Handlers\Admin\ManageUser\Log\EditHandler as LogEditHandler;
use App\Handlers\Admin\ManageUser\Log\UpdateHandler as LogUpdateHandler;
use App\Handlers\Admin\ManageUser\Log\DeleteHandler as LogDeleteHandler;

class LogController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Logs controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Logs.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return LogIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Logs.
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
     * Show the form for creating a new Logs.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return LogCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Logs in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return LogStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return LogShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return LogEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Logs in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return LogUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Logs from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return LogDeleteHandler::handler($request, $id, $this->api);
    }
}
