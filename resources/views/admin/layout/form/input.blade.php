<label for="{{ $attributes->get('id') }}" class="form-label">{{ $label }}</label>
<input {{ $attributes->merge(['class' => 'form-control']) }} >
<div class="invalid-feedback">Please fill out this field.</div>