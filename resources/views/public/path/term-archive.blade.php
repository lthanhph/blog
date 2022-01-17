@extends ('public.layout.main')

@section('main-content')
<div id="term-archive" class="container">
    <h1 class="display-1 text-capitalize my-5">{{ $term->title }}</h1>
    <div class="row px-5">
        <div class="col">
            @include('public.loop.post');
            {{ $post->links() }}
        </div>
    </div>
</div>
@endsection