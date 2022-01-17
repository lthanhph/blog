@extends('admin.layout.main')

@section('main-content')
    <x-post-create-edit :post="$post" :route="route('post.update', ['post' => $post->id])" method="PUT" />
@endsection