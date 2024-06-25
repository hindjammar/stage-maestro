<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Auth\Controllers\RegisterController;
use App\Http\Auth\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FiltrageController;
use App\Http\Controllers\ContactController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//admin 
    Route::get('/dashboardadmin', [UserController::class, 'dashboard']);

    Route::get('/side', function () {
        return view('admin.side');
    });

    Route::get('/allusers', [UserController::class, 'show']);
    Route::post('/allusers/{id}', [UserController::class, 'update']);

    Route::delete('/delete/{id}', [UserController::class, 'deleteUser']);
    Route::get('/deletedUsers', [UserController::class, 'showDeletedUsers']);
    Route::post('/restore/{id}', [UserController::class, 'restoreUser']);

    Route::get('/events', [EventController::class, 'CheckEvent']);
    Route::get('/approveEvents', function () {
        return view('admin.approveEvents');
    });

    //aprove or decline events
    Route::post('/approve-vehicule/{id}', [ProductController::class, 'approveEvent']);
    Route::post('/decline-vehicule/{id}', [ProductController::class, 'declineEvent']);


    //category
    Route::get('/categories', [CategoryController::class, 'showCategories']);

    Route::post('/categories', [CategoryController::class, 'store']);

    Route::delete('/deleteCategory/{id}', [CategoryController::class, 'destroyCategory']);







//creator
Route::get('/product', function () {
    return view('creator.product');
});


    Route::get('/dashboard', [UserController::class, 'statistic']);

    //events
    Route::get('/createComponent', [ProductController::class, 'showForm']);

    Route::post('/creComponent', [ProductController::class, 'store']);

    // Route::get('/colors', [EventController::class, 'AllEvents']);

    Route::get('/description/{id}', [EventController::class, 'ShowEventDescription']);

    Route::delete('/deleteEvent/{id}', [EventController::class, 'deleteEvent']);

    Route::get('/updateEvent/{id}', [EventController::class, 'editEvent']);

    Route::post('/updateEvent/{id}', [EventController::class, 'updateEvent']);

    Route::get('/reservations', [ReservationController::class, 'CheckReservation']);

    //aprove or decline
    Route::post('/approve-reservation/{id}', [ReservationController::class, 'approveReservation']);
    Route::post('/decline-reservation/{id}', [ReservationController::class, 'declineReservation']);




//color blade
//formcolor
Route::get('/affichecolors', [ColorController::class, 'affichecolors']);
Route::post('/api/submit-form', [ColorController::class, 'ajoutcolor']);
// Route::get('/colors', function () {
//     return view('creator.color');
// });
////formreference
Route::get('/colors', [ReferenceController::class, 'create']);
Route::post('/formulaire',[ReferenceController::class,'store']);
Route::get('/affichereferences', [ReferenceController::class, 'index']);

//vehiculeform
Route::get('/vehiculecreator', [ProductController::class, 'index']);
Route::post('/form', [ProductController::class, 'storevehicule']);
Route::get('/componentcreator', [ProductController::class, 'index']);


//dahboard creator
Route::get('/creator/dashboard', [HomeController::class, 'index'])->name('creator.dashboard');


//dashboard client
Route::get('/client/dashboard', [HomeController::class, 'creator']);
Route::get('/refcolors', [ReferenceController::class, 'afficheReference'])->name('refcolors');

Route::post('/cliquer-sur-reference', [ReferenceController::class, 'cliquerSurReference'])->name('cliquer-sur-reference');

Route::get('/profclic', [ClientController::class, 'traiterClicSurBouton']);
Route::get('/profil', [ClientController::class, 'afficherProfil']);
Route::get('/details/{id}', [ClientController::class, 'showDetails']);
Route::get('/formfiltarge',[ClientController::class, 'filtrage']);
Route::get('/filtrage',[FiltrageController::class, 'index']);
Route::get('/vehicule',[FiltrageController::class, 'vehicule']);

Route::get('/resultats',[FiltrageController::class, 'showdetailsvehicule']);
Route::post('/details-vehicule',[FiltrageController::class, 'showdetailsvehicule']);






//test 

// Route pour la page d'affichage de products  dans la page admin
Route::get('/approvevehicules', [ExcelController::class, 'afficherProduct'])->name('prods');
Route::get('/notification',[ProductController::class, 'notification']);

// excel tableau
Route::get('/afficher-vue', [ExcelController::class, 'afficherVue'])->name('afficher-vue');
Route::get('/creer-excel', [ExcelController::class, 'creerExcel'])->name('creer-excel');
Route::get('/exporter-excel', [ExcelController::class, 'exporterExcel'])->name('exporter-excel');
Route::post('/importer-excel', [ExcelController::class, 'importerExcel'])->name('importer-excel');

//email

// Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send.email');


// Route for fetching models based on selected brand
