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

use App\Models\UserLog;
use Illuminate\Http\Request;

use App\Handlers\Admin\ManageUser\UserLog\IndexHandler as UserLogIndexHandler;
use App\Handlers\Admin\ManageUser\UserLog\CreateHandler as UserLogCreateHandler;
use App\Handlers\Admin\ManageUser\UserLog\StoreHandler as UserLogStoreHandler;
use App\Handlers\Admin\ManageUser\UserLog\ShowHandler as UserLogShowHandler;
use App\Handlers\Admin\ManageUser\UserLog\EditHandler as UserLogEditHandler;
use App\Handlers\Admin\ManageUser\UserLog\UpdateHandler as UserLogUpdateHandler;
use App\Handlers\Admin\ManageUser\UserLog\DeleteHandler as UserLogDeleteHandler;

class UserLogController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for User Logs controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the User Logs.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserLogIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the User Logs.
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
     * Show the form for creating a new User Logs.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return UserLogCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created User Logs in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserLogStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified User Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return UserLogShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified User Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return UserLogEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified User Logs in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return UserLogUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified User Logs from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return UserLogDeleteHandler::handler($request, $id, $this->api);
    }
}
