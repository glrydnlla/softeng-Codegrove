<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <a class="navbar-brand" href="/">
            Codegrove
        </a>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if (Auth::user())
                <li class="nav-item d-lg-none">
                    <a class="nav-link" aria-current="page" href="/my-question" style="margin-left: 20px">My Questions</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" aria-current="page" href="/profile" style="margin-left: 20px">Profile</a>
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
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" aria-current="page" href="/my-question">My Questions</a>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link" aria-current="page" href="/profile">
                        <img src="" alt="img" style="border: 1px solid white; width:50px; height: 50px">
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
