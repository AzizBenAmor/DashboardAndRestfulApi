<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PartenaireTokenController;
use App\Http\Controllers\API\AdherentTokenController;
use App\Http\Controllers\API\Partenaire\PartenaireController;
use App\Http\Controllers\API\Partenaire\PartenaireOfferController;
use App\Http\Controllers\API\Adherent\GovernoratController;
use App\Http\Controllers\API\Adherent\AdherentController;
use App\Http\Controllers\API\Adherent\VilleController;
use App\Http\Controllers\API\Adherent\SecteurController;
use App\Http\Controllers\API\Adherent\ProfessionController;
use App\Http\Controllers\API\Adherent\NotificationController;
use App\Http\Controllers\API\Adherent\SectProffSpeciController;
use App\Http\Controllers\API\Adherent\OfferController;
use App\Http\Controllers\API\Guest\ContactUsController;
use App\Http\Controllers\API\Guest\SponsorServiceGuestController;
use App\Http\Controllers\API\Guest\StatisticGuestController;
use App\Http\Controllers\API\Guest\PartenaireGuestController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
Route::group(['middleware'=>['auth:sanctum']],function(){
Route::post('/logout',[PartenaireTokenController::class,'logout']);

});
Route::prefix('Guest')->name('guest.')->group(function(){
    Route::post('/contactUs',[ContactUsController::class,'ContactUs']);
    Route::get('/Services',[SponsorServiceGuestController::class,'GetService']);
    Route::get('/Sponsor',[SponsorServiceGuestController::class,'GetSponsor']);
    Route::get('/Secteur',[PartenaireGuestController::class,'GetSecteur']);
    Route::get('/{id}/Partenaire',[PartenaireGuestController::class,'GetPartenaire']);
    Route::post('/Profession',[PartenaireGuestController::class,'GetProfession']);
    Route::post('/Specialite',[PartenaireGuestController::class,'GetSpecialite']);
    Route::post('/filter',[PartenaireGuestController::class,'FilterGov']);
    Route::get('/StatisticAdherent',[StatisticGuestController::class,'StatisticAdherent']);
    Route::get('/StatisticAmicale',[StatisticGuestController::class,'StatisticAmicale']);
    Route::get('/StatisticPartenaire',[StatisticGuestController::class,'StatisticPartenaire']);
});
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/Adherent',[AdherentController::class,'AdherentData'])->name('AdherentData');
});
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/Partenaire',[PartenaireController::class,'PartenaireData'])->name('PartenaireData');
});
Route::prefix('partenaire')->name('partenaire.')->group(function(){
    Route::post('/auth',[PartenaireTokenController::class,'store']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/Offer',[PartenaireOfferController::class,'GetAllOffer'])->name('Offer');
        Route::get('/{id}/Offer',[PartenaireOfferController::class,'GetOffer']);
        Route::post('/Offer/store',[PartenaireOfferController::class,'store'])->name('OfferStore');

        Route::post('/Offer/{id}/update',[PartenaireOfferController::class,'update'])->name('OfferUpdate');
        Route::get('/Offer/{id}/delete',[PartenaireOfferController::class,'destroy'])->name('OfferDestroy');
        Route::post('/changePassword',[PartenaireController::class,'ChangePassword'])->name('ChangePassword');
        Route::post('/Scanner',[PartenaireController::class,'Scanner'])->name('scanner');
        Route::get('/Transaction',[PartenaireController::class,'Transaction'])->name('Transaction');

    Route::post('/logout',[PartenaireTokenController::class,'logout'])->name('logout');
});
Route::get('/secteur/{id}',[PartenaireOfferController::class,'getbysecteur'])->name('getbysecteur');
});
Route::prefix('adherent')->name('adherent.')->group(function(){
    Route::post('/auth',[AdherentTokenController::class,'store'])->name('store');

    Route::get('/gov',[GovernoratController::class,'GetGov'])->name('Gouvernorat');
    Route::get('/ville',[VilleController::class,'GetVille'])->name('Ville');
    Route::get('/secteur',[SecteurController::class,'GetSecteur'])->name('Secteur');
    Route::get('/Publicite',[PubliciteController::class,'getPublicite'])->name('getPublicite');
    Route::get('/profession',[ProfessionController::class,'GetProfession'])->name('Profession');
    Route::get('/notification',[NotificationController::class,'GetNotification'])->name('Notificaion');
    Route::get('/Permanent/Offer',[OfferController::class,'GetPermanentOffer'])->name('PermanentOffer');
    Route::get('/News/Offer',[OfferController::class,'GetNewsOffer'])->name('NewsOffer');
    Route::get('/Yooreed/Offer',[OfferController::class,'GetYooreedOffer'])->name('YooreedOffer');
    Route::post('/offer/search/permanent',[OfferController::class,'searchPermanent']);
    Route::post('/offer/search/news',[OfferController::class,'searchNews']);
    Route::post('/offer/filterPermanent',[OfferController::class,'filterPermanent'])->name('OfferfilterPermanent');
    Route::post('/offer/filterNews',[OfferController::class,'filterNews'])->name('OfferfilterNews');
    Route::get('/partenaire/{id}',[OfferController::class,'GetPartenaire'])->name('Partenaire');
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('/changePassword',[AdherentController::class,'ChangePassword'])->name('ChangePassword');

    });



});
