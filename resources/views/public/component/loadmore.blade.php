<form action="{{ $route }}" method="post" class="loadmore-form w-100 text-center" data-element="{{ $element }}">
    @csrf
    <input type="hidden" name="offset" value="{{ $offset }}">
    <input type="hidden" name="limit" value="{{ $limit }}">
    <input type="hidden" name="total" value="{{ $total }}">
    <button type="button" class="loadmore btn btn-success btn-lg">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Load more ...
    </button>
</form>