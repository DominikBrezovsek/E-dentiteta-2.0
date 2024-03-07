@extends('layout')

@section('content')
<div style="padding:auto">
    <div class="cards-about">
        <div class="cards-header">
            <h1>Podatki o partnerjih</h1>
            <div>
                <a href="{{ route('sad.add-vendor') }}" class="btn btn-add-card">Dodaj partnerja</a>
            </div>
        </div>
        <div class="cards-table">
            <table class="table">
                <tr>
                    <th>Ime partnerja</th>
                    <th colspan="2">Upravljanje s partnerjem</th>
                </tr>

                @if (!$data->isEmpty())

                    @if (count($data) > 0)
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row?->name }}</td>
                                <td>
                                    <div class="options">
                                        <a href="{{ route('sad.vendor', ['vendorId' => $row->id]) }}"
                                            class="btn btn-edit">Uredi</a>
                                        <form
                                            action="{{ route('sad.vendor.delete', ['vendorId' => $row->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn-delete"
                                            onclick="deleteVendor(event, this.parentNode)">
                                                Izbriši
                                            </button>

                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="4" class="text-center">Ni podatkov o organizacijah</td>
                    </tr>
                @endif
            </table>
        </div>
        <div>
            {{$data->links('custom_vendor.pagination.default')}}
        </div>
    </div>

</div>    
    <script>
        function deleteVendor(event, form) {
            event.preventDefault();
            @isset($row)
            Swal.fire({
                title: 'Potrditev dejanja',
                text: 'Želite izbrisati partnerja {{$row->name}} ? Tega dejanja ni mogoče razveljaviti!',
                showDenyButton: true,
                denyButtonText: 'Izbriši partnerja',
                confirmButtonText: 'Prekliči',
                icon: 'warning',
            }).then((result) => {
                if (result.isDenied) {
                    form.submit();
                }
            })
            @endisset
        }
    </script>
@endsection
