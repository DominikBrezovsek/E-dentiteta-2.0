@php use App\Models\OrganisationAdmin; @endphp
<div class="header">
    <div class="navbar-custom">
        @if (Auth::user() && Auth::user()->role == 'SAD')
            <div class="nav-items">
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('sad.organisations') }}">Organizacije</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('sad.vendors') }}">Partnerji</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="{{route('sad.verify-card')}}">Preveri kartico</a>
                </div>
                <div class="controls">
                    <div class="nav-item user">
                        <a class="nav-link" href="{{route('sad.profile.notifications')}}"><i class="fa-solid fa-bell"></i></a>
                    </div>
                    <div class="nav-item user">
                        <a class=nav-link" href="{{  route('sad.profile') }}"><i class="fa-solid fa-user"></i></a>
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
                    <a class="nav-link" href="{{ route('organisation_admin.cards.approve') }}">Zahteve za kartico</a>
                </div>
                @if (OrganisationAdmin::where('id_user','=', session('user')['id'])->exists())
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('organisation_admin.students') }}">Dijaki</a>
                    </div>
                @endif
                <div class="nav-item">
                    <a class="nav-link" href="{{ route('organisation_admin.organisation') }}">Organizacija</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link" href="{{route('organisation_admin.verify-card')}}">Preveri kartico</a>
                </div>
                <div class="controls">
                    <div class="nav-item user">
                        <a class="nav-link" href="{{route('organisation_admin.profile.notifications')}}"><i class="fa-solid fa-bell"></i></a>
                    </div>
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
                <a class="nav-link" href="{{route('student.profile.notifications')}}"><i class="fa-solid fa-bell"></i></a>
            </div>
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
            <a class="nav-link" href="{{ route('professor.users') }}">Uporabniki</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="{{ route('professor.card.approve') }}">Zahteve za kartico</a>
        </div>
        <div class="nav-item">
            <a class="nav-link" href="{{route('professor.verify-card')}}">Preveri kartico</a>
        </div>
        <div class="controls">
            <div class="nav-item user">
                <a class="nav-link" href="{{route('professor.profile.notifications')}}"><i class="fa-solid fa-bell"></i></a>
            </div>
            <div class="nav-item user">
                <a class=nav-link" href="{{route('professor.profile')}}"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="nav-item logout">
                <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
    @elseif(Auth::user() && Auth::user()->role == 'USR')
    <div class="nav-items">
        <div class="nav-item">
            <a class="nav-link" href="{{ route('user.organisations') }}">Pridruži se organizaciji</a>
        </div>
        <div class="controls">
            <div class="nav-item user">
                <a class=nav-link" href="{{route('professor.profile')}}"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="nav-item logout">
                <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
@elseif(Auth::user() && Auth::user()->role == 'VEN')
    <div class="nav-items">
        <div class="nav-item">
            <a class="nav-link" href="{{route('vendor.verify-card')}}">Preveri kartico</a>
        </div>
        {{-- <div class="nav-item">
            <a class="nav-link" href="{{ route('vendor.vendorInfo') }}">Partner</a>
        </div> --}}
        <div class="controls">
            <div class="nav-item user">
                <a class=nav-link" href="{{route('vendor.profile')}}"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="nav-item logout">
                <a class=nav-link" href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
    </div>
    @endif
    </div>
    </div>

