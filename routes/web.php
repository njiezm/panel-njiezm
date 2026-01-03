<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BrandAssetController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SocialPostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LegalController; // Ajoutez cette ligne
use App\Http\Controllers\FileController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Page d'accueil (redirection vers le tableau de bord si connecté, sinon vers la page de connexion)
Route::get('/', function () {
    return auth()->check() ? redirect('dashboard') : view('welcome');
});

// Routes d'authentification
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {
    // Tableau de bord
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Ressources de marque
    Route::resource('brand-assets', BrandAssetController::class);
    
    // Projets
    Route::resource('projects', ProjectController::class);
    
    // Modèles
    Route::resource('templates', TemplateController::class);
    
    // Documents
    Route::resource('documents', DocumentController::class);
    
    // Posts réseaux sociaux
    Route::resource('social-posts', SocialPostController::class);
    
    // Utilisateurs (réservé aux administrateurs)
    Route::resource('users', UserController::class)->middleware('role:admin');
    
    // Équipes
    Route::resource('teams', TeamController::class);
    
    // Pages spécifiques (pour correspondre à l'interface)
    Route::get('logos', function () {
        return view('brand-assets.logos');
    })->name('logos');
    
    Route::get('logo-variations', function () {
        return view('brand-assets.logo-variations');
    })->name('logo-variations');
    
    Route::get('seasonal', function () {
        return view('brand-assets.seasonal');
    })->name('seasonal');
    
    Route::get('marketing', function () {
        return view('brand-assets.marketing');
    })->name('marketing');
    
    Route::get('instagram-generator', function () {
        return view('social-posts.instagram-generator');
    })->name('instagram-generator');
    
    Route::get('linkedin-generator', function () {
        return view('social-posts.linkedin-generator');
    })->name('linkedin-generator');
    
    Route::get('templates', function () {
        return view('templates.index');
    })->name('templates');

    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');

    // Routes pour le générateur juridique
    Route::get('legal', [LegalController::class, 'index'])->name('legal');
    Route::post('legal/download-pdf', [LegalController::class, 'downloadPdf'])->name('legal.download-pdf');
    
    Route::get('signature', function () {
        return view('documents.signature');
    })->name('signature');
    
    Route::get('colors', function () {
        return view('brand-assets.colors');
    })->name('colors');
    
    Route::get('typography', function () {
        return view('brand-assets.typography');
    })->name('typography');
    
    Route::get('brand-guidelines', function () {
        return view('brand-assets.brand-guidelines');
    })->name('brand-guidelines');
    
    Route::get('blog-generator', function () {
        return view('generators.blog-generator');
    })->name('blog-generator');
    
    Route::get('email-generator', function () {
        return view('generators.email-generator');
    })->name('email-generator');
    
    Route::get('video-generator', function () {
        return view('generators.video-generator');
    })->name('video-generator');
    
    Route::get('presentation-generator', function () {
        return view('generators.presentation-generator');
    })->name('presentation-generator');
    
    Route::get('infographic-generator', function () {
        return view('generators.infographic-generator');
    })->name('infographic-generator');
    
    Route::get('press-release-generator', function () {
        return view('generators.press-release-generator');
    })->name('press-release-generator');
    
    Route::get('case-study-generator', function () {
        return view('generators.case-study-generator');
    })->name('case-study-generator');
    
    Route::get('testimonial-generator', function () {
        return view('generators.testimonial-generator');
    })->name('testimonial-generator');
    
    Route::get('faq-generator', function () {
        return view('generators.faq-generator');
    })->name('faq-generator');
    
    Route::get('team', function () {
        return view('team.index');
    })->name('team');
    
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    
    // Routes pour le calendrier
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');
    
    Route::get('files', function () {
        return view('files.index');
    })->name('files');
    
    Route::get('analytics', function () {
        return view('analytics.index');
    })->name('analytics');
    
    Route::get('integrations', function () {
        return view('integrations.index');
    })->name('integrations');
    
    Route::get('settings', function () {
        return view('settings.index');
    })->name('settings');

    // Routes pour les générateurs de posts sociaux
    Route::get('instagram-generator', [SocialPostController::class, 'instagramGenerator'])->name('instagram-generator');
    Route::get('linkedin-generator', [SocialPostController::class, 'linkedinGenerator'])->name('linkedin-generator');

    // Routes API pour les posts sociaux
    Route::prefix('api')->middleware('auth')->group(function () {
        Route::post('social-posts', [SocialPostController::class, 'apiStore']);
        Route::get('social-posts', [SocialPostController::class, 'apiIndex']);
    });

    // Routes pour les documents
    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    //Route::put('documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('documents/{document}/download-pdf', [DocumentController::class, 'downloadPdf'])->name('documents.download-pdf');
    Route::post('documents/create-from-template', [DocumentController::class, 'createFromTemplate'])->name('documents.create-from-template');
    
    // Routes pour les modèles de documents
    Route::get('templates/{template}/edit', function($template) {
        return view('templates.edit', compact('template'));
    })->name('templates.edit');

    // Routes pour le gestionnaire de fichiers
Route::resource('files', FileController::class);
Route::get('files/folder/{folder}', [FileController::class, 'folder'])->name('files.folder');
Route::post('files/create-folder', [FileController::class, 'createFolder'])->name('files.create-folder');
Route::get('files/{file}/share', [FileController::class, 'share'])->name('files.share');
Route::get('files/{file}/download', [FileController::class, 'download'])->name('files.download');
Route::get('shared/{token}', [FileController::class, 'sharedFile'])->name('shared.file');
});