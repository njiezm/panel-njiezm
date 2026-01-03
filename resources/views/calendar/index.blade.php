@extends('layouts.app')

@section('title', 'Calendrier - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Calendrier</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">25. Calendrier</h3>
        <div class="btn-group">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newEventModal">
                <i class="fas fa-plus me-2"></i>Nouvel événement
            </button>
            <button class="btn btn-outline-primary" onclick="exportCalendar()">
                <i class="fas fa-download me-2"></i>Exporter
            </button>
        </div>
    </div>
    
    <!-- Filtres et vues -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" id="monthView">Mois</button>
                <button type="button" class="btn btn-outline-primary" id="weekView">Semaine</button>
                <button type="button" class="btn btn-outline-primary" id="dayView">Jour</button>
                <button type="button" class="btn btn-outline-primary" id="agendaView">Agenda</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="calendarSearch" placeholder="Rechercher un événement...">
            </div>
        </div>
        <div class="col-md-4">
            <div class="btn-group">
                <button class="btn btn-outline-secondary" id="todayBtn">Aujourd'hui</button>
                <button class="btn btn-outline-secondary" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-outline-secondary" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    
    <!-- Filtres par type d'événement -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-sm btn-outline-primary filter-btn active" data-filter="all">Tous</button>
                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="project">Projets</button>
                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="invoice">Factures</button>
                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="quote">Devis</button>
                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="meeting">Réunions</button>
                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="deadline">Échéances</button>
                <button class="btn btn-sm btn-outline-primary filter-btn" data-filter="holiday">Jours fériés</button>
            </div>
        </div>
    </div>
    
    <!-- Calendrier -->
    <div class="row">
        <div class="col-md-9">
            <div class="calendar-container">
                <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                    <h4 id="currentMonth">{{ now()->format('F Y') }}</h4>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-secondary" id="prevMonthBtn"><i class="fas fa-chevron-left"></i></button>
                        <button class="btn btn-sm btn-outline-secondary" id="nextMonthBtn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                
                <div class="calendar-grid">
                    <div class="calendar-weekdays">
                        <div class="calendar-weekday">Lun</div>
                        <div class="calendar-weekday">Mar</div>
                        <div class="calendar-weekday">Mer</div>
                        <div class="calendar-weekday">Jeu</div>
                        <div class="calendar-weekday">Ven</div>
                        <div class="calendar-weekday">Sam</div>
                        <div class="calendar-weekday">Dim</div>
                    </div>
                    <div class="calendar-days" id="calendarDays">
                        <!-- Les jours du mois seront générés par JavaScript -->
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card-custom mb-4">
                <h5 class="brand-font">Événements à venir</h5>
                <div class="upcoming-events" id="upcomingEvents">
                    <!-- Les événements à venir seront générés par JavaScript -->
                </div>
            </div>
            
            <div class="card-custom mb-4">
                <h5 class="brand-font">Mini calendrier</h5>
                <div class="mini-calendar" id="miniCalendar">
                    <!-- Le mini calendrier sera généré par JavaScript -->
                </div>
            </div>
            
            <div class="card-custom">
                <h5 class="brand-font">Types d'événements</h5>
                <div class="event-types">
                    <div class="event-type">
                        <div class="event-type-color project"></div>
                        <span>Projets</span>
                    </div>
                    <div class="event-type">
                        <div class="event-type-color invoice"></div>
                        <span>Factures</span>
                    </div>
                    <div class="event-type">
                        <div class="event-type-color quote"></div>
                        <span>Devis</span>
                    </div>
                    <div class="event-type">
                        <div class="event-type-color meeting"></div>
                        <span>Réunions</span>
                    </div>
                    <div class="event-type">
                        <div class="event-type-color deadline"></div>
                        <span>Échéances</span>
                    </div>
                    <div class="event-type">
                        <div class="event-type-color holiday"></div>
                        <span>Jours fériés</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour créer un nouvel événement -->
<div class="modal fade" id="newEventModal" tabindex="-1" aria-labelledby="newEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newEventModalLabel">Créer un nouvel événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="eventForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Titre de l'événement</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="eventDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="eventDate" required>
                        </div>
                        <div class="col-md-6">
                            <label for="eventTime" class="form-label">Heure</label>
                            <input type="time" class="form-control" id="eventTime" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="eventLocation">
                    </div>
                    <div class="mb-3">
                        <label for="eventType" class="form-label">Type d'événement</label>
                        <select class="form-select" id="eventType" required>
                            <option value="project">Projet</option>
                            <option value="invoice">Facture</option>
                            <option value="quote">Devis</option>
                            <option value="meeting">Réunion</option>
                            <option value="deadline">Échéance</option>
                            <option value="holiday">Jour férié</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eventReminder" class="form-label">Rappel</label>
                        <select class="form-select" id="eventReminder">
                            <option value="none">Aucun</option>
                            <option value="15min">15 minutes avant</option>
                            <option value="30min">30 minutes avant</option>
                            <option value="1hour">1 heure avant</option>
                            <option value="1day">1 jour avant</option>
                            <option value="1week">1 semaine avant</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer l'événement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour voir les détails d'un événement -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailsModalLabel">Détails de l'événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="eventDetailsContent">
                <!-- Les détails de l'événement seront insérés ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="editEventBtn">Modifier</button>
                <button type="button" class="btn btn-danger" id="deleteEventBtn">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let currentDate = new Date();
let currentView = 'month';
let currentFilter = 'all';
let events = [];

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    initializeCalendar();
    setupEventListeners();
    loadEvents();
});

