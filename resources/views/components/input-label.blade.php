@props(['label', 'disabled' => false])

<label class="form-label required"> {{ $label ?? $slot }}</label>
<input {{ $disabled ? 'disabled' : '' }} class="form-control">
