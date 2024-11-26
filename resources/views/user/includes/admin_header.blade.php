
    <div class="bg-blue-900 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo -->
            <div class="text-lg font-bold text-yellow-400 flex items-center">
                <a href="{{url('/')}}"><img src="{{ asset('img/icon/logo.png') }}" alt="TS-Developers" width="50px" height="50px" class="mr-2">

            </a>
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="lg:hidden">
                <button id="menu-toggle" class="bg-gray-700 text-white px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div id="nav-links" class="hidden lg:flex items-center space-x-4">

                <a href="{{ url('/registration') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 {{ request()->is('registration') ? 'bg-green-600' : '' }}">Registration</a>
                <a href="{{ url('/reg-approvel') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 {{ request()->is('reg-approvel') ? 'bg-green-600' : '' }}">Reg-Fee-Approval</a>
                <a href="{{ url('fee_approvel') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 {{ request()->is('fee_approvel') ? 'bg-green-600' : '' }}">Fee Approval</a>
                <a href="{{ url('/fee-status-check') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 {{ request()->is('fee-status-check') ? 'bg-green-600' : '' }}">Stealth</a>
                <a href="{{ url('/video/upload') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 {{ request()->is('video/upload') ? 'bg-green-600' : '' }}">Video Upload</a>
                <a href="{{ url('/icons/create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 {{ request()->is('icons/create') ? 'bg-green-600' : '' }}">Icon Upload</a>

                <!-- Dropdown Menu -->
                <div class="relative group">
                    <button class="bg-gray-700 text-white px-4 py-2 rounded-full hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center">
                        Menu
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Content -->
                    <div class="absolute hidden group-hover:block bg-white text-gray-900 mt-2 py-2 rounded shadow-lg w-48 z-10">
                        <a href="{{ url('profile') }}" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="{{ url('courses') }}" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fa-solid fa-book mr-2"></i> My Courses
                        </a>
                        <a href="{{ url('lectures') }}" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fa-solid fa-video mr-2"></i> Lectures
                        </a>
                        <a href="{{ url('announcements') }}" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fa-solid fa-envelope mr-2"></i> Announsments
                        </a>
                        <a href="{{ url('fee') }}" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fa-solid fa-dollar-sign mr-2"></i> Fee Submission
                        </a>
                        <a href="{{ url('setting') }}" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-gray-200 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                        </a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden bg-blue-800 lg:hidden px-6 py-4">
            <a href="{{ url('/') }}" class="block py-2 text-white hover:bg-blue-700 rounded">Home</a>
            <a href="{{ url('/fee-status-check') }}" class="block py-2 text-white hover:bg-blue-700 rounded">Stealth</a>
            <a href="{{ url('fee_approvel') }}" class="block py-2 text-white hover:bg-blue-700 rounded">Fee Approval</a>
            <a href="{{ url('/registration') }}" class="block py-2 text-white hover:bg-blue-700 rounded">Registration Approval</a>
            <a href="{{ url('/video/upload') }}" class="block py-2 text-white hover:bg-blue-700 rounded">Video Upload</a>
            <a href="{{ url('/icons/create') }}" class="block py-2 text-white hover:bg-blue-700 rounded">Icon Upload</a>
        </div>
    </div>

    <script>
        // Toggle mobile menu
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
