<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Vault Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-bg: rgb(33, 51, 42);       /* Dark Green Background */
            --primary-accent: #6B7A62;   /* Vault Green Accent */
            --text-light: #D9C4A4;       /* Cream Text */
            --button-hover: #4C5B47;     /* Dark Olive Hover */
        }

        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        .login-side {
            width: 30%;
            background: var(--primary-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .background-side {
            width: 70%;
            background: url('<?= base_url("assets/staff-login.svg") ?>') center/cover no-repeat;
            position: relative;
        }

        .background-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }



        .logo {
            display: block;
            margin: 0 auto 2rem;
            max-width: 320px;
            height: auto;
            border-radius: 10px;
        }

        .sign-in-title {
            color: white;
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-light);
            border-radius: 10px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 0.2rem rgba(103, 125, 106, 0.25);
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-accent), var(--button-hover));
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--button-hover), var(--primary-accent));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(64, 83, 76, 0.3);
        }

        .btn-outline-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-light);
            border-radius: 0 10px 10px 0;
        }

        .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #f8d7da;
            border-radius: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .login-side {
                width: 100%;
                height: 60vh;
                order: 1;
            }
            
            .background-side {
                width: 100%;
                height: 40vh;
                order: 2;
            }
        }
    </style>
</head>
<body>
    <div class="login-side">
        <div class="login-container">
             <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <img src="<?= base_url(relativePath: 'assets/BookVault-Logo.png') ?>" alt="Book Vault Logo" class="logo">
            <h3 class="sign-in-title">Please sign in</h3>

            <form method="post" action="/do-login">
                <div class="mb-3">
                    <input 
                        type="text" 
                        name="username" 
                        class="form-control" 
                        placeholder="Username or Email" 
                        required>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            placeholder="Password" 
                            id="passwordInput" 
                            required>
                        <button 
                            type="button" 
                            class="btn btn-outline-secondary" 
                            onclick="togglePassword()">👁️</button>
                    </div>
                </div>

                <button class="btn btn-primary w-100" type="submit">Sign in</button>
            </form>
        </div>
    </div>

    <div class="background-side">
        <!-- Background image will be displayed here -->
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