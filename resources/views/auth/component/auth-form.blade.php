<div {{ $attributes->merge(['class' => 'auth-form flex-grow-1 mx-3']) }}>
    <div class="w-100 mb-4 text-center">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <h1 class="h1 text-success text-capitalize">
                <i class="brand-logo fab fa-blogger me-3"></i>personal blog
            </h1>
        </a>
    </div>

    <x-auth-error />
    <div class="cars shadow rounded mb-4" >
        <form action="{{ $route }}" method="post">
            @csrf
            @method($method)
            <div class="card-header bg-success text-center text-light">
                <h3 class="h3 text-capitalize">{{ $header }}</h3>
            </div>
            <div class="card-body px-4">{{ $body }}</div>
            <div class="card-footer d-flex justify-content-end align-items-center">{{ $footer }}</div>
        </form>
    </div>
</div>