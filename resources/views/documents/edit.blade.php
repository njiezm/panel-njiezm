@extends('layouts.app')

@section('title', 'Modifier un document - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Devis & Factures</a></li>
        <li class="breadcrumb-item active">Modifier le document</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!--h3 class="brand-font">
            Modifier le {{ $document->type == 'quote' ? 'devis' : 'facture' }} N°{{ str_pad($document->id, 5, '0', STR_PAD_LEFT) }}
        </!--h3-->
        <h3 class="brand-font">
    Modifier le {{ $document->type == 'quote' ? 'devis' : 'facture' }} N°{{ $document->type == 'quote' ? 'D' : 'F' }}{{ str_pad($document->reference_number, 5, '0', STR_PAD_LEFT) }}
</h3>
    </div>
    
    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $document->title }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="client_name" class="form-label">Nom du client</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" value="{{ $document->client_name }}" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="issue_date" class="form-label">Date d'émission</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date" value="{{ $document->issue_date->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="due_date" class="form-label">Date d'échéance</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $document->due_date->format('Y-m-d') }}" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant total (€)</label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" class="form-control" id="amount" name="amount" value="{{ $document->amount }}" step="0.01" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="draft" {{ $document->status == 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="sent" {{ $document->status == 'sent' ? 'selected' : '' }}>Envoyé{{ $document->type == 'quote' ? '' : 'e' }}</option>
                        @if($document->type == 'quote')
                            <option value="accepted" {{ $document->status == 'accepted' ? 'selected' : '' }}>Accepté</option>
                            <option value="refused" {{ $document->status == 'refused' ? 'selected' : '' }}>Refusé</option>
                        @else
                            <option value="paid" {{ $document->status == 'paid' ? 'selected' : '' }}>Payée</option>
                            <option value="overdue" {{ $document->status == 'overdue' ? 'selected' : '' }}>En retard</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Articles</label>
            <div id="items-container">
                @if($document->items->count() > 0)
                    @foreach($document->items as $index => $item)
                        <div class="item-row mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="items[{{ $index }}][description]" value="{{ $item->description }}" placeholder="Description de l'article">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" placeholder="Quantité">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="items[{{ $index }}][unit_price]" value="{{ $item->unit_price }}" step="0.01" placeholder="Prix HT">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="items[{{ $index }}][vat]" value="{{ $item->vat }}" min="0" max="100" placeholder="TVA (%)">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-item" onclick="removeItem(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        Aucun article n'a été ajouté à ce {{ $document->type == 'quote' ? 'devis' : 'facture' }}.
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-outline-primary mt-2" onclick="addItem()">
                <i class="fas fa-plus me-2"></i>Ajouter un article
            </button>
        </div>
        
        <div class="mb-3">
            <label for="file" class="form-label">Fichier (PDF)</label>
            <input type="file" class="form-control" id="file" name="file" accept=".pdf">
            @if($document->file_path)
                <div class="form-text">Fichier actuel : {{ $document->file_path }}</div>
            @endif
        </div>
        
        <div class="mb-3">
            <label for="metadata[notes]" class="form-label">Notes</label>
            <textarea class="form-control" rows="3" name="metadata[notes]" placeholder="Ajoutez des notes sur ce document...">{{ $document->metadata['notes'] ?? '' }}</textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('documents.show', $document->id) }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

<script>
// Variables globales pour les articles
let itemCount = {{ $document->items->count() }};

// Ajouter un article
function addItem() {
    const container = document.getElementById('items-container');
    const index = itemCount;
    
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
                <button type="button" class="btn btn-outline-danger btn-sm remove-item" onclick="removeItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    container.appendChild(itemRow);
    
    itemCount++;
    
    // Ajouter les écouteurs d'événements pour les nouveaux champs
    const inputs = itemRow.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', updateTotalAmount);
    });
    
    // Mettre à jour le montant total
    updateTotalAmount();
}

// Supprimer un article
function removeItem(button) {
    const itemRow = button.closest('.item-row');
    itemRow.remove();
    updateTotalAmount();
}

// Mettre à jour le montant total
function updateTotalAmount() {
    const rows = document.querySelectorAll('.item-row');
    let total = 0;
    
    rows.forEach(row => {
        const quantity = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
        const unitPrice = parseFloat(row.querySelector('input[name*="[unit_price]"]').value) || 0;
        total += quantity * unitPrice;
    });
    
    // Mettre à jour le champ du montant total
    const amountInput = document.getElementById('amount');
    if (amountInput) {
        amountInput.value = total.toFixed(2);
    }
}

// Initialiser les écouteurs d'événements
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter les écouteurs pour tous les champs d'articles existants
    document.querySelectorAll('.item-row').forEach(row => {
        const inputs = row.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', updateTotalAmount);
        });
    });
});
</script>
@endsection