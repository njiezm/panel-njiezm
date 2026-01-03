<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère les vrais dossiers depuis la BDD
        $folders = File::where('user_id', Auth::id())
            ->folders()
            ->where('folder', 'root') // On ne montre que les dossiers à la racine
            ->orderBy('name')
            ->get();
            
        // Récupère les fichiers à la racine
        $rootFiles = File::where('user_id', Auth::id())
            ->files()
            ->where('folder', 'root')
            ->orderBy('name')
            ->get();
            
        return view('files.index', compact('folders', 'rootFiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
            'folder' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_public' => 'boolean',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        $folder = $validated['folder'] ?? 'root';
        $path = $file->storeAs('files/' . $folder, $filename, 'public');

        File::create([
            'name' => pathinfo($originalName, PATHINFO_FILENAME),
            'original_name' => $originalName,
            'mime_type' => $file->getMimeType(),
            'path' => $path,
            'size' => $file->getSize(),
            'folder' => $folder,
            'description' => $validated['description'] ?? null,
            'is_public' => $validated['is_public'] ?? false,
            'user_id' => Auth::id(),
            'type' => 'file', // On explicite que c'est un fichier
        ]);

        return redirect()->route('files.index')
            ->with('success', 'Fichier téléchargé avec succès.');
    }
/**
     * Crée un dossier et l'enregistre en BDD.
     */
    public function createFolder(Request $request)
    {
        try {
            $validated = $request->validate([
                'folder_name' => 'required|string|max:255',
                'parent_folder' => 'nullable|string|max:255', // Pour gérer les sous-dossiers plus tard
            ]);

            $folderName = trim($validated['folder_name']);
            $parentFolder = $validated['parent_folder'] ?? 'root';
            
            // Valider le nom du dossier
            if (empty($folderName)) {
                throw new \Exception('Le nom du dossier ne peut pas être vide.');
            }
            
            // Valider les caractères autorisés
            if (!preg_match('/^[a-zA-Z0-9_-]+$/', $folderName)) {
                throw new \Exception('Le nom du dossier ne peut contenir que des lettres, chiffres, tirets et underscores.');
            }
            
            // Vérifier si un dossier avec ce nom existe déjà pour cet utilisateur à cet endroit
            $existingFolder = File::where('user_id', Auth::id())
                ->folders()
                ->where('name', $folderName)
                ->where('folder', $parentFolder)
                ->first();

            if ($existingFolder) {
                throw new \Exception('Un dossier avec ce nom existe déjà ici.');
            }
            
            // Créer le dossier physiquement
            $folderPath = 'files/' . $folderName;
            if ($parentFolder !== 'root') {
                $folderPath = 'files/' . $parentFolder . '/' . $folderName;
            }
            
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
            
            // Créer l'entrée du dossier dans la base de données
            File::create([
                'name' => $folderName,
                'original_name' => $folderName,
                'mime_type' => 'application/x-folder',
                'path' => $folderPath,
                'size' => 0,
                'folder' => $parentFolder,
                'description' => null,
                'is_public' => false,
                'user_id' => Auth::id(),
                'type' => 'folder', // C'est la partie cruciale !
            ]);
            
            Log::info('Dossier créé et enregistré: ' . $folderPath);

            return response()->json([
                'success' => true,
                'message' => 'Dossier "' . $folderName . '" créé avec succès.',
                'folder' => $folderName
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du dossier: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400); // 400 Bad Request est plus approprié ici
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\View\View
     */
    public function show(File $file)
    {
        // Vérifier si l'utilisateur a le droit de voir ce fichier
        if ($file->user_id !== Auth::id() && !$file->is_public) {
            abort(403, 'Vous n\'êtes pas autorisé à voir ce fichier.');
        }

        return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\View\View
     */
    public function edit(File $file)
    {
        // Vérifier si l'utilisateur a le droit de modifier ce fichier
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier ce fichier.');
        }

        $folders = File::where('user_id', Auth::id())
            ->distinct()
            ->pluck('folder')
            ->filter(function ($folder) {
                return $folder !== 'root';
            })
            ->sort()
            ->values();

        return view('files.edit', compact('file', 'folders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        // Vérifier si l'utilisateur a le droit de modifier ce fichier
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier ce fichier.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'folder' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_public' => 'boolean',
        ]);

        // Si le dossier change, déplacer le fichier
        if (isset($validated['folder']) && $validated['folder'] !== $file->folder) {
            $newFolder = $validated['folder'] ?? 'root';
            $oldPath = $file->path;
            $newPath = 'files/' . $newFolder . '/' . basename($oldPath);
            
            // Créer le nouveau dossier s'il n'existe pas
            Storage::disk('public')->makeDirectory('files/' . $newFolder);
            
            // Déplacer le fichier
            Storage::disk('public')->move($oldPath, $newPath);
            
            $validated['path'] = $newPath;
        }

        $file->update($validated);

        return redirect()->route('files.index')
            ->with('success', 'Fichier mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        // Vérifier si l'utilisateur a le droit de supprimer ce fichier
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer ce fichier.');
        }

        // Supprimer le fichier du stockage
        Storage::disk('public')->delete($file->path);

        // Supprimer l'enregistrement de la base de données
        $file->delete();

        return redirect()->route('files.index')
            ->with('success', 'Fichier supprimé avec succès.');
    }

    /**
     * Display files in a specific folder.
     *
     * @param  string  $folder
     * @return \Illuminate\View\View
     */
    public function folder($folder)
    {
        // Récupérer tous les dossiers pour la navigation
        $folders = File::where('user_id', Auth::id())
            ->distinct()
            ->pluck('folder')
            ->filter(function ($f) {
                return $f !== 'root';
            })
            ->sort()
            ->values();
            
        // Récupérer les fichiers dans le dossier demandé
        $files = File::where('user_id', Auth::id())
            ->where('folder', $folder)
            ->orderBy('name')
            ->get();

        return view('files.folder', compact('files', 'folder', 'folders'));
    }

    public function createFolderold(Request $request)
    {
        try {
            $validated = $request->validate([
                'folder_name' => 'required|string|max:255',
            ]);

            $folderName = $validated['folder_name'];
            
            // Valider le nom du dossier
            if (empty(trim($folderName))) {
                throw new \Exception('Le nom du dossier ne peut pas être vide.');
            }
            
            // Valider les caractères autorisés
            if (!preg_match('/^[a-zA-Z0-9_-]+$/', $folderName)) {
                throw new \Exception('Le nom du dossier ne peut contenir que des lettres, chiffres, tirets et underscores.');
            }
            
            // Créer le dossier s'il n'existe pas déjà
            $folderPath = 'files/' . $folderName;
            
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
                
                // Journaliser la création du dossier
                Log::info('Dossier créé: ' . $folderPath);
                
                // Renvoyer une réponse JSON pour les requêtes AJAX
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Dossier "' . $folderName . '" créé avec succès.',
                        'folder' => $folderName
                    ]);
                }
                
                return redirect()->route('files.index')
                    ->with('success', 'Dossier "' . $folderName . '" créé avec succès.');
            } else {
                // Journaliser la tentative de création d'un dossier existant
                Log::warning('Tentative de création du dossier existant: ' . $folderPath);
                
                // Renvoyer une réponse JSON pour les requêtes AJAX
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Ce dossier existe déjà.'
                    ]);
                }

                return redirect()->route('files.index')
                    ->with('error', 'Ce dossier existe déjà.');
            }
        } catch (\Exception $e) {
            // Journaliser l'erreur
            Log::error('Erreur lors de la création du dossier: ' . $e->getMessage());
            
            // Renvoyer une réponse JSON pour les requêtes AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('files.index')
                ->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }
    
    /**
     * Share a file.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function share(File $file)
    {
        // Vérifier si l'utilisateur a le droit de partager ce fichier
        if ($file->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à partager ce fichier.');
        }

        // Générer un token de partage si nécessaire
        if (!$file->share_token) {
            $file->update([
                'share_token' => Str::random(32),
                'shared_at' => now(),
                'is_public' => true,
            ]);
        }

        return redirect()->route('files.index')
            ->with('success', 'Fichier partagé avec succès. Lien de partage : ' . route('shared.file', $file->share_token));
    }

    /**
     * Display a shared file.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function sharedFile($token)
    {
        $file = File::where('share_token', $token)->firstOrFail();
        
        return view('files.shared', compact('file'));
    }

    /**
     * Download a file.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function download(File $file)
    {
        // Vérifier si l'utilisateur a le droit de télécharger ce fichier
        if ($file->user_id !== Auth::id() && !$file->is_public) {
            abort(403, 'Vous n\'êtes pas autorisé à télécharger ce fichier.');
        }

        return Storage::disk('public')->download($file->path, $file->original_name);
    }

    /**
     * Formate la taille d'un fichier en unités lisibles
     *
     * @param int $bytes
     * @return string
     */
    public static function formatFileSize($bytes): string
    {
        // Sécurité absolue
        if ($bytes === null || $bytes === '' || !is_numeric($bytes)) {
            return '—';
        }

        $bytes = (float) $bytes;

        if ($bytes <= 0) {
            return '0 Bytes';
        }

        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $i = (int) floor(log($bytes, $k));

        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }
}