
<!-- Modal -->
<div class="modal fade" id="model_feedback_form" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between text-primary">
                    <h5 class="modal-title">Feedback</h5>
                    <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('feedback') }}" method="POST"  class="clearfix" style="font-size:16px;">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{ (isset($post) && $post && $post->post_id)? $post->post_id: request('post_id') }}">
                    
                    <div class="bg-white mt-4">
                        <div class="clearfix">
                            <div class="form-group">
                                <!-- <label class="font-weight-bold mb-1" for="feedback">Message</label> -->
                                <textarea type="text" rows="3" class="form-control {{ $errors->has('feedback')? 'is-invalid': null }}" name="feedback" placeholder="Enter your feedback" id="_input_feedback">{{ old('feedback')? old('feedback'): null }}</textarea>
                                <div class="invalid-feedback" id="_input_help_feedback">{{ $errors->has('feedback')? $errors->first('feedback'): null }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->