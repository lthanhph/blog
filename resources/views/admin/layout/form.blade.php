<div {{ $attributes }} >
    <form action="{{ $route }}" method="post" class="needs-validation">
        @csrf
        @method( $method )

        {{-- Error --}}
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <p class="mb-0">{{ $error }}</p>
                </div>
            @endforeach
        @endif

        <h1 {{ $title->attributes->merge(['class' => 'h1']) }}>{{ $title }}</h1>
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="status-box card">
                    <div class="card-body">
                        {{ $status }}
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                
            {{ $side }}

            </div>
        </div>
    </form>
</div>