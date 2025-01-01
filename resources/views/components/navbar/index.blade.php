<nav class="bg-body-tertiary fixed-bottom">
  <ul class="nav justify-content-around">
    <x-navbar.nav-item href="{{ isset($reqBook) ? '?book='.$reqBook : '/' }}">Buku</x-navbar.item>
    <x-navbar.nav-item href="/account{{ isset($reqBook) ? '?book='.$reqBook : '' }}">Account</x-navbar.item>
    <x-navbar.nav-item href="/analisis{{ isset($reqBook) ? '?book='.$reqBook : '' }}">Analisis</x-navbar.item>
    <x-navbar.nav-item href="/setting{{ isset($reqBook) ? '?book='.$reqBook : '' }}">Lain</x-navbar.item>
    {{-- <x-navbar.nav-item href="/sign/out">Keluar</x-navbar.item> --}}
  </ul>
</nav>