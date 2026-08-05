<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin-sofifran')->group(function () {

    /* ---------- Routes publiques (connexion) ---------- */

    Route::middleware('guest:admin')->group(function () {

        Route::get('/login', [PageController::class, 'login'])->name('admin-login');

        Route::post('/login-verif', [AdminLoginController::class, 'login'])->name('login-submit');

        Route::get('/forgot', [PageController::class, 'forgot'])->name('admin-forgot');

        Route::get('/renew', function () {
            return view('admin.renew-password');
        })->name('admin-renew');
    });

    /* ---------- Routes protégées (admin connecté) ---------- */

    Route::middleware('auth:admin')->group(function () {

        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin-logout');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

        Route::get('/nos-contacts', [AdminController::class, 'Noscontacts'])->name('admin-list-contacts');

        /*** Equipe ***/
        Route::get('/team', [AdminController::class, 'team'])->name('admin-equipe');
        Route::get('/team/create', [AdminController::class, 'teamCreate'])->name('admin-equipe-create');
        Route::post('/team/create/valid', [AdminController::class, 'teamCreateValid'])->name('admin-equipe-create-valid');
        Route::get('/team/edit/{id}', [AdminController::class, 'teamEdit'])->name('admin-equipe-edit');
        Route::post('/team/edit/valid', [AdminController::class, 'teamEditValid'])->name('admin-equipe-edit-valid');
        Route::post('/team/del/valid', [AdminController::class, 'teamDel'])->name('admin-equipe-delete');

        /*** Projets ***/
        Route::get('/projets', [AdminController::class, 'projet'])->name('admin-projet');
        Route::get('/projets/create', [AdminController::class, 'CreateProjet'])->name('admin-projet-create');
        Route::post('/projets/valid', [AdminController::class, 'ValidProjet'])->name('admin-projet-valid');
        Route::get('/projets/edit/{id}', [AdminController::class, 'EditProjet'])->name('admin-projet-edit');
        Route::get('/projets/view/{id}', [AdminController::class, 'ViewProjet'])->name('admin-projet-view');
        Route::post('/projets/edit/valid', [AdminController::class, 'ValidEditProjet'])->name('admin-projet-edit-valid');
        Route::post('/projets/delete', [AdminController::class, 'DelProjet'])->name('admin-projet-delete');
        Route::post('/projets/partenaire/delete', [AdminController::class, 'DelProjetPartenaire'])->name('del-image');
        Route::post('/projets/ended', [AdminController::class, 'EndedProjet'])->name('admin-projet-ended');

        /*** Inscriptions ***/
        Route::get('/inscriptions', [AdminController::class, 'inscription'])->name('admin-inscriptions');

        /*** Temoignages ***/
        Route::get('/temoignages', [AdminController::class, 'temoignage'])->name('admin-temoignage');
        Route::get('/temoignages/create', [AdminController::class, 'CreateTemoignage'])->name('admin-temoignage-create');
        Route::post('/temoignages/valid', [AdminController::class, 'ValidTemoignage'])->name('admin-temoignage-valid');
        Route::get('/temoignages/edit/{id}', [AdminController::class, 'EditTemoignage'])->name('admin-temoignage-edit');
        Route::post('/temoignages/edit/valid', [AdminController::class, 'EditValidTemoignage'])->name('admin-temoignage-edit-valid');
        Route::post('/temoignages/delete', [AdminController::class, 'DelTemoignage'])->name('admin-temoignage-delete');

        /*** Ateliers ***/
        Route::post('/ateliers/header-atelier', [AdminController::class, 'EdtiteAtelierHeader'])->name('admin-edit-headerevent');
        Route::get('/ateliers', [AdminController::class, 'atelier'])->name('admin-atelier');
        Route::get('/ateliers/create', [AdminController::class, 'CreateAtelier'])->name('admin-atelier-create');
        Route::get('/ateliers/list', [AdminController::class, 'ListAtelier'])->name('admin-atelier-list');
        Route::post('/ateliers/valid', [AdminController::class, 'ValidAtelier'])->name('admin-atelier-valid');
        Route::post('/ateliers/delete', [AdminController::class, 'DelAtelier'])->name('admin-atelier-delete');
        Route::get('/ateliers/edit/{id}', [AdminController::class, 'EditAtelier'])->name('admin-atelier-edit');
        Route::post('/ateliers/edit/valid', [AdminController::class, 'EditAtelierValid'])->name('admin-atelier-edit-valid');

        /*** Partenaires ***/
        Route::get('/partenaires', [AdminController::class, 'partenaire'])->name('admin-partenaire');
        Route::get('/partenaires/create', [AdminController::class, 'CreatePartenaire'])->name('admin-partenaire-create');
        Route::post('/partenaires/valid', [AdminController::class, 'ValidPartenaire'])->name('admin-partenaire-valid');
        Route::get('/partenaires/edit/{id}', [AdminController::class, 'EditPartenaire'])->name('admin-partenaire-edit');
        Route::post('/partenaires/edit/valid', [AdminController::class, 'ValidEditPartenaire'])->name('admin-partenaire-edit-valid');
        Route::post('/partenaires/delete', [AdminController::class, 'DelPartenaire'])->name('admin-partenaire-delete');
        Route::post('/partenaires/reorder', [AdminController::class, 'reorder'])->name('partners.reorder');

        /*** Infolettre ***/
        Route::get('/infolettre', [AdminController::class, 'infolettre'])->name('admin-infolettre');
        Route::get('/infolettre/compose', [AdminController::class, 'Mail'])->name('admin-infolettre-create');
        Route::post('/infolettre/compose/valide', [AdminController::class, 'ComposeMail'])->name('admin-infolettre-create-valide');
        Route::post('/infolettre/delete', [AdminController::class, 'DelInfolettre'])->name('admin-infolettre-delete');

        /*** Banieres & Slides ***/
        Route::get('/rubriques/banieres', [AdminController::class, 'banieres'])->name('admin-banieres');
        Route::get('/rubriques/banieres/create', [AdminController::class, 'banieresCreate'])->name('admin-banieres-create');
        Route::post('/rubriques/banieres/create/valid', [AdminController::class, 'banieresCreateValid'])->name('admin-banieres-create-valid');
        Route::get('/rubriques/banieres/slide/{id}', [AdminController::class, 'EditSlide'])->name('admin-slide-edit');
        Route::get('/rubriques/banieres/create/slide', [AdminController::class, 'CreateSlide'])->name('admin-slide-create');
        Route::post('/rubriques/banieres/slide/create/valide', [AdminController::class, 'CreateValideSlide'])->name('admin-slide-create-valide');
        Route::post('/rubriques/banieres/slide/valide', [AdminController::class, 'EditValideSlide'])->name('admin-slide-edit-valide');
        Route::get('/rubriques/banieres/page/{id}', [AdminController::class, 'EditBaniere'])->name('admin-banieres-edit');
        Route::post('/rubriques/banieres/page/valide', [AdminController::class, 'EditValideBaniere'])->name('admin-banieres-edit-valide');
        Route::post('/rubriques/slide/delete', [AdminController::class, 'DelSlide'])->name('admin-slide-delete');
        Route::post('/rubriques/baniere/delete', [AdminController::class, 'DelBaniere'])->name('admin-baniere-delete');

        /*** General ***/
        Route::get('/general', [AdminController::class, 'general'])->name('admin-general');
        Route::post('/general/valide', [AdminController::class, 'GeneralValide'])->name('admin-general-valide');

        /*** Blog / Actualites ***/
        Route::post('/ateliers/header-blog', [AdminController::class, 'EdtiteBlogHeader'])->name('admin-edit-headerblog');
        Route::get('/blog-actualite', [AdminController::class, 'blog'])->name('admin-blog');
        Route::get('/blog-actualite/create', [AdminController::class, 'CreateBlog'])->name('admin-blog-create');
        Route::get('/blog-actualite/edit/{id}', [AdminController::class, 'EditBlog'])->name('admin-blog-edit');
        Route::post('/blog-actualite/edit/valid', [AdminController::class, 'EditValidBlog'])->name('admin-blog-edit-valid');
        Route::post('/blog-actualite/valid', [AdminController::class, 'ValidBlog'])->name('admin-blog-valid');
        Route::post('/blog-actualite/delete', [AdminController::class, 'DelBlog'])->name('admin-blog-delete');

        /*** A propos de nous ***/
        Route::get('/rubriques/apropos', [AdminController::class, 'apropos'])->name('admin-apropos');
        Route::post('/rubriques/apropos/edit', [AdminController::class, 'EditApropos'])->name('admin-apropos-edit');

        /*** Galerie ***/
        Route::get('/galerie', [AdminController::class, 'galerie'])->name('admin-galerie');
        Route::post('/galerie/header-activite', [AdminController::class, 'EdtiteActiviteHeader'])->name('admin-edit-headeractivite');
        Route::get('/galerie/create', [AdminController::class, 'CreateGalerie'])->name('admin-galerie-create');
        Route::get('/galerie/edit/{id}', [AdminController::class, 'EditGalerie'])->name('admin-galerie-edit');
        Route::post('/galerie/edit/valid', [AdminController::class, 'EditValidGalerie'])->name('admin-galerie-edit-valid');
        Route::post('/galerie/valid', [AdminController::class, 'ValidGalerie'])->name('admin-galerie-valid');
        Route::post('/galerie/delete', [AdminController::class, 'DelGalerie'])->name('admin-galerie-delete');
        Route::post('/sous-galerie/delete', [AdminController::class, 'DelSousGalerie'])->name('admin-sous-galerie-delete');
        Route::get('/galerie/videos', [AdminController::class, 'GalerieVideo'])->name('admin-galerie-video');
        Route::post('/galerie/videos/create', [AdminController::class, 'GalerieVideoCreate'])->name('admin-galerie-video-create');
        Route::post('/galerie/videos/edit', [AdminController::class, 'GalerieVideoEdit'])->name('admin-galerie-video-edit');
        Route::post('/galerie/videos/del', [AdminController::class, 'GalerieVideoDel'])->name('admin-galerie-video-del');

        /*** Popup ***/
        Route::get('/popups', [AdminController::class, 'popups'])->name('admin-popups');
        Route::get('/popups/create', [AdminController::class, 'popupsCreate'])->name('admin-popups-create');
        Route::post('/popups/create/valide', [AdminController::class, 'popupsCreateValide'])->name('admin-popups-create-valide');
        Route::get('/popups/edit/{id}', [AdminController::class, 'popupsEdit'])->name('admin-popups-edit');
        Route::post('/popups/edit/valide', [AdminController::class, 'popupsEditValide'])->name('admin-popups-edit-valide');
        Route::post('/popups/del/valide', [AdminController::class, 'popupsDelValide'])->name('admin-popup-del-valid');

        /*** Activite ***/
        Route::get('/activites', [AdminController::class, 'activites'])->name('admin-activite');
        Route::get('/activites/create', [AdminController::class, 'CreateActivite'])->name('admin-activite-create');
        Route::get('/activites/edit/{id}', [AdminController::class, 'EditActivite'])->name('admin-activite-edit');
        Route::post('/activites/edit/valid', [AdminController::class, 'EditValidActivite'])->name('admin-activite-edit-valid');
        Route::post('/activites/valid', [AdminController::class, 'ValidActivite'])->name('admin-activite-valid');
        Route::post('/activites/delete', [AdminController::class, 'DelActivite'])->name('admin-activite-delete');
        Route::post('/sous-activites/delete', [AdminController::class, 'DelSousActivite'])->name('admin-sous-activite-delete');

        /*** Categories d'activites ***/
        Route::get('/categories', [AdminController::class, 'categories'])->name('admin-categorie');
        Route::get('/categories/create', [AdminController::class, 'categorieCreate'])->name('admin-categorie-create');
        Route::post('/categories/create/valid', [AdminController::class, 'categorieCreateValid'])->name('admin-categorie-create-valid');
        Route::get('/categories/edit/{id}', [AdminController::class, 'categorieEdit'])->name('admin-categorie-edit');
        Route::post('/categories/edit/valid', [AdminController::class, 'categorieEditValid'])->name('admin-categorie-edit-valid');
        Route::post('/categories/delete', [AdminController::class, 'categorieDel'])->name('admin-categorie-delete');

        /*** Sondage ***/
        Route::get('/sondage', [AdminController::class, 'sondage'])->name('admin-sondage');
        Route::post('/sondage/valide', [AdminController::class, 'SondageValide'])->name('admin-sondage-valide');

        /*** Users, Roles & Permissions ***/
        Route::get('/users', [AdminController::class, 'users'])->name('admin-user');
        Route::get('/users/roles', [AdminController::class, 'roles'])->name('admin-role');
        Route::post('/users/roles/valid', [AdminController::class, 'ValidRole'])->name('admin-valid-role');
        Route::get('/users/role/edit/{id}', [AdminController::class, 'EditRole'])->name('admin-edit-role');
        Route::post('/users/role/edit/valid', [AdminController::class, 'EditValidRole'])->name('admin-edit-valid-role');
        Route::post('/users/role/delete/valide', [AdminController::class, 'DelRoleUser'])->name('admin-user-del-role-valide');
        Route::get('/users/edit/{id}', [AdminController::class, 'EditUser'])->name('admin-edit-user');
        Route::post('/users/edit/valide', [AdminController::class, 'UserEditValide'])->name('admin-user-edit-valide');
        Route::post('/users/delete/valide', [AdminController::class, 'DelUser'])->name('admin-user-del-valide');
        Route::post('/users/valide', [AdminController::class, 'UserValide'])->name('admin-user-valide');
        Route::get('/users/reset-password', [AdminController::class, 'ResetPassword'])->name('admin-user-reset-password');
        Route::post('/users/change', [AdminController::class, 'ChangePassword'])->name('admin-change-valide');
        Route::get('/users/roles/permissions', [AdminController::class, 'permissions'])->name('admin-permission');
        Route::get('/users/roles/permissions/{id}', [AdminController::class, 'permission_single'])->name('admin-permission-single');
        Route::post('/users/roles/permissions-valid', [AdminController::class, 'ValidPermissions'])->name('admin-permission-valid');
        Route::get('/permission_per_role/{id}', [AdminController::class, 'permission_per_role'])->name('admin-permission-per-role');

        /*** Blocs ***/
        Route::get('/bloc', [AdminController::class, 'blocs'])->name('admin-bloc');
        Route::get('/bloc/edit/{id}', [AdminController::class, 'Editbloc'])->name('admin-bloc-edit');
        Route::post('/bloc/edit/valide', [AdminController::class, 'EditblocValide'])->name('admin-bloc-edit-valide');

        /*** Engagez vous ***/
        Route::get('/engagez_vous', [AdminController::class, 'EngagezVous'])->name('admin-engagez-vous');

        /*** Publication ***/
        Route::get('/publication', [AdminController::class, 'publication'])->name('admin-publication');
        Route::get('/publication/create', [AdminController::class, 'publicationCreate'])->name('admin-publication-create');
        Route::post('/publication/create/valid', [AdminController::class, 'publicationCreateValid'])->name('admin-publication-create-valide');
        Route::get('/publication/edit/{id}', [AdminController::class, 'publicationEdit'])->name('admin-publication-edit');
        Route::post('/publication/edit/valid', [AdminController::class, 'publicationEditValid'])->name('admin-publication-edit-valide');
        Route::post('/publication/delete', [AdminController::class, 'DelPub'])->name('admin-publication-del-valide');
    });
});
