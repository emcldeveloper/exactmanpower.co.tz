@extends('permissions::layout')


@section('permissions-content')

<div class="card border-0 p-4 mb-4 ">
    <div class="w-100 mx-auto">
        <h2 class="mb-3">All permissions</h2>
        <div class="row mb-3 font-weight-bold">
            <div class="col">Description</div>
            <div class="col">URL</div>
        </div>
        <div class="clearfix">
        @foreach ($permissions as $row)
            <div class="row">
                <div class="col">{{ $row->description }}</div>
                <div class="col">{{ $row->name }}</div>
            </div>
        @endforeach
        </div>
    </div>  
</div>


@endsection
