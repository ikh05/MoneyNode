<x-header/>
{{-- <x-navbar.root :user=$user /> --}}
<main class="overflow-x-auto scrollbar-hidden container-fluid mt-4" style="margin-bottom: 5rem">
    @yield('content')
</main>


<x-footer />