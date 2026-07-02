<x-form.select {{ $attributes}}>
    @foreach($genders as $key => $gender)
        <option value="{{ $key }}">{{ $gender }}</option>
    @endforeach
</x-form.select>