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

use App\Models\Location;
use Illuminate\Http\Request;

use App\Handlers\Admin\Setting\Location\IndexHandler as LocationIndexHandler;
use App\Handlers\Admin\Setting\Location\CreateHandler as LocationCreateHandler;
use App\Handlers\Admin\Setting\Location\StoreHandler as LocationStoreHandler;
use App\Handlers\Admin\Setting\Location\ShowHandler as LocationShowHandler;
use App\Handlers\Admin\Setting\Location\EditHandler as LocationEditHandler;
use App\Handlers\Admin\Setting\Location\UpdateHandler as LocationUpdateHandler;
use App\Handlers\Admin\Setting\Location\DeleteHandler as LocationDeleteHandler;

class LocationController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Locations controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Locations.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return LocationIndexHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the Locations.
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
     * Show the form for creating a new Locations.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return LocationCreateHandler::handler($request, $this->api);
    }

    /**
     * Store a newly created Locations in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return LocationStoreHandler::handler($request, $this->api);
    }

    /**
     * Display the specified Locations.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        return LocationShowHandler::handler($request, $id, $this->api);
    }

    /**
     * Show the form for editing the specified Locations.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        return LocationEditHandler::handler($request, $id, $this->api);
    }

    /**
     * Update the specified Locations in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        return LocationUpdateHandler::handler($request, $id, $this->api);
    }

    /**
     * Remove the specified Locations from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        return LocationDeleteHandler::handler($request, $id, $this->api);
    }
}
