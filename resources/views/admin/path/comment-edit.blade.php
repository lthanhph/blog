@extends('admin.layout.main')

@section('main-content')
<x-form-layout id="comment-edit" :route="route('comment.update', ['comment' => $comment->id])" method="PUT">
    <x-slot name="title" class="mb-4">Edit Comment</x-slot>

    <x-form-input type="text" name="name" id="name" label="Name" placeholder="Name" class="mb-3" value="{{ $comment->name }}" required />
    <x-form-input type="email" name="email" id="email" label="Email" placeholder="Email" class="mb-3" value="{{ $comment->email }}" required /> 
    <x-form-textarea name="content" id="content" label="Content" required="{{ true }}">{{ $comment->content }}</x-form-textarea>

    <x-slot name="status">
        <p><strong class="text-capitalize">post: </strong>{{ $comment->post->title }}</p>
        <p><strong class="text-capitalize">reply to: </strong>{{ $comment->parent_name }}</p>
        <p><strong class="text-capitalize">last update: </strong>{{ $comment->updated_at }}</p>
    </x-slot>


    <x-slot name="side">{{-- Side --}}</x-slot>
</x-form-layout>
@endsection