<div id="comment-{{ $comment->id }}">
    <div class="comment-wrapper d-flex {{ $comment->depth_class }} mb-4">
        <div class="comment-avatar-wrapper me-3">
            <img src="{{ $comment->avatar }}" class="avatar rounded-circle" alt="">
        </div>
        <div class="comment-entry d-flex flex-column align-items-start flex-grow-1">
            <div class="name-and-date-time d-flex mb-2">
                <h6 class="h6 name me-3 mb-0 text-capitalize">{{ $comment->name }}</h6>
                <p class="date-time text-secondary mb-0">{{ $comment->updated_at }}</p>
            </div>
            <p class="content mb-2">{{ $comment->content }}</p>
            <div class="d-flex align-items-center mb-2">
                {{-- Reply Btn --}}
                <a href="#" class="reply text-dark text-decoration-none border-bottom me-3" data-reply-form="#reply-form-{{ $comment->id }}" >Reply</a>
                {{-- Edit Btn --}}
                @if (!empty(auth()->user()) && auth()->user()->is_admin)
                    <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" target="_blank" class="edit text-danger text-decoration-none border-bottom">Edit</a>
                @endif
            </div>
            <x-comment-form :post-id="$comment->post->id" :reply-to="$comment->name" :parent="$comment->id"/>
            @if ($comment->depth == 0 && $comment->has_children)
            <a href="#comment-children-{{ $comment->id }}" class="all-reply text-decoration-none border-bottom text-dark text-capitalize" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="comment-children-{{ $comment->id }}">
                all reply <i class="fas fa-angle-down ms-1"></i>
            </a>
            @endif 
        </div>
    </div>

    @if ($comment->has_children)

        {{-- collapse if comment parent depth equal 0 --}}
        @php
            $collapse = ''; $id = '';
            if ($comment->depth == '0') {
                $collapse = 'collapse';
                $id = 'comment-children-'.$comment->id;
            }
        @endphp

        <div class="comment-children {{ $collapse }}" id="{{ $id }}">
            @foreach ($comment->children as $child)
                <x-comment :comment="$child"/>
            @endforeach 
        </div>
    @endif
</div>