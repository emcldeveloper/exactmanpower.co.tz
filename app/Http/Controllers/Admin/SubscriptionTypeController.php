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

use App\Models\SubscriptionType;
use Illuminate\Http\Request;

use App\Handlers\Admin\SubscriptionType\IndexHandler as SubscriptionTypeIndexHandler;
use App\Handlers\Admin\SubscriptionType\CreateHandler as SubscriptionTypeCreateHandler;
use App\Handlers\Admin\SubscriptionType\StoreHandler as SubscriptionTypeStoreHandler;
use App\Handlers\Admin\SubscriptionType\ShowHandler as SubscriptionTypeShowHandler;
use App\Handlers\Admin\SubscriptionType\EditHandler as SubscriptionTypeEditHandler;
use App\Handlers\Admin\SubscriptionType\UpdateHandler as SubscriptionTypeUpdateHandler;
use App\Handlers\Admin\SubscriptionType\DeleteHandler as SubscriptionTypeDeleteHandler;

class SubscriptionTypeController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Subscription Types controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Subscription Types.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return SubscriptionTypeIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Subscription Types.
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
     * Show the form for creating a new Subscription Types.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return SubscriptionTypeCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Subscription Types in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return SubscriptionTypeStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Subscription Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return SubscriptionTypeShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Subscription Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return SubscriptionTypeEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Subscription Types in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return SubscriptionTypeUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Subscription Types from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return SubscriptionTypeDeleteHandler::handler($request, $id, $this->api);
    }
}
