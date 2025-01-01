@props(['name', 'data', 'color', 'firstChecked'=>false])
<div class="d-flex justify-content-center flex-wrap gap-1">
    @foreach ($data as $i => $category)
        <x-form.radio.category.item :name=$name :color=$color :category=$category :checked="$i ? false : $firstChecked" />
    @endforeach
</div>