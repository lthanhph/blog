@extends('admin.layout.main')

@section('main-content')
<div class="manager row h-100">
    <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('term.store') }}" method="post" class="w-100">
                    @csrf
                    <input type="hidden" name="tax_name" value="{{ $tax_name }}">
                    <x-form-input name="title" id="title" label="Title" class="mb-2" required/>
                    <x-form-textarea name="description" id="description" rows="7" label="Description" class="mb-4" ></x-form-textarea>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7">
        <div class="table-wrapper w-100 h-100">
            @include('admin.path.table.term')
        </div>
    </div>
</div>

{{-- Delete Popup --}}
<x-delete-popup />
@endsection