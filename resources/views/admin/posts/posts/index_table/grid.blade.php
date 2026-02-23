<div class="px-3 pb-3">
    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="row align-items-center justify-content-between m-0">
        <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
            {!! pagination_header_limit($posts_list) !!}
        </div>
        <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
            {!! pagination_header_search($posts_list) !!}
        </div>
    </div>

    <div class="px-3">
        @if(true)
        <div class="row">

        @foreach ($posts_list as $index => $row)
            <div class="col-md-4" style="padding: 1em;">
                <div class="card zoom hover-container box-shadow rounded-0 py-0 px-0 mb-1 ">
                    <div class=" align-items-center">
                        <div class="card-header" >
                            <div class="row">
                                <div class="col-md-8">
                                    {{Illuminate\Support\Str::limit($row->post_title, 27)}} 
                                </div>
                                <div class="col-md-4">
                                    <a class="btn btn-sm" style="border-radius: 30px; background-color: #FFFFFF; border: lightgrey;">
                                        <?php $counted = $row->post_view_analysis()->count(); ?>
                                        {{$counted}}   <i class="fas fa-eye text-primary"></i>       
                                    </a>
                                </div>
                            </div>


                        </div>
                            <a href="{{ url('admin/posts/'.request('post_type_id').'/show/'.$row->post_id) }}" 
                                style="background-image:url('{{ $row->image }}');min-width:170px;min-height:200px;" class="card d-block media-image  align-self-center" >
                            </a>
                        
                            <div class="row" style="padding:0em">
                                <div class="col-md-5 " style="padding-top: 0.5em; padding-left: 1.5em;">
                                    @if($row->post_status>0)
                                        <a class="btn btn-success" style="border-radius: 20px;">Published</a> 
                                    @else
                                        <a class="btn btn-primary" style="border-radius: 20px;">
                                            {{Illuminate\Support\Str::limit('Unpublished',11)}}
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-7" style="padding-top: 0.5em; padding-right: 1em;">
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-left">
                                           Created At: {{ date('d M Y', strtotime($row->created_at))}}    
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-lelf">
                                            Published At: {{ date('d M Y', strtotime($row->created_at))}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style=" padding-right: 2em;">
                                    <div class="row card-footer">
                                        <div class="col-md-2">
                                            <div class="col" style="max-width: 200em; min-width: 13em; background-color: ">
                                                @if(request('post_type_id')=='service')
                                                
                                                <!-- Button trigger modal -->
                                               
                                                <a data-toggle="modal" data-target="#arrangeGrid{{$row->post_id}}">
                                                    #{{$row->custom_view_number}}
                                                    <i class="fas fa-window-restore"></i>
                                                </a>
                                                @endif
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="col text-right" style="max-width: 500em; min-width: 0em; background-color: ">
                                                <div class="btn-group btn-group-sm">
                                                        <a href="{{ url('admin/posts/'.request('post_type_id').'/show/'.$row->post_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                                                        <a href="{{ url('admin/posts/'.request('post_type_id').'/edit/'. $row->post_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                                                        <a href="{{ url('admin/posts/'.request('post_type_id').'/delete/'. $row->post_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                                                         <a href="{{ url('admin/posts/'.request('post_type_id').'/show/' . $row->post_id . '/post-comments') }}" class="btn btn-outline-dark btn-circle  px-2 mr-2" title="More"> <i class="fas fa-comments fa-sm"></i> {{$row->post_comments()->count()}} </a>
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="arrangeGrid{{$row->post_id}}" tabindex="-1" role="dialog" aria-labelledby="arrangeGrid{{$row->post_id}}Label" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="{{ url('admin/posts/'.request('post_type_id').'/custom_view') }}">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="arrangeGrid{{$row->post_id}}Label">{{Illuminate\Support\Str::limit($row->post_title, 30)}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center">
                            <label class="" style="font-size: 3em;">
                            {{($row->custom_view_number)}}
                            </label>
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="post_id" value="{{$row->post_id}}">
                            <label>
                                Move From #{{($row->custom_view_number)}} To Your Desired Position:
                            </label>
                            <?php 
                                $options = App\Models\Post::where('post_type_id',request('post_type_id'))->get();
                                $init = $options->count();
                             ?>
                             <input type="hidden" value="{{$init}}" name="initialize_view">
                            <select class="form-control" name="destination_number">
                                <option>Select destination</option>
                                @foreach($options as $list)
                                    <?php 
                                        $destination = $loop->index + 1;
                                     ?>
                                    <option value="{{$destination}}">{{$destination}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
        @endforeach
        </div>
        @endif
        {{$posts_list->onEachSide(1)->links('pagination::bootstrap-4')}}
    </div>
</div>