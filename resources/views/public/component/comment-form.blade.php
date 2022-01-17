@php 
    if (empty($parent)) {
        $form_id = 'comment-form';
        $form_class = '';
    } else {
        $form_id = 'reply-form-'.$parent;
        $form_class = 'reply-form';
    }
@endphp
<div id="{{ $form_id }}" class="w-100 my-2 {{ $form_class }}">
    <form action="{{ route('comment.store') }}" method="post">
        @if ($replyTo)
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="title display-6 mb-4">Reply to <span class="text-capitalize">{{ $replyTo }}</span></h6>
            <a href="#" class="cancel text-dark text-decoration-none">Cancel reply</a>
        </div>
        @else
            <h3 class="display-3 mb-4">Leave a comment</h3>
        @endif
        @csrf
        <input type="hidden" name="post_id" class="form-control" value="{{ $postId }}">
        @if ($parent)
            <input type="hidden" name="parent" value="{{ $parent }}">
        @endif
        <div class="row">
            @auth 
                <input type="hidden" name="user_id" class="form-control" value="{{ auth()->id() }}">
                <input type="hidden" name="name" class="form-control" value="{{ auth()->user()->name }}">
                <input type="hidden" name="email" class="form-control" value="{{ auth()->user()->email }}">
            @endauth

            @guest 
                <div class="col-md-6 mb-3">
                    @php $guest_name = session()->has('guest.name') ? session('guest.name')[0] : ''; @endphp
                    <input type="text" class="form-control" name="name" placeholder="Name *" value="{{ $guest_name }}" require>
                </div>
                <div class="col-md-6 mb-3">
                    @php $guest_email = session()->has('guest.email') ? session('guest.email')[0] : ''; @endphp
                    <input type="email" name="email" class="form-control" placeholder="Email *" value="{{ $guest_email }}" require>
                </div>
            @endguest
            <div class="col mb-3">
                <textarea name="content" rows="7" class="form-control" placeholder="Comment" require></textarea>
            </div>
            @guest
            <div class="d-flex">
                @php $checked = session()->has('guest.save') ? session('guest.save')[0] : ''; @endphp
                <input type="checkbox" name="save" class="form-check-input mb-3 me-2" value="1" {{ $checked }}>
                <label class="form-check-lable user-select-none">Save my name, email in this browser for the next time I comment</label>
            </div>
            @endguest
            <div class="">
                <button type="submit" class="btn btn-lg btn-success d-inline-block align-self-start">Post Comment</button>
            </div>
        </div>
    </form>
</div>