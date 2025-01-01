{{-- data yang diterima (parties) --}}
@props(['name', 'class'=>'', 'color'=>'primary', 'outline'=>false, 'data', 'title'=>'Subjek', 'keterangan'=>false])

<div class="btn-group" class="{{ $class }}" style="width: 100%; height: 100%">
    <input type="hidden" name="{{ $name }}" value="{{ $data[0]->id }}">
    <button class="w-100 h-100 btn btn-{{ $outline ? 'outline-'.$outline : $color }} fs-4  border-1 rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="src/img/icon/{{ $data[0]->icon->path }}" alt="{{ $data[0]->name }}" class="" height="40">
    </button>
    <x-form.dropdown.menu :title=$title :keterangan=$keterangan >
        <x-form.dropdown.party.item :data="$data[0]" active />
        @foreach ($data->skip(1) as $d)
            <x-form.dropdown.party.item :data=$d />
        @endforeach
    </x-form.dropdown.menu>
</div>