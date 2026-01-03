@extends('layouts.app')

@section('title', 'Logos & Favicon - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Logos & Favicon</li>
    </ol>
</nav>

<!-- SECTION LOGOS PRINCIPAUX -->
<section id="logos">
    <div class="card-custom">
        <h3 class="brand-font">1. Logos & Favicons</h3>
        <ul class="nav nav-tabs tab-custom">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#logo-main">Principal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#logo-variations">Variations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#logo-guidelines">Guidelines</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="logo-main">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="preview-box" id="logo-preview" style="background: var(--nj-blue);">
                            <div style="font-family: 'Special Elite'; font-size: 3rem; color: var(--nj-yellow);">NJIEZM<span style="color: white;">.FR</span></div>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="preview-box" style="min-height: 100px; background: white;">
                                <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></div>
                            </div>
                            <div class="preview-box ms-2" style="min-height: 100px; background: white;">
                                <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: black;">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></div>
                            </div>
                            <div class="preview-box ms-2" style="min-height: 100px; background: white;">
                                <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue);">NJ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select id="logo-type" class="form-select mb-3">
                            <option value="main">Logo Principal</option>
                            <option value="favicon">Favicon (16x16)</option>
                            <option value="bw">Noir & Blanc (Impression)</option>
                            <option value="icon">Icône App</option>
                        </select>
                        <div class="mb-3">
                            <label class="form-label">Format</label>
                            <select class="form-select" id="logo-format">
                                <option value="png">PNG</option>
                                <option value="svg">SVG</option>
                                <option value="jpg">JPG</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Taille</label>
                            <select class="form-select" id="logo-size">
                                <option value="original">Original</option>
                                <option value="small">Petit (500px)</option>
                                <option value="medium">Moyen (1000px)</option>
                                <option value="large">Grand (2000px)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Couleur de fond</label>
                            <select class="form-select" id="logo-background">
                                <option value="transparent">Transparent</option>
                                <option value="blue">Bleu NJ</option>
                                <option value="white">Blanc</option>
                                <option value="black">Noir</option>
                            </select>
                        </div>
                        <button class="btn btn-primary w-100" onclick="exportLogo()">TÉLÉCHARGER</button>
                        <button class="btn btn-outline-primary w-100 mt-2" onclick="shareLogo()">PARTAGER</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="logo-variations">
                <div class="row">
                    <div class="col-md-3">
                        <div class="preview-box">
                            <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></div>
                            <p class="text-center mt-2 mb-0">Version complète</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="preview-box">
                            <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue);">NJ</div>
                            <p class="text-center mt-2 mb-0">Version abrégée</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="preview-box">
                            <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-yellow);">NJIEZM</div>
                            <p class="text-center mt-2 mb-0">Version sans .FR</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="preview-box">
                            <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: white; background: var(--nj-blue); padding: 5px;">NJIEZM</div>
                            <p class="text-center mt-2 mb-0">Version monogramme</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="logo-guidelines">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Espace de protection</h5>
                        <div class="preview-box" style="background: var(--nj-blue);">
                            <div style="font-family: 'Special Elite'; font-size: 2rem; color: var(--nj-yellow); margin: 20px;">NJIEZM<span style="color: white;">.FR</span></div>
                        </div>
                        <p class="small mt-2">L'espace de protection autour du logo doit être équivalent à la hauteur du "N" dans toutes les directions.</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Taille minimale</h5>
                        <div class="preview-box" style="background: white;">
                            <div style="font-family: 'Special Elite'; font-size: 0.8rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></div>
                        </div>
                        <p class="small mt-2">La taille minimale du logo pour l'impression est de 20mm de large. Pour le web, la hauteur minimale est de 30px.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de partage -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Partager le logo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Lien de partage</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="shareLink" readonly>
                        <button class="btn btn-outline-secondary" type="button" id="copyShareLink">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary me-2" onclick="shareOnSocial('facebook')">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button type="button" class="btn btn-info me-2" onclick="shareOnSocial('twitter')">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button type="button" class="btn btn-danger me-2" onclick="shareOnSocial('pinterest')">
                        <i class="fab fa-pinterest"></i>
                    </button>
                    <button type="button" class="btn btn-dark" onclick="shareOnSocial('linkedin')">
                        <i class="fab fa-linkedin-in"></i>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<canvas id="export-canvas" style="display: none;"></canvas>

