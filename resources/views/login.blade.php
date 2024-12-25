@extends('layout.no-navbar')

@section('content')
    @session('massage')
        <div class="alert alert-info" role="alert">
            {{ $request->session('message') }}
        </div>
    @endsession
    <x-form.sign />
@endsection