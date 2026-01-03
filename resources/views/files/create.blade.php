@extends('layouts.app')

@section('title', 'Télécharger un fichier - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('files.index') }}">Gestionnaire de fichiers</a></li>
        <li class="breadcrumb-item active">Télécharger un fichier</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="brand-font">Télécharger un fichier</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Choisir un fichier</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                            <div class="form-text">Taille maximale : 10MB</div>
                        </div>
                        <div class="mb-3">
                            <label for="folder" class="form-label">Dossier (Optionnel)</label>
                            <select class="form-select" id="folder" name="folder">
                                <option value="">Racine</option>
                                @foreach($folders as $folder)
                                    <option value="{{ $folder }}">{{ $folder }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (Optionnel)</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_public" name="is_public" value="1">
                            <label class="form-check-label" for="is_public">
                                Rendre ce fichier public
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-upload me-2"></i>Télécharger
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>