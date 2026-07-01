<x-form.select {{ $attributes}}>
    @foreach($relatives as $relative)
        <option value="{{ $relative }}">{{ $relative }}</option>
    @endforeach
</x-form.select>