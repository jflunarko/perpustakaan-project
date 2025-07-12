<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Vault - Member Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .simple-hover {
            transition: all 0.2s ease;
        }
        .simple-hover:hover {
            transform: translateY(-2px);
        }
        .bg-image {
            background-image: url('<?= base_url('assets/wallpaper-member-login.jpg') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="min-h-screen flex">
    
    <!-- Left Section - Register Form -->
    <div class="w-[30%] bg-[rgb(33,51,42)] flex items-center justify-center p-8">
        <div class="w-full max-w-sm">
            
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <img src="<?= base_url('assets/logo-vault-no-bg.png') ?>" alt="Book Vault Logo" class="w-28 h-auto rounded-lg">
                <div>
                    <h1 class="text-xl font-bold text-white mb-2">Join Book Vault!</h1>
                    <p class="text-[#D9C6A1] text-sm">Create your Book Vault account</p>
                </div>
            </div>

            <!-- Error Alert -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-500/20 border border-red-400/50 text-red-200 p-3 rounded-lg text-center mb-6">
                    <span class="text-sm"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <form method="post" action="/member/register" class="space-y-5">
                <div>
                    <label class="text-[#D9C6A1] text-sm font-medium block mb-2">Username</label>
                    <input type="text" name="username" class="w-full bg-white/10 border border-[#D9C6A1]/30 text-white rounded-lg px-4 py-3" required>
                </div>

                <div>
                    <label class="text-[#D9C6A1] text-sm font-medium block mb-2">Email</label>
                    <input type="email" name="email" class="w-full bg-white/10 border border-[#D9C6A1]/30 text-white rounded-lg px-4 py-3" required>
                </div>

                <div>
                    <label class="text-[#D9C6A1] text-sm font-medium block mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-white/10 border border-[#D9C6A1]/30 text-white rounded-lg px-4 py-3" required>
                </div>

                <div>
                    <label class="text-[#D9C6A1] text-sm font-medium block mb-2">Phone</label>
                    <input type="text" name="phone" class="w-full bg-white/10 border border-[#D9C6A1]/30 text-white rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="text-[#D9C6A1] text-sm font-medium block mb-2">Address</label>
                    <textarea name="address" rows="2" class="w-full bg-white/10 border border-[#D9C6A1]/30 text-white rounded-lg px-4 py-3"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#D9C6A1] hover:bg-[#c9b892] text-[rgb(33,51,42)] py-3 px-4 rounded-lg font-semibold simple-hover">
                    Register Now
                </button>
            </form>

            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-[#D9C6A1]/30"></div>
                <span class="px-4 text-[#D9C6A1] text-sm">or</span>
                <div class="flex-grow border-t border-[#D9C6A1]/30"></div>
            </div>

            <div class="text-center">
                <p class="text-[#D9C6A1] text-sm">
                    Already have an account?
                    <a href="/member/login" class="text-white hover:text-[#D9C6A1] font-medium">Sign In</a>
                </p>
            </div>

            <div class="text-center mt-8">
                <p class="text-[#D9C6A1]/70 text-xs">
                    © 2024 Book Vault. Your digital library companion.
                </p>
            </div>
        </div>
    </div>

    <!-- Right Section - Background Image -->
    <div class="w-[70%] bg-image"></div>

</body>
</html>
