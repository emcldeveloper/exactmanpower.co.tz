@extends('permissions::layout')


@section('permissions-content')

<div class="card border-0 p-4 mb-4 ">
    <div class="w-100 mx-auto">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="mb-3">All groups</h2>
            <a href="{{ url('permissions/groups/create') }}" class="btn btn-primary"> Create</a>
        </div>
        
        <div class="row mb-3 font-weight-bold">
            <div class="col">Name</div>
            <div class="col">Destription</div>
        </div>
        <div class="clearfix">
        @foreach ($groups as $row)
            <div class="row py-2">
                <div class="col">
                    <a class="text-dark" href="{{ url('permissions/groups/edit/'.$row->group_id) }}">{{ $row->name }}</a>
                </div>
                <div class="col">{{ $row->description }}</div>
            </div>
        @endforeach
        @if($groups->count() == 0)
            <div class="text-center p-5">No groups</div>
        @endif
        </div>
    </div>  
</div>



@endsection
