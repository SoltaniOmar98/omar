<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditeurController;
use App\Http\Controllers\Auto_evalController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\GrilleController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\UtilisateurController;
use App\Models\Chapitre;
use App\Models\Critere;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/auth/check', [UtilisateurController::class, 'Check'])->name('auth.check');
Route::post('/demande/save', [DemandeController::class, 'Save'])->name('demande.save');
Route::get('/auth/logout', [UtilisateurController::class, 'Logout'])->name('auth.logout');
Route::get('/auth/reccupermoncompte', [UtilisateurController::class, 'Resetpassword'])->name('motdepasseoublie');
Route::get('/auth/getcode', [UtilisateurController::class, 'Sendmail'])->name('takecode');
Route::get('/auth/validecode', [UtilisateurController::class, 'ValiderCode'])->name('validcode');
Route::get('/auth/UpdatePassword', [UtilisateurController::class, 'UpdatePassword'])->name('modifiermotdepasse');
Route::get('/auth/login', [UtilisateurController::class, 'Index'])->name('auth.login');
Route::get('/demande/engagement', [DemandeController::class, 'Index'])->name('demande.engagement');

Route::group(['middleware' => ['AuthCheck']], function () {
    Route::get('/admin/dashboard', [UtilisateurController::class, 'Dash_admin']);
    Route::get('/auditeur/dashboard', [UtilisateurController::class, 'Dash_expert']);
    Route::get('/etablissement/dashboard', [UtilisateurController::class, 'Dash_etab']);
    Route::get('dashboard/user/profil', [UtilisateurController::class, 'Show_me'])->name('Mon_profil');
    Route::post('/dashboard/user/profil/updated', [AdminController::class, 'Update_profil'])->name('update.profil');
    Route::post('/dashboard/user/profil/updatepassword', [AdminController::class, 'Update_password'])->name('update.password');
    Route::get('/admin/dashboard/Home', [UtilisateurController::class, 'Home'])->name('Dash.Home');
    // ******************** CRUD EXPERT*****************************
    Route::get('/Expert/List', [AuditeurController::class, 'Expert_List'])->name('listexpert');
    Route::get('/Expert/List/search',[AuditeurController::class,'Search']);
    Route::post('/Expert/List/add/save', [AuditeurController::class, 'Save_Expert'])->name('Save_expert');
    Route::get('/Expert/List/add', [AuditeurController::class, 'Add_Expert'])->name('add_expert');
    Route::get('/Expert/List/edit/{id}', [AuditeurController::class, 'Edit']);
    Route::post('/Expert/List/update/', [AuditeurController::class, 'Update'])->name('update_expert');
    Route::get('/Expert/List/delete', [AuditeurController::class, 'Delete'])->name('delete_expert');
    // ******************** CRUD EXPERT*****************************
    Route::get('/etab/index', [EtablissementController::class, 'index'])->name('index');
    Route::get('/etab/index/search', [EtablissementController::class, 'Search']);
    Route::get('/etab/add', [EtablissementController::class, 'AddEtab'])->name('add_etab');
    Route::post('/etab/add/save', [EtablissementController::class, 'Save'])->name('Save_etab');
    Route::get('/Etab/edit/{id}', [EtablissementController::class, 'Edit']);
    Route::post('/Etab/update', [EtablissementController::class, 'Update'])->name('update_etab');
    Route::get('/etab/delete', [EtablissementController::class, 'Delete'])->name('delete_etab');
    // ******************* Demande *********************************
    Route::get('/demande/list', [DemandeController::class, 'DisplayDemande'])->name('list_demandes');
    Route::get('/demande/accept/{id}', [DemandeController::class, 'AccepterDemande']);
    Route::get('/demande/delete', [DemandeController::class, 'Refuse'])->name('delete_demande');
    // ************************
    Route::get('/grille/index',[GrilleController::class ,'list_grille'])->name('grille.index');
    Route::get('/grille/add', [GrilleController::class, 'create_grille'])->name('add_grille');
    Route::get('/grille/edit/{id}', [GrilleController::class , 'Edit']);
    Route::post('/grille/update',[GrilleController::class , 'Update'])->name('grille.update');
    Route::get('/grille/delete',[GrilleController::class, 'delete'])->name('delete.grille');
    Route::post('/grille/save', [GrilleController::class, 'save'])->name('save_grille');
    Route::get('/grille/search',[GrilleController::class , 'search']);
    Route::get('/grille/save/{id}', [GrilleController::class, 'index'])->name('x');

    // Route::post('/grille/save', '/chapitre/add_chapitre');
    Route::post('/chapitre/save', [ChapitreController::class, 'save'])->name('chapitre_save');
    Route::get('/chapitre/index/{id}',[ChapitreController::class , 'list_chapitre']);
    Route::get('/chapitre/edit/{id}',[ChapitreController::class , 'Edit']);
    Route::get('/chapitre/read',[ChapitreController::class, 'read']);
    Route::post('/chapitre/update',[ChapitreController::class , 'Update'])->name('chapitre.update');
    Route::get('/chapitre/delete',[ChapitreController::class , 'Delete'])->name('chapitre.delete');
    Route::get('/chapitre/search',[ChapitreController::class, 'search']);

    //********************Domaines  */

    Route::get('/domaine/add/{id}',[DomaineController::class , 'index' ]);
    Route::get('/domaine/index/{id}',[DomaineController::class , 'list_domaine']);
    Route::post('/domaine/save', [DomaineController::class , 'save'])->name('domaine.save');
    Route::get('/domaine/edit/{id}',[DomaineController::class , 'Edit']);
    Route::post('/domaine/update',[DomaineController::class , 'Update'])->name('domaine.update');
    Route::get('/domaine/delete' , [DomaineController::class , 'delete'])->name('domaine.delete');
    Route::get('/domaine/search', [DomaineController::class , 'search']);
    //********************Reference */
    Route::get('/reference/add/{id}',[ReferenceController::class , 'index']);
    Route::get('/reference/index/{id}',[ReferenceController::class , 'list_ref']);
    Route::post('/reference/save', [ReferenceController::class , 'save'])->name('reference.save');
    Route::get('/reference/edit/{id}',[ReferenceController::class , 'Edit']);
    Route::post('/reference/update',[ReferenceController::class,'Update'])->name('reference.update');
    Route::get('reference/delete',[ReferenceController::class , 'delete'])->name('reference.delete');
    Route::get('/reference/search',[ReferenceController::class , 'search']);
    // ************************* Critere ***
    Route::get('/critere/add/{id}',[CritereController::class , 'index']);
    Route::get('critere/index/{id}',[CritereController::class , 'list_critere']);
    Route::post('/critere/save', [CritereController::class , 'save'])->name('critere.save');
    Route::get('/critere/edit/{id}' , [CritereController::class , 'Edit']);
    Route::post('/critere/update', [CritereController::class , 'Update'])->name('critere.update');
    Route::get('/critere/delete',[CritereController::class ,'delete'])->name('critere.delete');
    Route::get('/critere/search',[CritereController::class , 'search']);
    //* ******************************** Auto Évaluation **********
    Route::get('/auto_evaluation/index' ,[Auto_evalController::class , 'index'])->name('auto_eval');
    Route::get('/auto_eval/chapitre/{id}' , [Auto_evalController::class , 'getallchapitre']);
    Route::get('/chapitre/get', [Auto_evalController::class ,'get_chapitre']);
    Route::get('/auto_eval/domaine/{id}',[Auto_evalController::class , 'getalldomaine']);
    Route::get('domaine/get' ,[Auto_evalController::class ,'get_domaine']);
    Route::get('auto_eval/references/{id}',[Auto_evalController::class ,'getallreference']);
    Route::get('ref/get',[Auto_evalController::class , 'get_reference']);
    Route::get('auto_eval/critere/{id}',[Auto_evalController::class , 'getallcritere']);
    Route::post('/auto_eval/note', [Auto_evalController::class ,'InsertNote']);
});
