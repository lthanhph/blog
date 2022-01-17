@extends('public.layout.main')

@section('main-content')
@if ($carousel_items->isNotEmpty()) 
    <div id="home-slider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
        @foreach ($carousel_items as $index => $item)
            @php 
                $active = $index == 0 ? 'active' : '';
            @endphp
            <button data-bs-target="#home-slider" data-bs-slide-to="{{ $index }}" class="{{ $active }}"></button>
        @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($carousel_items as $index => $item)
                @php 
                    $active = $index == 0 ? 'active' : '';
                @endphp
                <div class="carousel-item {{ $active }} position-relative">
                    <img src="{{ $item->thumbnail }}" alt="" class="d-block w-100">
                    <div class="banner position-absolute p-4 text-center">
                        <h2 class="title h2 text-light mb-3">{{ $item->title }}</h2>
                        <p class="excerpt text-light mb-3">{{ $item->excerpt }}</p>
                        <a href="{{ route('post.show', ['post' => $item->id]) }}" class="btn btn-lg btn-success">Read more</a>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" data-bs-target="#home-slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" data-bs-target="#home-slider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
@endif
    
    <div id="new-post" class="container">
        <h1 class="h1 text-dark text-capitalize my-5">news</h1>
        <div class="row px-5">
            <div class="col">
                <div class="post-loop w-100">
                    @include('public.loop.post')
                </div>
                <x-loadmore :route="route('post.loadmore')" element=".post-loop" offset="5" limit="5" :total="$total"/>
            </div>
        </div>
    </div>
@endsection