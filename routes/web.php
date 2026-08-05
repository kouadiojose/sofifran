<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;


/**ROUTE FRONTEND */
Route::get('/', [
    PageController::class,
    'index'
])->name('index');

Route::get('/recueil-conte', [
    PageController::class,
    'compteEmbed1'
])->name('compteEmbed1');

Route::get('/qui-sommes-nous', [
    PageController::class,
    'about'
])->name('about');

Route::get('/equipes', [
    PageController::class,
    'team'
])->name('team');

Route::get('/projets', [
    PageController::class,
    'projet'
])->name('projets');

Route::get('/projets/termines', [
    PageController::class,
    'projetTermines'
])->name('projets-termines');

Route::get('/galerie/photos', [
    PageController::class,
    'GaleriePhoto'
])->name('galerie-photo');

Route::get('/galerie/photos/{get}', [
    PageController::class,
    'GaleriePhotoGet'
])->name('galerie-photo-get');


Route::get('/galerie/videos', [
    PageController::class,
    'GalerieVideo'
])->name('galerie-video');

Route::get('/blog/{slug}', [
    PageController::class,
    'DetailBlog'
])->name('detail-blog');

Route::get('/blog', [
    PageController::class,
    'blog'
])->name('blog');

Route::get('/publication/infolettre', [
    PageController::class,
    'infolettre'
])->name('infolettre');

Route::get('/publication/carrers', [
    PageController::class,
    'carrers'
])->name('carrers');


Route::get('/atelier', [
    PageController::class,
    'atelier'
])->name('atelier');

Route::get('/atelier/{slug}', [
    PageController::class,
    'Detailatelier'
])->name('detail-atelier');


Route::get('/engagez-vous', [
    PageController::class,
    'engagez'
])->name('engagez-vous');

Route::get('/activites', [
    PageController::class,
    'main_activites'
])->name('activites');

Route::get('/publication/rapports/rapport-annuel', [
    PageController::class,
    'rapport_annuel'
])->name('rapport_annuel');

Route::get('/publication/rapports/rapport-projet', [
    PageController::class,
    'rapport_projet'
])->name('rapport_projet');


Route::get('/publication/communique', [
    PageController::class,
    'communique'
])->name('communique');

Route::get('/publication/article-de-presse', [
    PageController::class,
    'article_presse'
])->name('article_presse');

Route::get('/activites/{slug}', [
    PageController::class,
    'activites'
])->name('sous-activites');

Route::get('/activites/{slug_cat}/{slug}', [
    PageController::class,
    'SingleActivite'
])->name('detail-activites');

Route::get('/projets/{slug}', [
    PageController::class,
    'projetDetail'
])->name('detail-projets');

Route::get('/contact', [
    PageController::class,
    'contact'
])->name('contact');

Route::post('/contact/sendmail', [
    PageController::class,
    'contactSendMail'
])->name('contact-send-mail');


Route::get('/partenaires', [
    PageController::class,
    'partenaire'
])->name('partenaires');


Route::get('/publication', [
    PageController::class,
    'publication'
])->name('publication');

Route::get('/temoignages', [
    PageController::class,
    'temoignage'
])->name('temoignage');

Route::get('/lang/{locale}', [
    LocaleController::class,
    'lang'
])->name('lang');

Route::get('/captcha', [PageController::class, 'generate'])->name('captcha.generate');

/**END ROUTE FRONTEND */




/** ROUTE ADMIN */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/auth_route.php';


/**END ROUTE ADMIN */
