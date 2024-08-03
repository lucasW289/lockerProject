<div class="login-container">
    <h1>Login</h1>

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="login">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" wire:model="email" class="form-control">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" wire:model="password" class="form-control">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <div class="login-footer">
        <p>Don't have an account? <a href="{{ route('register') }}" class="register-link">Register</a></p>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
    Livewire.on('loginSuccess', (data) => {
        localStorage.setItem('sanctum_token', data.token);
        window.location.href = data.redirect; // Redirect to the appropriate dashboard
    });

    Livewire.on('loginError', (errors) => {
        // Handle login errors
        console.log(errors);
    });
});

</script>