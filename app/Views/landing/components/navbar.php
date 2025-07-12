<!-- app/Views/landing/components/navbar.php -->
<nav class="bg-[rgb(33,51,42)] shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo dan Brand -->
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-24" src="<?= base_url('assets/landscape-logo-no-bg.png') ?>" alt="Logo Perpustakaan">
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="<?= site_url('/') ?>" 
                       class="text-gray-300 hover:text-green-800 px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out <?= (current_url() == site_url('/')) ? 'bg-green-700 text-white' : '' ?>">
                        Beranda
                    </a>
                    <a href="<?= site_url('catalog') ?>" 
                       class="text-gray-300 hover:text-green-800 px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out <?= (current_url() == site_url('catalog')) ? 'bg-green-700 text-white' : '' ?>">
                        Katalog
                    </a>
                </div>
            </div>

            <!-- Login Button -->
            <div class="hidden md:block">
    <?php if (session()->get('is_member_logged_in')): ?>
        <div class="relative">
            <button 
                id="userDropdownButton"
                onclick="toggleUserDropdown()" 
                class="bg-[#D9C6A1] text-[rgb(33,51,42)] px-4 py-2 rounded-lg text-sm font-medium transition duration-300"
            >
                <?= esc(session()->get('username')) ?>
            </button>
            <div 
                id="userDropdownMenu" 
                class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden z-50"
            >
                <a href="<?= site_url('member/logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <!-- Login button -->
        <a href="<?= site_url('member/login') ?>" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300 ease-in-out transform hover:scale-105 flex items-center space-x-2">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            <span>Login</span>
        </a>
    <?php endif; ?>
</div>



            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" 
                        class="mobile-menu-button text-gray-400 hover:text-white hover:bg-green-700 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300"
                        aria-expanded="false">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-green-800">
            <a href="<?= site_url('/') ?>" 
               class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition duration-300 <?= (current_url() == site_url('/')) ? 'bg-green-700 text-white' : '' ?>">
                Beranda
            </a>
            <a href="<?= site_url('catalog') ?>" 
               class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition duration-300 <?= (current_url() == site_url('catalog')) ? 'bg-green-700 text-white' : '' ?>">
                Katalog
            </a>
            <a href="<?= site_url('about') ?>" 
               class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition duration-300 <?= (current_url() == site_url('about')) ? 'bg-green-700 text-white' : '' ?>">
                Tentang
            </a>
            <a href="<?= site_url('contact') ?>" 
               class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium transition duration-300 <?= (current_url() == site_url('contact')) ? 'bg-green-700 text-white' : '' ?>">
                Kontak
            </a>
            <!-- Mobile Login Button -->
            <div class="px-3 py-2">
                <a href="<?= site_url('member/login') ?>" 
                   class="bg-green-600 hover:bg-green-700 text-white w-full px-4 py-2 rounded-lg text-sm font-medium transition duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Login</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.querySelector('.mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.querySelector('.mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>

<script>
    function toggleUserDropdown() {
        const dropdown = document.getElementById("userDropdownMenu");
        dropdown.classList.toggle("hidden");
    }

    // Optional: tutup dropdown jika klik di luar area
    window.addEventListener('click', function(e) {
        const button = document.getElementById("userDropdownButton");
        const menu = document.getElementById("userDropdownMenu");
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
</script>
