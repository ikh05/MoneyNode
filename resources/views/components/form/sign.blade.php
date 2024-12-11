<div class="card-container d-flex justify-content-center align-items-center" style="height: 400px;">
    <div class="card-flip" style="width: 100%; height: 100%;">
        <!-- Bagian Depan: Form Pendaftaran -->
        <div class="card-front">
            <div class="card p-4">
                <h3 class="text-center mb-3">Sign Up</h3>
                <form>
                    @csrf
                    <input type="hidden" value="sign up">
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="name" type="text" class="form-control" id="signup-name" required placeholder="name">
                                <label for="signup-name" class="form-label">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="email" type="email" class="form-control" id="signup-email" required placeholder="email">
                                <label for="signup-email" class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control" id="signup-password" required placeholder="password">
                                <label for="signup-password" class="form-label">Password</label>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="togglePassword(this, '#signup-password')">
                                <i class="bi bi-eye d-none"></i>
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="w-100 btn-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-primary">Sing In</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bagian Belakang: Form Masuk -->
        <div class="card-back">
            <div class="card p-4">
                <h3 class="text-center mb-3">Sign In</h3>
                <form>
                    @csrf
                    <input type="hidden" value="sign in">
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="email" type="email" class="form-control" id="signin-email" required placeholder="email">
                                <label for="signin-email" class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="password" type="password" class="form-control" id="signin-password" required placeholder="password">
                                <label for="signin-password" class="form-label">Password</label>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="togglePassword(this, '#signin-password')">
                                <i class="bi bi-eye d-none"></i>
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="w-100 btn-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" onclick="toggleClass('.card-flip', 'flip-active')" class="btn btn-primary">Sing Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
