@extends('admin.layout.main')

@section('main-content')
<div id="post-manager" class="manager">
    <a href="{{ route('post.create') }}" class="create btn btn-success btn-lg">
        <i class="fas fa-plus"></i> Create
    </a>
    <div class="table-wrapper w-100">
        @include('admin.path.table.post')
    </div>

    {{-- delete popup --}}
    <x-delete-popup/>
</div>

@endsection