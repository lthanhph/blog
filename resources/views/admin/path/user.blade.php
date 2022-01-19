@extends('admin.layout.main')

@section('main-content')
<div id="user-manager" class="manager h-100">
    <a href="{{ route('user.create') }}" class="create btn btn-success btn-lg">
        <i class="fas fa-plus"></i> Create
    </a>
    <div class="table-wrapper w-100 h-100">
        @include('admin.path.table.user')
    </div>

    {{-- Delete Popup --}}
    <x-delete-popup />
</div>

@endsection