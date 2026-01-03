@extends('layouts.app')

@section('title', 'Typographie - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Typographie</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">12. Typographie</h3>
    <p class="text-muted">Découvrez les polices qui définissent l'identité visuelle de NJIEZM.FR.</p>

    <!-- Onglets -->
    <ul class="nav nav-tabs tab-custom mt-4" id="typographyTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="fonts-tab" data-bs-toggle="tab" data-bs-target="#fonts" type="button" role="tab" aria-controls="fonts" aria-selected="true">
                <i class="fas fa-font me-2"></i>Polices Principales
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="hierarchy-tab" data-bs-toggle="tab" data-bs-target="#hierarchy" type="button" role="tab" aria-controls="hierarchy" aria-selected="false">
                <i class="fas fa-text-height me-2"></i>Hiérarchie Typographique
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="guidelines-tab" data-bs-toggle="tab" data-bs-target="#guidelines" type="button" role="tab" aria-controls="guidelines" aria-selected="false">
                <i class="fas fa-book me-2"></i>Directives d'Utilisation
            </button>
        </li>
    </ul>

    <div class="tab-content" id="typographyTabContent">
        
        <!-- Onglet Polices Principales -->
        <div class="tab-pane fade show active" id="fonts" role="tabpanel" aria-labelledby="fonts-tab">
            <div class="mt-4">
                <div class="row">
                    <!-- Space Grotesk -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">Space Grotesk</h4>
                                <p class="text-muted">Police principale pour le contenu textuel et les éléments d'interface.</p>
                                
                                <div class="font-examples mb-3">
                                    <div class="mb-3">
                                        <div class="font-weight-light" style="font-family: 'Space Grotesk', sans-serif; font-weight: 300; font-size: 24px;">
                                            Light: L'élégance dans la simplicité
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-normal" style="font-family: 'Space Grotesk', sans-serif; font-weight: 400; font-size: 24px;">
                                            Regular: La clarté avant tout
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-medium" style="font-family: 'Space Grotesk', sans-serif; font-weight: 500; font-size: 24px;">
                                            Medium: L'équilibre parfait
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-bold" style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 24px;">
                                            Bold: L'impact nécessaire
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Google Fonts</small>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('font-family: \'Space Grotesk\', sans-serif;', this)">
                                        <i class="fas fa-copy me-1"></i> Copier CSS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Special Elite -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title">Special Elite</h4>
                                <p class="text-muted">Police d'accent pour le branding et les titres marquants.</p>
                                
                                <div class="font-examples mb-3">
                                    <div class="mb-3">
                                        <div style="font-family: 'Special Elite', cursive; font-size: 24px;">
                                            NJIEZM.FR - L'élite du digital
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="font-family: 'Special Elite', cursive; font-size: 18px;">
                                            Caractère unique pour une identité forte
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="font-family: 'Special Elite', cursive; font-size: 14px;">
                                            Parfait pour les citations et les éléments de branding
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Google Fonts</small>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('font-family: \'Special Elite\', cursive;', this)">
                                        <i class="fas fa-copy me-1"></i> Copier CSS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Combinaisons Recommandées</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 style="font-family: 'Special Elite', cursive; color: var(--nj-blue);">Titre Principal</h6>
                                <p style="font-family: 'Space Grotesk', sans-serif;">Le contenu textuel qui accompagne le titre utilise Space Grotesk pour une lisibilité optimale.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: var(--nj-blue);">Titre Secondaire</h6>
                                <p style="font-family: 'Space Grotesk', sans-serif;">Pour une hiérarchie claire, les titres secondaires utilisent également Space Grotesk mais avec un poids différent.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <blockquote style="font-family: 'Special Elite', cursive; border-left: 4px solid var(--nj-yellow); padding-left: 15px; margin-left: 0;">
                                    "Les citations utilisent Special Elite pour se démarquer du contenu principal."
                                </blockquote>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="alert alert-info">
                                    <strong style="font-family: 'Special Elite', cursive;">Note:</strong> 
                                    <span style="font-family: 'Space Grotesk', sans-serif;">Les éléments d'alerte peuvent combiner les deux polices pour un impact visuel maximal.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Hiérarchie Typographique -->
        <div class="tab-pane fade" id="hierarchy" role="tabpanel" aria-labelledby="hierarchy-tab">
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Hiérarchie des Tailles de Police</h5>
                    </div>
                    <div class="card-body">
                        <h1 style="font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Titre H1 - 36px</h1>
                        <p class="text-muted">Utilisé pour les titres de page principaux</p>
                        
                        <h2 style="font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Titre H2 - 30px</h2>
                        <p class="text-muted">Utilisé pour les sections principales</p>
                        
                        <h3 style="font-family: 'Space Grotesk', sans-serif; font-weight: 600;">Titre H3 - 24px</h3>
                        <p class="text-muted">Utilisé pour les sous-sections</p>
                        
                        <h4 style="font-family: 'Space Grotesk', sans-serif; font-weight: 600;">Titre H4 - 20px</h4>
                        <p class="text-muted">Utilisé pour les titres de cartes et de widgets</p>
                        
                        <h5 style="font-family: 'Space Grotesk', sans-serif; font-weight: 500;">Titre H5 - 18px</h5>
                        <p class="text-muted">Utilisé pour les titres secondaires</p>
                        
                        <h6 style="font-family: 'Space Grotesk', sans-serif; font-weight: 500;">Titre H6 - 16px</h6>
                        <p class="text-muted">Utilisé pour les titres tertiaires</p>
                        
                        <p style="font-family: 'Space Grotesk', sans-serif;">Texte paragraphe - 16px</p>
                        <p class="text-muted">Utilisé pour le contenu textuel principal</p>
                        
                        <small style="font-family: 'Space Grotesk', sans-serif;">Texte petit - 14px</small>
                        <p class="text-muted">Utilisé pour les informations secondaires et les légendes</p>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Exemples d'Application</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h3 class="brand-font">Titre de Carte</h3>
                                    <p>Contenu de la carte avec une hiérarchie claire entre le titre et le contenu.</p>
                                    <small class="text-muted">Informations supplémentaires en texte plus petit.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="font-family: 'Special Elite', cursive; background-color: var(--nj-blue); color: white;">
                                        En-tête Spécial
                                    </div>
                                    <div class="card-body">
                                        <h5 style="font-family: 'Space Grotesk', sans-serif;">Titre de Contenu</h5>
                                        <p style="font-family: 'Space Grotesk', sans-serif;">Contenu avec une hiérarchie typographique cohérente.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Directives d'Utilisation -->
        <div class="tab-pane fade" id="guidelines" role="tabpanel" aria-labelledby="guidelines-tab">
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Bonnes Pratiques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 style="font-family: 'Space Grotesk', sans-serif; color: var(--nj-blue);">✓ À Faire</h6>
                                <ul>
                                    <li>Utiliser Space Grotesk pour le contenu textuel principal</li>
                                    <li>Réserver Special Elite pour les éléments de branding</li>
                                    <li>Maintenir une hiérarchie claire avec les tailles de police</li>
                                    <li>Utiliser des poids différents pour créer de l'emphase</li>
                                    <li>Assurer un contraste suffisant avec l'arrière-plan</li>
                                    <li>Limiter à 2-3 tailles de police par page pour éviter la confusion</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 style="font-family: 'Space Grotesk', sans-serif; color: var(--nj-danger);">✗ À Éviter</h6>
                                <ul>
                                    <li>Utiliser Special Elite pour de longs textes (lisibilité réduite)</li>
                                    <li>Mélanger trop de poids de police sur une même page</li>
                                    <li>Utiliser des tailles de police trop similaires</li>
                                    <li>Souligner le texte (préférer l'italique ou le gras)</li>
                                    <li>Utiliser du texte en majuscules pour les paragraphes</li>
                                    <li>Centrer de longs textes (difficile à lire)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Intégration dans le Code</h5>
                    </div>
                    <div class="card-body">
                        <h6>Déclaration CSS</h6>
                        <div class="bg-light p-3 rounded mb-3">
                            <code>
                                /* Import des polices Google Fonts */<br>
                                @import url('https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&display=swap');<br><br>
                                
                                /* Police principale */<br>
                                body {<br>
                                &nbsp;&nbsp;font-family: 'Space Grotesk', sans-serif;<br>
                                }<br><br>
                                
                                /* Police d'accent */<br>
                                .brand-font {<br>
                                &nbsp;&nbsp;font-family: 'Special Elite', cursive;<br>
                                }
                            </code>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('@import url(\'https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&display=swap\');\n\n/* Police principale */\nbody {\n  font-family: \'Space Grotesk\', sans-serif;\n}\n\n/* Police d\'accent */\n.brand-font {\n  font-family: \'Special Elite\', cursive;\n}', this)">
                                <i class="fas fa-copy me-1"></i> Copier le Code CSS
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Accessibilité</h5>
                    </div>
                    <div class="card-body">
                        <p>Pour assurer une bonne accessibilité :</p>
                        <ul>
                            <li>Maintenir un ratio de contraste d'au moins 4.5:1 pour le texte normal</li>
                            <li>Maintenir un ratio de contraste d'au moins 3:1 pour le texte plus grand (18px+)</li>
                            <li>Éviter de se fier uniquement à la couleur pour transmettre l'information</li>
                            <li>Permettre le redimensionnement du texte jusqu'à 200% sans perte de fonctionnalité</li>
                            <li>Utiliser des unités relatives (rem, em) plutôt que des unités fixes (px)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Copier le code CSS dans le presse-papiers
function copyToClipboard(text, buttonElement) {
    navigator.clipboard.writeText(text).then(function() {
        let originalHTML = buttonElement.innerHTML;
        buttonElement.innerHTML = '<i class="fas fa-check me-1"></i> Copié !';
        buttonElement.classList.remove('btn-outline-primary');
        buttonElement.classList.add('btn-success');

        setTimeout(function() {
            buttonElement.innerHTML = originalHTML;
            buttonElement.classList.remove('btn-success');
            buttonElement.classList.add('btn-outline-primary');
        }, 2000);
    }).catch(function(err) {
        console.error('Erreur lors de la copie : ', err);
    });
}
</script>
@endsection