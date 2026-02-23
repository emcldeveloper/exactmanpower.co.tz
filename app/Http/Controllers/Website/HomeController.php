<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;

use App\Handlers\Website\Home\HomeHandler as HomeHomeHandler;
use App\Handlers\Website\Home\PageHandler as HomePageHandler;
use App\Handlers\Website\Home\SubscribeHandler as HomeSubscribeHandler;
use App\Handlers\Website\Home\SwitchLanguegeHandler as HomeSwitchLanguegeHandler;
use App\Handlers\Website\Home\DownloadHandler as HomeDownloadHandler;

use App\Handlers\Website\Home\AboutHandler as HomeAboutHandler;
use App\Handlers\Website\Home\TeamHandler as HomeTeamHandler;
use App\Handlers\Website\Home\TeamSingleHandler as HomeTeamSingleHandler;
use App\Handlers\Website\Home\StoriesHandler as HomeStoriesHandler;
use App\Handlers\Website\Home\StoriesSingleHandler as HomeStoriesSingleHandler;
use App\Handlers\Website\Home\ServicesHandler as HomeServicesHandler;
use App\Handlers\Website\Home\ServicesSingleHandler as HomeServicesSingleHandler;


class HomeController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Posts controller
        // $this->middleware(['auth']);
    }

    public function welcome(Request $request)
    {
        return view('components.welcome');
    }

    /**
     * Display a listing of the Posts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        return HomeHomeHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        $data = [];

        return view('website.home.contact', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact_store(Request $request)
    {
        $data = [];

        return redirect()->back();
    }


    /**
     * Display a listing of the Account Orders.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function page(Request $request, $slug = null)
    {
        return HomePageHandler::handler($request, $slug, $this->api);
    }
    

    /**
     * Display a listing of the Account Orders.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        return HomeSubscribeHandler::handler($request, $this->api);
    }

    //switch_languege
    /**
     * Display a listing of the Account Orders.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function switch_languege(Request $request, $lang = 'sw')
    {
        return HomeSwitchLanguegeHandler::handler($request, $lang, $this->api);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request, $file)
    {
        return HomeDownloadHandler::handler($request, $file, $this->api);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about(Request $request)
    {
        return HomeAboutHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team(Request $request)
    {
        return HomeTeamHandler::handler($request, $this->api);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team_single(Request $request, $slug)
    {
        return HomeTeamSingleHandler::handler($request, $slug, $this->api);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stories(Request $request)
    {
        return HomeStoriesHandler::handler($request, $this->api);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stories_single(Request $request, $slug)
    {
        return HomeStoriesSingleHandler::handler($request, $slug, $this->api);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function services(Request $request)
    {
        return HomeServicesHandler::handler($request, $this->api);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function services_single(Request $request, $slug)
    {
        return HomeServicesSingleHandler::handler($request, $slug, $this->api);
    }
    
}
