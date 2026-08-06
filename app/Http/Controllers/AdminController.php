<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Admin;
use App\Models\Apropo;
use App\Models\Atelier;
use App\Models\Baniere;
use App\Models\Blog;
use App\Models\Categorie_activitie;
use App\Models\Contact;
use App\Models\Galerie;
use App\Models\Galerie_photo;
use App\Models\Galerie_video;
use App\Models\Infolettre;
use App\Models\Partenaire;
use App\Models\Partenaire_projet;
use App\Models\Permission;
use App\Models\Popup;
use App\Models\Projet;
use App\Models\Publication;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Sous_activite;
use App\Models\Team;
use App\Models\Temoignage;
use App\Models\User;
use App\Models\Visite;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class AdminController extends Controller
{
	private function uploadImage(UploadedFile $file, string $relativePath, ?int $width, ?int $height): string
	{
	    $image = Image::read($file);

	    // Seules les extensions d'images connues sont conservees : tout autre
	    // fichier est re-encode en .jpg pour empecher le depot d'un script dans /public.
	    $ext = strtolower($file->getClientOriginalExtension());
	    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
	        $ext = 'jpg';
	    }
	    $name  = time() . '_' . uniqid() . '.' . $ext;

	    $destinationPath = public_path(rtrim($relativePath, '/') . '/');
	    if (!is_dir($destinationPath)) {
	        @mkdir($destinationPath, 0775, true);
	    }

	    // Resize seulement si width & height fournis (>0)
	    if (!empty($width) && !empty($height)) {
	        $image->resize($width, $height);
	    }

	    $image->save($destinationPath . $name);
	    return $name;
	}


	/**
	 * Upload d'un document (PDF, Word...) sans passer par Intervention Image
	 * (qui ne sait lire que des images et plantait sur les PDF).
	 * Retourne le chemin public complet du fichier.
	 */
	private function uploadDocument(UploadedFile $file, string $relativePath): string
	{
	    $ext = strtolower($file->getClientOriginalExtension());
	    if (!in_array($ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) {
	        $ext = 'pdf';
	    }
	    $name = time() . '_' . uniqid() . '.' . $ext;

	    $relativePath = '/' . trim($relativePath, '/') . '/';
	    $destinationPath = public_path($relativePath);
	    if (!is_dir($destinationPath)) {
	        @mkdir($destinationPath, 0775, true);
	    }

	    $file->move($destinationPath, $name);

	    return $relativePath . $name;
	}

    private function uniqueSlug(string $base, string $model, string $column = 'slug', ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($base);
        $slug     = $baseSlug;
        $i        = 1;

        while ($model::where($column, $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        return $slug;
    }

    /**
     * Serie "visites par jour" des 30 derniers jours pour le graphique
     * (labels jj/mm + totaux, jours sans visite a zero).
     */
    private function visitesChartData(): array
    {
        $labels = [];
        $data   = [];

        try {
            $parJour = Visite::where('created_at', '>=', now()->subDays(29)->startOfDay())
                ->selectRaw('DATE(created_at) as jour, COUNT(*) as total')
                ->groupBy('jour')
                ->pluck('total', 'jour');
        } catch (\Throwable $e) {
            $parJour = collect(); // table visites absente
        }

        for ($i = 29; $i >= 0; $i--) {
            $d        = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d/m');
            $data[]   = (int) ($parJour[$d] ?? 0);
        }

        return [$labels, $data];
    }

    public function dashboard()
    {
        $countPorjetCours = Projet::where('ended', 'no')->count();
        $countPorjetEnd   = Projet::where('ended', 'yes')->count();
        $countActivite    = Activite::count();
        $countPub         = Publication::count();

        $countContacts    = Contact::count();
        $countInfolettre  = Infolettre::count();
        $countTemoignages = Temoignage::count();
        $countEvenements  = Atelier::where('start', '>=', now()->format('Y-m-d'))->count();

        // Statistiques de visites (0 tant que la migration n'est pas lancee).
        $visitesAujourdhui = 0;
        $visites30j        = 0;
        try {
            $visitesAujourdhui = Visite::whereDate('created_at', now()->format('Y-m-d'))->count();
            $visites30j        = Visite::where('created_at', '>=', now()->subDays(29)->startOfDay())->count();
        } catch (\Throwable $e) {
            // table visites absente
        }

        [$chartLabels, $chartData] = $this->visitesChartData();

        return view('admin.dashboard')
            ->with('visitesAujourdhui', $visitesAujourdhui)
            ->with('visites30j', $visites30j)
            ->with('chartLabels', $chartLabels)
            ->with('chartData', $chartData)
            ->with('countPorjetEnd', $countPorjetEnd)
            ->with('countPorjetCours', $countPorjetCours)
            ->with('countActivite', $countActivite)
            ->with('countPub', $countPub)
            ->with('countContacts', $countContacts)
            ->with('countInfolettre', $countInfolettre)
            ->with('countTemoignages', $countTemoignages)
            ->with('countEvenements', $countEvenements);
    }

    /** --------------------------------
     *           PROJETS
     * --------------------------------*/
    public function projet()
    {
        $post = Projet::orderBy('id', 'DESC')->get();
        return view('admin.projets.list')->with('post', $post);
    }

    public function ViewProjet($id)
    {
        $post = Projet::findOrFail($id);

        return view('admin.projets.view')
            ->with('post', $post);
    }

    public function CreateProjet()
    {
        return view('admin.projets.create');
    }

    public function ValidProjet(Request $request)
    {
        if (!$request->hasFile('img_project')) {
            $request->session()->flash('msg_error', 'Vous devez selectionner une image!');
        } elseif (!$request->filled('titre_fr')) {
            $request->session()->flash('msg_error', 'Vous devez saisir le titre en francais!');
        } elseif (!$request->filled('titre_en')) {
            $request->session()->flash('msg_error', 'Vous devez saisir le titre en anglais!');
        } elseif (!$request->filled('description_fr')) {
            $request->session()->flash('msg_error', 'Vous devez saisir la description en francais!');
        } elseif (!$request->filled('description_en')) {
            $request->session()->flash('msg_error', 'Vous devez saisir la description en anglais!');
        } else {

            $name = $this->uploadImage($request->file('img_project'), '/frontend/assets/images/projects/', 850, 550);
            $slug = $this->uniqueSlug($request->titre_fr, Projet::class, 'slug');

            $projet = Projet::create([
                'titre_fr'       => $request->titre_fr,
                'titre_en'       => $request->titre_en,
                'objectif'       => $request->objectif,
                'image'          => $name,
                'description_fr' => $request->description_fr,
                'description_en' => $request->description_en,
                'slug'           => $slug,
            ]);

            // Partenaires (images multiples)
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $value) {
                    $partnerName = $this->uploadImage($value, '/frontend/assets/images/projects/partenaires/', 450, 300);

                    Partenaire_projet::create([
                        'image'     => $partnerName,
                        'projet_id' => $projet->id,
                    ]);
                }
            }

            $request->session()->flash('msg', 'Vous avez ajouté un nouveau projet avec succès!');
        }

        return back();
    }

    public function EditProjet($id)
    {
        $projet = Projet::where('id', $id)->first();
        return view('admin.projets.edit')->with('projet', $projet);
    }

    public function ValidEditProjet(Request $request)
    {
        $name = ($request->hasFile('img_project'))
            ? $this->uploadImage($request->file('img_project'), '/frontend/assets/images/projects/', 450, 300)
            : $request->img_up;

        Projet::where('id', $request->id)->update([
            'titre_fr'       => $request->titre_fr,
            'titre_en'       => $request->titre_en,
            'objectif'       => $request->objectif,
            'image'          => $name,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'slug' => $this->uniqueSlug($request->titre_fr, Projet::class, 'slug', (int) $request->id),
        ]);

        // Nouvelles images partenaires
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $value) {
                $partnerName = $this->uploadImage($value, '/frontend/assets/images/projects/partenaires/', 450, 300);

                Partenaire_projet::create([
                    'image'     => $partnerName,
                    'projet_id' => $request->id,
                ]);
            }
        }

        $request->session()->flash('msg', 'Vous avez modifié le projet avec succès!');
        return back();
    }

    public function DelProjet(Request $request)
    {
        Projet::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé le projet avec succès!');
        return back();
    }

    public function DelProjetPartenaire(Request $request)
    {
        Partenaire_projet::findOrFail($request->id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé cette image avec succès!');
        return back();
    }

    public function EndedProjet(Request $request)
    {
        Projet::where('id', $request->ended_id)->update([
            'ended' => 'yes',
        ]);

        $request->session()->flash('msg', 'Vous avez Terminé le projet avec succès!');
        return back();
    }

    /** --------------------------------
     *          TEMOIGNAGES
     * --------------------------------*/
    public function temoignage()
    {
        $temoignage = Temoignage::orderBy('id', 'DESC')->get();
        return view('admin.temoignages.list')->with('temoignage', $temoignage);
    }

    public function CreateTemoignage()
    {
        $galeries = Galerie::orderBy('id', 'DESC')->get();
        return view('admin.temoignages.create')->with('galeries', $galeries);
    }

    public function ValidTemoignage(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string'],
            'photo' => ['required', 'image', 'max:8192'],
        ]);

        $name = $this->uploadImage($request->file('photo'), '/frontend/assets/images/temoignages/', 90, 90);

        Temoignage::create([
            'name'       => $request->name,
            'content_fr' => $request->contenu_fr,
            'content_en' => $request->contenu_en,
            'image'      => $name,
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté un temoignage avec succès!');
        return back();
    }

    public function EditTemoignage($id)
    {
        $temoignage = Temoignage::where('id', $id)->first();
        $galeries   = Galerie::orderBy('id', 'DESC')->get();

        return view('admin.temoignages.edit')
            ->with('galeries', $galeries)
            ->with('temoignage', $temoignage);
    }

    public function EditValidTemoignage(Request $request)
    {
        $name = ($request->hasFile('photo'))
            ? $this->uploadImage($request->file('photo'), '/frontend/assets/images/temoignages/', 90, 90)
            : $request->photo_up;

        Temoignage::where('id', $request->temoignage_id)->update([
            'name'       => $request->name,
            'content_fr' => $request->contenu_fr,
            'content_en' => $request->contenu_en,
            'image'      => $name,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié le temoignage avec succès!');
        return back();
    }

        /** FIN TEMOIGNAGES **/
    public function DelTemoignage(Request $request)
    {
        Temoignage::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé le Temoignage avec succès!');
        return back();
    }

    /** PARTENAIRES **/
    public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            DB::table('partenaires')->where('id', $item['id'])
                   ->update(['orders' => $item['position']]);
        }

        return response()->json(['success' => true]);
    }

    public function partenaire()
    {
        $partenaire = DB::table('partenaires')->orderBy('orders', 'asc')->get();
        $types = DB::table('partenaires')->select('type')->distinct()->pluck('type');

        // On regroupe les partenaires par type
        $partnersByType = [];
        foreach ($types as $type) {
            $partnersByType[$type] = DB::table('partenaires')->where('type', $type)
                ->orderBy('orders', 'asc')
                ->get();
        }


        //dd($partenaire);
        return view('admin.partenaires.list')
        ->with('partnersByType', $partnersByType)
        ->with('partenaire', $partenaire);
    }

    public function CreatePartenaire()
    {
        return view('admin.partenaires.create');
    }

    public function ValidPartenaire(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string'],
            'image' => ['required', 'image', 'max:8192'],
        ]);

        $name = $this->uploadImage($request->file('image'), '/frontend/assets/images/partenaires/', 450, 300);

        $ordre = $request->filled('orders')
            ? (int) $request->orders
            : ((int) DB::table('partenaires')->max('orders')) + 1;

        DB::table('partenaires')->insert([
            'name'  => $request->name,
            'image' => $name,
            'link'  => $request->link,
            'type'  => $request->type,
            'orders'  => $ordre,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté le partenaire avec succès!');
        return back();
    }

    public function EditPartenaire($id)
    {
        $partenaire = Partenaire::where('id', $id)->first();
        return view('admin.partenaires.edit')->with('partenaire', $partenaire);
    }

    public function ValidEditPartenaire(Request $request)
    {
        $name = ($request->hasFile('image'))
            ? $this->uploadImage($request->file('image'), '/frontend/assets/images/partenaires/', 450, 300)
            : $request->img_up;

        $partenaireActuel = DB::table('partenaires')->where('id', $request->id)->first();

        DB::table('partenaires')->where('id', $request->id)->update([
            'name'  => $request->name,
            'image' => $name,
            'link'  => $request->link,
            'type'  => $request->type,
            'orders'  => $request->filled('orders') ? (int) $request->orders : ($partenaireActuel->orders ?? 0),
            'updated_at'  => now(),
        ]);

        $request->session()->flash('msg', 'Vous avez modifié le partenaire avec succès!');
        return back();
    }

    public function DelPartenaire(Request $request)
    {
        DB::table('partenaires')->where('id', $request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé le partenaire avec succès!');
        return back();
    }
    /** FIN PARTENAIRES **/

    /** ATELIERS / EVENEMENTS (page unique : liste + calendrier) **/
    public function atelier()
    {
        $calendar = Atelier::orderByDesc('start')->get();

        return view('admin.ateliers.calendar')
            ->with('calendar', $calendar);
    }

    public function ListAtelier()
    {
        // L'ancienne page "liste" est fusionnee avec la page calendrier.
        return redirect()->route('admin-atelier');
    }

    public function CreateAtelier()
    {
        return view('admin.ateliers.create');
    }

    public function ValidAtelier(Request $request)
    {
        $request->validate([
            'title_fr' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'start'    => ['required', 'date'],
            'end'      => ['required', 'date', 'after_or_equal:start'],
            'img'      => ['nullable', 'image', 'max:8192'],
        ]);

        $name = ($request->hasFile('img'))
            ? $this->uploadImage($request->file('img'), '/frontend/assets/images/ateliers/', 850, 550)
            : null;

        $slug = $this->uniqueSlug($request->title_fr, Atelier::class, 'slug');

        Atelier::create([
            'title_fr'       => $request->title_fr,
            'title_en'       => $request->title_en,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'start'          => $request->start,
            'end'            => $request->end,
            'hour_start'     => $request->hour_start,
            'hour_end'       => $request->hour_end,
            'slug'           => $slug,
            'color'          => $request->color,
            'image'          => $name,
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté un évènement avec succès!');
        return back();
    }

    public function EditAtelier($id)
    {
        $atelier = Atelier::where('id', $id)->first();
        return view('admin.ateliers.edit')->with('atelier', $atelier);
    }

    public function EditAtelierValid(Request $request)
    {
        $request->validate([
            'title_fr' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'start'    => ['required', 'date'],
            'end'      => ['required', 'date', 'after_or_equal:start'],
            'img'      => ['nullable', 'image', 'max:8192'],
        ]);

        $name = ($request->hasFile('img'))
            ? $this->uploadImage($request->file('img'), '/frontend/assets/images/ateliers/', 850, 550)
            : ($request->img_up ?? null);

        Atelier::where('id', $request->atelier_id)->update([
            'title_fr'       => $request->title_fr,
            'title_en'       => $request->title_en,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'start'          => $request->start,
            'end'            => $request->end,
            'hour_start'     => $request->hour_start,
            'hour_end'       => $request->hour_end,
            'color'          => $request->color,
            'image'          => $name,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié un évènement avec succès!');
        return back();
    }

    public function DelAtelier(Request $request)
    {
        Atelier::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé cet atelier avec succès!');
        return back();
    }
    /** FIN ATELIERS **/

    /** INFOLETTRE **/
    public function infolettre()
    {
        $infolettre = Infolettre::all();
        return view('admin.infolettre.list')->with('infolettre', $infolettre);
    }

    public function Mail()
    {
        $infolettre = Infolettre::latest()->get();
        return view('admin.infolettre.compose')->with('infolettre', $infolettre);
    }

    public function ComposeMail(Request $request)
    {
        // Destinataires : selection groupee et/ou adresse individuelle ("A:").
        $emails = is_array($request->mailgroupe)
            ? $request->mailgroupe
            : explode(',', (string) $request->mailgroupe);

        if ($request->filled('to')) {
            $emails[] = $request->to;
        }

        $emails = array_values(array_filter(array_map('trim', $emails), function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }));

        if (empty($emails)) {
            $request->session()->flash('msg_error', 'Aucune adresse email valide sélectionnée!');
            return back();
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $ext  = $request->attachment->getClientOriginalExtension();
            $file = time() . '_' . uniqid() . '.' . $ext;
            $request->attachment->move(public_path('/frontend/assets/file_upload_compose/'), $file);
            $attachmentPath = public_path('/frontend/assets/file_upload_compose/') . $file;
        }

        Mail::send('admin.infolettre.html_send_content', [
            'sujet'    => $request->sujet,
            'contenu'  => $request->contenu,
        ], function ($message) use ($emails, $request, $attachmentPath) {
            $message->to('info@sofifran.org')
                    ->bcc($emails)
                    ->subject($request->sujet ?: 'Infolettre');

            if ($attachmentPath) {
                $message->attach($attachmentPath);
            }
        });

        $request->session()->flash('msg', 'Vous avez envoyé un email avec succès!');
        return back();
    }

    public function DelInfolettre(Request $request)
    {
        Infolettre::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé un email avec succès!');
        return back();
    }
    /** FIN INFOLETTRE **/

    /** BANIERES (une banniere par page du site) **/
    public function banieres()
    {
        $baniere = Baniere::orderBy('id')->get();

        // Pages du catalogue qui n'ont pas encore de banniere.
        $pagesManquantes = array_diff_key(
            Baniere::PAGE_LABELS,
            array_flip($baniere->pluck('page')->filter()->all())
        );

        return view('admin.rubriques.banniere')
            ->with('pagesManquantes', $pagesManquantes)
            ->with('baniere', $baniere);
    }

    public function EditBaniere($id)
    {
        $baniere = Baniere::findOrFail($id);
        return view('admin.rubriques.edit_baniere')->with('baniere', $baniere);
    }

    public function banieresCreate()
    {
        $banieres = Baniere::pluck('page')->filter()->all();

        $pagesManquantes = array_diff_key(Baniere::PAGE_LABELS, array_flip($banieres));

        return view('admin.rubriques.create_baniere')
            ->with('pagesManquantes', $pagesManquantes);
    }

    public function banieresCreateValid(Request $request)
    {
        $request->validate([
            'title_fr' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'page'     => ['required', 'in:' . implode(',', array_keys(Baniere::PAGE_LABELS))],
            'img'      => ['required', 'image', 'max:8192'],
        ]);

        if (Baniere::where('page', $request->page)->exists()) {
            $request->session()->flash('msg_error', 'Cette page a déjà une bannière : modifiez-la plutôt que d\'en créer une deuxième.');
            return back()->withInput();
        }

        $name = $this->uploadImage($request->file('img'), '/frontend/assets/images/resource/', 1920, 420);

        Baniere::create([
            'title_fr' => $request->title_fr,
            'title_en' => $request->title_en,
            'page'     => $request->page,
            'image'    => $name,
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté une banière!');
        return back();
    }

    public function EditValideBaniere(Request $request)
    {
        $request->validate([
            'title_fr' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'page'     => ['required', 'in:' . implode(',', array_keys(Baniere::PAGE_LABELS))],
            'new_img'  => ['nullable', 'image', 'max:8192'],
        ]);

        $baniere = Baniere::findOrFail($request->id);

        $name = ($request->hasFile('new_img'))
            ? $this->uploadImage($request->file('new_img'), '/frontend/assets/images/resource/', 1920, 420)
            : $baniere->image;

        $baniere->update([
            'title_fr' => $request->title_fr,
            'title_en' => $request->title_en,
            'page'     => $request->page,
            'image'    => $name,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié une banière!');
        return back();
    }

    public function DelBaniere(Request $request)
    {
        Baniere::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg_baniere', 'Vous avez supprimé une baniere avec succès!');
        return back();
    }
    /** FIN BANIERES **/

        /** SETTINGS **/
    public function general()
    {
        $setting = Setting::first();

        return view('admin.general.general')
            ->with('setting', $setting);
    }

    public function GeneralValide(Request $request)
    {
        $name = ($request->hasFile('new_img'))
            ? $this->uploadImage($request->file('new_img'), '/frontend/assets/images/', 0, 0) // pas de resize
            : $request->img_up;

        Setting::where('id', $request->id)->update([
            'phone1'   => $request->phone1,
            'phone2'   => $request->phone2,
            'adresse1' => $request->adresse1,
            'adresse2' => $request->adresse2,
            'email'    => $request->email,
            'facebook' => $request->facebook,
            'instagram'=> $request->instagram,
            'youtube'  => $request->youtube,
            'twitter'  => $request->twitter,
            'linkedln' => $request->linkedln,
            'logo'     => $name,
        ]);

        // Le header/footer du site utilisent ces valeurs en cache.
        \Illuminate\Support\Facades\Cache::forget('site_settings');

        $request->session()->flash('msg', 'Votre modification a été effectuée avec succès!');
        return back();
    }
    /** FIN SETTINGS **/

    /** BLOG/ACTUALITES **/
    public function blog()
    {
        $blog = Blog::latest()->get();

        return view('admin.blogs.list')
            ->with('blog', $blog);
    }

    public function CreateBlog()
    {
        return view('admin.blogs.create');
    }

    public function ValidBlog(Request $request)
    {
        $request->validate([
            'title_fr' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'image'    => ['required', 'image', 'max:8192'],
        ]);

        $name = $this->uploadImage($request->file('image'), '/frontend/assets/images/blog/', 850, 550);

        Blog::create([
            'title_fr'       => $request->title_fr,
            'title_en'       => $request->title_en,
            'image'          => $name,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'slug'           => $this->uniqueSlug($request->title_fr, Blog::class, 'slug'),
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté un nouveau blog avec succès!');
        return back();
    }

    public function EditBlog($id)
    {
        $blog = Blog::where('id', $id)->first();

        return view('admin.blogs.edit')
            ->with('blog', $blog);
    }

    public function EditvalidBlog(Request $request)
    {
        $name = ($request->hasFile('image'))
            ? $this->uploadImage($request->file('image'), '/frontend/assets/images/blog/', 850, 550)
            : $request->img_up;

        Blog::where('id', $request->id)->update([
            'title_fr'       => $request->title_fr,
            'title_en'       => $request->title_en,
            'image'          => $name,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'slug'           => $this->uniqueSlug($request->title_fr, Blog::class, 'slug', (int) $request->id),
        ]);

        $request->session()->flash('msg', 'Vous avez modifié un blog avec succès!');
        return back();
    }

    public function DelBlog(Request $request)
    {
        Blog::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé un blog avec succès!');
        return back();
    }
    /** FIN BLOG/ACTUALITES **/

    /** GALERIE (organisee en albums : 1 activite = 1 album) **/
    public function galerie()
    {
        $albums = Activite::withCount('photos')
            ->orderBy('id', 'DESC')
            ->get();

        $totalPhotos = Galerie_photo::count();

        return view('admin.galeries.list')
            ->with('totalPhotos', $totalPhotos)
            ->with('albums', $albums);
    }

    /**
     * Convertit une valeur php.ini du type "8M" / "2G" en octets.
     */
    private function iniToBytes(string $value): int
    {
        $value = trim($value);
        $unit  = strtolower(substr($value, -1));
        $num   = (float) $value;

        return (int) match ($unit) {
            'g' => $num * 1024 * 1024 * 1024,
            'm' => $num * 1024 * 1024,
            'k' => $num * 1024,
            default => $num,
        };
    }

    public function galerieAlbum($id)
    {
        $album  = Activite::withCount('photos')->findOrFail($id);
        $photos = Galerie_photo::where('galerie_id', $id)->orderBy('id', 'DESC')->get();

        // Limites d'upload effectives du serveur, affichees et verifiees
        // cote client pour eviter un rejet PHP (PostTooLargeException).
        $maxPostBytes = $this->iniToBytes(ini_get('post_max_size'));
        $maxFileBytes = $this->iniToBytes(ini_get('upload_max_filesize'));

        return view('admin.galeries.album')
            ->with('album', $album)
            ->with('photos', $photos)
            ->with('maxPostBytes', $maxPostBytes)
            ->with('maxFileBytes', $maxFileBytes);
    }

    public function CreateGalerie()
    {
        $activites = Activite::latest()->get();

        return view('admin.galeries.create')
            ->with('activites', $activites);
    }

    public function ValidGalerie(Request $request)
    {
        $request->validate([
            'activite'  => ['required', 'integer', 'exists:activites,id'],
            'photos'    => ['required', 'array'],
            'photos.*'  => ['image', 'max:8192'],
        ]);

        $count = 0;
        foreach ($request->file('photos') as $photo) {
            $name = $this->uploadImage($photo, '/frontend/assets/images/gallery/photos/', 850, 550);

            Galerie_photo::create([
                'image'      => $name,
                'galerie_id' => $request->activite,
            ]);
            $count++;
        }

        $request->session()->flash('msg', $count . ' photo(s) ajoutée(s) à l\'album avec succès!');
        return back();
    }

    public function EditGalerie($id)
    {
        $activites = Activite::latest()->get();
        $galerie   = Galerie_photo::findOrFail($id);

        return view('admin.galeries.edit')
            ->with('galerie', $galerie)
            ->with('activites', $activites);
    }

    public function EditvalidGalerie(Request $request)
    {
        // L'ancien code mettait a jour le modele "Galerie" (table galeries)
        // alors que la liste affiche des enregistrements de galerie_photos :
        // l'edition ne fonctionnait pas.
        $request->validate([
            'id'       => ['required', 'integer'],
            'activite' => ['required', 'integer'],
            'image'    => ['nullable', 'image', 'max:8192'],
        ]);

        $photo = Galerie_photo::findOrFail($request->id);

        $name = ($request->hasFile('image'))
            ? $this->uploadImage($request->file('image'), '/frontend/assets/images/gallery/photos/', 850, 550)
            : $photo->image;

        $photo->update([
            'image'      => $name,
            'galerie_id' => $request->activite,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié la photo avec succès!');
        return back();
    }

    public function DelGalerie(Request $request)
    {
        // L'ancien code supprimait dans la table "galeries" alors que la
        // liste affiche des photos (galerie_photos) : la suppression visait
        // le mauvais enregistrement.
        Galerie_photo::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé la photo avec succès!');
        return back();
    }

    public function DelSousGalerie(Request $request)
    {
        Sous_activite::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé une image avec succès!');
        return back();
    }

    public function GalerieVideo()
    {
        $videos = Galerie_video::latest()->get();

        return view('admin.galeries.video')
            ->with('videos', $videos);
    }

    /**
     * Extrait l'identifiant d'une video YouTube quel que soit le format
     * colle par l'admin : watch?v=ID, youtu.be/ID, embed/ID ou ID brut.
     */
    private function extractYoutubeId(string $url): string
    {
        $url = trim($url);

        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $m)) {
            return $m[1];
        }

        // Dernier segment de l'URL (comportement historique), sans querystring.
        $last = substr($url, strrpos($url, '/') + 1);
        return strtok($last, '?&') ?: $last;
    }

    public function GalerieVideoCreate(Request $request)
    {
        $request->validate([
            'titre_fr'    => ['required', 'string'],
            'link_video'  => ['required', 'string'],
            'image_video' => ['required', 'image', 'max:8192'],
        ]);

        $last_word = $this->extractYoutubeId($request->link_video);

        $name = $this->uploadImage($request->file('image_video'), '/frontend/assets/images/gallery/video/', 850, 550);

        Galerie_video::create([
            'image'          => $name,
            'titre_fr'       => $request->titre_fr,
            'titre_en'       => $request->titre_en,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'link_video'     => $last_word,
        ]);

        $request->session()->flash('msg', 'Vidéo ajoutée avec succès !');
        return back();
    }

    public function GalerieVideoEdit(Request $request)
    {
        $last_word = $this->extractYoutubeId($request->link_video);

        $name = ($request->hasFile('image_video'))
            ? $this->uploadImage($request->file('image_video'), '/frontend/assets/images/gallery/video/', 850, 550)
            : $request->img_up;

        Galerie_video::where('id', $request->id)->update([
            'image'          => $name,
            'titre_fr'       => $request->titre_fr,
            'titre_en'       => $request->titre_en,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'link_video'     => $last_word,
        ]);

        $request->session()->flash('msg', 'Vidéo modifiée avec succès !');
        return back();
    }

    public function GalerieVideoDel(Request $request)
    {
        Galerie_video::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg_error', 'Vidéo supprimée avec succès !');
        return back();
    }
    /** FIN GALERIE **/

    /** POPUP **/
    public function popups()
    {
        $popups = Popup::orderBy('id', 'DESC')->get();

        return view('admin.popups.index')
            ->with('popups', $popups);
    }

    /**
     * Cibles proposees pour le lien "contenu complet" d'un popup :
     * derniers articles de blog + pages cles du site.
     */
    private function popupLinkTargets(): array
    {
        $targets = [
            'Pages du site' => [
                route('infolettre')     => 'Infolettres (PDF)',
                route('publication')    => 'Toutes les publications',
                route('blog')           => 'Blogue - Actualités',
                route('projets')        => 'Projets en cours',
                route('activites')      => 'Activités',
                route('atelier')        => 'Évènements à venir',
                route('engagez-vous')   => 'Engagez-vous',
                route('contact')        => 'Contact',
            ],
        ];

        $blogs = Blog::latest()->take(10)->get();
        if ($blogs->isNotEmpty()) {
            $articles = [];
            foreach ($blogs as $b) {
                $articles[route('detail-blog', $b->slug)] = $b->title_fr;
            }
            $targets['Derniers articles du blogue'] = $articles;
        }

        return $targets;
    }

    public function popupsCreate()
    {
        return view('admin.popups.create')
            ->with('linkTargets', $this->popupLinkTargets());
    }

    public function popupsCreateValide(Request $request)
    {
        $request->validate([
            'titre' => ['required', 'string'],
            'start' => ['required', 'date'],
            'end'   => ['required', 'date', 'after_or_equal:start'],
            'link'  => ['nullable', 'string', 'max:500'],
            'img'   => ['nullable', 'image', 'max:8192'],
        ]);

        $name = $request->hasFile('img')
            ? $this->uploadImage($request->file('img'), '/frontend/assets/images/popups/', 0, 0) // pas de resize
            : null;

        Popup::create([
            'image'   => $name,
            'titre'   => $request->titre,
            'contenu' => $request->contenu,
            'start'   => $request->start,
            'end'     => $request->end,
            'link'    => $request->link,
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté un popup avec succès!');
        return back();
    }

    public function popupsEdit($id)
    {
        $popup = Popup::findOrFail($id);

        return view('admin.popups.edit')
            ->with('popup', $popup)
            ->with('linkTargets', $this->popupLinkTargets());
    }

    public function popupsEditValide(Request $request)
    {
        $request->validate([
            'titre' => ['required', 'string'],
            'start' => ['required', 'date'],
            'end'   => ['required', 'date', 'after_or_equal:start'],
            'link'  => ['nullable', 'string', 'max:500'],
            'img'   => ['nullable', 'image', 'max:8192'],
        ]);

        $popup = Popup::findOrFail($request->popup_id);

        $name = $request->hasFile('img')
            ? $this->uploadImage($request->file('img'), '/frontend/assets/images/popups/', 0, 0) // pas de resize
            : $popup->image;

        $popup->update([
            'image'   => $name,
            'titre'   => $request->titre,
            'contenu' => $request->contenu,
            'start'   => $request->start,
            'end'     => $request->end,
            'link'    => $request->link,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié un popup avec succès!');
        return back();
    }

    public function popupsDelValide(Request $request)
    {
        Popup::findOrFail($request->del_id)->delete();
        $request->session()->flash('del_msg', 'Vous avez supprimé ce popup avec succès!');
        return back();
    }
    /** FIN POPUP **/

        /** ACTIVITÉ **/
    public function activites()
    {
        $galerie = Activite::latest()->get();

        return view('admin.activites.list')
            ->with('galerie', $galerie);
    }

    public function CreateActivite()
    {
        $categories = Categorie_activitie::latest()->get();

        return view('admin.activites.create')
            ->with('categories', $categories);
    }

    public function ValidActivite(Request $request)
    {
        $request->validate([
            'title_fr' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'image'    => ['required', 'image', 'max:8192'],
        ]);

        $name = $this->uploadImage($request->file('image'), '/frontend/assets/images/activites/', 850, 550);

        Activite::create([
            'image'                   => $name,
            'title_fr'                => $request->title_fr,
            'title_en'                => $request->title_en,
            'description_en'          => $request->description_en,
            'description_fr'          => $request->description_fr,
            'categorie_activity_slug' => $request->type,
            'slug'                    => $this->uniqueSlug($request->title_fr, Activite::class, 'slug'),
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté une nouvelle activité avec succès!');
        return back();
    }

    public function EditActivite($id)
    {
        $galerie     = Activite::where('id', $id)->first();
        $categories  = Categorie_activitie::latest()->get();

        return view('admin.activites.edit')
            ->with('galerie', $galerie)
            ->with('categories', $categories);
    }

    public function EditvalidActivite(Request $request)
    {
        $name = ($request->hasFile('image'))
            ? $this->uploadImage($request->file('image'), '/frontend/assets/images/activites/', 850, 550)
            : $request->img_up;

        Activite::where('id', $request->id)->update([
            'image'                   => $name,
            'title_fr'                => $request->title_fr,
            'title_en'                => $request->title_en,
            'description_en'          => $request->description_en,
            'description_fr'          => $request->description_fr,
            'categorie_activity_slug' => $request->type,
            'slug'                    => $this->uniqueSlug($request->title_fr, Activite::class, 'slug', (int) $request->id),
        ]);

        $request->session()->flash('msg', 'Vous avez modifié une activité avec succès!');
        return back();
    }

    public function DelActivite(Request $request)
    {
        Activite::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé une activité avec succès!');
        return back();
    }

    /** --------------------------------
     *     CATEGORIES D'ACTIVITES
     * --------------------------------*/
    public function categories()
    {
        $categories = Categorie_activitie::withCount('activites')->orderBy('id', 'ASC')->get();

        return view('admin.main-activity.index')
            ->with('categories', $categories);
    }

    public function categorieCreate()
    {
        return view('admin.main-activity.create');
    }

    public function categorieCreateValid(Request $request)
    {
        $request->validate([
            'titre_fr'       => ['required', 'string'],
            'titre_en'       => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image'          => ['required', 'image', 'max:8192'],
        ]);

        $name = $this->uploadImage($request->file('image'), '/frontend/assets/images/activites/categories/', 850, 550);

        Categorie_activitie::create([
            'titre_fr'       => $request->titre_fr,
            'titre_en'       => $request->titre_en,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'image'          => $name,
            'slug'           => $this->uniqueSlug($request->titre_fr, Categorie_activitie::class, 'slug'),
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté une catégorie avec succès!');
        return back();
    }

    public function categorieEdit($id)
    {
        $categorie = Categorie_activitie::findOrFail($id);

        return view('admin.main-activity.edit')
            ->with('categorie', $categorie);
    }

    public function categorieEditValid(Request $request)
    {
        $request->validate([
            'titre_fr'       => ['required', 'string'],
            'titre_en'       => ['required', 'string'],
            'description_fr' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image'          => ['nullable', 'image', 'max:8192'],
        ]);

        $categorie = Categorie_activitie::findOrFail($request->categorie_id);

        $name = ($request->hasFile('image'))
            ? $this->uploadImage($request->file('image'), '/frontend/assets/images/activites/categories/', 850, 550)
            : $categorie->image;

        $newSlug = $this->uniqueSlug($request->titre_fr, Categorie_activitie::class, 'slug', (int) $categorie->id);
        $oldSlug = $categorie->slug;

        $categorie->update([
            'titre_fr'       => $request->titre_fr,
            'titre_en'       => $request->titre_en,
            'description_fr' => $request->description_fr,
            'description_en' => $request->description_en,
            'image'          => $name,
            'slug'           => $newSlug,
        ]);

        // Les activites referencent la categorie par son slug : on les met a
        // jour pour ne pas casser la liaison quand le titre change.
        if ($oldSlug !== $newSlug) {
            Activite::where('categorie_activity_slug', $oldSlug)
                ->update(['categorie_activity_slug' => $newSlug]);
        }

        $request->session()->flash('msg', 'Vous avez modifié la catégorie avec succès!');
        return back();
    }

    public function categorieDel(Request $request)
    {
        $categorie = Categorie_activitie::findOrFail($request->del_id);

        if ($categorie->activites()->exists()) {
            $request->session()->flash('msg_error', 'Impossible de supprimer cette catégorie : des activités y sont encore rattachées. Déplacez-les d\'abord vers une autre catégorie.');
            return back();
        }

        $categorie->delete();
        $request->session()->flash('msg', 'Vous avez supprimé la catégorie avec succès!');
        return back();
    }

    public function DelSousActivite(Request $request)
    {
        Sous_activite::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé une image avec succès!');
        return back();
    }
    /** FIN ACTIVITÉ **/


    /** USERS **/
    public function users()
    {
        // leftJoin : un admin au role supprime/invalide doit rester visible
        // dans la liste (l'inner join le faisait disparaitre).
        $users = DB::table('admins')
            ->leftJoin('roles', 'roles.id', '=', 'admins.role_id')
            ->select('admins.*', DB::raw("COALESCE(roles.name, 'Aucun rôle') as role_name"))
            ->get();

        $roles = Role::latest()->get();

        return view('admin.users.index')
            ->with('roles', $roles)
            ->with('users', $users);
    }

    public function EditUser($id)
    {
        $roles = Role::latest()->get();
        $user  = Admin::where('id', $id)->first();

        $users = DB::table('admins')
            ->leftJoin('roles', 'roles.id', '=', 'admins.role_id')
            ->select('admins.*', DB::raw("COALESCE(roles.name, 'Aucun rôle') as role_name"))
            ->get();

        return view('admin.users.edit_user')
            ->with('user', $user)
            ->with('users', $users)
            ->with('roles', $roles);
    }

    public function UserEditValide(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'unique:admins,email,' . (int) $request->user_id],
            'role'  => ['required', 'exists:roles,id'],
        ]);

        Admin::where('id', $request->user_id)->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'role_id' => $request->role,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié un utilisateur avec succès!');
        return back();
    }

    public function DelUser(Request $request)
    {
        Admin::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg_error', 'Vous avez supprimé un utilisateur avec succès!');
        return back();
    }

    public function roles()
    {
        $roles = Role::latest()->get();

        return view('admin.users.role')
            ->with('roles', $roles);
    }

    public function ValidRole(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:100']]);

        Role::create([
            'code'        => Str::slug($request->name),
            'name'        => $request->name,
            'description' => $request->description,
            'guard_name'  => 'web',
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté un rôle avec succès!');
        return back();
    }

    public function EditRole($id)
    {
        $roles = Role::latest()->get();
        $role  = Role::where('id', $id)->first();

        return view('admin.users.edit_role')
            ->with('roles', $roles)
            ->with('role', $role);
    }

    public function EditValidRole(Request $request)
    {
        $request->validate(['name' => ['required', 'string', 'max:100']]);

        Role::where('id', $request->role_id)->update([
            'code'        => Str::slug($request->name),
            'name'        => $request->name,
            'description' => $request->description,
            'guard_name'  => 'web',
        ]);

        $request->session()->flash('msg', 'Vous avez modifié un rôle avec succès!');
        return back();
    }

    public function DelRoleUser(Request $request)
    {
        Role::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg_error', 'Vous avez supprimé un rôle avec succès!');
        return back();
    }

    public function permissions()
    {
        $roles       = Role::latest()->get();
        $permissions = Permission::get();
        $groupe      = DB::table('groupes')->get();

        return view('admin.users.permission')
            ->with('permissions', $permissions)
            ->with('groupe', $groupe)
            ->with('roles', $roles);
    }

    public function permission_single($id)
    {
        $roles       = Role::latest()->get();
        $role        = Role::where('id', $id)->first();
        $permissions = Permission::get();
        $groupe      = DB::table('groupes')->get();

        return view('admin.users.permission_single')
            ->with('permissions', $permissions)
            ->with('groupe', $groupe)
            ->with('role', $role)
            ->with('roles', $roles);
    }

    public function ValidPermissions(Request $request)
    {
        DB::table('permission_role')->where('role_id', $request->role_id)->delete();

        $date = now()->format('Y-m-d');

        if (!empty($request->permissions)) {
            foreach ($request->permissions as $item) {
                DB::table('permission_role')->insert([
                    'permission_id' => $item,
                    'role_id'       => $request->role_id,
                    'created_at'    => $date,
                    'updated_at'    => $date,
                ]);
            }
        }

        $request->session()->flash('msg', 'Permissions assignées avec succès!');
        return back();
    }

    public function permission_per_role($id)
    {
        $permissions = DB::table('permission_role')
            ->where('role_id', $id)
            ->pluck('permission_id');

        return json_encode($permissions);
    }

    public function UserValide(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:150'],
            'email'    => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8'],
            'role'     => ['required', 'exists:roles,id'],
        ]);

        if ($request->password === $request->repassword) {
            Admin::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'password'=> bcrypt($request->password),
                'role_id' => $request->role,
            ]);

            $request->session()->flash('msg', 'Vous avez créé un utilisateur avec succès!');
        } else {
            $request->session()->flash('msg_error', 'Les deux mots de passe ne correspondent pas!');
        }

        return back();
    }

    public function ResetPassword()
    {
        return view('admin.users.change_password');
    }

    public function ChangePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        if (Hash::check($request->old_password, $admin->password)) {
            if ($request->new_password === $request->conf_password) {
                Admin::where('id', $admin->id)->update([
                    'password' => bcrypt($request->new_password),
                ]);
                $request->session()->flash('msg', 'Mot de passe changé avec succès!');
            } else {
                $request->session()->flash('msg_error', 'Les deux mots de passe ne sont pas identiques!');
            }
        } else {
            $request->session()->flash('msg_error', 'Ancien mot de passe incorrect!');
        }

        return back();
    }
    /** FIN USERS **/


    /** TEAM **/
    public function team()
    {
        $teams = Team::orderBy('id', 'DESC')->get();
        return view('admin.equipes.index')->with('teams', $teams);
    }

    public function teamCreate()
    {
        return view('admin.equipes.create');
    }

    public function teamCreateValid(Request $request)
    {
        $request->validate([
            'nom'   => ['required', 'string'],
            'photo' => ['required', 'image', 'max:8192'],
        ]);

        $name = $this->uploadImage($request->file('photo'), '/frontend/assets/images/team/', 300, 266);

        Team::create([
            'name'        => $request->nom,
            'image'       => $name,
            'post_en'     => $request->fonction_en,
            'post_fr'     => $request->fonction_fr,
            'type_membre' => $request->type_membre,
            'ordre'       => (int) ($request->ordre ?? 0),
            'facebook'    => $request->facebook,
            'instagram'   => $request->instagram,
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté un nouveau membre avec succès!');
        return back();
    }

    public function teamEdit($id)
    {
        $team = Team::where('id', $id)->first();

        return view('admin.equipes.edit')
            ->with('team', $team);
    }

    public function teamEditValid(Request $request)
    {
        $name = ($request->hasFile('photo'))
            ? $this->uploadImage($request->file('photo'), '/frontend/assets/images/team/', 300, 266)
            : $request->photo_up;

        Team::where('id', $request->team_id)->update([
            'name'        => $request->nom,
            'image'       => $name,
            'post_en'     => $request->fonction_en,
            'post_fr'     => $request->fonction_fr,
            'type_membre' => $request->type_membre,
            'ordre'       => (int) ($request->ordre ?? 0),
            'facebook'    => $request->facebook,
            'instagram'   => $request->instagram,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié ce membre avec succès!');
        return back();
    }

    public function teamDel(Request $request)
    {
        Team::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg_error', 'Vous avez supprimé un membre avec succès!');
        return back();
    }
    /** FIN TEAM **/

    /** A PROPOS **/
    public function apropos()
    {
        $apropos = Apropo::first() ?? Apropo::create([]);

        return view('admin.apropos.index')->with('apropos', $apropos);
    }

    public function EditApropos(Request $request)
    {
        $request->validate([
            'image_intro'     => ['nullable', 'image', 'max:8192'],
            'image_mission'   => ['nullable', 'image', 'max:8192'],
            'image_mandat'    => ['nullable', 'image', 'max:8192'],
            'image_objectif1' => ['nullable', 'image', 'max:8192'],
            'image_objectif2' => ['nullable', 'image', 'max:8192'],
            'image_objectif3' => ['nullable', 'image', 'max:8192'],
        ]);

        $apropos = Apropo::findOrFail($request->apropos_id);

        $images = [];
        foreach (['image_intro', 'image_mission', 'image_mandat', 'image_objectif1', 'image_objectif2', 'image_objectif3'] as $champ) {
            $images[$champ] = $request->hasFile($champ)
                ? $this->uploadImage($request->file($champ), '/frontend/assets/images/resource/', 850, 550)
                : $apropos->{$champ};
        }

        $apropos->update($images + [
            'experience_fr' => $request->experience_fr,
            'experience_en' => $request->experience_en,
            'intro_fr'      => $request->intro_fr,
            'intro_en'      => $request->intro_en,
            'historique_fr' => $request->historique_fr,
            'historique_en' => $request->historique_en,
            'mission_fr'    => $request->mission_fr,
            'mission_en'    => $request->mission_en,
            'mandat_fr'     => $request->mandat_fr,
            'mandat_en'     => $request->mandat_en,
            'objectifs_fr'  => $request->objectifs_fr,
            'objectifs_en'  => $request->objectifs_en,
        ]);

        $request->session()->flash('msg', 'La page « Qui sommes-nous ? » a été mise à jour avec succès!');
        return back();
    }

    /** FIN A PROPOS **/

    /** INSCRIPTION MEH **/

    public function inscription()
    {
        $inscrits = DB::table('inscriptions')->orderBy('id', 'DESC')->get();

        return view('admin.inscriptions.sondage')
            ->with('inscrits', $inscrits);
    }

    /** PUBLICATION **/
    public function publication()
    {
        $pubs = Publication::latest()->get();

        return view('admin.publication.index')
            ->with('pubs', $pubs);
    }

    public function publicationCreate()
    {
        return view('admin.publication.create');
    }

    public function publicationCreateValid(Request $request)
    {
        $request->validate([
            'titre_fr'  => ['required', 'string'],
            'titre_en'  => ['required', 'string'],
            'date_pub'  => ['required', 'date'],
            'type'      => ['required', 'in:' . implode(',', array_keys(Publication::TYPES))],
            'file_name' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:20480'],
        ]);

        $filePath = $this->uploadDocument($request->file('file_name'), '/frontend/assets/docs/publications/');

        Publication::create([
            'titre_fr' => $request->titre_fr,
            'titre_en' => $request->titre_en,
            'date_pub' => $request->date_pub,
            'type'     => $request->type,
            'doc'      => $filePath,
        ]);

        $request->session()->flash('msg', 'Vous avez ajouté une publication avec succès!');
        return back();
    }

    public function publicationEdit($id)
    {
        $pub = Publication::where('id', $id)->first();

        return view('admin.publication.edit')->with('pub', $pub);
    }

    public function publicationEditValid(Request $request)
    {
        $request->validate([
            'titre_fr'  => ['required', 'string'],
            'titre_en'  => ['required', 'string'],
            'date_pub'  => ['required', 'date'],
            'type'      => ['required', 'in:' . implode(',', array_keys(Publication::TYPES))],
            'file_name' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:20480'],
        ]);

        $fileName = ($request->hasFile('file_name'))
            ? $this->uploadDocument($request->file('file_name'), '/frontend/assets/docs/publications/')
            : $request->file_name_up;

        Publication::where('id', $request->pub_id)->update([
            'titre_fr' => $request->titre_fr,
            'titre_en' => $request->titre_en,
            'date_pub' => $request->date_pub,
            'type'     => $request->type,
            'doc'      => $fileName,
        ]);

        $request->session()->flash('msg', 'Vous avez modifié une publication avec succès!');
        return back();
    }

    public function DelPub(Request $request)
    {
        Publication::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Vous avez supprimé cette publication avec succès!');
        return back();
    }

    public function Noscontacts()
    {
        $contacts = Contact::latest()->get();

        return view('admin.contacts.list')
            ->with('contacts', $contacts);
    }

    public function DelContact(Request $request)
    {
        Contact::findOrFail($request->del_id)->delete();
        $request->session()->flash('msg', 'Message supprimé avec succès!');
        return back();
    }

    /** --------------------------------
     *     STATISTIQUES DE VISITES
     * --------------------------------*/
    public function visites()
    {
        $today   = now()->format('Y-m-d');
        $depuis  = now()->subDays(29)->startOfDay();

        // Compteurs globaux
        $visitesAujourdhui   = Visite::whereDate('created_at', $today)->count();
        $visiteursAujourdhui = Visite::whereDate('created_at', $today)->distinct('visitor_hash')->count('visitor_hash');
        $visites30j          = Visite::where('created_at', '>=', $depuis)->count();
        $visiteurs30j        = Visite::where('created_at', '>=', $depuis)->distinct('visitor_hash')->count('visitor_hash');
        $visitesTotal        = Visite::count();

        // Evolution jour par jour sur 30 jours (jours sans visite = 0)
        [$chartLabels, $chartData] = $this->visitesChartData();

        // Pages les plus visitees (30 jours)
        $topPages = Visite::where('created_at', '>=', $depuis)
            ->selectRaw('page, COUNT(*) as total')
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Sources de trafic (30 jours) : referents externes + acces directs
        $sources = Visite::where('created_at', '>=', $depuis)
            ->whereNotNull('referer_host')
            ->selectRaw('referer_host, COUNT(*) as total')
            ->groupBy('referer_host')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $accesDirects = Visite::where('created_at', '>=', $depuis)
            ->whereNull('referer_host')
            ->count();

        // Appareils et navigateurs (30 jours)
        $appareils = Visite::where('created_at', '>=', $depuis)
            ->selectRaw('device, COUNT(*) as total')
            ->groupBy('device')
            ->orderByDesc('total')
            ->get();

        $navigateurs = Visite::where('created_at', '>=', $depuis)
            ->selectRaw('browser, COUNT(*) as total')
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return view('admin.visites.index', compact(
            'visitesAujourdhui', 'visiteursAujourdhui', 'visites30j', 'visiteurs30j', 'visitesTotal',
            'chartLabels', 'chartData', 'topPages', 'sources', 'accesDirects', 'appareils', 'navigateurs'
        ));
    }

}
