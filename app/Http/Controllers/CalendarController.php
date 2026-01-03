<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Affiche la page du calendrier.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('calendar.index');
    }
    
    /**
     * Récupère les événements pour le calendrier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEvents(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $type = $request->input('type', 'all');
        
        $events = [];
        
        // Ajouter les projets
        if ($type === 'all' || $type === 'project') {
            $projects = Project::where(function($query) use ($start, $end) {
                if ($start) $query->where('deadline', '>=', $start);
                if ($end) $query->where('deadline', '<=', $end);
            })->get();
            
            foreach ($projects as $project) {
                $events[] = [
                    'id' => 'project_' . $project->id,
                    'title' => $project->name,
                    'description' => $project->description,
                    'start' => $project->deadline,
                    'end' => $project->deadline,
                    'type' => 'project',
                    'color' => '#0d6efd',
                    'url' => route('projects.show', $project->id)
                ];
            }
        }
        
        // Ajouter les documents (devis et factures)
        if ($type === 'all' || $type === 'invoice' || $type === 'quote') {
            $documents = Document::where(function($query) use ($start, $end) {
                if ($start) $query->where('due_date', '>=', $start);
                if ($end) $query->where('due_date', '<=', $end);
            })->get();
            
            foreach ($documents as $document) {
                if ($type === 'all' || $type === $document->type) {
                    $events[] = [
                        'id' => 'document_' . $document->id,
                        'title' => $document->title . ' - ' . $document->client_name,
                        'description' => $document->type . ' pour ' . $document->client_name,
                        'start' => $document->due_date,
                        'end' => $document->due_date,
                        'type' => $document->type,
                        'color' => $document->type === 'invoice' ? '#198754' : '#6f42c1',
                        'url' => route('documents.show', $document->id)
                    ];
                }
            }
        }
        
        // Ajouter les jours fériés
        if ($type === 'all' || $type === 'holiday') {
            $holidays = $this->getHolidays(date('Y'));
            
            foreach ($holidays as $date => $name) {
                $eventDate = Carbon::createFromFormat('Y-m-d', $date);
                
                if ((!$start || $eventDate >= $start) && (!$$end || $eventDate <= $end)) {
                    $events[] = [
                        'id' => 'holiday_' . $date,
                        'title' => $name,
                        'description' => 'Jour férié',
                        'start' => $date,
                        'end' => $date,
                        'type' => 'holiday',
                        'color' => '#fd7e14',
                        'url' => null
                    ];
                }
            }
        }
        
        return response()->json($events);
    }
    
    /**
     * Récupère la liste des jours fériés pour une année donnée.
     *
     * @param  int  $year
     * @return array
     */
    private function getHolidays($year)
    {
        $holidays = [];
        
        // Jours fériés fixes (France)
        $holidays[$year . '-01-01'] = 'Jour de l\'an';
        $holidays[$year . '-05-01'] = 'Fête du travail';
        $holidays[$year . '-05-08'] = 'Victoire 1945';
        $holidays[$year . '-07-14'] = 'Fête nationale';
        $holidays[$year . '-08-15'] = 'Assomption';
        $holidays[$year . '-11-01'] = 'Toussaint';
        $holidays[$year . '-11-11'] = 'Armistice 1918';
        $holidays[$year . '-12-25'] = 'Noël';
        
        // Jours fériés mobiles (calculés)
        $easter = $this->getEasterDate($year);
        $holidays[$easter->format('Y-m-d')] = 'Pâques';
        $holidays[$easter->copy()->addDays(1)->format('Y-m-d')] = 'Lundi de Pâques';
        $holidays[$easter->copy()->addDays(39)->format('Y-m-d')] = 'Ascension';
        $holidays[$easter->copy()->addDays(50)->format('Y-m-d')] = 'Pentecôte';
        
        // Jours fériés spécifiques à la Martinique
        $holidays[$year . '-05-22'] = 'Abolition de l\'esclavage';
        
        // Ajouter d'autres jours fériés spécifiques à la Martinique si nécessaire
        
        return $holidays;
    }
    
    /**
     * Calcule la date de Pâques pour une année donnée.
     *
     * @param  int  $year
     * @return \Carbon\Carbon
     */
    private function getEasterDate($year)
    {
        // Calcul de la date de Pâques (algorithme de Oudin)
        $a = $year % 19;
        $b = floor($year / 100);
        $c = $year % 100;
        $d = floor($b / 4);
        $e = $b % 4;
        $f = floor(($b + 8) / 25);
        $g = floor(($b - $f + 1) / 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = floor($c / 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = floor(($a + 11 * $h + 22 * $l) / 451);
        $month = floor(($h + $l - 7 * $m + 114) / 31);
        $day = (($h + $l - 7 * $m + 114) % 31) + 1;
        
        return Carbon::create($year, $month, $day);
    }
}