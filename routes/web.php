<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResponsibilitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\BenefitsController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\ConsultationsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\InclusionsController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\QualificationsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SpecializationsController;
use App\Models\Appointment;

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// HOME
Route::get('/', [PageController::class, 'home'])->name('home');


// ABOUT US
Route::get('/home/about-us/company-profile', [PageController::class, 'about_us'])->name('about-us');
Route::get('/home/about-us/board-of-directors', [PageController::class, 'BOD'])->name('BOD');


// SERVICES
Route::get('/home/services', [PageController::class, 'services'])->name('services');
Route::get('/home/services/{id}', [PageController::class, 'show_service'])->name('service.show');


// CAREERS
Route::get('/home/careers', [PageController::class, 'careers'])->name('careers');
Route::get('/home/careers/{id}', [PageController::class, 'show_career'])->name('careers.show');


// FIND A DOCTOR
Route::get('/home/find-a-doctor', [PageController::class, 'find_a_doctor'])->name('find-a-doctor.show');
Route::get('/home/find-a-doctor/results', [PageController::class, 'show_doctor'])->name('find-a-doctor.results');
Route::get('/home/find-a-doctor/doctor/{id}', [PageController::class, 'doctor_details'])->name('find-a-doctor.doctor-details');


// NEWS AND EVENTS
Route::get('/home/news-and-events', [PageController::class, 'news_and_events'])->name('news-and-events.show');
Route::get('/home/news-and-events/{id}', [PageController::class, 'show_news'])->name('news-and-events.singlepage');


//CONTACT US
Route::get('/home/contact-us', [PageController::class, 'contact_us'])->name('contact-us.show');
Route::post('/home/contact-us', [PageController::class, 'submit_contact_form'])->name('contact-us.submit');

// Frontend newsletter submission
Route::post('/newsletter', [NewslettersController::class, 'store'])->name('newsletter.store');
Route::post('/contact-us', [ContactsController::class, 'store'])->name('contacts.store');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('/consultations', [ConsultationsController::class, 'store'])->name('consultations.store');

//ADMIN PAGE
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('banners', BannersController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('benefits', BenefitsController::class);
    Route::resource('inclusions', InclusionsController::class);
    Route::resource('careers', CareersController::class);
    Route::resource('responsibilities', ResponsibilitiesController::class);
    Route::resource('qualifications', QualificationsController::class);
    Route::resource('doctors', DoctorsController::class);
    Route::resource('specialization', SpecializationsController::class);
    Route::resource('languages', LanguagesController::class);
    Route::resource('newsletters', NewslettersController::class);
    Route::resource('contacts', ContactsController::class);
    Route::resource('blogs', BlogsController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('consultations', ConsultationsController::class);
    Route::resource('career_applications', CareerApplicationController::class);


    Route::get('newsletter-export', [NewslettersController::class, 'export'])->name('newsletter.export');
    Route::get('contacts-export', [ContactsController::class, 'export'])->name('contacts.export');
    Route::get('appointment-export', [ContactsController::class, 'export'])->name('appointment.export');
});
