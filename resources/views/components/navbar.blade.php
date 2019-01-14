@auth
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="text-light navbar-brand" href="#">Books App Test</a>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="text-light nav-link" href="/dashboard">Dashboard</a>
                </li>
                @if(Auth::user()->role == 'admin')
                <li class="nav-item {{ Request::is('administration') ? 'active' : '' }}">
                    <a class="text-light nav-link" href="/administration">Administration</a>
                </li>
                @elseif(Auth::user()->role == 'writer')
                <li class="nav-item {{ Request::is('booksAdministration') ? 'active' : '' }}">
                    <a class="text-light nav-link" href="/booksAdministration">My Books</a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="text-light nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="bg-dark dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="text-light dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@endauth
