<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NJIEZM.FR | Brand Center Pro')</title>
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
        }

        .sidebar {
            background: var(--nj-blue);
            min-height: 100vh;
            color: white;
            padding: 20px;
            position: fixed;
            width: 280px;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            max-height: 100vh;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-toggle {
            position: absolute;
            right: -15px;
            top: 20px;
            background: var(--nj-yellow);
            color: var(--nj-dark);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001;
        }

        .main-content {
            margin-left: 280px;
            padding: 40px;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .card-custom {
            background: white;
            border: 2px solid var(--nj-blue);
            box-shadow: 6px 6px 0px var(--nj-yellow);
            border-radius: 0;
            margin-bottom: 30px;
            padding: 25px;
            transition: transform 0.2s;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .brand-font { 
            font-family: 'Special Elite', cursive; 
        }
        
        .nav-link-custom {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 4px;
            font-size: 0.9rem;
            transition: 0.2s;
            position: relative;
            overflow: hidden;
        }

        .nav-link-custom:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--nj-yellow);
            transform: translateX(-100%);
            transition: transform 0.3s;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            background: rgba(255,255,255,0.1);
            color: var(--nj-yellow);
            padding-left: 20px;
        }

        .nav-link-custom:hover:before, .nav-link-custom.active:before {
            transform: translateX(0);
        }

        .preview-box {
            background: #eee;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px dashed var(--nj-blue);
            margin-bottom: 15px;
            position: relative;
            transition: all 0.3s;
        }

        .preview-box:hover {
            border-color: var(--nj-yellow);
            background: #f8f9fa;
        }

        .seasonal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .seasonal-item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            background: white;
            cursor: pointer;
            transition: 0.2s;
            position: relative;
            overflow: hidden;
        }

        .seasonal-item:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 215, 0, 0.2);
            transition: left 0.3s;
        }

        .seasonal-item:hover { 
            border-color: var(--nj-yellow); 
            transform: translateY(-3px);
        }

        .seasonal-item:hover:before {
            left: 0;
        }

        .drop-zone {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            background: #fafafa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .drop-zone.active {
            border-color: var(--nj-yellow);
            background: rgba(255, 215, 0, 0.1);
        }

        canvas { display: none; }

        .doc-preview {
            background: white;
            padding: 40px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            min-height: 600px;
            font-family: 'Space Grotesk', sans-serif;
        }

        .social-format-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background: #f8f9fa;
            transition: all 0.2s;
        }

        .social-format-box:hover {
            border-color: var(--nj-yellow);
            background: #fff;
        }

        .tab-custom {
            border-bottom: 2px solid var(--nj-blue);
            margin-bottom: 20px;
        }

        .tab-custom .nav-link {
            border: none;
            color: var(--nj-dark);
            font-weight: 500;
            padding: 10px 20px;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }

        .tab-custom .nav-link.active {
            background: var(--nj-blue);
            color: white;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--nj-danger);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        .activity-timeline {
            position: relative;
            padding-left: 30px;
        }

        .activity-timeline:before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            height: 100%;
            width: 2px;
            background: var(--nj-light);
        }

        .activity-item {
            position: relative;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .activity-item:before {
            content: '';
            position: absolute;
            left: -25px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--nj-blue);
        }

        .progress-ring {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .progress-ring circle {
            transition: stroke-dashoffset 0.5s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        .team-member {
            text-align: center;
            padding: 15px;
            border: 1px solid var(--nj-light);
            margin-bottom: 15px;
            transition: all 0.2s;
        }

        .team-member:hover {
            border-color: var(--nj-yellow);
            transform: translateY(-3px);
        }

        .team-member img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid var(--nj-blue);
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .status-online { background: var(--nj-success); }
        .status-offline { background: #6c757d; }
        .status-busy { background: var(--nj-danger); }

        .ai-assistant {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: var(--nj-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: all 0.3s;
            z-index: 999;
        }

        .ai-assistant:hover {
            transform: scale(1.1);
            background: var(--nj-yellow);
            color: var(--nj-dark);
        }

        .ai-chat {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 450px;
            background: white;
            border: 2px solid var(--nj-blue);
            border-radius: 10px;
            display: none;
            flex-direction: column;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
            z-index: 998;
        }

        .ai-chat.active {
            display: flex;
        }

        .ai-chat-header {
            background: var(--nj-blue);
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ai-chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
        }

        .ai-chat-footer {
            padding: 15px;
            border-top: 1px solid var(--nj-light);
        }

        .ai-message {
            margin-bottom: 15px;
            display: flex;
        }

        .ai-message.user {
            justify-content: flex-end;
        }

        .ai-message-content {
            max-width: 80%;
            padding: 10px;
            border-radius: 10px;
        }

        .ai-message.assistant .ai-message-content {
            background: var(--nj-light);
        }

        .ai-message.user .ai-message-content {
            background: var(--nj-blue);
            color: white;
        }

        .calendar-widget {
            background: white;
            border: 1px solid var(--nj-light);
            border-radius: 5px;
            padding: 15px;
        }

        .calendar-day {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-day:hover {
            background: var(--nj-light);
        }

        .calendar-day.today {
            background: var(--nj-blue);
            color: white;
        }

        .calendar-day.has-event {
            position: relative;
        }

        .calendar-day.has-event:after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background: var(--nj-yellow);
            border-radius: 50%;
        }

        .quick-action {
            background: white;
            border: 1px solid var(--nj-light);
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quick-action:hover {
            border-color: var(--nj-yellow);
            transform: translateY(-3px);
        }

        .quick-action i {
            font-size: 24px;
            color: var(--nj-blue);
            margin-bottom: 10px;
        }

        .project-card {
            border: 1px solid var(--nj-light);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.2s;
        }

        .project-card:hover {
            border-color: var(--nj-yellow);
            transform: translateY(-3px);
        }

        .project-progress {
            height: 8px;
            background: var(--nj-light);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 10px;
        }

        .project-progress-bar {
            height: 100%;
            background: var(--nj-blue);
        }

        .tag {
            display: inline-block;
            padding: 3px 8px;
            background: var(--nj-light);
            border-radius: 12px;
            font-size: 0.8rem;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid var(--nj-light);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--nj-dark);
        }

        .dashboard-stat {
            text-align: center;
            padding: 20px;
            background: white;
            border: 1px solid var(--nj-light);
            border-radius: 5px;
            margin-bottom: 20px;
            transition: all 0.2s;
        }

        .dashboard-stat:hover {
            border-color: var(--nj-yellow);
            transform: translateY(-3px);
        }

        .dashboard-stat i {
            font-size: 30px;
            color: var(--nj-blue);
            margin-bottom: 10px;
        }

        .dashboard-stat h3 {
            margin: 0;
            font-size: 24px;
            color: var(--nj-dark);
        }

        .dashboard-stat p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }

        .file-manager {
            background: white;
            border: 1px solid var(--nj-light);
            border-radius: 5px;
            padding: 15px;
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid var(--nj-light);
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-item:hover {
            background: var(--nj-light);
        }

        .file-item i {
            font-size: 20px;
            margin-right: 10px;
            color: var(--nj-blue);
        }

        .file-item .file-name {
            flex: 1;
        }

        .file-item .file-size {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .file-item .file-date {
            color: #6c757d;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin-bottom: 20px;
        }

        .breadcrumb-custom .breadcrumb-item {
            color: var(--nj-dark);
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--nj-blue);
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item:before {
            content: ">";
            color: var(--nj-dark);
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .card-custom {
            background: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .sidebar {
            background: #0d0d0d;
        }

        .dark-mode .main-content {
            background-color: #121212;
        }

        .dark-mode .nav-link-custom {
            color: rgba(255,255,255,0.7);
        }

        .dark-mode .nav-link-custom:hover, .dark-mode .nav-link-custom.active {
            background: rgba(255,255,255,0.1);
            color: var(--nj-yellow);
        }

        .dark-mode .preview-box {
            background: #2a2a2a;
            border-color: #444;
        }

        .dark-mode .drop-zone {
            background: #2a2a2a;
            border-color: #444;
        }

        .dark-mode .doc-preview {
            background: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .social-format-box {
            background: #2a2a2a;
            border-color: #444;
        }

        .dark-mode .tab-custom .nav-link {
            color: #e0e0e0;
        }

        .dark-mode .tab-custom .nav-link.active {
            background: var(--nj-blue);
            color: white;
        }

        .dark-mode .team-member {
            background: #1e1e1e;
            border-color: #444;
        }

        .dark-mode .ai-chat {
            background: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .ai-message.assistant .ai-message-content {
            background: #2a2a2a;
        }

        .dark-mode .calendar-widget {
            background: #1e1e1e;
            border-color: #444;
        }

        .dark-mode .quick-action {
            background: #1e1e1e;
            border-color: #444;
        }

        .dark-mode .project-card {
            background: #1e1e1e;
            border-color: #444;
        }

        .dark-mode .search-box input {
            background: #2a2a2a;
            border-color: #444;
            color: #e0e0e0;
        }

        .dark-mode .dashboard-stat {
            background: #1e1e1e;
            border-color: #444;
        }

        .dark-mode .file-manager {
            background: #1e1e1e;
            border-color: #444;
        }

        .dark-mode .file-item {
            border-color: #444;
        }

        .dark-mode .file-item:hover {
            background: #2a2a2a;
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
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .ai-chat {
                width: calc(100% - 40px);
                right: 20px;
                left: 20px;
            }
        }

        /* Dans votre fichier CSS principal */
.card-custom {
    margin-left: 0;
    padding-left: 15px;
    overflow-x: hidden;
}

/* Pour les conteneurs qui débordent */
.row {
    margin-left: 0;
    margin-right: 0;
}

.col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
}

/* Pour les éléments qui peuvent causer un débordement */
.preview-box, .social-format-box {
    max-width: 100%;
    box-sizing: border-box;
}

/* Styles pour les templates de contenu */
.content-template {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.content-template:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.content-template.border-primary {
    border-color: #007bff;
    background-color: rgba(0, 123, 255, 0.05);
}

/* Styles pour les posts Instagram */
.instagram-post {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    background-color: white;
}

.instagram-header {
    display: flex;
    align-items: center;
    padding: 10px 15px;
}

.instagram-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #003366;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 10px;
}

.instagram-username {
    font-weight: bold;
}

.instagram-actions {
    display: flex;
    padding: 10px 15px;
}

.instagram-action-btn {
    background: none;
    border: none;
    font-size: 20px;
    margin-right: 15px;
    cursor: pointer;
}

.instagram-caption {
    padding: 0 15px 15px;
}

/* Styles pour les posts LinkedIn */
.linkedin-post {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    background-color: white;
}

.linkedin-header {
    display: flex;
    align-items: center;
    padding: 15px;
}

.linkedin-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #003366;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 10px;
}

.linkedin-info {
    flex-grow: 1;
}

.linkedin-name {
    font-weight: bold;
}

.linkedin-headline {
    font-size: 14px;
    color: #666;
}

.linkedin-time {
    font-size: 12px;
    color: #999;
}

.linkedin-follow-btn {
    background-color: #0a66c2;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 5px 15px;
    font-weight: bold;
    cursor: pointer;
}

.linkedin-content {
    padding: 0 15px;
}

.linkedin-actions {
    display: flex;
    padding: 15px;
    border-top: 1px solid #e0e0e0;
}

.linkedin-action-btn {
    background: none;
    border: none;
    font-size: 14px;
    margin-right: 20px;
    cursor: pointer;
    color: #666;
}

/* Styles pour les zones de dépôt de fichiers */
.drop-zone {
    border: 2px dashed #ccc;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.drop-zone:hover {
    background-color: #f8f9fa;
}

.drop-zone.bg-light {
    background-color: #f8f9fa;
}

/* Styles pour les tags */
.tag {
    display: inline-block;
    background-color: #e9ecef;
    color: #495057;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 12px;
    margin-right: 5px;
    margin-bottom: 5px;
}

/* Styles pour les placeholders gris */
.gray-placeholder {
    background-color: #f0f0f0;
    border: 1px dashed #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

/* Pour les écrans mobiles */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        width: 280px !important; /* S'assurer que la largeur est conservée */
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar.active {
        transform: translateX(0);
        z-index: 1050; /* Assurer que la sidebar est au-dessus du contenu */
    }

    .main-content {
        margin-left: 0;
        padding: 20px; /* Réduire le padding pour mobile */
    }

    .sidebar-toggle {
        position: fixed; /* Changement de absolute à fixed */
        left: 20px; /* Déplacer à gauche au lieu de droite */
        right: auto;
        top: 20px;
        z-index: 1002; /* Augmenter le z-index */
    }

    /* Ajouter un overlay pour fermer la sidebar quand on clique à l'extérieur */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 999;
        display: none;
    }

    .sidebar-overlay.active {
        display: block;
    }

    /* Ajustements pour le bouton de mode sombre */
    .dark-mode-toggle {
        top: 20px;
        right: 20px;
        z-index: 1003; /* S'assurer qu'il est au-dessus de la sidebar */
    }
}
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">
        <i class="fas fa-moon"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <h2 class="brand-font text-yellow mb-4" style="color: var(--nj-yellow);">NJIEZM<small>.FR</small></h2>
        
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" placeholder="Rechercher...">
        </div>

        <nav>
            <p class="small text-uppercase opacity-50 mb-2">Tableau de bord</p>
            <a href="{{ route('dashboard') }}" class="nav-link-custom {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Vue d'ensemble
                <!--span class="notification-badge"></!--span-->
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Visuels</p>
            <a href="{{ route('logos') }}" class="nav-link-custom {{ request()->is('logos') ? 'active' : '' }}">
                <i class="fas fa-image me-2"></i> Logos & Favicon
            </a>
            <a href="{{ route('logo-variations') }}" class="nav-link-custom {{ request()->is('logo-variations') ? 'active' : '' }}">
                <i class="fas fa-palette me-2"></i> Déclinaisons Logo
            </a>
            <a href="{{ route('seasonal') }}" class="nav-link-custom {{ request()->is('seasonal') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i> Déclinaisons Saisonnières
            </a>
            <a href="{{ route('marketing') }}" class="nav-link-custom {{ request()->is('marketing') ? 'active' : '' }}">
                <i class="fas fa-bullhorn me-2"></i> Marketing & Social Media
            </a>
            <a href="{{ route('instagram-generator') }}" class="nav-link-custom {{ request()->is('instagram-generator') ? 'active' : '' }}">
                <i class="fab fa-instagram me-2"></i> Générateur Instagram
            </a>
            <a href="{{ route('linkedin-generator') }}" class="nav-link-custom {{ request()->is('linkedin-generator') ? 'active' : '' }}">
                <i class="fab fa-linkedin me-2"></i> Générateur LinkedIn
            </a>
            <a href="{{ route('templates') }}" class="nav-link-custom {{ request()->is('templates') ? 'active' : '' }}">
                <i class="fas fa-file-alt me-2"></i> Modèles & Templates
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Administratif</p>
            <a href="{{ route('documents.index') }}" class="nav-link-custom {{ request()->is('documents') ? 'active' : '' }}">
                <i class="fas fa-file-invoice me-2"></i> Devis & Factures
            </a>
            <a href="{{ route('legal') }}" class="nav-link-custom {{ request()->is('legal') ? 'active' : '' }}">
                <i class="fas fa-gavel me-2"></i> Générateur de Contrats/Statuts
            </a>
            <a href="{{ route('signature') }}" class="nav-link-custom {{ request()->is('signature') ? 'active' : '' }}">
                <i class="fas fa-signature me-2"></i> Signature Email & Manuscrite
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Style</p>
            <a href="{{ route('colors') }}" class="nav-link-custom {{ request()->is('colors') ? 'active' : '' }}">
                <i class="fas fa-palette me-2"></i> Palette & Merch
            </a>
            <a href="{{ route('typography') }}" class="nav-link-custom {{ request()->is('typography') ? 'active' : '' }}">
                <i class="fas fa-font me-2"></i> Typographie
            </a>
            <a href="{{ route('brand-guidelines') }}" class="nav-link-custom {{ request()->is('brand-guidelines') ? 'active' : '' }}">
                <i class="fas fa-book me-2"></i> Charte Graphique
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Générateurs de contenu</p>
            <a href="{{ route('blog-generator') }}" class="nav-link-custom {{ request()->is('blog-generator') ? 'active' : '' }}">
                <i class="fas fa-blog me-2"></i> Articles de Blog
            </a>
            <a href="{{ route('email-generator') }}" class="nav-link-custom {{ request()->is('email-generator') ? 'active' : '' }}">
                <i class="fas fa-envelope me-2"></i> Emails Marketing
            </a>
            <a href="{{ route('video-generator') }}" class="nav-link-custom {{ request()->is('video-generator') ? 'active' : '' }}">
                <i class="fas fa-video me-2"></i> Scripts Vidéo
            </a>
            <a href="{{ route('presentation-generator') }}" class="nav-link-custom {{ request()->is('presentation-generator') ? 'active' : '' }}">
                <i class="fas fa-presentation me-2"></i> Présentations
            </a>
            <a href="{{ route('infographic-generator') }}" class="nav-link-custom {{ request()->is('infographic-generator') ? 'active' : '' }}">
                <i class="fas fa-chart-pie me-2"></i> Infographies
            </a>
            <a href="{{ route('press-release-generator') }}" class="nav-link-custom {{ request()->is('press-release-generator') ? 'active' : '' }}">
                <i class="fas fa-newspaper me-2"></i> Communiqués de Presse
            </a>
            <a href="{{ route('case-study-generator') }}" class="nav-link-custom {{ request()->is('case-study-generator') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list me-2"></i> Études de Cas
            </a>
            <a href="{{ route('testimonial-generator') }}" class="nav-link-custom {{ request()->is('testimonial-generator') ? 'active' : '' }}">
                <i class="fas fa-quote-right me-2"></i> Témoignages
            </a>
            <a href="{{ route('faq-generator') }}" class="nav-link-custom {{ request()->is('faq-generator') ? 'active' : '' }}">
                <i class="fas fa-question-circle me-2"></i> FAQ
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Collaboration</p>
            <a href="{{ route('team') }}" class="nav-link-custom {{ request()->is('team') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i> Équipe & Permissions
            </a>
            <a href="{{ route('projects.index') }}" class="nav-link-custom {{ request()->is('projects.index') ? 'active' : '' }}">
                <i class="fas fa-project-diagram me-2"></i> Projets
            </a>
            <a href="{{ route('calendar.index') }}" class="nav-link-custom {{ request()->is('calendar.index') ? 'active' : '' }}">
                <i class="fas fa-calendar me-2"></i> Calendrier
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Ressources</p>
            <a href="{{ route('files.index') }}" class="nav-link-custom {{ request()->is('files.index') ? 'active' : '' }}">
                <i class="fas fa-folder me-2"></i> Gestionnaire de fichiers
            </a>
            <a href="{{ route('analytics') }}" class="nav-link-custom {{ request()->is('analytics') ? 'active' : '' }}">
                <i class="fas fa-chart-line me-2"></i> Analytics
            </a>
            <a href="{{ route('integrations') }}" class="nav-link-custom {{ request()->is('integrations') ? 'active' : '' }}">
                <i class="fas fa-plug me-2"></i> Intégrations
            </a>
            
            <p class="small text-uppercase opacity-50 mt-4 mb-2">Paramètres</p>
            <a href="{{ route('settings') }}" class="nav-link-custom {{ request()->is('settings') ? 'active' : '' }}">
                <i class="fas fa-cog me-2"></i> Paramètres
            </a>
            
            @auth
    <p class="small text-uppercase opacity-50 mt-4 mb-2">Compte</p>
    <a href="{{ route('logout') }}"
       class="nav-link-custom"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endauth

        </nav>
    </div>

    <div class="main-content" id="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- AI ASSISTANT -->
    <div class="ai-assistant" onclick="toggleAIChat()">
        <i class="fas fa-robot fa-lg"></i>
    </div>

    <div class="ai-chat" id="ai-chat">
        <div class="ai-chat-header">
            <h5 class="mb-0">Assistant IA</h5>
            <button class="btn btn-sm" onclick="toggleAIChat()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="ai-chat-body" id="ai-chat-body">
            <div class="ai-message assistant">
                <div class="ai-message-content">
                    Bonjour ! Je suis votre assistant IA. Comment puis-je vous aider aujourd'hui ?
                </div>
            </div>
        </div>
        <div class="ai-chat-footer">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tapez votre message..." id="ai-input">
                <button class="btn btn-primary" onclick="sendAIMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <canvas id="export-canvas"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
       // Toggle sidebar
// Toggle sidebar (uniquement pour desktop)
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    
    // Uniquement pour les écrans de bureau
    if (window.innerWidth > 768) {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    }
}

// Ajouter cette fonction pour fermer la sidebar quand on clique sur l'overlay
document.getElementById('sidebar-overlay').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
});
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

        // Toggle AI Chat
        function toggleAIChat() {
            const aiChat = document.getElementById('ai-chat');
            aiChat.classList.toggle('active');
        }

        // Send AI Message
        function sendAIMessage() {
            const input = document.getElementById('ai-input');
            const chatBody = document.getElementById('ai-chat-body');
            
            if (input.value.trim() === '') return;
            
            // Add user message
            const userMessage = document.createElement('div');
            userMessage.className = 'ai-message user';
            userMessage.innerHTML = `<div class="ai-message-content">${input.value}</div>`;
            chatBody.appendChild(userMessage);
            
            // Clear input
            const userInput = input.value;
            input.value = '';
            
            // Simulate AI response
            setTimeout(() => {
                const aiMessage = document.createElement('div');
                aiMessage.className = 'ai-message assistant';
                
                // Simple response logic
                let response = "Je suis désolé, je ne comprends pas cette demande.";
                
                if (userInput.toLowerCase().includes('logo')) {
                    response = "Pour créer un nouveau logo, allez dans la section 'Logos & Favicon' dans le menu de gauche. Vous pouvez y télécharger votre logo ou utiliser le générateur intégré.";
                } else if (userInput.toLowerCase().includes('facture')) {
                    response = "Pour créer une facture, allez dans la section 'Devis & Factures' dans le menu de gauche. Remplissez les informations requises et cliquez sur 'PRÉVISUALISER'.";
                } else if (userInput.toLowerCase().includes('projet')) {
                    response = "Pour créer un nouveau projet, allez dans la section 'Projets' dans le menu de gauche et cliquez sur le bouton 'NOUVEAU PROJET'.";
                } else if (userInput.toLowerCase().includes('aide') || userInput.toLowerCase().includes('help')) {
                    response = "Je suis là pour vous aider ! Vous pouvez me poser des questions sur l'utilisation du Brand Center, comme créer des logos, des factures, ou gérer vos projets.";
                }
                
                aiMessage.innerHTML = `<div class="ai-message-content">${response}</div>`;
                chatBody.appendChild(aiMessage);
                
                // Scroll to bottom
                chatBody.scrollTop = chatBody.scrollHeight;
            }, 1000);
            
            // Scroll to bottom
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // Handle Enter key in AI input
        document.getElementById('ai-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendAIMessage();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>