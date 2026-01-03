<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - NJIEZM.FR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --nj-blue: #003366;
            --nj-yellow: #FFD700;
            --nj-white: #F8F9FA;
            --nj-dark: #1a1a1a;
            --nj-light: #e9ecef;
            --nj-success: #28a745;
            --nj-danger: #dc3545;
            --nj-purple: #6f42c1;
            --nj-pink: #e83e8c;
            --nj-teal: #20c997;
            --nj-orange: #fd7e14;
        }

        body {
            background: linear-gradient(135deg, var(--nj-blue) 0%, #004080 100%);
            font-family: 'Space Grotesk', sans-serif;
            color: var(--nj-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .brand-font { 
            font-family: 'Special Elite', cursive; 
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border: 2px solid var(--nj-blue);
            box-shadow: 8px 8px 0px var(--nj-yellow);
            border-radius: 0;
            overflow: hidden;
        }

        .register-header {
            background: var(--nj-blue);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .register-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--nj-yellow);
        }

        .register-logo {
            font-size: 2rem;
            margin-bottom: 15px;
            display: block;
        }

        .register-body {
            padding: 40px 30px;
        }

        .form-control {
            border: 1px solid var(--nj-light);
            border-radius: 0;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--nj-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 102, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--nj-dark);
        }

        .btn-register {
            background: var(--nj-blue);
            border: none;
            color: white;
            padding: 12px;
            font-weight: 500;
            border-radius: 0;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-register:hover {
            background: #002244;
            transform: translateY(-2px);
        }

        .btn-register:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 102, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--nj-blue);
            border-color: var(--nj-blue);
        }

        .alert-danger {
            border-radius: 0;
            border-left: 4px solid var(--nj-danger);
        }

        .register-footer {
            text-align: center;
            padding: 20px 30px;
            background: #f8f9fa;
            border-top: 1px solid var(--nj-light);
        }

        .register-footer a {
            color: var(--nj-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .register-footer a:hover {
            color: #002244;
            text-decoration: underline;
        }

        .input-group-text {
            background: var(--nj-light);
            border: 1px solid var(--nj-light);
            border-radius: 0;
            color: var(--nj-dark);
        }

        .password-toggle {
            cursor: pointer;
        }

        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 0;
        }

        .strength-weak {
            background-color: var(--nj-danger);
            width: 33%;
        }

        .strength-medium {
            background-color: var(--nj-orange);
            width: 66%;
        }

        .strength-strong {
            background-color: var(--nj-success);
            width: 100%;
        }

        .social-login {
            margin-top: 30px;
            text-align: center;
        }

        .social-login p {
            color: #6c757d;
            margin-bottom: 15px;
            position: relative;
        }

        .social-login p::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
            z-index: 1;
        }

        .social-login p span {
            background: white;
            padding: 0 15px;
            position: relative;
            z-index: 2;
        }

        .social-buttons {
            display: flex;
            gap: 10px;
        }

        .social-btn {
            flex: 1;
            padding: 10px;
            border: 1px solid #dee2e6;
            background: white;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .social-btn:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }

        .social-btn i {
            font-size: 18px;
        }

        .social-btn.google {
            color: #ea4335;
        }

        .social-btn.facebook {
            color: #1877f2;
        }

        .social-btn.linkedin {
            color: #0077b5;
        }

        .terms-text {
            font-size: 14px;
            color: #6c757d;
            margin-top: 15px;
        }

        .terms-text a {
            color: var(--nj-blue);
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        /* Dark mode styles */
        body.dark-mode {
            background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
        }

        .dark-mode .register-card {
            background: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .register-header {
            background: #0d0d0d;
        }

        .dark-mode .register-body {
            background: #1e1e1e;
        }

        .dark-mode .form-control {
            background: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .dark-mode .form-control:focus {
            background: #2a2a2a;
            border-color: var(--nj-blue);
        }

        .dark-mode .form-label {
            color: #e0e0e0;
        }

        .dark-mode .register-footer {
            background: #2a2a2a;
            border-color: #444;
        }

        .dark-mode .social-login p span {
            background: #1e1e1e;
        }

        .dark-mode .social-btn {
            background: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .dark-mode .social-btn:hover {
            background: #333;
        }

        .dark-mode .terms-text {
            color: #aaa;
        }

        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--nj-blue);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001;
        }

        /* Media queries */
        @media (max-width: 576px) {
            .register-body {
                padding: 30px 20px;
            }
            
            .social-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
    </button>

    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <a href="/" class="register-logo brand-font text-decoration-none">
                    NJIEZM<span style="color: var(--nj-yellow);">.FR</span>
                </a>
                <h3 class="mb-0">Inscription</h3>
            </div>
            
            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" onkeyup="checkPasswordStrength()">
                            <span class="input-group-text password-toggle" onclick="togglePassword()">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </span>
                        </div>
                        <div class="progress password-strength">
                            <div class="progress-bar" id="password-strength-bar"></div>
                        </div>
                        <small class="text-muted">Le mot de passe doit contenir au moins 8 caractères</small>
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <span class="input-group-text password-toggle" onclick="toggleConfirmPassword()">
                                <i class="fas fa-eye" id="confirm-password-icon"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a>
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-register">
                            S'inscrire
                        </button>
                    </div>
                </form>

                <div class="social-login">
                    <p><span>OU</span></p>
                    <div class="social-buttons">
                        <button type="button" class="btn social-btn google">
                            <i class="fab fa-google"></i> Google
                        </button>
                        <button type="button" class="btn social-btn facebook">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </button>
                        <button type="button" class="btn social-btn linkedin">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="register-footer">
                <p class="mb-0">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Toggle confirm password visibility
        function toggleConfirmPassword() {
            const confirmPasswordInput = document.getElementById('password-confirm');
            const confirmPasswordIcon = document.getElementById('confirm-password-icon');
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                confirmPasswordIcon.classList.remove('fa-eye');
                confirmPasswordIcon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                confirmPasswordIcon.classList.remove('fa-eye-slash');
                confirmPasswordIcon.classList.add('fa-eye');
            }
        }

        // Check password strength
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('password-strength-bar');
            
            let strength = 0;
            
            // Check length
            if (password.length >= 8) strength += 1;
            
            // Check for lowercase letters
            if (/[a-z]/.test(password)) strength += 1;
            
            // Check for uppercase letters
            if (/[A-Z]/.test(password)) strength += 1;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength += 1;
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Update progress bar
            strengthBar.className = 'progress-bar';
            
            if (password.length === 0) {
                strengthBar.style.width = '0%';
            } else if (strength <= 2) {
                strengthBar.style.width = '33%';
                strengthBar.classList.add('bg-danger');
            } else if (strength <= 4) {
                strengthBar.style.width = '66%';
                strengthBar.classList.add('bg-warning');
            } else {
                strengthBar.style.width = '100%';
                strengthBar.classList.add('bg-success');
            }
        }

        // Toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const darkModeToggle = document.querySelector('.dark-mode-toggle i');
            
            if (document.body.classList.contains('dark-mode')) {
                darkModeToggle.classList.remove('fa-moon');
                darkModeToggle.classList.add('fa-sun');
            } else {
                darkModeToggle.classList.remove('fa-sun');
                darkModeToggle.classList.add('fa-moon');
            }
        }
    </script>
</body>
</html>