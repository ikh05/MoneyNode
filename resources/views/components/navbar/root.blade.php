<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container align-items-center">
        <a class="navbar-brand me-3" href="/" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="Interactive Cataloging App">
            <img class="me-2" src="/src/img/nav/icon.png" alt="icon" width="40"> ICA
        </a>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active small active" aria-current="page" href="/">All App</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav ms-auto my-2 my-lg-0">
            <li class="nav-item dropdown">
                <a id="popover-user" class="me-3" role="button" href="#" data-bs-toggle="popover" data-bs-title="{{ Str::title($user->username) }}" content-popover="#content-popover-user">
                    <img class="img-thumbnail rounded-circle" src="https://robohash.org/set_set4/bgset_bg1/{{ $user->username }}" alt="avatar user" width="50">
                </a>
                <div class="d-none">
                    <ul class="list-group list-group-flush overflow-hidden" id="content-popover-user">
                        <a href="#" class="list-group-item list-group-item-action">Log</a>
                        <a href="#" class="list-group-item list-group-item-action">Pengaturan</a>
                        <a href="/sign/out" class="list-group-item list-group-item-action">Keluar</a>
                      </ul>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>