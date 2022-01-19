@extends('admin.layout.main')

@section('main-content')
    <x-post-create-edit post="" :route="route('post.store')" method="POST"/>
@endsection