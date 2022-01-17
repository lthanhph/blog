<div class="tag-wrapper">
    <span class="tag badge bg-success me-2 mt-2 user-select-none">
        {{ $title }}
        <i class="remove text-light fas fa-times ms-2"></i>
    </span>
    <input type="hidden" name="tag_titles[]" value="{{ $title }}">
</div>