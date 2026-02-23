<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class EditHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.home.index');
    }

    public function list()
    {
        $posts_list = Post::all();
        $data = [];
        $page_title = 'Slider';
        $data['page_title'] = $posts_list;
        return view('admin.posts.home.list',  $posts_list);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider=Post::updateOrCreate(
            ['id'=>$request->id],
            ['post_title'=>$request->post_title, 'post_type_id'=>$request->post_type_id,'post_content'=>$request->sub_title, 'event_date'=>$request->event_date, 'post_status'=>$request->post_status]
        );
        $slider2 = Post::find($slider->id);
        #dd($slider2);
        $file = \Request::file('post_featured_image');
        if ($file) {
            $path = 'uploaded/';
            $filename = uniqid(date('Hmdysi')) . '_' . $file->getClientOriginalName();
            $upload = \Request::file('post_featured_image')->move($path, $filename);
            if ($upload) {
                $slider2->post_featured_image = $filename;
            }
        }
        $slider2->update();
        $data = [];
        $data['slider'] = $slider2;
        return view('admin/posts/home/show',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider=Post::find($id);
        #dd($slider);
        $data = [];
        $page_title = 'Slider';
        $data['slider'] = $slider;
        return view('admin/posts/home/show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider=Post::find($id);
        $data = [];
        $data['slider']=$slider;
        return view('admin.posts.home.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Post::find($id);
        $slider->delete();
        return back()->with('error',$slider->post_title.' is deleted!');
    }

    public function publish($id,Request $request){
        $slider=Post::updateOrCreate(
            ['id'=>$id],
            ['post_status'=>$request->post_status]
        );
        if($request->post_status=="1")
            return back()->with('success','Slider published successful!');
        else
            return back()->with('success','Slider Un-published successful!');
        
    }
}
