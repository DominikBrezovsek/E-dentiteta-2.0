@extends('layout')

@section('content')
    <div class="cards-about">
        <div class="cards-header">
            <div>
                <h1>Seznam kartic organizacije</h1>
            </div>
            <div>
                <a href="{{ route('organisation.card.add')}}">
                    <div class="btn-add-card">
                        Dodaj kartico
                    </div>
                </a>
            </div>
        </div>
        <div class="cards-table">
            <table class="table">
                <tr>
                    <th>Ime kartice</th>
                    <th>Upravljanje s kartico</th>
                    <th>Dejanja</th>
                </tr>

                @if (!$data->isEmpty())

                    @if (count($data) > 0)
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row?->name }}</td>
                                <td><a href="{{ route('organisation.card', ['cardId' => $row?->id]) }}"
                                       class="btn-edit">Uredi</a></td>
                                <td>
                                    <form action="{{ route('organisation.card.delete', ['cardId' => $row?->id]) }}"
                                          method="POST" class="delete-form">
                                        @method('DELETE')
                                        @csrf
                                        <div class="delete-button">
                                            <button type="button" class="btn-delete"
                                                    onclick="confirmDelete(event, this.parentNode.parentNode)">
                                                Izbriši
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="4" class=".text-center">Ni podatkov o karticah</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <script>
        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                title: "Izbris kartice?",
                text: "Ste prepričani, da želite izbrisati to kartico? Dejanja ni mogoče razveljaviti.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Izbriši kartico",
                cancelButtonText: "Prekliči izbris",
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection
