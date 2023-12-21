@props(['label', 'for', 'required' => false])

<label for={{$for}} class="form-label {{$required ? 'required' : '' }}"> {{ $label ?? $slot }}</label>
