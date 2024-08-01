<div class="registration-container">
    <h1>Register</h1>
    <form wire:submit.prevent="register">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" wire:model="name" placeholder="Enter your name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" placeholder="Enter your email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" wire:model="password" placeholder="Enter your password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" placeholder="Confirm your password">
            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
        </div>
        <input type="hidden" wire:model="role_id" value="3">
        <button type="submit">Register</button>
    </form>
    <div class="login-link">
        <p>Already registered? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('registration-success', () => {
        Swal.fire({
            title: 'Registration Successful!',
            text: 'You will be redirected to the login page.',
            icon: 'success',
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('login') }}';
            }
        });
    });
</script>