// Initialiser le calendrier
function initializeCalendar() {
    renderCalendar();
    renderMiniCalendar();
    renderUpcomingEvents();
}

// Configuration des écouteurs d'événements
function setupEventListeners() {
    // Navigation entre les vues
    document.getElementById('monthView').addEventListener('click', function() {
        currentView = 'month';
        updateViewButtons();
        renderCalendar();
    });
    
    document.getElementById('weekView').addEventListener('click', function() {
        currentView = 'week';
        updateViewButtons();
        renderCalendar();
    });
    
    document.getElementById('dayView').addEventListener('click', function() {
        currentView = 'day';
        updateViewButtons();
        renderCalendar();
    });
    
    document.getElementById('agendaView').addEventListener('click', function() {
        currentView = 'agenda';
        updateViewButtons();
        renderCalendar();
    });
    
    // Navigation entre les mois
    document.getElementById('prevMonthBtn').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
        renderMiniCalendar();
    });
    
    document.getElementById('nextMonthBtn').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
        renderMiniCalendar();
    });
    
    // Bouton "Aujourd'hui"
    document.getElementById('todayBtn').addEventListener('click', function() {
        currentDate = new Date();
        renderCalendar();
        renderMiniCalendar();
    });
    
    // Filtres
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentFilter = this.dataset.filter;
            updateFilterButtons();
            loadEvents();
        });
    });
    
    // Recherche
    document.getElementById('calendarSearch').addEventListener('input', function() {
        renderCalendar();
    });
    
    // Formulaire d'événement
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const title = document.getElementById('eventTitle').value;
        const description = document.getElementById('eventDescription').value;
        const date = document.getElementById('eventDate').value;
        const time = document.getElementById('eventTime').value;
        const location = document.getElementById('eventLocation').value;
        const type = document.getElementById('eventType').value;
        const reminder = document.getElementById('eventReminder').value;
        
        // Envoyer les données au serveur
        fetch('/calendar/events', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                title,
                description,
                date,
                time,
                location,
                type,
                reminder
            })
        })
        .then(response => response.json())
        .then(data => {
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('newEventModal'));
            modal.hide();
            
            // Réinitialiser le formulaire
            document.getElementById('eventForm').reset();
            
            // Rafraîchir le calendrier
            loadEvents();
            
            // Afficher une notification
            showNotification('Événement créé avec succès', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Erreur lors de la création de l\'événement', 'danger');
        });
    });
}

// Mettre à jour les boutons de vue
function updateViewButtons() {
    document.querySelectorAll('#monthView, #weekView, #dayView, #agendaView').forEach(btn => {
        btn.classList.remove('active');
    });
    
    document.getElementById(currentView + 'View').classList.add('active');
}

// Mettre à jour les boutons de filtre
function updateFilterButtons() {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    document.querySelector(`.filter-btn[data-filter="${currentFilter}"]`).classList.add('active');
}

