<?php
// admin_header.php - Reusable Header Component
?>
<header class="fixed top-0 right-0 left-64 bg-primary-bg/80 backdrop-blur-sm border-b border-white/10 z-30 transition-all duration-300">
    <div class="flex items-center justify-between px-6 py-4">
        <!-- Left Side - Page Title & Breadcrumb -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Toggle (Hidden on Desktop) -->
            <button class="lg:hidden text-text-light hover:text-white transition-colors duration-200" 
                    onclick="toggleSidebar()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Page Title -->
            <div>
                <h1 class="text-xl font-semibold text-white">
                    <?= $pageTitle ?? 'Dashboard' ?>
                </h1>
                <?php if(isset($breadcrumb)): ?>
                    <nav class="text-sm text-text-light">
                        <?php foreach($breadcrumb as $index => $item): ?>
                            <?php if($index > 0): ?>
                                <span class="mx-2">›</span>
                            <?php endif; ?>
                            <?php if(isset($item['url']) && $index < count($breadcrumb) - 1): ?>
                                <a href="<?= $item['url'] ?>" class="hover:text-primary-accent transition-colors duration-200">
                                    <?= $item['title'] ?>
                                </a>
                            <?php else: ?>
                                <span><?= $item['title'] ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Side - User Info & Actions -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <button class="relative p-2 text-text-light hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5V17zM10.07 2.82l-.65-.65a1.5 1.5 0 00-2.12 0L5.64 3.84a1.5 1.5 0 000 2.12l.65.65m3.78-3.78l-1.06 1.06m1.06-1.06l6.35 6.35m-7.41-5.29l-1.06 1.06m1.06-1.06l5.29 5.29m-6.35 4.23l1.06-1.06m-1.06 1.06l-5.29-5.29m7.41 5.29l1.06-1.06m-1.06 1.06l-4.23-4.23"></path>
                </svg>
                <!-- Notification Badge -->
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
            </button>
            
            <!-- User Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="flex items-center space-x-3 p-2 text-text-light hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200">
                    <!-- User Avatar -->
                    <div class="w-8 h-8 bg-gradient-to-br from-primary-accent to-button-hover rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            <?= strtoupper(substr(session('staff_name') ?? 'A', 0, 1)) ?>
                        </span>
                    </div>
                    
                    <!-- User Info -->
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-white">
                            <?= session('staff_name') ?? 'Administrator' ?>
                        </p>
                        <p class="text-xs text-text-light">
                            <?= session('staff_role') ?? 'Admin' ?>
                        </p>
                    </div>
                    
                    <!-- Dropdown Arrow -->
                    <svg class="w-4 h-4 transition-transform duration-200" 
                         :class="{ 'rotate-180': open }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-primary-bg border border-white/20 rounded-lg shadow-lg z-50">
                    
                    <div class="py-2">
                        <a href="<?= base_url('/admin/profile') ?>" 
                           class="flex items-center px-4 py-2 text-text-light hover:bg-white/10 hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </a>
                        
                        <a href="<?= base_url('/admin/settings') ?>" 
                           class="flex items-center px-4 py-2 text-text-light hover:bg-white/10 hover:text-white transition-all duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                        
                        <hr class="my-2 border-white/10">
                        
                        <a href="<?= base_url('/staff/logout') ?>" 
                           class="flex items-center px-4 py-2 text-red-300 hover:bg-red-900/20 hover:text-red-200 transition-all duration-200">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" 
     class="fixed inset-0 bg-black/50 z-35 lg:hidden hidden" 
     onclick="toggleSidebar()"></div>

<script>
// Mobile Sidebar Toggle
function toggleSidebar() {
    const sidebar = document.querySelector('aside');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

// Make sidebar responsive
window.addEventListener('resize', function() {
    if (window.innerWidth >= 1024) { // lg breakpoint
        const sidebar = document.querySelector('aside');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.add('hidden');
    }
});
</script>