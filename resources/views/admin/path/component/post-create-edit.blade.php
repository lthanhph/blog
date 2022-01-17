@php 
    $title = isset($post->title) ? $post->title : '';
    $content = isset($post->content) ? $post->content : '';
    $user_name = isset($post->user->name) ? $post->user->name : '';
    $updated_at = isset($post->updated_at) ? $post->updated_at : '';
    $thumbnail_id = isset($post->thumbnail_id) ? $post->thumbnail_id : '';
    $thumbnail_url = isset($post->thumbnail) ? $post->thumbnail : $placeholder;
    $post_categories = isset($post->categories) ? $post->categories : [];
    $post_tags = isset($post->tags) ? $post->tags : [];
@endphp

<x-form-layout id="post-create-edit" :route="$route" method="{{ $method }}">
    <x-slot name="title" class="mb-4">Post Edit</x-slot>

            <x-form-input name="title" id="title" label="Title" placeholder="Title" class="form-control-lg mb-3" value="{{ $title }}" required />
            <x-form-textarea name="content" id="content" label="Content" placeholder="Content" required>{{ $content }}</x-form-textarea>

            <x-slot name="status">
                <p><strong class="text-capitalize">user: </strong>{{ $user_name }}</p>
                <p><strong class="text-capitalize">last update: </strong>{{ $updated_at }}</p>
            </x-slot>

            <x-slot name="side">

                <x-form-box box-name="thumbnail-box">
                    <x-slot name="header">Thumbnail</x-slot>
                    <x-slot name="body">
                        <button class="upload btn btn-success">Upload</button>
                        <input type="file" name="thumbnail" class="form-control d-none">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="thumbnail_id" class="form-control" value="{{ $thumbnail_id }}">
                        <div class="thumbnail-preview">
                            <img class="img-thumbnail" src="{{ $thumbnail_url }}">
                        </div>
                        <a href="#" class="remove-thumbnail">Remove thumbnail</a>
                    </x-slot>
                </x-form-box>

                <x-form-box box-name="category-box">
                    <x-slot name="header">Category</x-slot>
                    <x-slot name="body" class="d-flex flex-column">
                        @if (!empty($categories))
                            @foreach ($categories as $origin_cate)
                                <div class="input-wrapper">
                                    @php
                                        $checked = '';
                                        if (!empty($post_categories)) {
                                            foreach ($post_categories as $post_cate) {
                                                if ($post_cate->id == $origin_cate->id) {
                                                    $checked = 'checked';
                                                    break;
                                                }
                                            }
                                        }
                                    @endphp
                                    <input type="checkbox" class="form-check-input" name="category_ids[]" id="{{ 'category_'.$origin_cate->id }}" value="{{ $origin_cate->id }}" {{ $checked }}>
                                    <label for="{{ 'category_'.$origin_cate->id }}" class="form-check-label ms-1 text-capitalize user-select-none">{{ $origin_cate->title }}</label>
                                </div>
                            @endforeach
                        @endif
                    </x-slot>
                </x-form-box>

                <x-form-box box-name="tag-box">
                    <x-slot name="header">Tag</x-slot>
                    <x-slot name="body">
                        <div class="input-group">
                            <input type="text" list="tag-list" name="tag" class="form-control" placeholder="Tag">
                            <button class="add btn btn-success">Add</button>
                        </div>
                        <datalist id="tag-list">
                            @foreach ($tags as $t)
                                <option class="text-upper" value="{{ $t->title }}" data-tag-id="{{ $t->id }}">
                            @endforeach
                        </datalist>
                        <div class="tag-added d-flex mt-3 flex-wrap">
                            @if (!empty($post_tags)) 
                                @foreach ($post_tags as $tag)
                                    <x-tag :title="$tag->title" />
                                @endforeach
                            @endif
                        </div>
                    </x-slot>
                </x-form-box>

            </x-slot>

</x-form-layout>