// Charger les événements depuis le serveur
function loadEvents() {
    const startDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const endDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    
    fetch(`/calendar/events?start=${startDate.toISOString()}&end=${endDate.toISOString()}&type=${currentFilter}`)
        .then(response => response.json())
        .then(data => {
            events = data;
            renderCalendar();
            renderUpcomingEvents();
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Erreur lors du chargement des événements', 'danger');
        });
}

// Rendre le calendrier
function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Mettre à jour l'en-tête du calendrier
    document.getElementById('currentMonth').textContent = new Date(year, month, 1).toLocaleDateString('fr-FR', { month: 'long', year: 'numeric' });
    
    // Calculer le premier jour du mois et le nombre de jours dans le mois
    const firstDay = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    // Ajuster pour que la semaine commence le lundi
    let startingDayOfWeek = firstDay.getDay();
    if (startingDayOfWeek === 0) startingDayOfWeek = 6;
    else startingDayOfWeek--;
    
    // Créer le tableau de jours
    const calendarDays = document.getElementById('calendarDays');
    calendarDays.innerHTML = '';
    
    // Ajouter des cases vides pour les jours avant le premier jour du mois
    for (let i = 0; i < startingDayOfWeek; i++) {
        calendarDays.innerHTML += '<div class="calendar-day empty"></div>';
    }
    
    // Ajouter les jours du mois
    const today = new Date();
    const searchTerm = document.getElementById('calendarSearch').value.toLowerCase();
    
    for (let day = 1; day <= daysInMonth; day++) {
        const currentDay = new Date(year, month, day);
        const isToday = currentDay.toDateString() === today.toDateString();
        
        // Filtrer les événements pour ce jour
        const dayEvents = events.filter(event => {
            const eventDate = new Date(event.start);
            return eventDate.toDateString() === currentDay.toDateString() && 
                   (searchTerm === '' || event.title.toLowerCase().includes(searchTerm));
        });
        
        let eventHtml = '';
        
        if (dayEvents.length > 0) {
            // Limiter à 3 événements par jour
            const displayEvents = dayEvents.slice(0, 3);
            
            eventHtml = '<div class="day-events">';
            displayEvents.forEach(event => {
                const eventClass = getEventClass(event.type);
                eventHtml += `<div class="day-event ${eventClass}" title="${event.title}" data-event-id="${event.id}">${event.title}</div>`;
            });
            if (dayEvents.length > 3) {
                eventHtml += `<div class="day-more">+${dayEvents.length - 3} plus</div>`;
            }
            eventHtml += '</div>';
        }
        
        const dayClass = isToday ? 'today' : '';
        const hasEventClass = dayEvents.length > 0 ? 'has-event' : '';
        
        calendarDays.innerHTML += `
            <div class="calendar-day ${dayClass} ${hasEventClass}" data-date="${year}-${month + 1}-${day}">
                ${day}
                ${eventHtml}
            </div>
        `;
    }
    
    // Ajouter des cases vides pour compléter la grille (généralement 6 lignes x 7 colonnes = 42 cases)
    const totalCells = startingDayOfWeek + daysInMonth;
    const totalGridCells = 42; // 6 lignes x 7 colonnes
    
    for (let i = totalCells; i < totalGridCells; i++) {
        calendarDays.innerHTML += '<div class="calendar-day empty"></div>';
    }
    
    // Ajouter les écouteurs d'événements pour afficher les détails
    document.querySelectorAll('.calendar-day:not(.empty)').forEach(day => {
        day.addEventListener('click', function(e) {
            // Si on clique sur un événement, afficher ses détails
            if (e.target.classList.contains('day-event')) {
                const eventId = e.target.dataset.eventId;
                const event = events.find(ev => ev.id === eventId);
                if (event) {
                    showEventDetails(event);
                }
            } else {
                // Sinon, afficher les événements du jour
                const dateStr = this.dataset.date;
                const [year, month, day] = dateStr.split('-').map(Number);
                const date = new Date(year, month - 1, day);
                
                const dayEvents = events.filter(event => {
                    const eventDate = new Date(event.start);
                    return eventDate.toDateString() === date.toDateString();
                });
                
                if (dayEvents.length > 0) {
                    showEventDetails(dayEvents[0]);
                }
            }
        });
    });
}

