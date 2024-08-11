<div class="container mx-auto px-4">
    <!-- Dashboard Header -->
    <header class="dashboard-header">
        <div class="header-content flex justify-between items-center bg-blue-500 text-white p-4 rounded-lg shadow-md">
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <h2 class="text-xl mt-1">Lockers</h2>
            </div>
            <div class="relative">
                <div>{{ $user->name }}</div>
                <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 border border-gray-300 rounded-lg shadow-lg hidden group-hover:block">
                    <button wire:click="logout" class="block px-4 py-2 text-red-500 hover:bg-gray-100 w-full text-left">Logout</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Navigation -->
    <nav class="dashboard-nav mt-4">
        <a href="{{ url('/dashboard') }}" class="text-blue-500 hover:underline">Dashboard</a> |
        <a href="{{ route('rent-locker') }}" class="text-blue-500 hover:underline">Rent Locker</a> |
        <a href="{{ route('sepa.steps') }}" class="text-blue-500 hover:underline">Sepa Payment</a>
    </nav>

    <!-- Main Content -->
    <main class="mt-6">
        <!-- Rent Locker Instructions -->
        <section class="instructions mb-6">
            <h2 class="text-2xl font-semibold mb-2">Rent a Locker</h2>
            <p class="mb-4">You can rent a locker for your child at Primo-Levi-Gymnasium via this platform.</p>
            <p class="mb-4">Submit a new locker request via the button "Rent locker". After you have entered all relevant contract and payment data, we will note your locker request.</p>
            <p class="mb-4">At the end of the holidays, you will receive an email telling you which locker we have found for your child based on the classroom distribution. In the first days of the school year, the keys of the lockers will be handed out in the classes. If you and your child find that the location of the locker is not ideal after all, you also have the option of choosing another free location.</p>
            <p>You also have the option to rent additional lockers for other (sibling) children at any time and to view the status of your rental request. You can find this information under the tab "Lockers".</p>
        </section>

        <!-- Contact Information -->
        <section class="contact-info bg-gray-100 p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-2">Contact Information</h2>
            <p class="mb-2">If you have any questions about your tenancy agreement, your locker, or any other concerns, please contact <a href="mailto:schliessfach@primolevi.de" class="text-blue-500 hover:underline">schliessfach@primolevi.de</a>.</p>
            <p>Yours</p>
        </section>
    </main>
</div>
