@if ($errors->any())
    <div class="auth-error mb-3 alert alert-danger alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <p class="mb-2"><i class="fas fa-exclamation-triangle me-2"></i><strong>Whoops! Something went wrong.</strong></p>
        <ul class="m-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif