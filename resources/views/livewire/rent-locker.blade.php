<div>
    <div class="steps-nav">
        <button wire:click="goToStep(1)" :class="{ 'active': step === 1 }">1. Choose Package</button>
        <button wire:click="goToStep(2)" :class="{ 'active': step === 2 }">2. Register Child</button>
        <button wire:click="goToStep(3)" :class="{ 'active': step === 3 }">3. Fill SEPA Form</button>
        <button wire:click="goToStep(4)" :class="{ 'active': step === 4 }">4. Download SEPA Form</button>
        <button wire:click="goToStep(5)" :class="{ 'active': step === 5 }">5. Upload SEPA Form</button>
    </div>

    <div class="step-content">
        @if ($step === 1)
            <div>
                <h2>Choose Package</h2>
                <!-- Package selection form -->
                <div class="packages-container">
                    @foreach ($packages as $package)
                        <div 
                            class="package-card {{ $selectedPackage === $package->id ? 'selected' : '' }}"
                            wire:click="selectPackage({{ $package->id }})"
                        >
                            <h3>{{ $package->name }}</h3>
                            <p>{{ $package->description }}</p>
                            <p>Price: {{ $package->price }}</p>
                        </div>
                    @endforeach
                </div>
                <button wire:click="submitPackage" {{ $selectedPackage ? '' : 'disabled' }}>Next</button>
            </div>
        @elseif ($step === 2)
            <div>
                <h2>Register Child</h2>
                <!-- Child registration form -->
                <form wire:submit.prevent="submitChildData">
                    <input type="text" wire:model="childData.name" placeholder="Child's Name">
                    <input type="date" wire:model="childData.birth_date" placeholder="Child's Birthdate">
                    <select wire:model="childData.class_id">
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Next</button>
                </form>
            </div>
        @elseif ($step === 3)
            <div>
                <h2>Fill SEPA Form</h2>
                <!-- SEPA form -->
                <form wire:submit.prevent="submitSepaData">
                    <input type="text" wire:model="sepaData.bank_name" placeholder="Bank Name">
                    <input type="text" wire:model="sepaData.iban" placeholder="IBAN">
                    <button type="submit">Next</button>
                </form>
            </div>
        @elseif ($step === 4)
            <div>
                <h2>Download SEPA Form</h2>
                <!-- SEPA form download -->
                <a href="/path-to-sepa-form" download>Download SEPA Form</a>
                <button wire:click="goToStep(5)">Next</button>
            </div>
        @elseif ($step === 5)
            <div>
                <h2>Upload SEPA Form</h2>
                <!-- SEPA form upload -->
                <form wire:submit.prevent="uploadSepaForm">
                    <input type="file" wire:model="sepaForm">
                    <button type="submit">Submit</button>
                </form>
            </div>
        @endif
    </div>
</div>
