@extends('layouts.app')

@section('title', 'Modifier {{ $file->name }} - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('files.index') }}">Gestionnaire de fichiers</a></li>
        @if($file->folder !== 'root')
            <li class="breadcrumb-item"><a href="{{ route('files.folder', $file->folder) }}">{{ $file->folder }}</a></li>
        @endif
        <li class="breadcrumb-item active">{{ $file->name }}</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">Modifier {{ $file->name }}</h3>
    </div>
    
    <form action="{{ route('files.update', $file->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $file->name }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="folder" class="form-label">Dossier</label>
                    <select class="form-select" id="folder" name="folder">
                        <option value="root" {{ $file->folder === 'root' ? 'selected' : '' }}>Racine</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder }}" {{ $file->folder === $folder ? 'selected' : '' }}>{{ $folder }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $file->description }}</textarea>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_public" name="is_public" value="1" {{ $file->is_public ? 'checked' : '' }}>
            <label class="form-check-label" for="is_public">
                Rendre ce fichier public
            </label>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ $file->folder !== 'root' ? route('files.folder', $file->folder) : route('files.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>