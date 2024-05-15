<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <a class="navbar-brand" href="/">
            Codegrove
        </a>
        <form class="d-flex" role="search" action="search" method="post">
            @csrf
            @if (isset($search))
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{$search}}">
            @else
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
            @endif
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 30px">
            @if (Auth::user())
                @if (Auth::user()->role == "user")
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" aria-current="page" href="/my-questions" style="margin-left: 20px">My Questions</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" aria-current="page" href="/archived-questions" style="margin-left: 20px">Archived Questions</a>
                    </li>
                @endif
                <li class="nav-item d-lg-none">
                    <a class="nav-link" aria-current="page" href="/profile" style="margin-left: 20px">Profile</a>
                </li>
                <li class="nav-item d-lg-none">
                    <form action="logout" method="post" id="logout-form1">
                        @csrf
                        <button type="submit" class="btn nav-link" style="margin-left: 20px">Log Out</button>
                    </form>
                </li>
            @else
                <li class="nav-item d-lg-none">
                    <a class="nav-link" aria-current="page" href="/login">Login</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" aria-current="page" href="/register">Register</a>
                </li>
            @endif    
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0 d-flex align-items-center" style="width: max-content">
            @if (Auth::user())
                @if (Auth::user()->role == "user")
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" aria-current="page" href="/my-questions">My Questions</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" aria-current="page" href="/archived-questions">Archived Questions</a>
                    </li>
                    @endif
                <li class="nav-item d-none d-lg-block">
                    <form action="logout" method="post" id="logout-form2">
                        @csrf
                        <button type="submit" class="btn nav-link">Log Out</button>
                    </form>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" aria-current="page" href="/profile">
                        @if (Auth::user()->display_picture_path)
                            <img src="{{ asset('storage/images/'.Auth::user()->display_picture_path) }}" class="rounded-circle" alt="Profile Picture" width="30" height="30">
                        @else
                            <img src="{{ asset('storage/asset/gg--profile.png') }}" class="rounded-circle" alt="Profile Picture" width="30" height="30">
                        @endif
                    </a>
                </li>
            @else
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" aria-current="page" href="/login">Login</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" aria-current="page" href="/register">Register</a>
                </li>
            @endif    
        </ul>
    </div>
</nav>
