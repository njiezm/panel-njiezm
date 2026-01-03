@extends('layouts.app')

@section('title', 'Devis & Factures - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Devis & Factures</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">8. Devis & Factures</h3>
    
    <!-- Onglets -->
    <ul class="nav nav-tabs tab-custom mt-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#quotes">Devis</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#invoices">Factures</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#templates">Modèles</a>
        </li>
    </ul>
    
    <div class="tab-content mt-3">
        <!-- Onglet Devis -->
        <div class="tab-pane fade show active" id="quotes">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Liste des devis</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quoteModal">
                    <i class="fas fa-plus me-2"></i>Créer un devis
                </button>
            </div>
            
            <!-- Filtres -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-select" id="quote-status-filter">
                        <option value="">Tous les statuts</option>
                        <option value="draft">Brouillon</option>
                        <option value="sent">Envoyé</option>
                        <option value="accepted">Accepté</option>
                        <option value="refused">Refusé</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text" class="form-control" id="quote-client-filter" placeholder="Rechercher un client...">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="quote-date-filter">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100" onclick="filterQuotes()">
                        <i class="fas fa-filter me-2"></i>Filtrer
                    </button>
                </div>
            </div>
            
            <!-- Tableau des devis -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Date d'émission</th>
                            <th>Date d'échéance</th>
                            <th>Montant</th>
                            <th>Réduction</th>
                            <th>Total TTC</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="quotes-table-body">
                        @if($documents->where('type', 'quote')->count() > 0)
                            @foreach($documents->where('type', 'quote') as $document)
                            <tr>
                                <td>{{ $document->type == 'quote' ? 'D' : 'F' }}{{ str_pad($document->reference_number, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $document->client_name }}</td>
                                <td>{{ $document->issue_date->format('d/m/Y') }}</td>
                                <td>{{ $document->due_date->format('d/m/Y') }}</td>
                                <td>{{ number_format($document->amount, 2, ',', ' ') }} €</td>
                                <td>
                                    @if($document->discount_type !== 'none')
                                        <span class="text-danger">
                                            {{ $document->discount_type === 'fixed' ? number_format($document->discount_amount, 2, ',', ' ') . ' €' : $document->discount_percentage . '%' }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ number_format($document->getTotalTtcAfterDiscountAttribute(), 2, ',', ' ') }} €</td>
                                <td>
                                    <span class="badge bg-{{ $document->status == 'sent' ? 'primary' : ($document->status == 'accepted' ? 'success' : ($document->status == 'refused' ? 'danger' : 'secondary')) }}">
                                        {{ $document->status == 'draft' ? 'Brouillon' : ($document->status == 'sent' ? 'Envoyé' : ($document->status == 'accepted' ? 'Accepté' : 'Refusé')) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-outline-primary" title="Visualiser">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('documents.download-pdf', $document->id) }}" class="btn btn-sm btn-outline-info" title="Télécharger PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $document->id }})" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Aucun devis trouvé</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Onglet Factures -->
        <div class="tab-pane fade" id="invoices">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Liste des factures</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                    <i class="fas fa-plus me-2"></i>Créer une facture
                </button>
            </div>
            
            <!-- Filtres -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <select class="form-select" id="invoice-status-filter">
                        <option value="">Tous les statuts</option>
                        <option value="draft">Brouillon</option>
                        <option value="sent">Envoyée</option>
                        <option value="paid">Payée</option>
                        <option value="overdue">En retard</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="invoice-client-filter" placeholder="Rechercher un client...">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="invoice-date-filter">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100" onclick="filterInvoices()">
                        <i class="fas fa-filter me-2"></i>Filtrer
                    </button>
                </div>
            </div>
            
            <!-- Tableau des factures -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Date d'émission</th>
                            <th>Date d'échéance</th>
                            <th>Montant</th>
                            <th>Réduction</th>
                            <th>Total TTC</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="invoices-table-body">
                        @if($documents->where('type', 'invoice')->count() > 0)
                            @foreach($documents->where('type', 'invoice') as $document)
                            <tr>
                                <td>{{ $document->type == 'quote' ? 'D' : 'F' }}{{ str_pad($document->reference_number, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $document->client_name }}</td>
                                <td>{{ $document->issue_date->format('d/m/Y') }}</td>
                                <td>{{ $document->due_date->format('d/m/Y') }}</td>
                                <td>{{ number_format($document->amount, 2, ',', ' ') }} €</td>
                                <td>
                                    @if($document->discount_type !== 'none')
                                        <span class="text-danger">
                                            {{ $document->discount_type === 'fixed' ? number_format($document->discount_amount, 2, ',', ' ') . ' €' : $document->discount_percentage . '%' }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ number_format($document->getTotalTtcAfterDiscountAttribute(), 2, ',', ' ') }} €</td>
                                <td>
                                    <span class="badge bg-{{ $document->status == 'sent' ? 'primary' : ($document->status == 'paid' ? 'success' : 'danger') }}">
                                        {{ $document->status == 'draft' ? 'Brouillon' : ($document->status == 'sent' ? 'Envoyée' : ($document->status == 'paid' ? 'Payée' : 'En retard')) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-outline-primary" title="Visualiser">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('documents.download-pdf', $document->id) }}" class="btn btn-sm btn-outline-info" title="Télécharger PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $document->id }})" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Aucune facture trouvée</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Onglet Modèles -->
        <div class="tab-pane fade" id="templates">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Modèles de documents</h5>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Devis standard</h5>
                            <p class="card-text">Modèle de devis avec conditions générales</p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-primary" onclick="useTemplate('quote')">Utiliser</button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="editTemplate('quote')">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Facture standard</h5>
                            <p class="card-text">Modèle de facture avec mentions légales</p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-primary" onclick="useTemplate('invoice')">Utiliser</button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="editTemplate('invoice')">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Devis proforma</h5>
                            <p class="card-text">Modèle de devis pour clients internationaux</p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-sm btn-outline-primary" onclick="useTemplate('proforma')">Utiliser</button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="editTemplate('proforma')">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour créer un devis -->
<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quoteModalLabel">Créer un devis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="type" value="quote">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre du devis</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nom du client</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="issue_date" class="form-label">Date d'émission</label>
                                <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Date d'échéance</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Montant total HT (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" readonly>
                                </div>
                                <div class="form-text">Le montant sera calculé automatiquement à partir des articles</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="draft">Brouillon</option>
                                    <option value="sent">Envoyé</option>
                                    <option value="accepted">Accepté</option>
                                    <option value="refused">Refusé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Articles</label>
                        <div id="quote-items-container">
                            <div class="item-row mb-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="items[0][description]" placeholder="Description de l'article">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="items[0][quantity]" value="1" min="1" placeholder="Quantité">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="items[0][unit_price]" step="0.01" placeholder="Prix HT">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="items[0][vat]" value="20" min="0" max="100" placeholder="TVA (%)">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-item" onclick="removeQuoteItem(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary mt-2" onclick="addQuoteItem()">
                            <i class="fas fa-plus me-2"></i>Ajouter un article
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Réduction</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-select" id="discount_type" name="discount_type" onchange="toggleDiscountFields()">
                                            <option value="none">Aucune</option>
                                            <option value="fixed">Montant fixe</option>
                                            <option value="percentage">Pourcentage</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="discount_amount_field" style="display: none;">
                                        <div class="input-group">
                                            <span class="input-group-text">€</span>
                                            <input type="number" class="form-control" id="discount_amount" name="discount_amount" step="0.01" min="0" placeholder="Montant">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="discount_percentage_field" style="display: none;">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" step="0.01" min="0" max="100" placeholder="Pourcentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_after_discount" class="form-label">Total après réduction HT (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="total_after_discount" name="total_after_discount" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_ttc_after_discount" class="form-label">Total TTC après réduction (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="total_ttc_after_discount" name="total_ttc_after_discount" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">Fichier (PDF)</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer le devis</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour créer une facture -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Créer une facture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="type" value="invoice">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre de la facture</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Nom du client</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="issue_date" class="form-label">Date d'émission</label>
                                <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Date d'échéance</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Montant total HT (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" readonly>
                                </div>
                                <div class="form-text">Le montant sera calculé automatiquement à partir des articles</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="draft">Brouillon</option>
                                    <option value="sent">Envoyée</option>
                                    <option value="paid">Payée</option>
                                    <option value="overdue">En retard</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Articles</label>
                        <div id="invoice-items-container">
                            <div class="item-row mb-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="items[0][description]" placeholder="Description de l'article">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="items[0][quantity]" value="1" min="1" placeholder="Quantité">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="items[0][unit_price]" step="0.01" placeholder="Prix HT">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" name="items[0][vat]" value="20" min="0" max="100" placeholder="TVA (%)">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger btn-sm remove-item" onclick="removeInvoiceItem(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary mt-2" onclick="addInvoiceItem()">
                            <i class="fas fa-plus me-2"></i>Ajouter un article
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Réduction</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-select" id="discount_type_invoice" name="discount_type" onchange="toggleDiscountFields('invoice')">
                                            <option value="none">Aucune</option>
                                            <option value="fixed">Montant fixe</option>
                                            <option value="percentage">Pourcentage</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="discount_amount_field_invoice" style="display: none;">
                                        <div class="input-group">
                                            <span class="input-group-text">€</span>
                                            <input type="number" class="form-control" id="discount_amount_invoice" name="discount_amount" step="0.01" min="0" placeholder="Montant">
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="discount_percentage_field_invoice" style="display: none;">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="discount_percentage_invoice" name="discount_percentage" step="0.01" min="0" max="100" placeholder="Pourcentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_after_discount_invoice" class="form-label">Total après réduction HT (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="total_after_discount_invoice" name="total_after_discount" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="total_ttc_after_discount_invoice" class="form-label">Total TTC après réduction (€)</label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" class="form-control" id="total_ttc_after_discount_invoice" name="total_ttc_after_discount" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">Fichier (PDF)</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer la facture</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce document ? Cette action est irréversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let documentToDelete = null;

// Fonction pour confirmer la suppression
function confirmDelete(documentId) {
    documentToDelete = documentId;
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = `/documents/${documentId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Fonction pour utiliser un modèle
function useTemplate(template) {
    fetch('/documents/create-from-template', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            template: template
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = `/documents/${data.document_id}/edit`;
        } else {
            alert('Une erreur est survenue lors de la création du document à partir du modèle.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors de la création du document à partir du modèle.');
    });
}

// Fonction pour modifier un modèle
function editTemplate(template) {
    // Rediriger vers la page d'édition du modèle
    window.location.href = `/templates/${template}/edit`;
}

// Fonction pour filtrer les devis
function filterQuotes() {
    const status = document.getElementById('quote-status-filter').value;
    const client = document.getElementById('quote-client-filter').value.toLowerCase();
    const date = document.getElementById('quote-date-filter').value;
    
    const rows = document.querySelectorAll('#quotes-table-body tr');
    
    rows.forEach(row => {
        let show = true;
        
        if (status && row.dataset.status !== status) {
            show = false;
        }
        
        if (client && !row.dataset.client.toLowerCase().includes(client)) {
            show = false;
        }
        
        if (date && row.dataset.date !== date) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
    });
}

// Fonction pour filtrer les factures
function filterInvoices() {
    const status = document.getElementById('invoice-status-filter').value;
    const client = document.getElementById('invoice-client-filter').value.toLowerCase();
    const date = document.getElementById('invoice-date-filter').value;
    
    const rows = document.querySelectorAll('#invoices-table-body tr');
    
    rows.forEach(row => {
        let show = true;
        
        if (status && row.dataset.status !== status) {
            show = false;
        }
        
        if (client && !row.dataset.client.toLowerCase().includes(client)) {
            show = false;
        }
        
        if (date && row.dataset.date !== date) {
            show = false;
        }
        
        row.style.display = show ? '' : 'none';
    });
}

// Script pour gérer les dates par défaut
document.addEventListener('DOMContentLoaded', function() {
    // Définir la date du jour comme date d'émission par défaut
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('#issue_date').forEach(input => {
        input.value = today;
    });
    
    // Définir la date d'échéance à 30 jours par défaut
    const dueDate = new Date();
    dueDate.setDate(dueDate.getDate() + 30);
    const dueDateStr = dueDate.toISOString().split('T')[0];
    document.querySelectorAll('#due_date').forEach(input => {
        input.value = dueDateStr;
    });
    
    // Ajouter les attributs data pour le filtrage
    document.querySelectorAll('#quotes-table-body tr').forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length >= 8) {
            row.dataset.status = cells[7].textContent.trim().toLowerCase();
            row.dataset.client = cells[1].textContent.toLowerCase();
            row.dataset.date = cells[3].textContent;
        }
    });
    
    document.querySelectorAll('#invoices-table-body tr').forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length >= 8) {
            row.dataset.status = cells[7].textContent.trim().toLowerCase();
            row.dataset.client = cells[1].textContent.toLowerCase();
            row.dataset.date = cells[3].textContent;
        }
    });
});

// Variables globales pour les articles
let quoteItemCount = 1;
let invoiceItemCount = 1;

// Ajouter un article au devis
function addQuoteItem() {
    const container = document.getElementById('quote-items-container');
    const index = quoteItemCount;
    
    const itemRow = document.createElement('div');
    itemRow.className = 'item-row mb-3';
    itemRow.innerHTML = `
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control" name="items[${index}][description]" placeholder="Description de l'article">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="items[${index}][quantity]" value="1" min="1" placeholder="Quantité">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="items[${index}][unit_price]" step="0.01" placeholder="Prix HT">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="items[${index}][vat]" value="20" min="0" max="100" placeholder="TVA (%)">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger btn-sm remove-item" onclick="removeQuoteItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    container.appendChild(itemRow);
    
    quoteItemCount++;
    
    // Ajouter les écouteurs d'événements pour les nouveaux champs
    const inputs = itemRow.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', updateQuoteTotalAmount);
    });
    
    // Mettre à jour le montant total
    updateQuoteTotalAmount();
}

// Supprimer un article du devis
function removeQuoteItem(button) {
    const itemRow = button.closest('.item-row');
    itemRow.remove();
    updateQuoteTotalAmount();
}

// Mettre à jour le montant total du devis
function updateQuoteTotalAmount() {
    const rows = document.querySelectorAll('#quote-items-container .item-row');
    let total = 0;
    
    rows.forEach(row => {
        const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
        total += quantity * unitPrice;
    });
    
    // Mettre à jour le champ du montant total
    const amountInput = document.querySelector('#quoteModal #amount');
    if (amountInput) {
        amountInput.value = total.toFixed(2);
    }
    
    // Mettre à jour les totaux avec réduction
    updateTotalsWithDiscount('quote');
}

// Ajouter un article à la facture
function addInvoiceItem() {
    const container = document.getElementById('invoice-items-container');
    const index = invoiceItemCount;
    
    const itemRow = document.createElement('div');
    itemRow.className = 'item-row mb-3';
    itemRow.innerHTML = `
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control" name="items[${index}][description]" placeholder="Description de l'article">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="items[${index}][quantity]" value="1" min="1" placeholder="Quantité">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="items[${index}][unit_price]" step="0.01" placeholder="Prix HT">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" name="items[${index}][vat]" value="20" min="0" max="100" placeholder="TVA (%)">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger btn-sm remove-item" onclick="removeInvoiceItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    container.appendChild(itemRow);
    
    invoiceItemCount++;
    
    // Ajouter les écouteurs d'événements pour les nouveaux champs
    const inputs = itemRow.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', updateInvoiceTotalAmount);
    });
    
    // Mettre à jour le montant total
    updateInvoiceTotalAmount();
}

// Supprimer un article de la facture
function removeInvoiceItem(button) {
    const itemRow = button.closest('.item-row');
    itemRow.remove();
    updateInvoiceTotalAmount();
}

// Mettre à jour le montant total de la facture
function updateInvoiceTotalAmount() {
    const rows = document.querySelectorAll('#invoice-items-container .item-row');
    let total = 0;
    
    rows.forEach(row => {
        const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
        total += quantity * unitPrice;
    });
    
    // Mettre à jour le champ du montant total
    const amountInput = document.querySelector('#invoiceModal #amount');
    if (amountInput) {
        amountInput.value = total.toFixed(2);
    }
    
    // Mettre à jour les totaux avec réduction
    updateTotalsWithDiscount('invoice');
}

// Fonction pour afficher/masquer les champs de réduction
function toggleDiscountFields(type = 'quote') {
    const discountType = document.getElementById(`discount_type${type === 'invoice' ? '_invoice' : ''}`).value;
    const discountAmountField = document.getElementById(`discount_amount_field${type === 'invoice' ? '_invoice' : ''}`);
    const discountPercentageField = document.getElementById(`discount_percentage_field${type === 'invoice' ? '_invoice' : ''}`);
    
    discountAmountField.style.display = 'none';
    discountPercentageField.style.display = 'none';
    
    if (discountType === 'fixed') {
        discountAmountField.style.display = 'block';
    } else if (discountType === 'percentage') {
        discountPercentageField.style.display = 'block';
    }
    
    updateTotalsWithDiscount(type);
}

// Mettre à jour les totaux avec réduction
function updateTotalsWithDiscount(type = 'quote') {
    const rows = document.querySelectorAll(`#${type}-items-container .item-row`);
    let totalHt = 0;
    let totalTva = 0;
    
    // Calculer le total HT et la TVA par article
    rows.forEach(row => {
        const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
        const vat = parseFloat(row.querySelector('input[name*="[vat]"]').value) || 0;
        
        const itemHt = quantity * unitPrice;
        const itemTva = itemHt * (vat / 100);
        
        totalHt += itemHt;
        totalTva += itemTva;
    });
    
    // Mettre à jour le champ du montant total
    const amountInput = document.querySelector(`#${type}Modal #amount`);
    if (amountInput) {
        amountInput.value = totalHt.toFixed(2);
    }
    
    // Appliquer la réduction
    const discountType = document.getElementById(`discount_type${type === 'invoice' ? '_invoice' : ''}`).value;
    const discountAmount = parseFloat(document.getElementById(`discount_amount${type === 'invoice' ? '_invoice' : ''}`).value) || 0;
    const discountPercentage = parseFloat(document.getElementById(`discount_percentage${type === 'invoice' ? '_invoice' : ''}`).value) || 0;
    
    let discountValue = 0;
    if (discountType === 'fixed') {
        discountValue = Math.min(discountAmount, totalHt); // Ne pas dépasser le montant total
    } else if (discountType === 'percentage') {
        discountValue = totalHt * (discountPercentage / 100);
    }
    
    // Calculer les totaux après réduction
    const totalHtAfterDiscount = totalHt - discountValue;
    
    // Calculer la TVA après réduction en proportionnant la réduction sur chaque article
    let totalTvaAfterDiscount = 0;
    rows.forEach(row => {
        const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
        const vat = parseFloat(row.querySelector('input[name*="[vat]"]').value) || 0;
        
        const itemHt = quantity * unitPrice;
        const itemTva = itemHt * (vat / 100);
        
        // Proportionner la réduction sur cet article
        const itemDiscount = itemHt * (discountValue / totalHt);
        const itemHtAfterDiscount = itemHt - itemDiscount;
        
        // Calculer la TVA sur le montant après réduction
        totalTvaAfterDiscount += itemHtAfterDiscount * (vat / 100);
    });
    
    const totalTtcAfterDiscount = totalHtAfterDiscount + totalTvaAfterDiscount;
    
    // Mettre à jour les champs d'affichage
    document.getElementById(`total_after_discount${type === 'invoice' ? '_invoice' : ''}`).value = totalHtAfterDiscount.toFixed(2);
    document.getElementById(`total_ttc_after_discount${type === 'invoice' ? '_invoice' : ''}`).value = totalTtcAfterDiscount.toFixed(2);
}

// Initialiser les écouteurs d'événements
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter les écouteurs pour tous les champs d'articles existants dans le devis
    document.querySelectorAll('#quote-items-container .item-row').forEach(row => {
        const inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', updateQuoteTotalAmount);
        });
    });
    
    // Ajouter les écouteurs pour tous les champs d'articles existants dans la facture
    document.querySelectorAll('#invoice-items-container .item-row').forEach(row => {
        const inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', updateInvoiceTotalAmount);
        });
    });
    
    // Écouteurs pour les champs de réduction du devis
    document.getElementById('discount_amount').addEventListener('input', () => updateTotalsWithDiscount('quote'));
    document.getElementById('discount_percentage').addEventListener('input', () => updateTotalsWithDiscount('quote'));
    
    // Écouteurs pour les champs de réduction de la facture
    document.getElementById('discount_amount_invoice').addEventListener('input', () => updateTotalsWithDiscount('invoice'));
    document.getElementById('discount_percentage_invoice').addEventListener('input', () => updateTotalsWithDiscount('invoice'));
});
</script>
@endsection