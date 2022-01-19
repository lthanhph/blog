@extends('admin.layout.main')

@section('main-content')
    <div id="comment-manager" class="manager w-100 h-100">
        <div class="table-wrapper w-100 h-100">
            @include('admin.path.table.comment')
        </div>
    </div>
    
<x-delete-popup />
@endsection