<!-- resources/views/livewire/rent-locker.blade.php -->

<div>
    <div class="steps-nav">
        <button wire:click="goToStep(1)" class="{{ $step === 1 ? 'active' : '' }}">1. Choose Package</button>
        <button wire:click="goToStep(2)" class="{{ $step === 2 ? 'active' : '' }}" {{ $selectedPackage ? '' : 'disabled' }}>2. Register Child</button>
    </div>

    <div class="step-content">
        @if ($step === 1)
            <div>
                <h2>Choose Package</h2>
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
                <form wire:submit.prevent="submitChildData">
                    <div class="form-group">
                        <label for="child_name">Child's Name</label>
                        <input type="text" id="child_name" wire:model="childData.name" placeholder="Child's Name">
                        @error('childData.name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="child_birth_date">Child's Birthdate</label>
                        <input type="date" id="child_birth_date" wire:model="childData.birth_date">
                        @error('childData.birth_date') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="child_class">Class</label>
                        <select id="child_class" wire:model="childData.class_id">
                            <option value="">Select Class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        @error('childData.class_id') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit">Register</button>
                </form>
            </div>
        @endif
    </div>
</div>
