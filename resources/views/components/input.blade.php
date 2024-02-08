<div class="inputs">
    <div>
        <i class="{{isset($faIcon) ? $faIcon : ''}}"></i>
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
<script type="module">
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        color: "var(--text)",
        background: "var(--toast-background)",
        customClass: {
            timerProgressBar: 'progressBarToast',
            container: 'containerToast'
        },
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        /*title: "{{isset($errors->get('title')[0]) ? $errors->get('title')[0] : ''}}",*/
        text: "{{$message}}",
        icon: "error",
    })
</script>
@enderror

@if(session('message'))
    <script type="module">
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            color: "var(--text)",
            background: "var(--toast-background)",
            customClass: {
                timerProgressBar: 'progressBarToast',
                popup: 'popupToast',
                icon: 'popupIcon'
            },
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            /*title: "{{isset($errors->get('title')[0]) ? $errors->get('title')[0] : ''}}",*/
            text: "{{session('message')}}",
            icon: "success",
            iconColor: "var(--icon-color)"
        })
        </script>
@endif
