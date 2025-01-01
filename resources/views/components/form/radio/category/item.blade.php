<div style="width: 5rem; height: 5rem;">
    <div class="text-center w-100 h-100">
        <input name="{{ $name }}" class="btn-check" type="radio" value="{{ $category->id }}" id="category_{{ $category->id }}" {{ $checked ? 'checked' : '' }}>
        <label class="btn btn-outline-{{ $color }} w-100 h-100" for="category_{{ $category->id }}" style="min-width: 3rem;">
            <img src="/src/img/icon/{{ $category->icon->path }}" alt="{{ $category->name }}" height="32">
            <p class="mb-0 small text-break">{{ $category->name }}</p>
        </label>
    </div>            
</div>