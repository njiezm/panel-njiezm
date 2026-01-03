@extends('layouts.app')

@section('title', 'Fichier partagé - NJIEZM.FR')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-body text-center">
                    @if($file->isImage())
                        <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->name }}" class="img-fluid mb-4" style="max-height: 400px;">
                    @elseif($file->isPdf())
                        <iframe src="{{ asset('storage/' . $file->path) }}" width="100%" height="400px" class="mb-4"></iframe>
                    @else
                        <div class="text-center mb-4">
                            <i class="fas fa-file fa-5x text-muted"></i>
                            <p class="mt-3">Aperçu non disponible pour ce type de fichier.</p>
                            <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Télécharger
                            </a>
                        </div>
                    @endif
                    
                    <h4>{{ $file->name }}</h4>
                    <p class="text-muted">{{ $file->original_name }}</p>
                    <p class="text-muted">Taille: {{ $file->size }}</p>
                    
                    @if($file->description)
                        <div class="mt-3">
                            <p>{{ $file->description }}</p>
                        </div>
                    @endif
                    
                    <div class="mt-4">
                        <p class="small text-muted">Partagé par {{ $file->user->name }} le {{ $file->shared_at->format('d/m/Y') }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary">
                            <i class="fas fa-download me-2"></i>Télécharger
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-home me-2"></i>Accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>