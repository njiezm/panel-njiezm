@extends('layouts.app')

@section('title', 'Paramètres - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Paramètres</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">29. Paramètres</h3>
    <div class="alert alert-info">
        Cette section est en cours de développement. Revenez bientôt pour découvrir nos paramètres.
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Retour au tableau de bord</a>
    </div>
</div>
@endsection