<div class="card-container" style="width: 100vw;">
    <div class="card-flip @if (old('sign') === 'out') flip-active @endif">
        <!-- Bagian Depan: Form Masuk -->
        <div class="card-front">
            <div class="card p-4">
                <h3 class="text-center mb-3">Sign In</h3>
                <form method="POST">
                    @csrf
                    <input type="hidden" value="in" name="sign">
                    <div class="mb-3">
                        <div class="input-group"> 
                            <div class="form-floating">
                                <input name="username" type="text" class="form-control  @if (old('sign') === 'in') @error('username') {{ 'is-invalid' }} @enderror @endif" id="signin-username" required placeholder="username" value="@if (old('sign')==='in') {{ old('username') }}  @endif">
                                <label for="signin-username" class="form-label">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control  @if (old('sign') === 'in') @error('password') {{ 'is-invalid' }} @enderror @endif" id="signin-password" required placeholder="password">
                                <label for="signin-password" class="form-label">Password</label>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="togglePassword(this, '#signin-password')">
                                <i class="bi bi-eye d-none"></i>
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    {{-- <div class="form-check mb-4 small">
                        <input class="form-check-input" type="checkbox" name="rememberme" id="signin_rememberme">
                        <label class="form-check-label" for="signin_rememberme">
                          Tolong ingat saya
                        </label>
                    </div> --}}
                    <div class="w-100 btn-group">
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info">Sign Up</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Bagian Belakang: Form Pendaftaran -->
        <div class="card-back">
            <div class="card p-4">
                <h3 class="text-center mb-3">Sign Up</h3>
                <form method="POST">
                    @csrf
                    <input type="hidden" value="up" name="sign">
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="username" type="text" class="form-control @if (old('sign') === 'up') @error('username') {{ 'is-invalid' }} @enderror @endif" id="signup-username" required placeholder="username" value="@if (old('sign')==='up') {{ old('username') }}  @endif">
                                <label for="signup-username" class="form-label">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control @if (old('sign') === 'up') @error('name') {{ 'is-invalid' }} @enderror @endif" id="signup-name" required placeholder="name" value="@if (old('sign')==='up') {{ old('name') }}  @endif">
                                <label for="signup-name" class="form-label">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control @if (old('sign') === 'up') @error('password') {{ 'is-invalid' }} @enderror @endif" id="signup-password" required placeholder="password">
                                <label for="signup-password" class="form-label">Password</label>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="togglePassword(this, '#signup-password')">
                                <i class="bi bi-eye d-none"></i>
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    {{-- <div class="form-check mb-4 small">
                        <input class="form-check-input" type="checkbox" name="rememberme" id="signup_rememberme">
                        <label class="form-check-label" for="signup_rememberme">
                          Tolong ingat saya
                        </label>
                    </div> --}}
                    <div class="w-100 btn-group">
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info">Sign In</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@if (old())
    <x-alerts.simpel color="danger">Gagal melakukan perintah!</x-alerts.simpel>    
@endif