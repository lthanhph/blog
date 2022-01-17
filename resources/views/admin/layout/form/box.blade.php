<div {{ $attributes->merge(['class' => 'card '.$boxName]) }} >
    <div class="card-header">
        <h5 class="h5">{{ $header }}</h5>
    </div>
    <div {{ $body->attributes->merge(['class' => 'card-body']) }} >
        {{ $body }}
    </div>
</div>