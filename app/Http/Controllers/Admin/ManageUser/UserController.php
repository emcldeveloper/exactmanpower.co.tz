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

use App\Models\User;
use Illuminate\Http\Request;

use App\Handlers\Admin\ManageUser\User\IndexHandler as UserIndexHandler;
use App\Handlers\Admin\ManageUser\User\CreateHandler as UserCreateHandler;
use App\Handlers\Admin\ManageUser\User\StoreHandler as UserStoreHandler;
use App\Handlers\Admin\ManageUser\User\ShowHandler as UserShowHandler;
use App\Handlers\Admin\ManageUser\User\EditHandler as UserEditHandler;
use App\Handlers\Admin\ManageUser\User\UpdateHandler as UserUpdateHandler;
use App\Handlers\Admin\ManageUser\User\DeleteHandler as UserDeleteHandler;

class UserController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Users controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Users.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Users.
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
     * Show the form for creating a new Users.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return UserCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Users in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Users.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return UserShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Users.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return UserEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Users in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return UserUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Users from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return UserDeleteHandler::handler($request, $id, $this->api);
    }
}
