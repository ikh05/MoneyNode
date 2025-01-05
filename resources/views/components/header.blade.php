@props(['title' => 'Interactive Cataloging App'])
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- icon bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- icon fontawesome --}}
    <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" >
    
    {{-- my css --}}
    <link rel="stylesheet" href="/src/css/myStyle.css">

    <!-- Ikon website -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
  </head>
  <body data-bs-theme="dark" class="position-relative m-0 p-0 overflow-x-hidden stickScroll" style="width: 100vw; min-height: 100vh;">

@session('error')
  <x-alerts.simpel color="danger">{{ session('error') }}</x-alerts.simpel>    
@endsession