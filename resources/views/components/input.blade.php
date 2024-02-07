<div class="inputs">
    <div>
        <i class="{{isset($faIcon) ? $faIcon : ''}}}}"></i>
    </div>
        <input type="{{ $type }}"
               class="input {{ isset($errorMessaage) ? 'is-invalid' : ''}}"
               id="{{ $name }}"
               name="{{ $name }}"
               placeholder="{{ $displayedName }}"
               value="{{ old($name, $value ?? '') }}"
               autocomplete="off"
            {{ isset($readonly) && $readonly ? 'readonly' : '' }} >
</div>


@error($name)
<div class="alert alert-danger auto-dismiss" popover>{{ $message }}</div>
@enderror
