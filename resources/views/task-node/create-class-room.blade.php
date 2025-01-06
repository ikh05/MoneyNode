@extends('layout.no-navbar')

@section('content')
    <div class="position-absolute top-50 translate-middle-y">
        <x-form.create-classroom :allClassRoom=$allClassRoom/>
    </div>
@endsection