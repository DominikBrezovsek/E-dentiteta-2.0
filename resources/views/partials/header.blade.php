    @php use App\Models\Organisation; @endphp
    <div class="header">
        <div class="navbar-custom">
                @if (Auth::user() && Auth::user()->role == 'ADM')
                    <div class="nav-items">
                            <div class="nav-item">Admin</div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('admin.profile') }}">Moj profil</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('admin.organisations') }}">Organizacije</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('admin.cards') }}">Kartice</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users') }}">Uporabniki</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Odjava</a>
                            </div>

                    </div>
                @elseif(Auth::user() && Auth::user()->role == 'ORG')
                <div class="nav-items">
                        <div class="nav-item">Organisation</div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('organisation.profile') }}">Moj profil</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('organisation.cards') }}">Kartice</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('organisation.card.approve') }}">Zahteve za kartico</a>
                        </div>
                        @if (Organisation::where('id_user', session('user')->id)->exists())
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('organisation.users') }}">Uporabniki organizacije</a>
                        </div>
                        @endif
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Odjava</a>
                        </div>

                </div>
                @elseif(Auth::user() && Auth::user()->role == 'USR')
                <div class="nav-items">
                        <div class="nav-item">User</div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('user.profile') }}">Moj profil</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('user.cards') }}">Moje kartice</a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Odjava</a>
                        </div>
                </div>
                @endif
            </div>
        </div>

