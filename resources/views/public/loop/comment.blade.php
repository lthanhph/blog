@foreach ($comments as $comment)
    <x-comment :comment="$comment" />
@endforeach

{{-- Comment Pagination --}}
{{-- $comments->links('vendor.pagination.bootstrap-4', ['use_ajax' => true]) --}}