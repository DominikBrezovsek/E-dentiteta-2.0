@extends('layout')

@section('content')
    <script>
        function searchFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementsByTagName("table")[0];
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                // Column numbers: 1 for username, 0 for email, 2 for EMŠO
                if (tr[i].getElementsByTagName("td").length > 0) {
                    // Searching over username, email, and EMŠO
                    if (searchColumn(tr[i], 1, filter) || searchColumn(tr[i], 0, filter) || searchColumn(tr[i], 2, filter)) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function searchColumn(row, column, filter) {
            var td = row.getElementsByTagName("td")[column];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    return true;
                }
            }
            return false;
        }
    </script>
    <div class="organisation-users">
        <div class="cards-content">
            <div class="card-header">
                <h1>Podatki o uporabnikih</h1>
                <a href="{{ route('professor.student.add')}}"
                   class="btn-add-user">Dodaj uporabnika k organizaciji</a>
            </div>
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="form-control" id="searchInput" onkeyup=" searchFunction()"
                       placeholder="Poišči uporabnika po emšu ali po mailu ali po uporabniškem imenu">
            </div>
                <div class="cards-table">
                    <table class="table" id="userTable">
                        <tr>
                            <th>Email</th>
                            <th>Uporabniško ime</th>
                            <th>Upravljanje z uporabnikom</th>
                        </tr>
                        @if (!$data->isEmpty())

                            @if (count($data) > 0)
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row?->email }}</td>
                                        <td>{{ $row?->username }}</td>
                                        <td class="options">
                                            <form
                                                action="{{ route('professor.student.delete', ['userId' => $row?->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div>
                                                    <button type="button" class="btn-delete"
                                                            onclick="return confirm('Ali ste prepričani, da želite izbrisati tega uporabnika?');">
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
                                <td class="no-data">Ni podatkov o uporabnikih organizacije</td>
                                <td>/</td>
                                <td>/</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
@endsection
