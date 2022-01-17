<label for="{{ $attributes->get('id') }}" class="form-label text-capitalize">{{ $label }}</label>
<input {{ $attributes->merge(['type' => 'text', 'class' => 'form-control mb-2']) }}>