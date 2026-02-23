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
namespace App\Http\Controllers\Admin;

use App\Models\Dashboard;
use Illuminate\Http\Request;

use App\Handlers\Admin\Dashboard\IndexHandler as DashboardIndexHandler;
use App\Handlers\Admin\Dashboard\CreateHandler as DashboardCreateHandler;
use App\Handlers\Admin\Dashboard\StoreHandler as DashboardStoreHandler;
use App\Handlers\Admin\Dashboard\ShowHandler as DashboardShowHandler;
use App\Handlers\Admin\Dashboard\EditHandler as DashboardEditHandler;
use App\Handlers\Admin\Dashboard\UpdateHandler as DashboardUpdateHandler;
use App\Handlers\Admin\Dashboard\DeleteHandler as DashboardDeleteHandler;

class DashboardController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Dashboard controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return DashboardIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Dashboard.
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
     * Show the form for creating a new Dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return DashboardCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Dashboard in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return DashboardStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Dashboard.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return DashboardShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Dashboard.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return DashboardEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Dashboard in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return DashboardUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Dashboard from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return DashboardDeleteHandler::handler($request, $id, $this->api);
    }
}
