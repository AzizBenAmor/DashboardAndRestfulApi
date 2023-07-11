<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adherent\AdherentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PubliciteAdminController;
use App\Http\Controllers\Admin\NotificationAdminController;
use App\Http\Controllers\Admin\PartenaireAdminController;
use App\Http\Controllers\Admin\PromoAdminController;
use App\Http\Controllers\Admin\AmicaleAdminController;
use App\Http\Controllers\Admin\CarteAdminController;
use App\Http\Controllers\Admin\EvenementAdminController;
use App\Http\Controllers\Admin\GouvVilleAdminController;
use App\Http\Controllers\Admin\SecteurProfessionSpecial;
use App\Http\Controllers\Admin\AdherentAdminController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Partenaire\PartenaireController;
use App\Http\Controllers\Guest\GuestController;
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
// Auth::routes();







 Route::get('country-state-city',[GouvVilleAdminController::class, 'test']);  
 Route::post('/api/fetch-villes', [GouvVilleAdminController::class, 'getVilles']);
 Route::get('secteur-state-profession',[SecteurProfessionSpecial::class, 'test1']);  
 Route::post('/api/fetch-professions', [SecteurProfessionSpecial::class, 'getProfession']);
 Route::post('/api/fetch-specialites', [SecteurProfessionSpecial::class, 'getSpecialite']);
 Route::get('profession-state-specialite',[SecteurProfessionSpecial::class, 'test2']);  

 Route::view('/','dashboard.admin.login')->name('login');

 Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
        Route::view('/','dashboard.admin.login')->name('login');
        Route::post('/check',[AdminController::class,'check'])->name('check');

    });
        Route::middleware(['auth:admin','PreventBackHistory','SingleSession'])->group(function(){
            Route::get('/home',[AdminController::class,'index'])->name('home'); 
            Route::get('/changePassword',[AdminController::class,'edit'])->name('changePassword'); 
            Route::post('/changePassword/update',[AdminController::class,'update'])->name('update');
            Route::post('/logout',[AdminController::class,'logout'])->name('logout');
            Route::get('/amicale',[AmicaleAdminController::class,'AmicaleIndex'])->name('Amicale'); 
            Route::post('/AdherentStore',[AdherentAdminController::class,'AdherentStore'])->name('AdherentStore'); 
            Route::post('/amicalestore',[AmicaleAdminController::class,'AmicaleStore'])->name('amicalestore');
            Route::get('/amicale/{id}/adherent',[AdherentAdminController::class,'AdherentIndex'])->name('AdherentIndex'); 
            Route::get('/adherent/active',[AdherentAdminController::class,'AdherentActiveIndex'])->name('AdherentActiveIndex'); 
            Route::get('/adherent/bloquer',[AdherentAdminController::class,'AdherentBloquerIndex'])->name('AdherentBloquerIndex'); 
            Route::get('/carte',[CarteAdminController::class,'CarteIndex'])->name('Carte'); 
            Route::match(array('GET', 'POST'),'/amicale/search',[AmicaleAdminController::class,'SearchAmicale'])->name('SearchAmicale'); 
            Route::match(array('GET', 'POST','PUT'),'/adherent/{id}/block',[CarteAdminController::class,'Carteblock'])->name('Carteblock');
            Route::get('/adherent/{id}/Unblock',[CarteAdminController::class,'CarteUnblock'])->name('CarteUnblock');
            Route::match(array('GET', 'POST'),'/adherent/search',[AdherentAdminController::class,'SearchAdherent'])->name('SearchAdherent'); 
            Route::get('/adherent/{id}/delete',[AdherentAdminController::class,'destroyAdherent'])->name('destroyAdherent');
            Route::get('/carte/{id}/delete',[CarteAdminController::class,'destroyCarte'])->name('destroyCarte');
            Route::get('/amicale/{id}/delete',[AmicaleAdminController::class,'AmicaleDestroy'])->name('AmicaleDestroy');
            Route::put('/adherent/{id}/update',[AdherentAdminController::class,'UpdateAdherent'])->name('UpdateAdherent'); 
            Route::put('/amicale/{id}/update',[AmicaleAdminController::class,'UpdateAmicale'])->name('UpdateAmicale'); 
            Route::match(array('GET', 'POST'),'/carte/search',[CarteAdminController::class,'SearchCarte'])->name('SearchCarte'); 
            Route::get('/evenement',[EvenementAdminController::class,'EvenementIndex'])->name('EvenementIndex'); 
            Route::post('/evenement/store',[EvenementAdminController::class,'EvenementStore'])->name('EvenementStore');
            Route::get('/evenement/{id}/post',[EvenementAdminController::class,'EvenementPost'])->name('EvenementPost');
            Route::get('/evenement/{id}/Unpost',[EvenementAdminController::class,'EvenementUnPost'])->name('EvenementUnPost');
            Route::put('/evenement/{id}/update',[EvenementAdminController::class,'EvenementUpdate'])->name('EvenementUpdate'); 
            Route::get('/evenement/{id}/delete',[EvenementAdminController::class,'EvenementDelete'])->name('EvenementDelete');
            Route::get('/promo',[PromoAdminController::class,'PromoIndex'])->name('PromoIndex'); 
            Route::post('/promo/store',[PromoAdminController::class,'PromoStore'])->name('PromoStore');
            Route::get('/promo/{id}/post',[PromoAdminController::class,'PromoPost'])->name('PromoPost');
            Route::get('/promo/{id}/Unpost',[PromoAdminController::class,'PromounPost'])->name('PromoUnPost');
            Route::get('/promo/{id}/delete',[PromoAdminController::class,'PromoDelete'])->name('PromoDelete');
            Route::put('/promo/{id}/update',[PromoAdminController::class,'PromoUpdate'])->name('PromoUpdate'); 
            Route::get('/partenaire',[PartenaireAdminController::class,'PartenaireIndex'])->name('PartenaireIndex'); 
            Route::post('/partenaire/store',[PartenaireAdminController::class,'PartenaireStore'])->name('PartenaireStore'); 
            Route::put('/partenaire/{id}/update',[PartenaireAdminController::class,'PartenaireUpdate'])->name('PartenaireUpdate'); 
            Route::get('/partenaire/{id}/delete',[PartenaireAdminController::class,'PartenaireDelete'])->name('PartenaireDelete');
            Route::match(array('GET', 'POST'),'/evenement/search',[EvenementAdminController::class,'SearchEvenement'])->name('SearchEvenement'); 
            Route::match(array('GET', 'POST'),'/promo/search',[PromoAdminController::class,'SearchPromo'])->name('SearchPromo'); 
            Route::match(array('GET', 'POST'),'/partenaire/search',[PartenaireAdminController::class,'SearchPartenaire'])->name('SearchPartenaire'); 
            Route::post('carte/import',[CarteAdminController::class,'importCarte'])->name('importCarte');
            Route::post('carte/amicaleAdd',[CarteAdminController::class,'AddAmicaleToCarte'])->name('AddAmicaleToCarte');
            Route::post('carte/store',[CarteAdminController::class,'CarteStore'])->name('CarteStore');
            Route::post('carte/{id}/amicaleAddOne',[CarteAdminController::class,'AffectAmicale'])->name('AffectAmicale');
            Route::post('adherent/import',[AdherentAdminController::class,'ImportAdhernet'])->name('ImportAdhernet');
            Route::get('/notification',[NotificationAdminController::class,'NotificationIndex'])->name('NotificationIndex'); 
            Route::post('/notificationstore',[NotificationAdminController::class,'NotificationStore'])->name('NotificationStore');
            Route::get('/notification/{id}/delete',[NotificationAdminController::class,'NotificationDelete'])->name('NotificationDelete');
            Route::get('/Gouvernorat',[GouvVilleAdminController::class,'GouvernoratIndex'])->name('GouvernoratIndex'); 
            Route::put('/Gouvernorat/{id}/update',[GouvVilleAdminController::class,'UpdateGouvernorat'])->name('UpdateGouvernorat'); 
            Route::post('/gouvernoratstore',[GouvVilleAdminController::class,'GouvernoratStore'])->name('GouvernoratStore');
            Route::get('/gouvernorat/{id}/delete',[GouvVilleAdminController::class,'GouvernoratDelete'])->name('GouvernoratDelete');
            Route::get('/Gouvernorat/{id}/ville',[GouvVilleAdminController::class,'VilleIndex'])->name('VilleIndex'); 
            Route::post('/villestore/{id}',[GouvVilleAdminController::class,'VilleStore'])->name('VilleStore');
            Route::get('/ville/{id}/delete',[GouvVilleAdminController::class,'VilleDelete'])->name('VilleDelete');
            Route::put('/ville/{id}/update',[GouvVilleAdminController::class,'Updateville'])->name('Updateville'); 
            Route::get('/publicite',[PubliciteAdminController::class,'indexPublicite'])->name('indexPublicite'); 
            Route::post('/publiciteStore',[PubliciteAdminController::class,'storePublicite'])->name('storePublicite');
            Route::get('/publicite/{id}/post',[PubliciteAdminController::class,'PublicitePost'])->name('PublicitePost');
            Route::get('/publicite/{id}/Unpost',[PubliciteAdminController::class,'PubliciteUnPost'])->name('PubliciteUnPost');
            Route::get('/publicite/{id}/delete',[PubliciteAdminController::class,'PubliciteDelete'])->name('PubliciteDelete');
            Route::get('/partenaire/{id}/offers',[OfferController::class,'Index'])->name('OfferIndex');
            Route::post('/partenaire/{id}/offers/store',[OfferController::class,'OfferStore'])->name('OfferStore');
            Route::post('/offers/store',[OfferController::class,'OfferYooreedStore'])->name('OfferYooreedStore');
            Route::get('/partenaire/offers/{id}/delete',[OfferController::class,'DeleteOffer'])->name('DeleteOffer');
            Route::get('/partenaire/offers/{id}/accept',[OfferController::class,'AcceptOffer'])->name('AcceptOffer');
            Route::get('/partenaire/offers/{id}/refuse',[OfferController::class,'RefuseOffer'])->name('RefuseOffer');
            Route::get('/offers/pending',[OfferController::class,'PendingOffer'])->name('PendingOffer');
            Route::get('/offers/yooreed',[OfferController::class,'YooreedOffer'])->name('YooreedOffer');
            Route::get('/offers/accept',[OfferController::class,'AcceptedOffer'])->name('AcceptedOffer');
            Route::get('/offers/refused',[OfferController::class,'RefusedOffer'])->name('RefusedOffer');
            Route::match(array('GET', 'POST'),'/gouvernorat/search',[GouvVilleAdminController::class,'SearchGouvernorat'])->name('SearchGouvernorat'); 
            Route::match(array('GET', 'POST'),'/secteur/search',[SecteurProfessionSpecial::class,'SearchSecteur'])->name('SearchSecteur'); 
            Route::match(array('GET', 'POST'),'/profession/search',[SecteurProfessionSpecial::class,'SearchProfession'])->name('SearchProfession'); 
            Route::match(array('GET', 'POST'),'/specialite/search',[SecteurProfessionSpecial::class,'SearchSpecialite'])->name('SearchSpecialite'); 
            Route::match(array('GET', 'POST'),'/sponsor/search',[SponsorController::class,'SearchSponsor'])->name('SearchSponsor'); 
            Route::match(array('GET', 'POST'),'/service/search',[ServiceController::class,'SearchService'])->name('SearchService'); 
            Route::match(array('GET', 'POST'),'/ville/search',[GouvVilleAdminController::class,'SearchVille'])->name('SearchVille'); 
            Route::match(array('GET', 'POST'),'/notification/search',[NotificationAdminController::class,'SearchNotification'])->name('SearchNotification'); 
            Route::match(array('GET', 'POST'),'/offers/search',[OfferController::class,'SearchOffer'])->name('SearchOffer'); 
            Route::match(array('GET', 'POST'),'/publicite/search',[PubliciteAdminController::class,'SearchPublicite'])->name('SearchPublicite'); 
            Route::get('/secteur',[SecteurProfessionSpecial::class,'SecteurIndex'])->name('SecteurIndex'); 
            Route::put('/secteur/{id}/update',[SecteurProfessionSpecial::class,'SecteurUpdate'])->name('SecteurUpdate'); 
            Route::get('/secteur/{id}/delete',[SecteurProfessionSpecial::class,'SecteurDelete'])->name('SecteurDelete');
            Route::get('/secteur/{id}/profession',[SecteurProfessionSpecial::class,'ProfessionIndex'])->name('ProfessionIndex'); 
            Route::Post('/secteur/store',[SecteurProfessionSpecial::class,'SecteurStore'])->name('SecteurStore'); 
            Route::get('/profession/{id}/show',[SecteurProfessionSpecial::class,'ProfessionShow'])->name('ProfessionShow'); 
            Route::get('/profession/{id}/edit',[SecteurProfessionSpecial::class,'ProfessionEdit'])->name('ProfessionEdit'); 
            Route::put('/profession/{id}/update',[SecteurProfessionSpecial::class,'ProfessionUpdate'])->name('ProfessionUpdate'); 
            Route::Post('/profession/{id}/store',[SecteurProfessionSpecial::class,'ProfessionStore'])->name('ProfessionStore'); 
            Route::get('/profession/{id}/specialite',[SecteurProfessionSpecial::class,'SpecialiteIndex'])->name('SpecialiteIndex'); 
            Route::put('/specialite/{id}/update',[SecteurProfessionSpecial::class,'SpecialiteUpdate'])->name('SpecialiteUpdate'); 
            Route::Post('/specialite/{id}/store',[SecteurProfessionSpecial::class,'SpecialiteStore'])->name('SpecialiteStore'); 
            Route::get('/sponsor',[SponsorController::class,'index'])->name('sponsorIndex'); 
            Route::post('/sponsor/store',[SponsorController::class,'store'])->name('SponsorStore'); 
            Route::put('/sponsor/{id}/update',[SponsorController::class,'update'])->name('SponsorEdit'); 
            Route::get('/sponsor/{id}/delete',[SponsorController::class,'destroy'])->name('SponsorDelete'); 
            Route::get('/service',[ServiceController::class,'index'])->name('serviceIndex'); 
            Route::post('/service/store',[ServiceController::class,'store'])->name('ServiceStore'); 
            Route::put('/service/{id}/update',[ServiceController::class,'update'])->name('ServiceEdit'); 
            Route::get('/service/{id}/delete',[ServiceController::class,'destroy'])->name('ServiceDelete'); 

        });
        });