// Rendre le mini calendrier
function renderMiniCalendar() {
    const miniCalendar = document.getElementById('miniCalendar');
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    
    // Mettre à jour l'en-tête du mini calendrier
    const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    const monthName = monthNames[month];
    
    // Créer l'en-tête
    let miniCalendarHtml = `
        <div class="mini-calendar-header">
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-sm btn-outline-secondary" onclick="changeMonth(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <h6 class="mb-0">${monthName} ${year}</h6>
                <button class="btn btn-sm btn-outline-secondary" onclick="changeMonth(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="mini-calendar-body">
            <div class="mini-calendar-weekdays">
                <div class="mini-calendar-weekday">L</div>
                <div class="mini-calendar-weekday">M</div>
                <div class="mini-calendar-weekday">M</div>
                <div class="mini-calendar-weekday">J</div>
                <div class="mini-calendar-weekday">V</div>
                <div class="mini-calendar-weekday">S</div>
                <div class="mini-calendar-weekday">D</div>
            </div>
            <div class="mini-calendar-days">
    `;
    
    // Calculer le premier jour du mois et le nombre de jours dans le mois
    const firstDay = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    // Ajuster pour que la semaine commence le lundi
    let startingDayOfWeek = firstDay.getDay();
    if (startingDayOfWeek === 0) startingDayOfWeek = 6;
    else startingDayOfWeek--;
    
    // Ajouter des cases vides pour les jours avant le premier jour du mois
    for (let i = 0; i < startingDayOfWeek; i++) {
        miniCalendarHtml += '<div class="mini-calendar-day empty"></div>';
    }
    
    // Ajouter les jours du mois
    const today = new Date();
    
    for (let day = 1; day <= daysInMonth; day++) {
        const currentDay = new Date(year, month, day);
        const isToday = currentDay.toDateString() === today.toDateString();
        
        // Filtrer les événements pour ce jour
        const dayEvents = events.filter(event => {
            const eventDate = new Date(event.start);
            return eventDate.toDateString() === currentDay.toDateString();
        });
        
        const dayClass = isToday ? 'today' : '';
        const hasEventClass = dayEvents.length > 0 ? 'has-event' : '';
        
        miniCalendarHtml += `
            <div class="mini-calendar-day ${dayClass} ${hasEventClass}" data-date="${year}-${month + 1}-${day}">
                ${day}
                ${dayEvents.length > 0 ? '<div class="mini-calendar-event"></div>' : ''}
            </div>
        `;
    }
    
    miniCalendarHtml += `
            </div>
        </div>
    `;
    
    miniCalendar.innerHTML = miniCalendarHtml;
    
    // Ajouter les écouteurs d'événements pour le mini calendrier
    document.querySelectorAll('.mini-calendar-day:not(.empty)').forEach(day => {
        day.addEventListener('click', function() {
            const dateStr = this.dataset.date;
            const [year, month, day] = dateStr.split('-').map(Number);
            currentDate = new Date(year, month - 1, day);
            renderCalendar();
        });
    });
}

