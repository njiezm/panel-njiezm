@extends('layouts.app')

@section('title', 'Palette & Merch - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Palette & Merch</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">11. Palette de Couleurs & Goodies</h3>
    <p class="text-muted">Découvrez l'identité visuelle de NJIEZM.FR et explorez nos objets promotionnels.</p>

    <!-- Onglets -->
    <ul class="nav nav-tabs tab-custom mt-4" id="colorMerchTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="palette-tab" data-bs-toggle="tab" data-bs-target="#palette" type="button" role="tab" aria-controls="palette" aria-selected="true">
                <i class="fas fa-palette me-2"></i>Palette de Couleurs
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="merch-tab" data-bs-toggle="tab" data-bs-target="#merch" type="button" role="tab" aria-controls="merch" aria-selected="false">
                <i class="fas fa-tshirt me-2"></i>Goodies & Merchandising
            </button>
        </li>
    </ul>

    <div class="tab-content" id="colorMerchTabContent">
        
        <!-- Onglet Palette de Couleurs -->
        <div class="tab-pane fade show active" id="palette" role="tabpanel" aria-labelledby="palette-tab">
            <div class="mt-4">
                <h4 class="brand-font">Notre Palette de Couleurs</h4>
                <p class="text-muted">Chaque couleur a été choisie pour refléter notre marque : professionnelle, moderne et dynamique.</p>
                
                @php
                    $brandColors = [
                        ['name' => 'Bleu Principal', 'hex' => '#003366', 'usage' => 'Textes principaux, titres, éléments de branding'],
                        ['name' => 'Jaune Accent', 'hex' => '#FFD700', 'usage' => 'Boutons, icônes, points d\'attention'],
                        ['name' => 'Blanc Fond', 'hex' => '#F8F9FA', 'usage' => 'Arrière-plans, cartes, zones de contenu'],
                        ['name' => 'Gris Foncé', 'hex' => '#1a1a1a', 'usage' => 'Textes très importants, contraste maximal'],
                        ['name' => 'Gris Clair', 'hex' => '#e9ecef', 'usage' => 'Bordures, arrière-plans secondaires, séparateurs'],
                        ['name' => 'Succès', 'hex' => '#28a745', 'usage' => 'Messages de confirmation, indicateurs positifs'],
                        ['name' => 'Danger', 'hex' => '#dc3545', 'usage' => 'Messages d\'erreur, alertes importantes'],
                    ];
                @endphp

                <div class="row">
                    @foreach($brandColors as $color)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="color-swatch mb-3 rounded" style="background-color: {{ $color['hex'] }}; height: 100px; width: 100%; border: 1px solid #dee2e6;"></div>
                                    <h5 class="card-title">{{ $color['name'] }}</h5>
                                    <p class="card-text">
                                        <strong>HEX:</strong> {{ $color['hex'] }}<br>
                                        <small class="text-muted">{{ $color['usage'] }}</small>
                                    </p>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $color['hex'] }}', this)">
                                        <i class="fas fa-copy me-1"></i> Copier HEX
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="my-5">

                <h4 class="brand-font">Exemples d'Utilisation</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-primary">
                            <div class="card-header" style="background-color: var(--nj-blue); color: white;">
                                En-tête Principal
                            </div>
                            <div class="card-body">
                                <p class="card-text">Contenu avec le style de carte par défaut.</p>
                                <a href="#" class="btn btn-primary" style="background-color: var(--nj-yellow); color: var(--nj-dark); border-color: var(--nj-yellow);">Bouton Accent</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-success" role="alert">
                            <strong>Bravo !</strong> Ceci est une alerte de succès utilisant la couleur dédiée.
                        </div>
                        <div class="alert alert-danger" role="alert">
                            <strong>Attention !</strong> Ceci est une alerte de danger.
                        </div>
                    </div>
                    <div class="col-md-4">
                         <h5 style="color: var(--nj-blue);">Titre en Bleu Principal</h5>
                         <p style="color: var(--nj-dark);">Texte en gris foncé pour une excellente lisibilité.</p>
                         <p class="text-muted">Texte secondaire en gris plus clair pour les informations moins importantes.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Goodies & Merchandising -->
        <div class="tab-pane fade" id="merch" role="tabpanel" aria-labelledby="merch-tab">
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="brand-font mb-0">Nos Goodies</h4>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm active" onclick="filterMerch('all', this)">Tout</button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="filterMerch('clothing', this)">Vêtements</button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="filterMerch('office', this)">Bureau</button>
                        <button class="btn btn-outline-secondary btn-sm" onclick="filterMerch('tech', this)">Tech</button>
                    </div>
                </div>

                @php
                    $merchItems = [
                        ['id' => 1, 'name' => 'T-Shirt Logo Classique', 'category' => 'clothing', 'image' => 'https://via.placeholder.com/300x300/003366/FFFFFF?text=T-SHIRT', 'description' => 'Coton bio, coupe moderne.'],
                        ['id' => 2, 'name' => 'Mug "Brand Builder"', 'category' => 'office', 'image' => 'https://via.placeholder.com/300x300/FFD700/000000?text=MUG', 'description' => 'Céramique haute qualité, imprimé des deux côtés.'],
                        ['id' => 3, 'name' => 'Sticker Pack', 'category' => 'tech', 'image' => 'https://via.placeholder.com/300x300/e9ecef/000000?text=STICKERS', 'description' => 'Pack de 10 stickers vinyle résistants à l\'eau.'],
                        ['id' => 4, 'name' => 'Sweat à Capuche', 'category' => 'clothing', 'image' => 'https://via.placeholder.com/300x300/1a1a1a/FFFFFF?text=SWEAT', 'description' => 'Doublure polaire, broderie du logo sur le cœur.'],
                        ['id' => 5, 'name' => 'Carnet de Notes', 'category' => 'office', 'image' => 'https://via.placeholder.com/300x300/F8F9FA/000000?text=CARNET', 'description' => '96 pages, couverture rigide avec logo en relief.'],
                        ['id' => 6, 'name' => 'Chargeur Solaire', 'category' => 'tech', 'image' => 'https://via.placeholder.com/300x300/28a745/FFFFFF?text=CHARGEUR', 'description' => '2000 mAh, compatible avec tous les smartphones.'],
                    ];
                @endphp

                <div class="row">
                    @foreach($merchItems as $item)
                        <div class="col-lg-4 col-md-6 mb-4 merch-item" data-category="{{ $item['category'] }}">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['name'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                    <p class="card-text">{{ $item['description'] }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-secondary text-capitalize">{{ $item['category'] }}</span>
                                        <button class="btn btn-sm btn-primary" onclick="showMerchDetail({{ $item['id'] }})">
                                            <i class="fas fa-eye me-1"></i> Voir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les détails du merch (Optionnel) -->
<div class="modal fade" id="merchDetailModal" tabindex="-1" aria-labelledby="merchDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="merchDetailModalLabel">Détails du Goodie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Fonctionnalité de commande ou de demande d'informations à venir.</p>
                <p>Pour l'instant, contactez-nous directement pour toute demande de goodies.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <a href="mailto:contact@njiezm.fr?subject=Demande de Goodies" class="btn btn-primary">Nous contacter</a>
            </div>
        </div>
    </div>
</div>

<script>
// Copier le code couleur dans le presse-papiers
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

// Filtrer les goodies par catégorie
function filterMerch(category, buttonElement) {
    // Mettre à jour les boutons
    document.querySelectorAll('#merch .btn-group .btn').forEach(btn => {
        btn.classList.remove('active');
    });
    buttonElement.classList.add('active');

    // Filtrer les éléments
    const items = document.querySelectorAll('.merch-item');
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// Afficher les détails du merch (fonction simple pour l'exemple)
function showMerchDetail(itemId) {
    const modal = new bootstrap.Modal(document.getElementById('merchDetailModal'));
    modal.show();
}
</script>
@endsection