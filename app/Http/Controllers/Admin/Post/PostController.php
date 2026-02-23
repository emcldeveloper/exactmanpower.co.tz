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
namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Models\PostViewType;
use App\Models\PostViewCustomPosition;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Handlers\Admin\Post\Post\IndexSHandler as PostIndexHandler;
use App\Handlers\Admin\Post\Post\CreateHandler as PostCreateHandler;
use App\Handlers\Admin\Post\Post\StoreHandler as PostStoreHandler;
use App\Handlers\Admin\Post\Post\ShowHandler as PostShowHandler;
use App\Handlers\Admin\Post\Post\EditHandler as PostEditHandler;
use App\Handlers\Admin\Post\Post\UpdateHandler as PostUpdateHandler;
use App\Handlers\Admin\Post\Post\DeleteHandler as PostDeleteHandler;

class PostController extends \App\Http\Controllers\Controller
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
     * Display a listing of the Posts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $post_type_id = null, $api = false)
    { 
        return PostIndexHandler::handler($request, $post_type_id, $api);
    }

    /**
     * Display a listing of the Posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function api_index(Request $request, $post_type_id = null)
    {
        // get data from index method on this class
        return $this->index($request, $post_type_id,  true);
    }

    /**
     * Show the form for creating a new Posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $post_type_id = null)
    {
        return PostCreateHandler::handler($request, $post_type_id);
    }

    /**
     * Store a newly created Posts in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_type_id = null)
    {
        return PostStoreHandler::handler($request, $post_type_id);
    }

    /**
     * Display the specified Posts.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $post_type_id = null, $id = null)
    {
        return PostShowHandler::handler($request, $post_type_id, $id);
    }

    /**
     * Show the form for editing the specified Posts.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $post_type_id = null, $id = null)
    {
        return PostEditHandler::handler($request, $post_type_id, $id);
    }

    /**
     * Update the specified Posts in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_type_id = null, $id = null)

    {
        return PostUpdateHandler::handler($request, $post_type_id, $id);
    }

    public function comment(Request $request, $post_type_id = null, $id = null)

    {
        return PostUpdateHandler::comment($request, $post_type_id, $id);
    }

    /**
     * Remove the specified Posts from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $post_type_id = null, $id = null)
    {
        return PostDeleteHandler::handler($request, $post_type_id, $id);
    }

    /**
     * Remove the specified Posts from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $status_code = null, $id = null)
    {
        return PostStatusHandler::handler($request, $status_code, $id);
    }

    public function view_type(Request $request, $view_type){
        $view_type = PostViewType::where('user_id',Auth::user()->id)->first();
        if($view_type->status == 1){
            $status = 0;
        } else {
            $status = 1;
        }
        $change_list_view = PostViewType::updateOrCreate(
            ['user_id'=>Auth::user()->id],
            ['status'=> $status]
        );
        return redirect()->back();
    }

    public function custom_arrangement(Request $request, $post_type_id, $id = null){

        $year = $request->destination_number+Carbon::now()->format('Y');
        $updated = $year.'-08-18 18:53:27';
        //$updated = $year.'-'.Carbon::now()->format('m').'-'.Carbon::now()->format('d').' '.Carbon::now()->format('h:m:s');
        $check = Post::where('custom_view_number',$request->destination_number)->where('post_type_id',$post_type_id)->first();

        if(isset($check)){
            $findId = Post::where('post_id',$request->post_id)->first();
            $check->update(['custom_view_number'=>$findId->custom_view_number]);
            $findId->update(['custom_view_number'=>$request->destination_number]);
            return redirect()->back();
        } else {
            $set_custom_view = Post::updateOrCreate(
                ['post_id'=>$request->post_id],
                ['updated_at'=>$updated, 'custom_view_number'=>$request->destination_number]
            );
            return redirect()->back();
        }  
    }
}