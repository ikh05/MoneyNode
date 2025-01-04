{{-- Sementara --}}
<nav id="nav-md" class="d-md-none d-block bg-body-tertiary fixed-bottom">
  <ul class="nav justify-content-around">
    <x-navbar.item-md :active="request()->is('/')" href="/">Buku</x-navbar.item-lg>
    <x-navbar.item-md :active="request()->is('account')" href="/account">Account</x-navbar.item-lg>
    <x-navbar.item-md :active="request()->is('analisis')" href="/analisis">Analisis</x-navbar.item-lg>
    <x-navbar.item-md :active="request()->is('setting')" href="/setting">Lain</x-navbar.item-lg>
  </ul>
</nav>

{{-- LG --}}
{{-- <nav id="nav-lg" class="d-none d-md-block bg-body-tertiary fixed-top">
  <ul class="nav">
    <x-navbar.item-lg :active="request()->is('/')" href="/">Buku</x-navbar.item-lg>
    <x-navbar.item-lg :active="request()->is('account')" href="/account">Account</x-navbar.item-lg>
    <x-navbar.item-lg :active="request()->is('analisis')" href="/analisis">Analisis</x-navbar.item-lg>
    <x-navbar.item-lg :active="request()->is('setting')" href="/setting">Lain</x-navbar.item-lg>
  </ul>
</nav> --}}
{{-- MD --}}
{{-- <nav id="nav-md" class="d-md-none d-block bg-body-tertiary fixed-bottom">
<ul class="nav justify-content-around">
    <x-navbar.item-md :active="request()->is('/')" href="/">Buku</x-navbar.item-md>
    <x-navbar.item-md :active="request()->is('account')" href="/account">Account</x-navbar.item-md>
    <x-navbar.item-md :active="request()->is('analisis')" href="/analisis">Analisis</x-navbar.item-md>
    <x-navbar.item-md :active="request()->is('setting')" href="/setting">Lain</x-navbar.item-md>
  </ul>
</nav> --}}
{{-- SMALL --}}
<nav id="nav-md" class="d-sm-none d-block bg-body-tertiary fixed-bottom">
  <ul class="nav justify-content-around nav-pills nav-justified">
    <x-navbar.item-md :active="request()->is('/')" href="/">Buku</x-navbar.item-md>
    <x-navbar.item-md :active="request()->is('account')" href="/account">Account</x-navbar.item-md>
    <x-navbar.item-md :active="request()->is('analisis')" href="/analisis">Analisis</x-navbar.item-md>
    <x-navbar.item-md :active="request()->is('setting')" href="/setting">Lain</x-navbar.item-md>
  </ul>
</nav>
