<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostViewsAnalysis;


class ApproachController extends \App\Http\Controllers\Controller
{
    /**
     * This function run first automatic before any other function
     */
    public function __construct() {
        parent::__construct();
        // Run middleware for Posts controller
        // $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ad_hoc_hr_services(Request $request, $approach)
    {

        $approach = Post::find($approach);
        $data = [];
        $data['approach'] = $approach;
        //dd($approach->post_id);
        $analysis = PostViewsAnalysis::create(
            ['post_id'=>$approach->post_id,'visitor_ip'=>$request->ip()]
        );

        return view('website.approach.general', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function out_sourced_hr_services(Request $request)
    {
        $data = [];

        return view('website.approach.out-sourced-hr-services', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function retained_hr_services(Request $request)
    {
        $data = [];

        return view('website.approach.retained-hr-services', $data);
    }
    

    
}