<script>
function exportLogo() {
    const logoType = document.getElementById('logo-type').value;
    const format = document.getElementById('logo-format').value;
    const size = document.getElementById('logo-size').value;
    const background = document.getElementById('logo-background').value;
    
    // Définir les dimensions en fonction du type et de la taille
    let width, height;
    
    if (logoType === 'favicon') {
        width = 32;
        height = 32;
    } else if (size === 'small') {
        width = 500;
        height = 500;
    } else if (size === 'medium') {
        width = 1000;
        height = 1000;
    } else if (size === 'large') {
        width = 2000;
        height = 2000;
    } else {
        width = 1200;
        height = 600;
    }
    
    // Créer le canvas
    const canvas = document.getElementById('export-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = width;
    canvas.height = height;
    
    // Définir la couleur de fond
    if (background === 'transparent') {
        ctx.clearRect(0, 0, width, height);
    } else if (background === 'blue') {
        ctx.fillStyle = '#003366';
        ctx.fillRect(0, 0, width, height);
    } else if (background === 'white') {
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, width, height);
    } else if (background === 'black') {
        ctx.fillStyle = '#000000';
        ctx.fillRect(0, 0, width, height);
    }
    
    // Définir la police et la couleur du texte
    ctx.font = logoType === 'favicon' ? "bold 16px 'Special Elite'" : "bold 48px 'Special Elite'";
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    // Déterminer la couleur du texte en fonction du fond
    let textColor, secondaryColor;
    if (background === 'transparent' || background === 'white') {
        textColor = '#003366';
        secondaryColor = '#FFD700';
    } else if (background === 'blue') {
        textColor = '#FFD700';
        secondaryColor = '#FFFFFF';
    } else if (background === 'black') {
        textColor = '#FFD700';
        secondaryColor = '#FFFFFF';
    }
    
    // Dessiner le logo
    if (logoType === 'favicon') {
        // Version simplifiée pour le favicon
        ctx.fillStyle = textColor;
        ctx.fillText('NJ', width / 2, height / 2 - 10);
    } else if (logoType === 'bw') {
        // Version noir et blanc
        ctx.fillStyle = background === 'black' ? '#FFFFFF' : '#000000';
        ctx.fillText('NJIEZM.FR', width / 2, height / 2);
    } else if (logoType === 'icon') {
        // Version icône
        ctx.fillStyle = textColor;
        ctx.fillText('NJ', width / 2, height / 2 - 10);
    } else {
        // Version complète
        ctx.fillStyle = textColor;
        ctx.fillText('NJIEZM', width / 2, height / 2 - 10);
        ctx.fillStyle = secondaryColor;
        ctx.fillText('.FR', width / 2, height / 2 + 10);
    }
    
    // Télécharger le logo
    canvas.toBlob(function(blob) {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        
        // Définir le nom du fichier
        let filename = 'njiezm-logo';
        if (logoType === 'favicon') filename += '-favicon';
        else if (logoType === 'bw') filename += '-bw';
        else if (logoType === 'icon') filename += '-icon';
        
        // Ajouter l'extension en fonction du format
        if (format === 'png') {
            filename += '.png';
            a.download = filename;
        } else if (format === 'svg') {
            // Pour SVG, nous devons utiliser une approche différente
            exportLogoAsSVG();
            return;
        } else if (format === 'jpg') {
            filename += '.jpg';
            a.download = filename;
        } else if (format === 'pdf') {
            filename += '.pdf';
            a.download = filename;
        }
        
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        // Afficher une notification de succès
        showNotification('Logo téléchargé avec succès !', 'success');
    }, `image/${format === 'jpg' ? 'jpeg' : format}`);
}

