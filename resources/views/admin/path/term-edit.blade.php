@extends('admin.layout.main')

@section('main-content')
<x-form-layout route="{{ route('term.update', ['term' => $term->id]) }}" method="PUT">
    <x-slot name="title" class="mb-4">Edit {{ $term->taxonomy->name }}</x-slot>
    <x-form-input name="title" id="title" label="Title" class="form-control-lg mb-3" value="{{ $term->title }}" required />
    <x-form-textarea name="description" id="description" rows="10" label="Description" >{{ $term->description }}</x-form-textarea>

    <x-slot name="status">
        <p><strong class="text-capitalize">last update: </strong>{{ $term->updated_at }}</p>
    </x-slot>

    <x-slot name="side">{{-- Side --}}</x-slot>
</x-form-layout>
@endsection