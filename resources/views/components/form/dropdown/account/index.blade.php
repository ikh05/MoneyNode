{{-- data yang diterima (account) --}}
@props(['class'=>'', 'color'=>'primary', 'outline'=>false, 'data', 'name', 'label'=>false, 'title'=>'Accounts', 'keterangan'=>false])

<div class="btn-group w-100 h-100">
    <input type="hidden" name="{{ $name }}" value="{{ $data[0]->id }}">
    <button class="w-100 h-100 btn btn-{{ $outline ? 'outline-'.$outline : $color }} fs-4 border-1 rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="src/img/icon/{{ $data[0]->icon->path }}" alt="{{ $data[0]->name }}" class="" height="40">
        @if ($label)
            <p class="fs-6 m-0 p-0">{{ $data[0]->name }}</p>
        @endif
    </button>
    <x-form.dropdown.menu :title=$title :keterangan=$keterangan>
        <x-form.dropdown.account.item :data="$data[0]" active :label=$label />
        @foreach ($data->skip(1) as $d)
        <x-form.dropdown.account.item :data=$d :label=$label />
        @endforeach
    </x-form.dropdown.menu>
</div>