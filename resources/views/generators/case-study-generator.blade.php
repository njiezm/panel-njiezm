@extends('layouts.app')

@section('title', 'Nom de la section - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur d'étude de cas</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">20. Générateur d'étude de cas</h3>
    <div class="alert alert-info">
        Cette section est en cours de développement. Revenez bientôt pour découvrir nos fonctionnalités génération d'étude de cas pour NJIEZM.FR.
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Retour au tableau de bord</a>
    </div>
</div>
@endsection