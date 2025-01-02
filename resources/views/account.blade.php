@extends('layout.navbar')


@section('content')
<div class="row bg-danger-subtle position-relative px-1">
    <div class="row py-2 px-5 mb-3 mt-2 text-center w-100">
        <div class="">
            <p class="mb-0 fs-4">Asset Bersih:</p>
            <p class="fs-5"> {{ Str::toRupiah($account->totalAssetBersih()) }}</p>
        </div>
        <div class="row px-0" style="width: 100%">
            <div class="col">
                <p class="mb-0">Asset: {{ Str::toRupiah($account->totalAssetBersih() + $account['hutang']->totalNominalGroupAccounts()) }}</p>
            </div>
            <div class="col">
                <p class="mb-0">Hutang: {{ Str::toRupiah($account['hutang']->totalNominalGroupAccounts()) }}</p>
            </div>
        </div>
    </div>
    <div class="container px-sm-5 px-3 pb-2 pt-4 bg-dark-subtle rounded-top-5 ">
    @foreach ($account as $key => $groupAccount)
        <x-card.index component="card.account" :data="$groupAccount" >
            <p class="mb-0 fw-bold">{{ Str::apa($key) }}</p>
            <div class="text-end small position-absolute end-0 me-3 top-50 translate-middle-y">
                <p class="fw-bold text-secondary mb-0 ">Asset: {{ Str::toRupiah($groupAccount->totalNominalGroupAccounts()) }}</p>
            </div>
        </x-card>
    @endforeach
    </div>
</div>
@endsection