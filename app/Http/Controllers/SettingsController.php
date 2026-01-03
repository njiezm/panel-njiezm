<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Affiche la page des paramètres.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    /**
     * Met à jour les informations du profil.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Met à jour le mot de passe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Mot de passe mis à jour avec succès.');
    }

    /**
     * Met à jour les préférences de notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateNotifications(Request $request)
    {
        $user = Auth::user();
        
        // Supposons que vous avez une table user_settings ou un champ JSON dans users
        $settings = $user->settings ?? [];
        $settings['notifications'] = [
            'email_invoice' => $request->has('emailInvoice'),
            'email_project' => $request->has('emailProject'),
            'email_mention' => $request->has('emailMention'),
            'app_task' => $request->has('appTask'),
            'app_message' => $request->has('appMessage'),
        ];
        
        $user->settings = $settings;
        $user->save();

        return back()->with('success', 'Préférences de notification mises à jour avec succès.');
    }

    /**
     * Met à jour les préférences d'apparence.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAppearance(Request $request)
    {
        $user = Auth::user();
        
        $settings = $user->settings ?? [];
        $settings['appearance'] = [
            'theme' => $request->theme,
            'language' => $request->language,
            'timezone' => $request->timezone,
        ];
        
        $user->settings = $settings;
        $user->save();

        return back()->with('success', 'Préférences d\'apparence mises à jour avec succès.');
    }

    /**
     * Met à jour les informations de l'entreprise.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCompany(Request $request)
    {
        $user = Auth::user();
        
        // Supposons que vous avez une table company_settings ou un champ JSON dans users
        $settings = $user->settings ?? [];
        $settings['company'] = [
            'name' => $request->companyName,
            'siret' => $request->companySiret,
            'address' => $request->companyAddress,
            'phone' => $request->companyPhone,
            'email' => $request->companyEmail,
        ];
        
        $user->settings = $settings;
        $user->save();

        return back()->with('success', 'Informations de l\'entreprise mises à jour avec succès.');
    }
}