<!-- resources/views/livewire/sepa-steps.blade.php -->

<div>
    <div class="choices">
        <button wire:click="selectOption(2)" class="{{ $step === 2 ? 'active' : '' }}">Enter New SEPA Info</button>
        <button wire:click="selectOption(4)" class="{{ $step === 4 ? 'active' : '' }}">Download Existing SEPA</button>
        <button wire:click="selectOption(5)" class="{{ $step === 5 ? 'active' : '' }}">Upload SEPA</button>
    </div>

    <div class="step-content">
        @if ($step === 2)
            <div>
                <h2>Fill SEPA Form</h2>
                @if ($sepaDataExists)
                    <p>You already have SEPA info saved. If you proceed, it will replace the existing info.</p>
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
        
                    <button type="submit">Save and Download SEPA</button>
                </form>
            </div>   
        @elseif ($step === 4)
            <div>
                <h2>Download SEPA Form</h2>
                <a href="#" wire:click.prevent="downloadExistingSepa">Download SEPA Form</a>
            </div>
        @elseif ($step === 5)
            <div>
                <h2>Upload SEPA Form</h2>
                @if ($sepaUploaded)
                    <p>You have already uploaded a SEPA form.</p>
                @endif
                <form wire:submit.prevent="uploadSepaForm">
                    <input type="file" wire:model="sepaForm">
                    @error('sepaForm') <span class="error">{{ $message }}</span> @enderror
                    <button type="submit">Upload</button>
                </form>
            </div>
        @endif
    </div>
</div>
