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
                        <div class="input-group">
                            
                            <div class="btn-group w-100 h-100">
                                <input type="hidden" name="code" value="">
                                <button class="w-100 h-100 btn btn-outline-secondary fs-4 border-1 rounded-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <p class="fs-6 m-0 p-0">Classroom Code</p>
                                </button>
                                <x-form.dropdown.menu title='Classroom Code'>
                                    @foreach ($allClassRoom as $classroom)
                                        <li class="dropdown-item w-100" value="{{ $classroom->code }}">
                                            <div class="row">
                                                <div class="col-4 align-items-center d-flex">
                                                    <div class="innerHTML">
                                                        <p class="p-0 m-0 fs-6 label small">{{ $classroom->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-8 text-end">
                                                    <p class="m-0 p-0 fs-6">{{ $classroom->countUser() }}</p>
                                                    <p class="saldo m-0 p-0 small">{{ $classroom->creator->username }}</p>
                                                </div>
                                            </div>    
                                        </li>
                                    @endforeach
                                </x-form.dropdown.menu>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 btn-group">
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info">Sing In</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>