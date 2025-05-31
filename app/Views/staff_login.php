<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Vault Login</title>
    <!-- Tailwind CSS Local -->
    <link href="<?= base_url('/css/tailwind.css') ?>" rel="stylesheet">
    
    <style>
        .background-image {
            background-image: url('<?= base_url("assets/staff-login.svg") ?>');
        }
        
        .background-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="m-0 h-screen overflow-hidden flex">
    <!-- Login Side -->
    <div class="w-full md:w-[30%] bg-primary-bg flex items-center justify-center p-8">
        <div class="w-full max-w-md">
            <!-- Error Alert -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-900/20 border border-red-600/30 text-red-200 p-3 rounded-lg text-center mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <!-- Logo -->
            <img src="<?= base_url(relativePath: 'assets/BookVault-Logo.png') ?>" 
                 alt="Book Vault Logo" 
                 class="block mx-auto mb-8 max-w-80 h-auto rounded-lg">
            
            <!-- Title -->
            <h3 class="text-white text-center mb-6 font-medium text-xl">Please sign in</h3>

            <!-- Login Form -->
            <form method="post" action="/staff/login" class="space-y-4">
                <!-- Username Input -->
                <div>
                    <input 
                        type="text" 
                        name="username" 
                        class="w-full bg-white/10 border border-white/20 text-text-light rounded-lg px-4 py-3 placeholder-white/70 focus:border-primary-accent focus:outline-none focus:ring-2 focus:ring-primary-accent/25 focus:bg-white/15 focus:text-white transition-all duration-200" 
                        placeholder="Username or Email" 
                        required>
                </div>

                <!-- Password Input Group -->
                <div>
                    <div class="relative flex">
                        <input 
                            type="password" 
                            name="password" 
                            class="w-full bg-white/10 border border-white/20 text-text-light rounded-l-lg px-4 py-3 placeholder-white/70 focus:border-primary-accent focus:outline-none focus:ring-2 focus:ring-primary-accent/25 focus:bg-white/15 focus:text-white transition-all duration-200" 
                            placeholder="Password" 
                            id="passwordInput" 
                            required>
                        <button 
                            type="button" 
                            class="bg-white/10 border border-white/20 border-l-0 text-text-light rounded-r-lg px-4 py-3 hover:bg-white/20 hover:border-white/30 hover:text-white transition-all duration-200" 
                            onclick="togglePassword()">👁️</button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    class="w-full bg-gradient-to-br from-primary-accent to-button-hover text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 hover:from-button-hover hover:to-primary-accent hover:-translate-y-0.5 hover:shadow-lg hover:shadow-button-hover/30" 
                    type="submit">
                    Sign in
                </button>
            </form>
        </div>
    </div>

    <!-- Background Side -->
    <div class="hidden md:block w-[70%] background-image bg-cover bg-center relative background-overlay">
        <!-- Background image will be displayed here -->
    </div>

    <!-- Mobile Responsive: Background for small screens -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 h-[40vh] background-image bg-cover bg-center background-overlay -z-10">
        <!-- Background image for mobile -->
    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleBtn = event.target;
            
            if (passwordInput.getAttribute('type') === 'password') {
                passwordInput.setAttribute('type', 'text');
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.setAttribute('type', 'password');
                toggleBtn.textContent = '👁️';
            }
        }
    </script>
</body>
</html>