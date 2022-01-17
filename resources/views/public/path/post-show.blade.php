@extends('public.layout.main')

@section('main-content')
    <div id="post-show" class="container py-5">
        <div class="post-title mt-5">
                <h1 class="display-1">{{ $post->title }}</h1>
            </div>
        @if ($post->hasThumbnail())
        <div class="post-thumbnail img-thumbnail mt-5 w-100">
            <img src="{{ $post->thumbnail }}" class="w-100" alt="">
        </div>
        @endif
        <div class="row">
            <div class="col col-lg-8 mx-auto">
                <div class="post-content mt-5">
                    <p>{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="post-comment" class="container">
        <div class="row">
            <div class="col col-lg-8 mx-auto">

                {{-- Comment Loop --}}
                @if ($post->has_comment)
                    <div id="comment-loop">
                    <h2 class="h2 comment-numner mb-5">{{ $post->comment_number }} Comment</h2>
                        <div class="comment-loop-wrapper position-relative">
                            @include('public.loop.comment', [
                                'comments' => $post->comment()->where('depth', 0)->limit(5)->get(),
                            ])
                        </div>
                    </div>
                    <x-loadmore :route="route('comment.loadmore', ['post' => $post->id])" element=".comment-loop-wrapper" :total="$post->comment_number" limit="5" offset="5" />
                @endif

                {{-- Comment Form --}}
                <x-comment-form :post-id="$post->id" reply-to="" parent=""/>
            </div>
        </div>
    </div>

@endsection