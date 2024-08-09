<div class="container">
    <a href="{{ route('user.dashboard') }}" class="btn-back-dashboard">
        <div class="icon-container">
            <svg width="25px" height="25px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                <path fill="#000000" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path>
                <path fill="#000000" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path>
            </svg>
        </div>
        <p>Go Back to Dashboard</p>
    </a>
    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="choices">
        <button wire:click="selectOption(2)" class="{{ $step === 2 ? 'active' : '' }}">Enter New SEPA Info</button>
        <button wire:click="selectOption(4)" class="{{ $step === 4 ? 'active' : '' }}">Download Existing SEPA</button>
        <button wire:click="selectOption(5)" class="{{ $step === 5 ? 'active' : '' }}">Upload SEPA</button>
    </div>

    <div class="step-content">
        @if ($step === 2)
            <div class="form-container">
                <h2>Fill SEPA Form</h2>
                @if ($sepaDataExists)
                    <p class="alert alert-warning">You already have SEPA info saved. If you proceed, it will replace the existing info.</p>
                @endif
                <form wire:submit.prevent="submitSEPAForm">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" wire:model="full_name" placeholder="Full Name" required>
                        @error('full_name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="email" placeholder="Email" required>
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="iban">IBAN</label>
                        <input type="text" id="iban" wire:model="iban" placeholder="IBAN" required>
                        @error('iban') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="bic">BIC</label>
                        <input type="text" id="bic" wire:model="bic" placeholder="BIC" required>
                        @error('bic') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn-submit">Save and Download SEPA</button>
                </form>
            </div>
        @elseif ($step === 4)
            <div>
                <h2>Download SEPA Form</h2>
<a href="#" wire:click.prevent="downloadExistingSepa" class="btn-download-sepa">
    Download SEPA Form
</a>            </div>
        @elseif ($step === 5)
            <div>
                <h2>Upload SEPA Form</h2>
                <form wire:submit.prevent="uploadSepaForm" class="upload-form">
                    <div class="form-group">
                        <label for="sepaForm">Upload SEPA Form (PDF only)</label>
                        <input type="file" id="sepaForm" wire:model="sepaForm">
                        @error('sepaForm') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn-upload">Upload</button>
                </form>

                @if ($sepaDataExists)
                    <div class="status">
                        <div class="status-item {{ $sepaUploaded ? 'status-uploaded' : 'status-not-uploaded' }}">
                            <p>SEPA Form Status: {{ $sepaUploaded ? 'Uploaded' : 'Not Uploaded' }}</p>
                        </div>
                        <div class="status-item {{ $sepaVerified === 'Pending' ? 'status-pending' : ($sepaVerified === 'Verified' ? 'status-uploaded' : 'status-not-uploaded') }}">
                            <p>SEPA Verification Status: 
                                @if ($sepaVerified === 'Verified')
                                    Verified
                                @elseif ($sepaVerified === 'Pending')
                                    Pending (Contact administration via email if this remains for more than 2 weeks)
                                @else
                                    Not Verified
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>





<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.tailwindcss.com"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('confirm-sepa-update', (event) => {
        let data = event.detail;
        data = data[0]; // Access the first item in the array

        Swal.fire({
            title: 'Existing SEPA Info Found',
            text: `Do you want to update the existing SEPA info for ${data.full_name}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.confirmSEPAUpdate(data);
            }
        });
    });

    window.addEventListener('sepa-saved', (event) => {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: event.detail.message,
        });
    });

    window.addEventListener('sepa-uploaded', (event) => {
        Swal.fire({
            icon: 'success',
            title: 'Uploaded!',
            text: event.detail.message,
        });
    });
    window.addEventListener('error', (event) => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: event.detail.message,
        });
});
});
</script>
