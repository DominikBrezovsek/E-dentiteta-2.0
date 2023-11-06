<div class="form-group">
    <label for="{{ $name }}">{{ $displayedName }}</label>
    <input type="{{ $type }}"
           class="form-control {{ isset($errorMessaage) ? 'is-invalid' : '' }}"
           name="{{ $name }}"
           value="{{ old($name, $value ?? '') }}"
           {{ isset($readonly) && $readonly ? 'readonly' : '' }}
    >

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>