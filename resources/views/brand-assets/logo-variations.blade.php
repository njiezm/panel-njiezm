@extends('layouts.app')

@section('title', 'Déclinaisons Logo - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Déclinaisons Logo</li>
    </ol>
</nav>

<!-- SECTION DÉCLINAISONS LOGO AMÉLIORÉES -->
<section id="logo-variations">
    <div class="card-custom">
        <h3 class="brand-font">2. Déclinaisons Logo Avancées</h3>
        <p class="small">Créez des variations sophistiquées du logo avec des icônes et des éléments graphiques.</p>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Icônes disponibles</h5>
                <div class="d-flex flex-wrap mb-3">
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-code')">
                        <i class="fas fa-code fa-2x"></i>
                        <p class="small mb-0">Code</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-laptop-code')">
                        <i class="fas fa-laptop-code fa-2x"></i>
                        <p class="small mb-0">Dev</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-mobile-alt')">
                        <i class="fas fa-mobile-alt fa-2x"></i>
                        <p class="small mb-0">Mobile</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-palette')">
                        <i class="fas fa-palette fa-2x"></i>
                        <p class="small mb-0">Design</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-chart-line')">
                        <i class="fas fa-chart-line fa-2x"></i>
                        <p class="small mb-0">Analytics</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-shield-alt')">
                        <i class="fas fa-shield-alt fa-2x"></i>
                        <p class="small mb-0">Sécurité</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-cloud')">
                        <i class="fas fa-cloud fa-2x"></i>
                        <p class="small mb-0">Cloud</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-database')">
                        <i class="fas fa-database fa-2x"></i>
                        <p class="small mb-0">Base de données</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-robot')">
                        <i class="fas fa-robot fa-2x"></i>
                        <p class="small mb-0">IA</p>
                    </div>
                    <div class="icon-option p-2 m-1 border rounded text-center" style="cursor: pointer;" onclick="selectIcon('fa-cogs')">
                        <i class="fas fa-cogs fa-2x"></i>
                        <p class="small mb-0">Système</p>
                    </div>
                </div>
                
                <h5>Position de l'icône</h5>
                <div class="d-flex mb-3">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="iconPosition" id="iconLeft" value="left" checked>
                        <label class="form-check-label" for="iconLeft">
                            À gauche
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="iconPosition" id="iconRight" value="right">
                        <label class="form-check-label" for="iconRight">
                            À droite
                        </label>
                    </div>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="iconPosition" id="iconTop" value="top">
                        <label class="form-check-label" for="iconTop">
                            Au-dessus
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="iconPosition" id="iconBottom" value="bottom">
                        <label class="form-check-label" for="iconBottom">
                            En dessous
                        </label>
                    </div>
                </div>
                
                <h5>Taille de l'icône</h5>
                <div class="mb-3">
                    <input type="range" class="form-range" min="10" max="100" value="50" id="iconSize">
                </div>
                
                <h5>Couleur de l'icône</h5>
                <div class="mb-3">
                    <input type="color" class="form-control form-control-color" value="#FFD700" id="iconColor">
                </div>
                
                <h5>Couleur du texte</h5>
                <div class="mb-3">
                    <input type="color" class="form-control form-control-color" value="#003366" id="textColor">
                </div>
                
                <h5>Couleur du point</h5>
                <div class="mb-3">
                    <input type="color" class="form-control form-control-color" value="#FFD700" id="dotColor">
                </div>
                
                <h5>Couleur de fond</h5>
                <div class="mb-3">
                    <select class="form-select" id="bgColor">
                        <option value="transparent">Transparent</option>
                        <option value="white">Blanc</option>
                        <option value="blue">Bleu NJ</option>
                        <option value="black">Noir</option>
                    </select>
                </div>
                
                <button class="btn btn-primary w-100" onclick="generateLogoVariation()">GÉNÉRER</button>
                <button class="btn btn-success w-100 mt-2" onclick="exportLogoVariation()">TÉLÉCHARGER</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="saveLogoVariation()">ENREGISTRER COMME MODÈLE</button>
            </div>
            
            <div class="col-md-6">
                <h5>Aperçu</h5>
                <div class="preview-box" style="min-height: 200px; background: white;" id="logo-variation-preview">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-code fa-3x me-3" style="color: #FFD700;"></i>
                        <div>
                            <div style="font-family: 'Special Elite'; font-size: 2.5rem; color: #003366;">NJIEZM<span style="color: #FFD700;">.FR</span></div>
                            <div style="font-size: 0.9rem; color: #666; margin-top: 5px;">Développement Web & Solutions Digitales</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <h5>Préréglages rapides</h5>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="applyLogoPreset('tech')">
                                <i class="fas fa-laptop-code me-2"></i>Tech
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="applyLogoPreset('creative')">
                                <i class="fas fa-palette me-2"></i>Creatif
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="applyLogoPreset('security')">
                                <i class="fas fa-shield-alt me-2"></i>Sécurité
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="applyLogoPreset('data')">
                                <i class="fas fa-database me-2"></i>Données
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <h5>Déclinaisons enregistrées</h5>
                    <div class="row" id="saved-variations">
                        <!-- Les déclinaisons enregistrées seront ajoutées ici dynamiquement -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<canvas id="export-canvas" style="display: none;"></canvas>

<script>
let selectedIcon = 'fa-code';

function selectIcon(icon) {
    selectedIcon = icon;
    document.querySelectorAll('.icon-option').forEach(option => {
        option.classList.remove('border-primary');
        option.classList.add('border');
    });
    event.currentTarget.classList.remove('border');
    event.currentTarget.classList.add('border-primary');
    generateLogoVariation();
}

function generateLogoVariation() {
    const preview = document.getElementById('logo-variation-preview');
    const iconPosition = document.querySelector('input[name="iconPosition"]:checked').value;
    const iconSize = document.getElementById('iconSize').value;
    const iconColor = document.getElementById('iconColor').value;
    const textColor = document.getElementById('textColor').value;
    const dotColor = document.getElementById('dotColor').value;
    const bgColor = document.getElementById('bgColor').value;
    
    let html = '';
    
    // Définir le style de fond de l'aperçu
    if (bgColor === 'transparent') {
        preview.style.background = 'white';
    } else if (bgColor === 'white') {
        preview.style.background = 'white';
    } else if (bgColor === 'blue') {
        preview.style.background = '#003366';
    } else if (bgColor === 'black') {
        preview.style.background = '#000000';
    }
    
    // Créer le HTML en fonction de la position de l'icône
    if (iconPosition === 'left') {
        html = `<div class="d-flex align-items-center">
            <i class="fas ${selectedIcon}" style="font-size: ${iconSize}px; color: ${iconColor}; margin-right: 15px;"></i>
            <div>
                <div style="font-family: 'Special Elite'; font-size: 2.5rem; color: ${textColor};">NJIEZM<span style="color: ${dotColor};">.FR</span></div>
                <div style="font-size: 0.9rem; color: #666; margin-top: 5px;">Développement Web & Solutions Digitales</div>
            </div>
        </div>`;
    } else if (iconPosition === 'right') {
        html = `<div class="d-flex align-items-center">
            <div>
                <div style="font-family: 'Special Elite'; font-size: 2.5rem; color: ${textColor};">NJIEZM<span style="color: ${dotColor};">.FR</span></div>
                <div style="font-size: 0.9rem; color: #666; margin-top: 5px;">Développement Web & Solutions Digitales</div>
            </div>
            <i class="fas ${selectedIcon}" style="font-size: ${iconSize}px; color: ${iconColor}; margin-left: 15px;"></i>
        </div>`;
    } else if (iconPosition === 'top') {
        html = `<div class="text-center">
            <i class="fas ${selectedIcon}" style="font-size: ${iconSize}px; color: ${iconColor}; margin-bottom: 10px;"></i>
            <div style="font-family: 'Special Elite'; font-size: 2.5rem; color: ${textColor};">NJIEZM<span style="color: ${dotColor};">.FR</span></div>
            <div style="font-size: 0.9rem; color: #666; margin-top: 5px;">Développement Web & Solutions Digitales</div>
        </div>`;
    } else if (iconPosition === 'bottom') {
        html = `<div class="text-center">
            <div style="font-family: 'Special Elite'; font-size: 2.5rem; color: ${textColor};">NJIEZM<span style="color: ${dotColor};">.FR</span></div>
            <div style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">Développement Web & Solutions Digitales</div>
            <i class="fas ${selectedIcon}" style="font-size: ${iconSize}px; color: ${iconColor}; margin-top: 10px;"></i>
        </div>`;
    }
    
    preview.innerHTML = html;
}

function applyLogoPreset(preset) {
    if (preset === 'tech') {
        selectedIcon = 'fa-laptop-code';
        document.getElementById('iconColor').value = '#4d94ff';
        document.getElementById('textColor').value = '#003366';
        document.getElementById('dotColor').value = '#FFD700';
        document.getElementById('bgColor').value = 'white';
    } else if (preset === 'creative') {
        selectedIcon = 'fa-palette';
        document.getElementById('iconColor').value = '#e83e8c';
        document.getElementById('textColor').value = '#333333';
        document.getElementById('dotColor').value = '#FFD700';
        document.getElementById('bgColor').value = 'white';
    } else if (preset === 'security') {
        selectedIcon = 'fa-shield-alt';
        document.getElementById('iconColor').value = '#28a745';
        document.getElementById('textColor').value = '#333333';
        document.getElementById('dotColor').value = '#FFD700';
        document.getElementById('bgColor').value = 'white';
    } else if (preset === 'data') {
        selectedIcon = 'fa-database';
        document.getElementById('iconColor').value = '#fd7e14';
        document.getElementById('textColor').value = '#333333';
        document.getElementById('dotColor').value = '#FFD700';
        document.getElementById('bgColor').value = 'white';
    }
    
    generateLogoVariation();
}

function exportLogoVariation() {
    const iconPosition = document.querySelector('input[name="iconPosition"]:checked').value;
    const iconSize = document.getElementById('iconSize').value;
    const iconColor = document.getElementById('iconColor').value;
    const textColor = document.getElementById('textColor').value;
    const dotColor = document.getElementById('dotColor').value;
    const bgColor = document.getElementById('bgColor').value;
    
    // Définir les dimensions
    const width = 800;
    const height = 400;
    
    // Créer le canvas
    const canvas = document.getElementById('export-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = width;
    canvas.height = height;
    
    // Définir la couleur de fond
    if (bgColor === 'transparent') {
        ctx.clearRect(0, 0, width, height);
    } else if (bgColor === 'white') {
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, width, height);
    } else if (bgColor === 'blue') {
        ctx.fillStyle = '#003366';
        ctx.fillRect(0, 0, width, height);
    } else if (bgColor === 'black') {
        ctx.fillStyle = '#000000';
        ctx.fillRect(0, 0, width, height);
    }
    
    // Dessiner le logo en fonction de la position de l'icône
    if (iconPosition === 'left') {
        // Dessiner l'icône
        ctx.font = `${iconSize}px FontAwesome`;
        ctx.fillStyle = iconColor;
        ctx.textAlign = 'left';
        ctx.textBaseline = 'middle';
        
        // Simuler l'icône avec un cercle (caractéristique de FontAwesome)
        const iconX = 50;
        const iconY = height / 2;
        ctx.beginPath();
        ctx.arc(iconX, iconY, iconSize / 2, 0, 2 * Math.PI);
        ctx.fill();
        
        // Dessiner le texte à droite de l'icône
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = textColor;
        ctx.textAlign = 'left';
        ctx.textBaseline = 'middle';
        ctx.fillText('NJIEZM', iconX + iconSize + 20, height / 2 - 10);
        
        // Dessiner le point
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = dotColor;
        ctx.fillText('.FR', iconX + iconSize + 180, height / 2 + 10);
        
        // Ajouter le slogan
        ctx.font = "14px 'Space Grotesk'";
        ctx.fillStyle = '#666';
        ctx.fillText('Développement Web & Solutions Digitales', iconX + iconSize + 20, height / 2 + 40);
    } else if (iconPosition === 'right') {
        // Dessiner le texte à gauche
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = textColor;
        ctx.textAlign = 'right';
        ctx.textBaseline = 'middle';
        ctx.fillText('NJIEZM', width - 50 - iconSize - 20, height / 2 - 10);
        
        // Dessiner le point
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = dotColor;
        ctx.fillText('.FR', width - 50 - iconSize - 180, height / 2 + 10);
        
        // Dessiner le slogan
        ctx.font = "14px 'Space Grotesk'";
        ctx.fillStyle = '#666';
        ctx.fillText('Développement Web & Solutions Digitales', width - 50 - iconSize - 20, height / 2 + 40);
        
        // Dessiner l'icône
        ctx.font = `${iconSize}px FontAwesome`;
        ctx.fillStyle = iconColor;
        ctx.textAlign = 'right';
        ctx.textBaseline = 'middle';
        
        // Simuler l'icône avec un cercle
        const iconX = width - 50 - iconSize / 2;
        const iconY = height / 2;
        ctx.beginPath();
        ctx.arc(iconX, iconY, iconSize / 2, 0, 2 * Math.PI);
        ctx.fill();
    } else if (iconPosition === 'top') {
        // Dessiner l'icône en haut
        ctx.font = `${iconSize}px FontAwesome`;
        ctx.fillStyle = iconColor;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        
        // Simuler l'icône avec un cercle
        const iconX = width / 2;
        const iconY = 50;
        ctx.beginPath();
        ctx.arc(iconX, iconY, iconSize / 2, 0, 2 * Math.PI);
        ctx.fill();
        
        // Dessiner le texte en dessous de l'icône
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = textColor;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'top';
        ctx.fillText('NJIEZM', width / 2, iconY + iconSize + 20);
        
        // Dessiner le point
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = dotColor;
        ctx.fillText('.FR', width / 2, iconY + iconSize + 70);
        
        // Ajouter le slogan
        ctx.font = "14px 'Space Grotesk'";
        ctx.fillStyle = '#666';
        ctx.fillText('Développement Web & Solutions Digitales', width / 2, iconY + iconSize + 100);
    } else if (iconPosition === 'bottom') {
        // Dessiner le texte en haut
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = textColor;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
        ctx.fillText('NJIEZM', width / 2, height - 50 - iconSize - 70);
        
        // Dessiner le point
        ctx.font = "bold 48px 'Special Elite'";
        ctx.fillStyle = dotColor;
        ctx.fillText('.FR', width / 2, height - 50 - iconSize - 30);
        
        // Ajouter le slogan
        ctx.font = "14px 'Space Grotesk'";
        ctx.fillStyle = '#666';
        ctx.fillText('Développement Web & Solutions Digitales', width / 2, height - 50 - iconSize);
        
        // Dessiner l'icône en bas
        ctx.font = `${iconSize}px FontAwesome`;
        ctx.fillStyle = iconColor;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
        
        // Simuler l'icône avec un cercle
        const iconX = width / 2;
        const iconY = height - 50 - iconSize / 2;
        ctx.beginPath();
        ctx.arc(iconX, iconY, iconSize / 2, 0, 2 * Math.PI);
        ctx.fill();
    }
    
    // Télécharger le logo
    canvas.toBlob(function(blob) {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'njiezm-logo-variation.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        // Afficher une notification de succès
        showNotification('Déclinaison de logo téléchargée avec succès !', 'success');
    }, 'image/png');
}

function saveLogoVariation() {
    // Récupérer les paramètres actuels
    const iconPosition = document.querySelector('input[name="iconPosition"]:checked').value;
    const iconSize = document.getElementById('iconSize').value;
    const iconColor = document.getElementById('iconColor').value;
    const textColor = document.getElementById('textColor').value;
    const dotColor = document.getElementById('dotColor').value;
    const bgColor = document.getElementById('bgColor').value;
    
    // Créer un objet avec les paramètres
    const logoVariation = {
        icon: selectedIcon,
        iconPosition,
        iconSize,
        iconColor,
        textColor,
        dotColor,
        bgColor
    };
    
    // Ajouter la déclinaison à la liste des déclinaisons enregistrées
    addSavedVariation(logoVariation);
    
    // Afficher une notification de succès
    showNotification('Déclinaison de logo enregistrée avec succès !', 'success');
}

function addSavedVariation(variation) {
    const container = document.getElementById('saved-variations');
    
    // Créer un élément pour la nouvelle déclinaison
    const variationElement = document.createElement('div');
    variationElement.className = 'col-md-3 mb-3';
    variationElement.innerHTML = `
        <div class="preview-box" onclick="loadVariation(${JSON.stringify(variation).replace(/"/g, '&quot;')})">
            <div class="d-flex align-items-center">
                <i class="fas ${variation.icon}" style="font-size: ${variation.iconSize}px; color: ${variation.iconColor}; margin-right: 15px;"></i>
                <div>
                    <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: ${variation.textColor};">NJIEZM<span style="color: ${variation.dotColor};">.FR</span></div>
                </div>
            </div>
        </div>
        <button class="btn btn-sm btn-outline-primary w-100 mt-2" onclick="loadVariation(${JSON.stringify(variation).replace(/"/g, '&quot;')})">UTILISER</button>
    `;
    
    // Ajouter l'élément au conteneur
    container.appendChild(variationElement);
    
    // Limiter à 12 déclinaisons
    if (container.children.length > 12) {
        container.removeChild(container.firstChild);
    }
}

function loadVariation(variationJson) {
    // Charger les paramètres de la déclinaison
    const variation = JSON.parse(variationJson);
    
    // Mettre à jour les contrôles avec les paramètres de la déclinaison
    document.getElementById('iconColor').value = variation.iconColor;
    document.getElementById('textColor').value = variation.textColor;
    document.getElementById('dotColor').value = variation.dotColor;
    document.getElementById('bgColor').value = variation.bgColor;
    document.getElementById('iconSize').value = variation.iconSize;
    
    // Sélectionner la position de l'icône
    document.getElementById(variation.iconPosition).checked = true;
    
    // Mettre à jour l'icône sélectionnée
    selectedIcon = variation.icon;
    
    // Mettre à jour l'aperçu
    generateLogoVariation();
}

function showNotification(message, type = 'info') {
    // Créer une notification
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Supprimer la notification après 3 secondes
    setTimeout(() => {
        notification.classList.remove('alert-show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 150);
    }, 3000);
}
</script>
@endsection