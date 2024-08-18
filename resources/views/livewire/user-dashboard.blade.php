<div class="status-check-container bg-white p-6 sm:p-8 md:p-12 lg:p-16 xl:p-20 rounded-lg shadow-lg max-w-7xl mx-auto my-16 border border-gray-200 min-h-[800px] flex flex-col justify-between">
    <!-- User Dashboard Header -->
    <header class="dashboard-header mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center bg-blue-600 text-white p-4 md:p-6 rounded-lg shadow-lg">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">User Dashboard</h1>
                <p class="text-xl md:text-2xl mt-2">Welcome back, {{ $user->name }}!</p>
            </div>
            <div class="relative group mt-4 md:mt-0">
                <button wire:click="logout()"
                    class="group flex items-center justify-start w-11 h-11 bg-red-600 rounded-full cursor-pointer relative overflow-hidden transition-all duration-200 shadow-lg hover:w-32 hover:rounded-lg active:translate-x-1 active:translate-y-1">
                    <div
                        class="flex items-center justify-center w-full transition-all duration-300 group-hover:justify-start group-hover:px-3">
                        <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white">
                            <path
                                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="absolute right-5 transform translate-x-full opacity-0 text-white text-lg font-semibold transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                        Logout
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- User Dashboard Navigation -->
    <nav class="dashboard-nav flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 mb-8">
        <a href="{{ url('/user-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Dashboard</a> |
        <a href="{{ route('rent-locker') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Rent Locker</a> |
        <a href="{{ route('sepa.steps') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Sepa Payment</a> |
        <a href="{{ route('check.status') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Check Status</a> 
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Rent Locker Instructions -->
        <section class="instructions mb-6">
            <h2 class="text-xl md:text-2xl font-semibold mb-2">Rent a Locker</h2>
            <p class="mb-4">You can rent a locker for your child at Primo-Levi-Gymnasium via this platform.</p>
            <p class="mb-4">Submit a new locker request via the button "Rent locker". After you have entered all relevant contract and payment data, we will note your locker request.</p>
            <p class="mb-4">At the end of the holidays, you will receive an email telling you which locker we have found for your child based on the classroom distribution. In the first days of the school year, the keys of the lockers will be handed out in the classes. If you and your child find that the location of the locker is not ideal after all, you also have the option of choosing another free location.</p>
            <p>You also have the option to rent additional lockers for other (sibling) children at any time and to view the status of your rental request. You can find this information under the tab "Lockers".</p>
        </section>

        <!-- Contact Information -->
        <section class="contact-info bg-gray-100 p-4 md:p-6 rounded-lg shadow-md">
            <h2 class="text-lg md:text-xl font-semibold mb-2">Contact Information</h2>
            <p class="mb-4">If you have any questions about your tenancy agreement, your locker, or any other concerns, please contact <a href="mailto:schliessfach@primolevi.de" class="text-blue-500 hover:underline">schliessfach@primolevi.de</a>.</p>
            <p class="mt-4">Yours sincerely,</p>
        </section>
    </main>
</div>

<script src="https://cdn.tailwindcss.com"></script>
