@if(!empty($post))
    @foreach($post as $p)
        <div class="post-wrapper mb-5 shadow">
            <div class="card border-0">
                <div class="row">
                    <div class="col-md-4">
                        {{-- @if ($p->hasThumbnail()) --}}
                        <div class="post-thumbnail h-100">
                            <a href="{{ route('post.show', ['post' => $p->id]) }}" class="d-inline-block h-100">
                                <img src="{{ $p->thumbnail }}" class="rounded-start h-100 w-100" alt="">
                            </a>
                        </div>
                        {{-- @endif --}}
                    </div>
                    <div class="col-md-8">
                        <div class="card-body h-100 d-flex flex-column">
                            <div class="card-title post-title">
                                <a class="text-decoration-none text-dark" href="{{ route('post.show', ['post' => $p->id]) }}">
                                    <h3 class="h3">{{ $p->title }}</h3>
                                </a>
                            </div>
                            <div class="post-category d-flex">
                                    @foreach ($p->categories as $cate)
                                        <a href="{{ route('term.archive', ['term' => $cate->id]) }}" class="text-decoration-none">
                                            <h6 class="h6 text-capitalize me-2">
                                                <span class="badge bg-primary">
                                                    {{ $cate->title }}
                                                </span>
                                            </h6>
                                        </a>
                                    @endforeach
                            </div>
                            <div class="card-text post-content flex-grow-1">
                                <p>{{ $p->excerpt }}</p>
                            </div>
                            <div class="read-more-btn align-self-start">
                                <a href="{{ route('post.show', ['post' => $p->id]) }}" class="btn btn-success d-flex align-items-center">
                                    <p class="me-2 mb-0">Read more</p> <i class="fas fa-chevron-right my-auto"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif