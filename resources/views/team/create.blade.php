@extends('layouts.app')

@section('title', 'Créer une équipe - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Équipes</a></li>
        <li class="breadcrumb-item active">Créer une équipe</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">Créer une nouvelle équipe</h3>
    
    <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'équipe</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="color" class="form-label">Couleur</label>
                    <input type="color" class="form-control form-control-color" id="color" name="color" value="{{ old('color', '#003366') }}">
                    @error('color')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="users" class="form-label">Membres</label>
                    <select class="form-select" id="users" name="users[]" multiple>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ in_array($user->id, old('users', [])) ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                        @endforeach
                    </select>
                    <div class="form-text">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs membres.</div>
                    @error('users')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('teams.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Créer l'équipe</button>
        </div>
    </form>
</div>
@endsection