// Rendre les événements à venir
function renderUpcomingEvents() {
    const upcomingEventsContainer = document.getElementById('upcomingEvents');
    const today = new Date();
    
    // Filtrer les événements à venir (dans les 30 prochains jours)
    const upcoming = events.filter(event => {
        const eventDate = new Date(event.start);
        const daysUntilEvent = Math.ceil((eventDate - today) / (1000 * 60 * 60 * 24));
        return daysUntilEvent >= 0 && daysUntilEvent <= 30;
    });
    
    // Trier par date
    upcoming.sort((a, b) => new Date(a.start) - new Date(b.start));
    
    if (upcoming.length === 0) {
        upcomingEventsContainer.innerHTML = `
            <div class="text-center py-3">
                <i class="fas fa-calendar-alt fa-2x text-muted mb-2"></i>
                <p class="text-muted">Aucun événement à venir</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    
    upcoming.forEach(event => {
        const eventDate = new Date(event.start);
        const daysUntilEvent = Math.ceil((eventDate - today) / (1000 * 60 * 60 * 24));
        const eventClass = getEventClass(event.type);
        
        html += `
            <div class="upcoming-event">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-1">${event.title}</h6>
                        <p class="text-muted small mb-1">${event.description}</p>
                        <div class="d-flex align-items-center">
                            <div class="event-type-color ${eventClass} me-2"></div>
                            <small class="text-muted">${formatDate(event.start)} - ${formatTime(event.start)}</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary">${daysUntilEvent === 0 ? 'Aujourd\'hui' : `Dans ${daysUntilEvent} jours`}</span>
                    </div>
                </div>
            </div>
        `;
    });
    
    upcomingEventsContainer.innerHTML = html;
}

// Changer de mois pour le mini calendrier
function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
    renderMiniCalendar();
    loadEvents();
}

// Obtenir la classe CSS pour un type d'événement
function getEventClass(type) {
    const eventClasses = {
        'project': 'project',
        'invoice': 'invoice',
        'quote': 'quote',
        'meeting': 'meeting',
        'deadline': 'deadline',
        'holiday': 'holiday',
        'other': 'other'
    };
    
    return eventClasses[type] || 'other';
}

// Formater une date
function formatDate(date) {
    return new Date(date).toLocaleDateString('fr-FR');
}

// Formater une heure
function formatTime(date) {
    return new Date(date).toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
}

// Afficher les détails d'un événement
function showEventDetails(event) {
    const detailsContent = document.getElementById('eventDetailsContent');
    
    detailsContent.innerHTML = `
        <div class="event-details">
            <h5 class="event-title">${event.title}</h5>
            <div class="event-meta mb-3">
                <div class="d-flex align-items-center mb-2">
                    <div class="event-type-color ${getEventClass(event.type)} me-2"></div>
                    <span class="badge bg-secondary">${getEventTypeName(event.type)}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-calendar-alt me-2"></i>
                    <span>${formatDate(event.start)} à ${formatTime(event.start)}</span>
                </div>
                ${event.location ? `<div class="d-flex align-items-center mb-2"><i class="fas fa-map-marker-alt me-2"></i>${event.location}</div>` : ''}
            </div>
            <div class="event-description">
                <p>${event.description}</p>
            </div>
        </div>
    `;
    
    // Configurer les boutons
    document.getElementById('editEventBtn').onclick = function() {
        editEvent(event.id);
    };
    
    document.getElementById('deleteEventBtn').onclick = function() {
        deleteEvent(event.id);
    };
    
    // Afficher le modal
    const modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
    modal.show();
}

// Modifier un événement
function editEvent(eventId) {
    // Implémenter la modification d'événement
    showNotification('Fonctionnalité de modification à venir', 'info');
}

// Supprimer un événement
function deleteEvent(eventId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
        // Envoyer la requête de suppression au serveur
        fetch(`/calendar/events/${eventId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('eventDetailsModal'));
            modal.hide();
            
            // Rafraîchir le calendrier
            loadEvents();
            
            // Afficher une notification
            showNotification('Événement supprimé avec succès', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Erreur lors de la suppression de l\'événement', 'danger');
        });
    }
}

// Exporter le calendrier
function exportCalendar() {
    // Créer le contenu à exporter
    let content = `Calendrier NJIEZM.FR - ${new Date().toLocaleDateString('fr-FR')}\n\n`;
    
    // Ajouter les événements du mois actuel
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    
    const monthEvents = events.filter(event => {
        const eventDate = new Date(event.start);
        return eventDate.getFullYear() === year && eventDate.getMonth() === month;
    });
    
    if (monthEvents.length > 0) {
        content += `Événements du mois de ${new Date(year, month, 1).toLocaleDateString('fr-FR', { month: 'long' })}`;
        content += '\n\n';
        
        monthEvents.forEach(event => {
            content += `Date: ${formatDate(event.start)}\n`;
            content += `Titre: ${event.title}\n`;
            content += `Description: ${event.description}\n`;
            content += `Type: ${getEventTypeName(event.type)}\n`;
            content += `Lieu: ${event.location || 'Non spécifié'}\n\n`;
        });
    }
    
    // Créer et télécharger le fichier
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = `calendrier_njiezm_${new Date().toISOString().split('T')[0]}.txt`;
    link.click();
    
    URL.revokeObjectURL(url);
    
    showNotification('Calendrier exporté avec succès', 'success');
}

// Obtenir le nom du type d'événement
function getEventTypeName(type) {
    const typeNames = {
        'project': 'Projet',
        'invoice': 'Facture',
        'quote': 'Devis',
        'meeting': 'Réunion',
        'deadline': 'Échéance',
        'holiday': 'Jour férié',
        'other': 'Autre'
    };
    
    return typeNames[type] || 'Autre';
}

