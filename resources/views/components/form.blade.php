 <form class="form-main"
    action="{{ isset($existingData->id)
        ? route(
            $submitRouteName . '.update',
            array_filter([
                $variableName ?? 'default_variable_name' => $existingData->id ?? null,
                $optionalVariableName ?? null => $optionalId ?? null,
            ]),
        )
        : route(
            $submitRouteName . '.create',
            array_filter([
                $optionalVariableName ?? null => $optionalId ?? null,
            ]),
        ) }}"
    method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if (isset($existingData->id))
        @method('PUT')
    @endif

    <div class="form-inputs">
        {{ $slot }}
    </div>

    <div class="form-buttons">
        <button type="submit" class="btn btn-save">{{ $submitButtonName ?? 'Shrani' }}</button>
        @if($backRouteName != null && $backButtonName != null)
            <a href="{{ isset($optionalVariableName)
            ? route($backRouteName, [$optionalVariableName => $optionalId])
            : route($backRouteName) }}"
               class="btn btn-back" style="margin-left: 10px">{{ $backButtonName ?? 'Nazaj' }}</a>
        @endif

    </div>
 </form>
