@php use App\Models\OrganisationAdmin; @endphp
<div class="header">
    <div class="navbar-custom">
        @if (Auth::user() && Auth::user()->role == 'SAD')
            <div class="nav-items">
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('organisation_admin.organisations') }}">Organizacije</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('organisation_admin.users') }}">Partnerji</a>
                </div>
                <div class="controls">
                    <div class="nav-item user">
                        <a class=nav-link" href="{{  route('organisation_admin.profile') }}"><i class="fa-solid fa-user"></i></a>
                    </div>
                    <div class="nav-item logout">
                        <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                </div>
            </div>
        @elseif(Auth::user() && Auth::user()->role == 'OAD')
            <div class="nav-items">
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('organisation_admin.cards') }}">Kartice</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('organisation_admin.cards') }}">Zahteve za kartico</a>
                </div>
                @if (OrganisationAdmin::where('id_user','=', session('user')->id)->exists())
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('organisation_admin.users') }}">Uporabniki organizacije</a>
                    </div>
                @endif
                <div class="controls">
                    <div class="nav-item user">
                        <a class=nav-link" href="{{route('organisation_admin.profile')}}"><i class="fa-solid fa-user"></i></a>
                    </div>
                    <div class="nav-item logout">
                        <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                </div>
            </div>
    </div>

</div>
@elseif(Auth::user() && Auth::user()->role == 'STU')
    <div class="nav-items">
        <div class="nav-item">
            <a class="nav-link" href="{{ route('student.cards') }}">Moje kartice</a>
        </div>
        <div class="controls">
            <div class="nav-item user">
                <a class=nav-link" href="{{route('student.profile') }}"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="nav-item logout">
                <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
@elseif(Auth::user() && Auth::user()->role == 'PRF')
    <div class="nav-items">
        <div class="nav-item">
            <a class="nav-link" href="{{ route('professor.cards') }}">Uporabniki</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="{{ route('professor.card.approve') }}">Razredne kartice</a>
        </div>
        @if (OrganisationAdmin::where('id_user', session('user')->id)->exists())
            <div class="nav-item">
                <a class="nav-link" href="{{ route('professor.users') }}">Razred</a>
            </div>
        @endif
        <div class="controls">
            <div class="nav-item user">
                <a class=nav-link" href="{{route('professor.profile')}}"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="nav-item logout">
                <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
    @endif
    </div>
    </div>

