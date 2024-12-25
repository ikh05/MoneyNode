<div class="card-container d-flex justify-content-center align-items-center overflow-hidden" style="height: 400px;">
    <div class="card-flip @if (old('sign') === 'in') flip-active @endif" style="width: 100%; height: 100%;">
        <!-- Bagian Depan: Form Pendaftaran -->
        <div class="card-front">
            <div class="card p-4">
                <h3 class="text-center mb-3">Sign Up</h3>
                <form method="POST">
                    @csrf
                    <input type="hidden" value="up" name="sign">
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control @if (old('sign') === 'up') @error('name') {{ 'is-invalid' }} @enderror @endif" id="signup-name" required placeholder="name" value="@if (old('sign')==='up') {{ old('name') }}  @endif">
                                <label for="signup-name" class="form-label">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="email" type="email" class="form-control @if (old('sign') === 'up') @error('email') {{ 'is-invalid' }} @enderror @endif" id="signup-email" required placeholder="email" value="@if (old('sign')==='up') {{ old('email') }}  @endif">
                                <label for="signup-email" class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
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
                    <div class="w-100 btn-group">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info">Sing In</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bagian Belakang: Form Masuk -->
        <div class="card-back">
            <div class="card p-4">
                <h3 class="text-center mb-3">Sign In</h3>
                <form method="POST">
                    @csrf
                    <input type="hidden" value="in" name="sign">
                    <div class="mb-3">
                        <div class="input-group"> 
                            <div class="form-floating">
                                <input name="email" type="email" class="form-control  @if (old('sign') === 'in') @error('email') {{ 'is-invalid' }} @enderror @endif" id="signin-email" required placeholder="email" value="@if (old('sign')==='in') {{ old('email') }}  @endif">
                                <label for="signin-email" class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
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
                    <div class="w-100 btn-group">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-outline-info">Sing Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if (old())
    <x-alerts.simpel color="danger">Gagal melakukan perintah!</x-alerts.simpel>    
@endif