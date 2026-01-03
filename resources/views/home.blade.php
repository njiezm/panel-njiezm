<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NJIEZM.FR | Admin</title>
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
            background-color: #f0f2f5;
            font-family: 'Space Grotesk', sans-serif;
            color: var(--nj-dark);
            scroll-behavior: smooth;
            margin: 0;
            padding: 0;
        }

        .brand-font { 
            font-family: 'Special Elite', cursive; 
        }

        .hero-section {
            background: linear-gradient(135deg, var(--nj-blue) 0%, #004080 100%);
            color: white;
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,112C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 30px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            font-size: 2.5rem;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .brand-logo:hover {
            color: var(--nj-yellow);
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .features-section {
            padding: 80px 0;
            background: white;
        }

        .feature-card {
            background: white;
            border: 2px solid var(--nj-blue);
            box-shadow: 6px 6px 0px var(--nj-yellow);
            border-radius: 0;
            padding: 30px;
            height: 100%;
            transition: transform 0.2s;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--nj-blue);
            margin-bottom: 20px;
        }

        .cta-section {
            background-color: #f1f3f4;
            padding: 80px 0;
            text-align: center;
        }

        .btn-primary-custom {
            background-color: var(--nj-blue);
            border-color: var(--nj-blue);
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom:hover {
            background-color: #002244;
            border-color: #002244;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 0;
            margin-left: 15px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background-color: white;
            color: var(--nj-blue);
        }

        .footer {
            background-color: var(--nj-dark);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .social-links a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--nj-yellow);
        }

        .testimonial-card {
            background: white;
            border-left: 4px solid var(--nj-yellow);
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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

        /* Dark mode styles */
        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .features-section {
            background: #1e1e1e;
        }

        .dark-mode .feature-card {
            background: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .cta-section {
            background: #2a2a2a;
        }

        .dark-mode .testimonial-card {
            background: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .footer {
            background: #0d0d0d;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
    </button>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <a href="/" class="brand-logo brand-font">
                NJIEZM<span style="color: var(--nj-yellow);">.FR</span>
            </a>
            <h1 class="hero-title">Admin Pannel Pro</h1>
            <p class="hero-subtitle">La plateforme tout-en-un pour gérer votre marque, vos documents et votre équipe</p>
            
            @guest
                <div class="hero-buttons">
                    <a href="{{ route('register') }}" class="btn btn-primary-custom">Commencer</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-custom">Se connecter</a>
                </div>
            @else
                <div class="hero-buttons">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary-custom">Accéder au tableau de bord</a>
                </div>
            @endguest
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-12">
                    <h2 class="display-5 fw-bold">Fonctionnalités principales</h2>
                    <p class="lead">Découvrez tout ce que notre plateforme peut faire pour vous</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3>Gestion de documents</h3>
                        <p>Créez et gérez facilement vos devis, factures et autres documents professionnels avec notre système intuitif.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h3>Gestion de projets</h3>
                        <p>Suivez l'avancement de vos projets, collaborez avec votre équipe et respectez les délais grâce à notre tableau de bord.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Gestion d'équipe</h3>
                        <p>Organisez votre équipe, attribuez des rôles et suivez les performances individuelles avec notre système de permissions.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <h3>Réseaux sociaux</h3>
                        <p>Planifiez et générez du contenu pour vos réseaux sociaux avec nos générateurs Instagram et LinkedIn intégrés.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h3>Ressources de marque</h3>
                        <p>Centralisez et accédez facilement à tous vos actifs de marque (logos, couleurs, typographies) en un seul endroit.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>Calendrier intégré</h3>
                        <p>Planifiez vos événements, réunions et échéances avec notre calendrier partagé et synchronisable.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-5">Ce que nos utilisateurs en disent</h2>
                    
                    <div class="testimonial-card">
                        <p class="mb-3">"Brand Center Pro a transformé la façon dont nous gérons notre marque. Tout est au même endroit, ce qui nous fait gagner un temps précieux."</p>
                        <footer class="blockquote-footer">Marie Dupont, Directrice Marketing</footer>
                    </div>
                    
                    <div class="testimonial-card">
                        <p class="mb-3">"La génération de documents est devenue un jeu d'enfant. Je recommande cette plateforme à toutes les petites entreprises."</p>
                        <footer class="blockquote-footer">Jean Martin, Fondateur de StartupTech</footer>
                    </div>
                    
                    <div class="testimonial-card">
                        <p class="mb-3">"L'interface est intuitive et les fonctionnalités sont exactement ce dont nous avions besoin pour notre équipe."</p>
                        <footer class="blockquote-footer">Sophie Lemaire, Chef de Projet</footer>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="features-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="display-5 fw-bold mb-4">Prêt à simplifier votre gestion ?</h2>
                    <p class="lead mb-5">Rejoignez-nous dès aujourd'hui et transformez votre façon de travailler</p>
                    
                    @guest
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('register') }}" class="btn btn-primary-custom me-3">Commencer gratuitement</a>
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">Se connecter</a>
                        </div>
                    @else
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary-custom">Accéder au tableau de bord</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="brand-font">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></h5>
                    <p>Plateforme de gestion intégrée pour les entreprises modernes.</p>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        @guest
                            <li><a href="{{ route('login') }}" class="text-white-50">Connexion</a></li>
                            <li><a href="{{ route('register') }}" class="text-white-50">Inscription</a></li>
                        @endguest
                        <li><a href="#" class="text-white-50">À propos</a></li>
                        <li><a href="#" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5>Suivez-nous</h5>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 bg-white-50">
            
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center text-white-50">© {{ date('Y') }} NJIEZM.FR. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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