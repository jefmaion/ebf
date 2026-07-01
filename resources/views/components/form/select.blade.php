@props(['disabled' => false])
<select @disabled($disabled) {{ $attributes->merge(['class' => 'form-control '.($errors->has($attributes->get('name')) ?
' is-invalid' : '')]) }}>
    {{$slot}}
</select>
@error($attributes->get('name'))<div class="invalid-feedback">{{ $message }}</div>@enderror