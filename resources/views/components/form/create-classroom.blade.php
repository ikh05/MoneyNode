<div class="card-container" style="width: 100vw;">
    <div class="card-flip">
        <!-- Bagian Depan: Form Buat ClassRoom -->
        <div class="card-front">
            <div class="card p-4">
                <h3 class="text-center mb-3">New Classroom</h3>
                <form method="POST">
                    @csrf
                    <input type="hidden" value="create" name="form">
                    <div class="mb-3">
                        <div class="input-group"> 
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="create-name" required placeholder="Name Classroom">
                                <label for="create-name" class="form-label">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <textarea name="description" id="create-description" class="form-control p-2" required placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="w-100 btn-group">
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info {{ $allClassRoom->count() === 0 ? 'd-none' : '' }}">Join</button>
                        {{-- <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info ">Join</button> --}}
                        <button type="submit" class="btn btn-info {{ $allClassRoom->count() === 0 ? 'rounded' : '' }}">Create</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Bagian Belakang: Form Pendaftaran -->
        <div class="card-back">
            <div class="card p-4">
                <h3 class="text-center mb-3">Join ClassRoom</h3>
                <form method="POST">
                    @csrf
                    <input type="hidden" value="join" name="form">
                    <div class="mb-3">
                        <select name="code" id="code_class" class="form-select">
                            <option class="d-none">Classroom</option>
                            @foreach ($allClassRoom as $classroom)
                                <option value="{{ $classroom->code }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-100 btn-group">
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info">Create</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>