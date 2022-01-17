<li class="menu-item">
    <div class="list-group-item list-group-item-action list-group-item-secondary">
        <div class="btn-group w-100 h-100 d-flex justify-content-between">
            <button type="button" class="border-0 bg-transparent h-100">
                {{ $item->title }}
            </button>
            <div class="flex-grow-1" style="cursor:move"></div>
            <button type="button" class="border-0 bg-transparent h-100" data-bs-toggle="collapse" data-bs-target="#item-config-{{ $item->id }}" aria-expanded="false" aria-controls="item-config-{{ $item->id }}">
                <i class="fas fa-sort-down float-end"></i>
            </button>
        </div>
    </div>
    <div class="collapse" id="item-config-{{ $item->id }}">
        <div class="card">
            <div class="card-body">
                <input type="text" name="item_title[]" class="form-control mb-2" placeholder="Title" value="{{ $item->title }}">
                <input type="text" name="item_url[]" class="form-control mb-2" placeholder="Url" value="{{ $item->url }}">
                <div class="remove-item text-end">
                    <button class="btn btn-danger">Remove</button>
                </div>
            </div>
        </div>
    </div>
</li>