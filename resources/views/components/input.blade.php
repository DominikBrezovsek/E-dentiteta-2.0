<div class="inputs">
    <input type="{{ $type }}"
           class="input {{ isset($errorMessaage) ? 'is-invalid' : ''}} {{$faClass}}"
           id="{{ $name }}"
           name="{{ $name }}"
           placeholder="{!! $icon !!}"
           value="{{ old($name, $value ?? '') }}"
           autocomplete="off"
           {{ isset($readonly) && $readonly ? 'readonly' : '' }}
    >

    @error($name)
        <div class="alert alert-danger auto-dismiss" popover>{{ $message }}</div>
    @enderror


</div>