// Afficher une notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('alert-show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 150);
    }, 3000);
}
</script>

<style>
.calendar-container {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.calendar-header {
    background-color: var(--nj-blue);
    color: white;
    padding: 10px 15px;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    grid-template-rows: auto repeat(6, 1fr);
}

.calendar-weekdays {
    display: contents;
    grid-template-columns: repeat(7, 1fr);
    grid-template-rows: 1fr;
}

.calendar-weekday {
    text-align: center;
    font-weight: bold;
    padding: 10px 0;
    color: var(--nj-dark);
}

.calendar-day {
    min-height: 100px;
    padding: 8px;
    border: 1px solid #e9ecef;
    text-align: left;
    position: relative;
    cursor: pointer;
    transition: all 0.2s ease;
}

.calendar-day:hover {
    background-color: #f8f9fa;
}

.calendar-day.today {
    background-color: var(--nj-blue);
    color: white;
    font-weight: bold;
}

.calendar-day.has-event {
    background-color: #f0f8ff;
    border-color: var(--nj-blue);
}

.calendar-day.empty {
    border: none;
    background: transparent;
    cursor: default;
}

.day-events {
    position: absolute;
    top: 25px;
    left: 5px;
    right: 5px;
}

.day-event {
    background-color: var(--nj-blue);
    color: white;
    font-size: 0.7rem;
    padding: 2px 4px;
    border-radius: 3px;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
}

.day-event:hover {
    opacity: 0.8;
}

.day-event.project {
    background-color: #0d6efd;
}

.day-event.invoice {
    background-color: #198754;
}

.day-event.quote {
    background-color: #6f42c1;
}

.day-event.meeting {
    background-color: #20c997;
}

.day-event.deadline {
    background-color: #dc3545;
}

.day-event.holiday {
    background-color: #fd7e14;
}

.day-event.other {
    background-color: #6c757d;
}

.day-more {
    font-size: 0.7rem;
    color: var(--nj-blue);
    font-weight: bold;
    cursor: pointer;
}

.mini-calendar {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 12px;
}

.mini-calendar-header {
    background-color: var(--nj-blue);
    color: white;
    padding: 5px 10px;
}

.mini-calendar-body {
    padding: 5px;
}

.mini-calendar-weekday {
    text-align: center;
    font-weight: bold;
    padding: 3px 0;
    color: var(--nj-dark);
    font-size: 0.7rem;
}

.mini-calendar-day {
    min-height: 25px;
    border: 1px solid #e9ecef;
    text-align: center;
    position: relative;
    cursor: pointer;
    transition: all 0.2s ease;
}

.mini-calendar-day:hover {
    background-color: #f8f9fa;
}

.mini-calendar-day.today {
    background-color: var(--nj-blue);
    color: white;
    font-weight: bold;
}

.mini-calendar-day.has-event {
    background-color: #f0f8ff;
    border-color: var(--nj-blue);
}

.mini-calendar-day.empty {
    border: none;
    background: transparent;
    cursor: default;
}

.mini-calendar-event {
    position: absolute;
    top: 0;
    right: 0;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: var(--nj-yellow);
}

.upcoming-events {
    max-height: 400px;
    overflow-y: auto;
}

.upcoming-event {
    border-bottom: 1px solid #e9ecef;
    padding: 10px;
    margin-bottom: 10px;
}

.upcoming-event:last-child {
    border-bottom: none;
}

.event-type-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}

.event-type.project {
    background-color: #0d6efd;
}

.event-type.invoice {
    background-color: #198754;
}

.event-type.quote {
    background-color: #6f42c1;
}

.event-type.meeting {
    background-color: #20c997;
}

.event-type.deadline {
    background-color: #dc3545;
}

.event-type.holiday {
    background-color: #fd7e14;
}

.event-type.other {
    background-color: #6c757d;
}

.event-details {
    font-family: 'Space Grotesk', sans-serif;
}

.event-title {
    color: var(--nj-blue);
    margin-bottom: 10px;
}

.event-meta {
    margin-bottom: 10px;
}

.badge {
    font-size: 0.7rem;
}
</style>
@endsection