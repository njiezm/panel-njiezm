@extends('layouts.app')

@section('title', 'Visualisation du document - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Devis & Factures</a></li>
        <li class="breadcrumb-item active">Visualisation du document</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="brand-font">
            {{ $document->type == 'quote' ? 'Devis' : 'Facture' }} N°{{ str_pad($document->id, 5, '0', STR_PAD_LEFT) }}
        </h3>
        <div class="btn-group">
            <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('documents.download-pdf', $document->id) }}" class="btn btn-outline-info">
                <i class="fas fa-file-pdf"></i> Télécharger PDF
            </a>
            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirmDelete({{ $document->id }})">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
    
    <div class="document-preview">
        <div class="document-header">
            <div class="document-logo">
                <span style="font-family: 'Special Elite'; font-size: 24px; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>
            </div>
            <div class="document-info">
                <div class="document-type">{{ $document->type == 'quote' ? 'DEVIS' : 'FACTURE' }}</div>
                <div class="document-number">N° {{ str_pad($document->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="document-date">Date: {{ $document->issue_date->format('d/m/Y') }}</div>
                @if($document->type == 'invoice')
                    <div class="document-date">Échéance: {{ $document->due_date->format('d/m/Y') }}</div>
                @endif
            </div>
        </div>
        
        <div class="document-content">
            <div class="company-info">
                <div class="section-title">NJIEZM.FR</div>
                <div class="info-row">123 Rue de la République, 75001 Paris</div>
                <div class="info-row">+33 1 23 45 67 89</div>
                <div class="info-row">contact@njiezm.fr</div>
                <div class="info-row">SIRET: 12345678901234</div>
                <div class="info-row">TVA: FR00123456789</div>
            </div>
            
            <div class="client-info">
                <div class="section-title">Client</div>
                <div class="info-row">{{ $document->client_name }}</div>
                @if(isset($document->metadata['client_address']))
                    <div class="info-row">{{ $document->metadata['client_address'] }}</div>
                @endif
                @if(isset($document->metadata['client_email']))
                    <div class="info-row">{{ $document->metadata['client_email'] }}</div>
                @endif
                @if(isset($document->metadata['client_phone']))
                    <div class="info-row">{{ $document->metadata['client_phone'] }}</div>
                @endif
            </div>
        </div>
        
        @if($document->type == 'quote')
            <div class="section-title">Objet du devis</div>
            <div class="info-row">{{ $document->title }}</div>
        @endif
        
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Quantité</th>
                    <th class="text-right">Prix unitaire</th>
                    <th class="text-right">TVA (%)</th>
                    <th class="text-right">Total HT</th>
                </tr>
            </thead>
            <tbody>
                @if($document->items->count() > 0)
    @foreach($document->items as $item)
        <tr>
            <td>{{ $item->description }}</td>
            <td class="text-right">{{ $item->quantity }}</td>
            <td class="text-right">{{ number_format($item->unit_price, 2, ',', ' ') }} €</td>
            <td class="text-right">{{ $item->vat }} %</td>
            <td class="text-right">{{ number_format($item->total_ht, 2, ',', ' ') }} €</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center p-4">
            Aucun article n'a été ajouté à ce {{ $document->type == 'quote' ? 'devis' : 'facture' }}.
        </td>
    </tr>
@endif

            </tbody>
        </table>
        
       <div class="totals">
    @php
        // Total HT
        $total_ht = $document->items->sum('total_ht');
        // Total TVA
        $total_tva = $document->items->sum('total_tva');
        // Total TTC
        $total_ttc = $document->items->sum('total_ttc');
    @endphp

    <div class="totals-row">
        <div class="totals-label">Total HT:</div>
        <div class="totals-value">{{ number_format($total_ht, 2, ',', ' ') }} €</div>
    </div>

    <div class="totals-row">
        <div class="totals-label">TVA:</div>
        <div class="totals-value">{{ number_format($total_tva, 2, ',', ' ') }} €</div>
    </div>

    <div class="totals-row grand-total">
        <div class="totals-label">Total TTC:</div>
        <div class="totals-value">{{ number_format($total_ttc, 2, ',', ' ') }} €</div>
    </div>
</div>

        
        @if($document->type == 'invoice')
            <div class="payment-info">
                <div class="section-title">Informations de paiement</div>
                <div class="info-row">Virement bancaire</div>
                <div class="info-row">IBAN: FR76 3000 4000 1234 5678 9012 345</div>
                <div class="info-row">BIC: BNPAFRPPXXX</div>
            </div>
        @endif
        
        @if(isset($document->metadata['notes']))
            <div class="notes">
                <div class="section-title">Notes</div>
                <div>{{ $document->metadata['notes'] }}</div>
            </div>
        @endif
        
        <div class="footer">
            <div>{{ $document->type == 'quote' ? 'Devis' : 'Facture' }} établi par NJIEZM.FR</div>
            <div>{{ $document->type == 'quote' ? 'Ce devis est valable 30 jours.' : 'En cas de retard de paiement, une pénalité de 3 fois le taux d\'intérêt légal sera appliquée.' }}</div>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <a href="{{ route('documents.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
</div>

<style>
.document-preview {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.document-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--nj-blue);
}

.document-logo {
    font-family: 'Special Elite', cursive;
    font-size: 24px;
    color: var(--nj-blue);
}

.document-logo span {
    color: var(--nj-yellow);
}

.document-info {
    text-align: right;
}

.document-type {
    font-size: 24px;
    font-weight: bold;
    color: var(--nj-blue);
    margin-bottom: 5px;
}

.document-number {
    font-size: 18px;
    margin-bottom: 5px;
}

.document-date {
    font-size: 14px;
    color: #666;
}

.content {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
}

.company-info, .client-info {
    width: 48%;
}

.section-title {
    font-weight: bold;
    color: var(--nj-blue);
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.info-row {
    margin-bottom: 5px;
}

.items-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.items-table th, .items-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.items-table th {
    background-color: #f0f0f0;
    font-weight: bold;
}

.items-table .text-right {
    text-align: right;
}

.totals {
    text-align: right;
    margin-bottom: 30px;
}

.totals-row {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 5px;
}

.totals-label {
    width: 150px;
    padding-right: 10px;
    text-align: right;
}

.totals-value {
    width: 100px;
    text-align: right;
}

.totals-row.grand-total {
    font-weight: bold;
    font-size: 18px;
    border-top: 1px solid #ddd;
    padding-top: 10px;
    margin-top: 10px;
}

.payment-info {
    margin-bottom: 20px;
}

.notes {
    margin-top: 30px;
    padding: 15px;
    background-color: #f9f9f9;
    border-left: 3px solid var(--nj-blue);
}

.footer {
    margin-top: 50px;
    border-top: 1px solid #ddd;
    padding-top: 20px;
    font-size: 12px;
    color: #666;
}
</style>
@endsection