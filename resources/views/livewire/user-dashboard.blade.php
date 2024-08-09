<div>
    <div class="container mx-auto px-4">
        <!-- Dashboard Header -->
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Dashboard</h1>
                <h2>Lockers</h2>
                <p class="user-email">{{$user->name}}</p>
            </div>
        </header>

        <!-- Dashboard Navigation -->
        <nav class="dashboard-nav">
            <a href="{{ url('/dashboard') }}">Dashboard</a> |
            <a href="{{ route('rent-locker') }}">Rent locker</a> |
            <a href="{{ route('sepa.steps') }}">Sepa Payment</a>

        </nav>

        <!-- Main Content -->
        <main>
            <!-- Rent Locker Instructions -->
            <section>
                <h2>You can rent a locker for your child at Primo-Levi-Gymnasium via this platform.</h2>
                <p>You can submit a new locker request via the button "Rent locker". After you have entered all relevant contract and payment data, we will note your locker request.</p>
                <p>At the end of the holidays you will receive an email telling you which locker we have found for your child based on the classroom distribution. In the first days of the school year, the keys of the lockers will be handed out in the classes. If you and your child find that the location of the locker is not ideal after all, you also have the option of choosing another free location.</p>
                <p>You also have the option to rent additional lockers for other (sibling) children at any time and to view the status of your rental request. You can find this information under the tab "Lockers".</p>
            </section>

            <!-- Contact Information -->
            <section class="contact-info">
                <h2>Contact Information</h2>
                <p>If you have any questions about your tenancy agreement, your locker, or any other concerns, please contact <a href="mailto:schliessfach@primolevi.de">schliessfach@primolevi.de</a>.</p>
                <p>Yours</p>
            </section>
        </main>
    </div>
</div>