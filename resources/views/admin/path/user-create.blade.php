@extends('admin.layout.main')

@section('main-content')
<div class="row">
    <div class="col col-lg-8 mx-auto">
        <div id="user-create-edit">
            <div class="card">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h4 class="h4 text-capitalize">Create user</h4>
                    </div>
                    <div class="card-body">
                        <div class="avatar-wrapper w-100">
                            <div class="avatar-preview">
                                <img src="{{ $placeholder }}" alt="" class="avatar img-thumbnail mb-3">
                            </div>
                            <a href="#" class="remove-avatar mb-3 me-3 btn btn-secondary">Remove</a>
                            <button type="button" class="upload btn btn-success mb-3">Change</button>
                            <input type="file" name="avatar" hidden>
                            <input type="hidden" name="avatar_id">
                        </div>
                        <input type="text" class="form-control mb-3" name="name" placeholder="User name *" value="{{ old('name') }}" require>
                        @error('name')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <p class="m-0">{{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email *" value="{{ old('email') }}"require>
                        @error('email')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <p class="m-0">{{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror
                        <input type="password" name="password" class="form-control mb-3" placeholder="Password *" require>
                        @error('password')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <p class="m-0">{{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror
                        <input type="password" name="password_again" class="form-control mb-3" placeholder="Password again *" require>
                        @error('password_again')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <p class="m-0">{{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror
                        <select name="role_id" class="form-select mb-3">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" >{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <p class="m-0">{{ $message }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @enderror
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success my-1">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection