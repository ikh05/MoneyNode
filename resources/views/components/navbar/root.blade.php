{{-- Ukuran di atas mobile (sm) --}}
<div class="d-none d-sm-block">
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</div>

{{-- Ukuran di mobile (sm) --}}
<div class="d-block d-sm-none position-fixed bottom-0 mb-3 start-50 translate-middle-x w-100">
    <nav class="navbar bg-light-subtle mx-3 rounded-4">
        <div class="container-fluid">
            <ul class="nav w-100 justify-content-center">
                <li class="nav-item">
                  <a class="nav-link active rounded-circle bg-dark"href="#">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </nav>
</div>