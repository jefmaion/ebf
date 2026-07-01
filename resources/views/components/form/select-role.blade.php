<select class="form-select" name="{{$name}}">
    <option ></option>
    @foreach($roles as $role)
    <option value="{{ $role->name }}">{{ $role->name }}</option>
    @endforeach
</select>