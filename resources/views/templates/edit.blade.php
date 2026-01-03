@extends('layouts.app')

@section('title', 'Modifier un modèle - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('documents') }}">Devis & Factures</a></li>
        <li class="breadcrumb-item"><a href="{{ route('documents') }}#templates">Modèles</a></li>
        <li class="breadcrumb-item active">Modifier le modèle</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">Modifier le modèle {{ $template == 'quote' ? 'devis' : ($template == 'invoice' ? 'facture' : 'devis proforma') }}</h3>
    
    <div class="alert alert-info">
        Cette fonctionnalité est en cours de développement. Revenez bientôt pour modifier les modèles de documents.
    </div>
    
    <div class="text-center mt-4">
        <a href="{{ route('documents') }}#templates" class="btn btn-primary">Retour aux modèles</a>
    </div>
</div>
@endsection