function exportLogoAsSVG() {
    // Créer un SVG simple avec le logo
    const logoType = document.getElementById('logo-type').value;
    const background = document.getElementById('logo-background').value;
    
    let svgContent = `<svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" viewBox="0 0 200 100">`;
    
    // Ajouter le fond si nécessaire
    if (background !== 'transparent') {
        if (background === 'blue') {
            svgContent += `<rect width="200" height="100" fill="#003366"/>`;
        } else if (background === 'white') {
            svgContent += `<rect width="200" height="100" fill="#FFFFFF"/>`;
        } else if (background === 'black') {
            svgContent += `<rect width="200" height="100" fill="#000000"/>`;
        }
    }
    
    // Déterminer la couleur du texte en fonction du fond
    let textColor, secondaryColor;
    if (background === 'transparent' || background === 'white') {
        textColor = '#003366';
        secondaryColor = '#FFD700';
    } else if (background === 'blue') {
        textColor = '#FFD700';
        secondaryColor = '#FFFFFF';
    } else if (background === 'black') {
        textColor = '#FFD700';
        secondaryColor = '#FFFFFF';
    }
    
    // Ajouter le texte du logo
    if (logoType === 'favicon') {
        svgContent += `<text x="100" y="45" text-anchor="middle" font-family="Special Elite" font-size="16" font-weight="bold" fill="${textColor}">NJ</text>`;
    } else if (logoType === 'bw') {
        svgContent += `<text x="100" y="50" text-anchor="middle" font-family="Special Elite" font-size="24" font-weight="bold" fill="${background === 'black' ? '#FFFFFF' : '#000000'}">NJIEZM.FR</text>`;
    } else if (logoType === 'icon') {
        svgContent += `<text x="100" y="45" text-anchor="middle" font-family="Special Elite" font-size="24" font-weight="bold" fill="${textColor}">NJ</text>`;
    } else {
        svgContent += `<text x="100" y="45" text-anchor="middle" font-family="Special Elite" font-size="24" font-weight="bold" fill="${textColor}">NJIEZM</text>`;
        svgContent += `<text x="100" y="55" text-anchor="middle" font-family="Special Elite" font-size="24" font-weight="bold" fill="${secondaryColor}">.FR</text>`;
    }
    
    svgContent += `</svg>`;
    
    // Télécharger le SVG
    const blob = new Blob([svgContent], { type: 'image/svg+xml' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    
    // Définir le nom du fichier
    let filename = 'njiezm-logo';
    if (logoType === 'favicon') filename += '-favicon';
    else if (logoType === 'bw') filename += '-bw';
    else if (logoType === 'icon') filename += '-icon';
    
    filename += '.svg';
    a.download = filename;
    
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    // Afficher une notification de succès
    showNotification('Logo SVG téléchargé avec succès !', 'success');
}

function shareLogo() {
    // Générer un lien de partage temporaire
    const shareLink = window.location.origin + '/shared-logo';
    document.getElementById('shareLink').value = shareLink;
    
    // Afficher le modal de partage
    const shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
    shareModal.show();
}

function copyShareLink() {
    const shareLink = document.getElementById('shareLink');
    shareLink.select();
    document.execCommand('copy');
    
    // Afficher une notification de succès
    showNotification('Lien copié dans le presse-papiers !', 'success');
}

function shareOnSocial(platform) {
    const shareLink = window.location.origin + '/shared-logo';
    let url;
    
    switch(platform) {
        case 'facebook':
            url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareLink)}`;
            break;
        case 'twitter':
            url = `https://twitter.com/intent/tweet?text=Découvrez le logo de NJIEZM.FR&url=${encodeURIComponent(shareLink)}`;
            break;
        case 'pinterest':
            url = `https://pinterest.com/pin/create/button/?url=${encodeURIComponent(shareLink)}&media=${encodeURIComponent(window.location.origin + '/images/njiezm-logo.png')}&description=Logo de NJIEZM.FR`;
            break;
        case 'linkedin':
            url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(shareLink)}`;
            break;
    }
    
    window.open(url, '_blank');
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