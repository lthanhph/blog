<div class="form-check">
    <input type="checkbox" {{ $attributes->merge(['class' => 'form-check-input mb-2']) }}>
    <label for="{{ $attributes->get('id') }}" class="form-check-label user-select-none">{{ $label }}</label>
</div>
