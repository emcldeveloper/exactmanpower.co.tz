<div class="container-fluid  col-md-12" id="message">
    @if (Session::get('error', false))
        <div class="alert alert-danger alert-dismissible" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('error')}}
        </div>
    @endif

    @if (Session::get('warning', false))
        <div class="alert alert-warning alert-dismissible" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('warning')}}
        </div>
    @endif

    @if (Session::get('success', false))
        <div class="alert alert-success alert-dismissible " role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{Session::get('success')}}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

</div>
