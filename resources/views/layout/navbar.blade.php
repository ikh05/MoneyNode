<x-header />
<x-navbar />
<main class="overflow-x-auto scrollbar-hidden container-fluid" style="height: calc(100vh - 72px)">
    @yield('content')
</main>
<x-footer />