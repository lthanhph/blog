@extends('admin.layout.main')

@section('main-content')
    <div id="menu-config" class="h-100">
        <div class="save-btn w-100 text-end">
            <button class="save btn btn-success float-left">Save</button>
        </div>
        <div class="row">
            <div class="col-md-6 p-4 d-flex flex-column">
                <div class="mb-3">
                    <h4 class="h4">Item: </h4>
                </div>
                
                <ul class="list-group">
                    <a href="#post-list" class="list-group-item list-group-item-action list-group-item-success" data-bs-toggle="collapse" aria-expanded="false" aria-controls="post-list">
                        Post <i class="fas fa-sort-down float-end"></i>
                    </a>
                    <div class="collapse" id="post-list">
                        <div class="card">
                            <div class="card-body item-list">
                                @foreach ($post as $p)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input me-1" name="post" id="post_{{ $p->id }}" data-url="{{ route('post.show', ['post' => $p->id]) }}" data-title="{{ $p->title }}" data-type="post" data-id="{{ $p->id }}">
                                        <label for="post_{{ $p->id }}" class="form-check-label user-select-none">{{ $p->title }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer text-end">
                                <button class="add-to-menu btn btn-secondary">Add to menu</button>
                            </div>
                        </div>
                    </div>
                    <a href="#category-list" class="list-group-item list-group-item-action list-group-item-success" data-bs-toggle="collapse" aria-expanded="false" aria-controls="category-list">
                        Category <i class="fas fa-sort-down float-end"></i>
                    </a>
                    <div class="collapse" id="category-list">
                        <div class="card">
                            <div class="card-body item-list">
                                @foreach ($category as $cate)
                                <div class="form-check">
                                    <input type="checkbox" name="category" id="category_{{ $cate->id }}" class="form-check-input me-1" data-url="{{ route('term.archive', ['term' => $cate->id]) }}" data-title="{{ $cate->title }}" data-type="category" data-id="{{ $cate->id }}">
                                    <label for="category_{{ $cate->id }}" class="form-check-label user-select-none">{{ $cate->title }}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-footer text-end">
                                <button class="add-to-menu btn btn-secondary">Add to menu</button>
                            </div>
                        </div>
                    </div>
                    <a href="#tag-list" class="list-group-item list-group-item-action list-group-item-success" data-bs-toggle="collapse" aria-expanded="false" aria-controls="tag-list">
                        Tag <i class="fas fa-sort-down float-end"></i>
                    </a>
                    <div class="collapse" id="tag-list">
                        <div class="card">
                            <div class="card-body item-list">
                                @foreach ($tag as $t)
                                    <div class="form-check">
                                        <input type="checkbox" name="tag" id="tag_{{ $t->id }}" class="form-check-input me-1" data-url="{{ route('term.archive', ['term' => $t->id]) }}" data-title="{{ $t->title }}" data-type="tag" data-id="{{ $t->id }}">
                                        <label for="tag_{{ $t->id }}" class="form-check-label user-select-none">{{ $t->title }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer text-end">
                                <button class="add-to-menu btn btn-secondary">Add to menu</button>
                            </div>
                        </div>
                    </div>
                    <a href="#custom-link" class="list-group-item list-group-item-action list-group-item-success" data-bs-toggle="collapse" aria-expanded="false" aria-controls="custom-link">
                        Custom link <i class="fas fa-sort-down float-end"></i>
                    </a>
                    <div class="collapse" id="custom-link">
                        <div class="card">
                            <div class="card-body item-list">
                                <input type="text" name="custom_link" class="form-control" placeholder="https://" data-title="custom link" data-type="custom-link">
                            </div>
                            <div class="card-footer text-end">
                                <button class="add-to-menu btn btn-secondary">Add to menu</button>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
            <div class="col-md-6 p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="h4">Menu: </h4>
                    <button class="remove-all-item btn btn-danger">Remove all</button>
                </div>
                
                <form action="{{ route('menu.update-item', ['menu' => $menu->id]) }}" method="post" class="w-100">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <div class="menu w-100 border border-secondary rounded-3 p-2">
                        <ul class="list-group" style="list-style-type: none">
                            @if ($items->isNotEmpty())
                                @foreach ($items as $item)
                                    <x-menu-item :item="$item"/>
                                @endforeach
                            @endif
                        </ul>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection