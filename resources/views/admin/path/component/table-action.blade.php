<td class="td-action">
                        <div class="dropdown">
                            <button class="btn bg-transparent" id="table-action-{{ $index }}" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="table-action-{{ $index }}">
                            @if ($routeShow)
                            <li class="dropdown-item">
                                <a href="{{ $routeShow }}" target="_blank"  class="text-decoration-none text-dark d-block">Preview</a>
                            </li>
                            @endif
                            <li class="dropdown-item">
                                <a href="{{ $routeEdit }}" class="edit text-dark me-3 d-block">
                                    {{-- <i class="fas fa-edit"></i> --}} Edit
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <form action="{{ $routeDestroy }}" method="post" class="delete-form d-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete text-danger p-0 w-100 h-100 text-start" data-bs-toggle="modal" data-bs-target="#delete-popup">
                                        {{-- <i class="fas fa-trash-alt me-1"></i> --}} Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                        </div>
                    </td>