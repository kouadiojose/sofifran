<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Popup;
use App\Models\Projet;
use App\Models\Atelier;
use App\Models\Temoignage;
use App\Models\Publication;
use App\Models\Infolettre;
use App\Models\Blog;
use App\Models\Galerie_photo;
use App\Models\Galerie_video;
use App\Models\Setting;
use App\Models\Team;
use App\Models\Inscription;
use App\Models\Baniere;
use App\Models\Activite;
use App\Models\Categorie_activitie;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;



class PageController extends Controller

{

    public $m_sujet = null ;
      public $reply_to = null ;
      public $reply_from = null ;


    public function index()
    {
        // Seules les donnees reellement affichees par pages/index.blade.php
        // sont chargees ici (l'ancienne version executait ~10 requetes inutilisees).

        // Popup actif : celui dont la periode start/end couvre la date du jour
        // (avant, le popup id=1 etait affiche en permanence quelles que soient
        // les dates configurees dans l'admin).
        $today = now()->format('Y-m-d');
        $popup = Popup::whereDate('start', '<=', $today)
            ->whereDate('end', '>=', $today)
            ->orderBy('id', 'DESC')
            ->first();

        $projets = Projet::where('ended', 'no')->orderBy('id', 'DESC')->paginate(4);

        $blogs = Blog::orderBy('id', 'DESC')->paginate(6);

        // Evenements a venir ou en cours (logique centralisee dans le modele,
        // tolerante aux heures manquantes).
        $atelier = Atelier::aVenir()->chrono()->get();

        $temoignages = Temoignage::orderBy('id', 'DESC')->get();

        $partenaires = DB::table('partenaires')->orderBy('orders', 'asc')->get();

        $activites = Categorie_activitie::orderBy('id', 'ASC')->get();

        return view('pages.index')
        ->with('atelier', $atelier)
        ->with('activites', $activites)
        ->with('popup', $popup)
        ->with('temoignages', $temoignages)
        ->with('blogs', $blogs)
        ->with('partenaires', $partenaires)
        ->with('projets', $projets);
    }



    public function vision_mission()

    {

        return view('pages.vision_mission');

    }



    /*public function temoignage()

    {

        $temoignage = Temoignage::orderBy('id', 'DESC')->get();

        return view('pages.temoignage')->with('temoignage', $temoignage);

    }*/



    public function benevole()

    {

        return view('pages.benevole');

    }
    
    public function infolettre()
    {

        return view('pages.infolettre')
        ->with('baniere', Baniere::forPage('publication'))
        ->with('pubs', Publication::where('type', 'infolettre')->orderBy('date_pub', 'DESC')->get());

    }
    
    
    public function atelier()
    {
        $baniere = Baniere::forPage('atelier');

        // Inclut les evenements en cours (avant : start >= aujourd'hui,
        // un evenement multi-jours deja commence disparaissait de la page).
        $data = Atelier::aVenir()->chrono()->get();

        return view('pages.calendrier')
        ->with('baniere', $baniere)
        ->with('calendar', $data);
    }





    public function Detailatelier($slug)
    {
        $baniere = Baniere::forPage('atelier');
        $atelier = Atelier::Where('slug', $slug)
        ->firstOrFail();
        $ateliers = Atelier::aVenir()->chrono()->take(5)->get();
        return view('pages.detail_atelier')
        ->with('baniere', $baniere)
        ->with('ateliers', $ateliers)
        ->with('atelier', $atelier);

    }



    public function partenaire()
    {

        $baniere = Baniere::forPage('partenaire');

        $partenaireFinance = DB::table('partenaires')->where('type', 'financier')->orderBy('orders', 'asc')->get();
        $partenaireCommunautaire = DB::table('partenaires')->where('type', 'communautaire')->orderBy('orders', 'asc')->get();
        $partenaireCommanditaire = DB::table('partenaires')->where('type', 'commanditaire')->orderBy('orders', 'asc')->get();
        $partenaireAutres = DB::table('partenaires')->where('type', 'autre')->orderBy('orders', 'asc')->get();

        return view('pages.partenaires')
        ->with('partenaireFinance', $partenaireFinance)
        ->with('partenaireAutres', $partenaireAutres)
        ->with('partenaireCommunautaire', $partenaireCommunautaire)
        ->with('baniere', $baniere)
        ->with('partenaireCommanditaire', $partenaireCommanditaire);

    }



    public function GalerieVideo()
    {

        $baniere = Baniere::forPage('galerie-video');
        $videos = Galerie_video::latest()->paginate(9);

        return view('pages.galerie_video')
        ->with('baniere', $baniere)
        ->with('videos', $videos);

    }



    public function GaleriePhoto()

    {
        $baniere = Baniere::forPage('galerie-photo');

        $galerie = Galerie_photo::join('activites', 'activites.id', '=', 'galerie_photos.galerie_id')
        ->count();

        //dd('ici');
        $activites = Activite::latest()->paginate(12);

        return view('pages.galerie_photo')
        ->with('baniere', $baniere)
        ->with('activites', $activites)
        ->with('galerie', $galerie);

    }

    public function GaleriePhotoGet($get)

    {

        $activite = Activite::where('slug', $get)->firstOrFail();

        $baniere = Baniere::forPage('galerie-photo');

        $galerie = Galerie_photo::Where('galerie_id', $activite->id)
        ->paginate(9);

        $activites = Activite::latest()->paginate(9);

        return view('pages.get_galerie_photos')
        ->with('baniere', $baniere)
        ->with('activite', $activite)
        ->with('galerie', $galerie);

    }



    public function engagez()

    {

        // code...
        $baniere = Baniere::forPage('engagez');
        return view('pages.engagez')
        ->with('baniere', $baniere);

    }



    public function projet()

    {
        $baniere = Baniere::forPage('projets');
    	$projets = Projet::Where('ended', 'no')->orderBy('id', 'DESC')->paginate(9);
        $projet_termines = Projet::Where('ended', 'yes')->orderBy('id', 'DESC')->paginate(9);

        return view('pages.projets')
        ->with('projet_termines', $projet_termines)
        ->with('baniere', $baniere)
        ->with('projets', $projets);

    }



    public function projetTermines()

    {
        $baniere = Baniere::forPage('projets');
        $projets = Projet::Where('ended', 'yes')->orderBy('id', 'DESC')->paginate(9);

        return view('pages.projet_termines')
        ->with('baniere', $baniere)
        ->with('projets', $projets);

    }





    public function projetDetail($slug)
    {
        $baniere = Baniere::forPage('projets');
        $projet= Projet::where('slug', $slug)->firstOrFail();
    	$projets= Projet::orderBy('id', 'DESC')->paginate(5);

        return view('pages.projet_detail')
        ->with('projets', $projets)
        ->with('baniere', $baniere)
        ->with('projet', $projet);

    }



    public function ValidInfolettre(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:filter', 'max:150'],
        ]);

        $email = strtolower($request->email);

        if (Infolettre::where('email', $email)->exists()) {
            session()->flash('newsletter_error', app()->getLocale() == 'fr'
                ? 'Cette adresse email est déjà inscrite!'
                : 'This email address is already subscribed!');
        } else {
            Infolettre::create(['email' => $email]);

            session()->flash('newsletter_success', app()->getLocale() == 'fr'
                ? 'Votre email a bien été enregistré. Merci!'
                : 'Your email has been successfully registered. Thank you!');
        }

        // Revenir ancre sur le formulaire (en bas de page) pour que le
        // message de confirmation soit visible.
        return back()->withFragment('newsletter');
    }





    public function DetailBlog($slug)
    {


        $baniere = Baniere::forPage('blog');
        $blog = Blog::where('slug', $slug)

        ->firstOrFail();

        $blogs = Blog::latest()->paginate(4);



        return view('pages.detail_blog')
        ->with('blog', $blog)
        ->with('baniere', $baniere)

        ->with('blogs', $blogs);

    }



    public function Blog()
    {
      $baniere = Baniere::forPage('blog');
      $blog = Blog::latest()->paginate(6);
      return view('pages.blog')
      ->with('baniere', $baniere)
      ->with('blog', $blog);

    }


    public function main_activites()
    {

      $baniere = Baniere::forPage('activites');
      $activites = Categorie_activitie::orderBy('id', 'ASC')->get();
      return view('pages.main-activity')
      ->with('baniere', $baniere)
      ->with('activites', $activites);

    }

    public function rapport_annuel()
    {
        return view('pages.rapport_annuel')
        ->with('baniere', Baniere::forPage('publication'))
        ->with('pubs', Publication::where('type', 'rapport-annuel')->orderBy('date_pub', 'DESC')->get());
    }
    public function rapport_projet()
    {
        return view('pages.rapport_projet')
        ->with('baniere', Baniere::forPage('publication'))
        ->with('pubs', Publication::where('type', 'rapport-projet')->orderBy('date_pub', 'DESC')->get());
    }
    public function communique()
    {
        return view('pages.communique')
        ->with('baniere', Baniere::forPage('presse'))
        ->with('pubs', Publication::where('type', 'communique')->orderBy('date_pub', 'DESC')->get());
    }

    public function article_presse()
    {
        return view('pages.article_presse')
        ->with('baniere', Baniere::forPage('presse'))
        ->with('pubs', Publication::where('type', 'article-presse')->orderBy('date_pub', 'DESC')->get());
    }


    public function activites($slug)
    {

      $title = ucfirst($slug);
      $titlesimple = $slug;

      $activites = Activite::Where('categorie_activity_slug', $slug)->orderBy('id', 'DESC')->paginate(6);

      $cat = Categorie_activitie::Where('slug', $slug)->first();
      $baniere = Baniere::forPage('activites');

      return view('pages.activites')
      ->with('title', $title)
      ->with('titlesimple', $titlesimple)
      ->with('cat', $cat)
      ->with('baniere', $baniere)
      ->with('activites', $activites);

    }



    public function SingleActivite($slug_cat, $slug)
    {

        $baniere = Baniere::forPage('activites');
        $activite = Activite::where('slug', $slug)
            ->firstOrFail();

        $galerie = Galerie_photo::Where('galerie_id', $activite->id)->get();

        $activites = Activite::latest()->paginate(4);

      return view('pages.detail_activite')
      ->with('activites', $activites)
      ->with('baniere', $baniere)
      ->with('galerie', $galerie)
      ->with('activite', $activite);

    }



    public function contact()

    {

        # code...
        $baniere = Baniere::forPage('contact');
        $setting = Setting::first();
        $captcha_image = $this->createCaptchaImage();

        return view('pages.contact')
        ->with('captcha_image', $captcha_image)
        ->with('baniere', $baniere)
        ->with('setting', $setting);

    }

    public function contactSendMail(Request $request)
    {

        $request->validate([
            'form_name'    => ['required', 'string', 'max:150'],
            'form_phone'   => ['nullable', 'string', 'max:30'],
            'email'        => ['required', 'email:filter', 'max:150'],
            'form_message' => ['required', 'string', 'max:5000'],
            'captcha'      => ['required', 'string'],
        ]);

        // Vérifier si le délai minimum est respecté
        if (Session::has('captcha_time') && (time() - Session::get('captcha_time') < 10)) {
            session()->flash('message_error', 'Veuillez attendre 10 secondes avant de réessayer.');
            return back()->withInput();
        }

        if (strtoupper(trim($request->input('captcha'))) !== Session::get('captcha')) {
            $attempts = Session::get('captcha_attempts', 0) + 1;
            Session::put('captcha_attempts', $attempts);

            if ($attempts >= 3) {
                session()->flash('message_error', 'Vous avez dépassé le nombre maximum de tentatives. Veuillez réessayer plus tard.');
                return back()->withInput();
            } else {
                session()->flash('message_error', 'CAPTCHA incorrect. Tentative '. $attempts.' sur 3.');
                return back()->withInput();
            }
        }

        // Le captcha utilisé ne doit pas pouvoir être rejoué.
        Session::forget('captcha');

        Session::put('captcha_attempts', 0);

        Contact::create([

            'name' => $request->form_name,
            'phone' => $request->form_phone,
            'email' => $request->email,
            'message' => $request->form_message

        ]);


        $form_data['name'] = $request->form_name;
          $form_data['email'] = $request->email;
          $form_data['tel'] = $request->form_phone;
          $form_data['message'] = $request->form_message;

          $this->m_sujet = $request->form_name;
          $this->reply_to = strtolower($request->email);

          Mail::send('emails.contact_form',  ['form' => $form_data] , function ($message) {

              $message->from('info@sofifran.org', 'CONTACT SOFIFRAN' );
              $message->to( 'info@sofifran.org', "Sofifran")->subject( htmlspecialchars( $this->m_sujet )  );
              $message->replyTo( $this->reply_to );
          });

        $request->session()->flash('msg_success', 'Nous avons bien recu votre message et nous vous repondons dans un bref delai. Merci!');
        

        return back();
    }

    public function publication()
    {
        // code...
        $baniere = Baniere::forPage('publication');
        $pubs = Publication::orderBy('date_pub', 'DESC')->get();

        return view('pages.publication')
        ->with('pubs', $pubs)
        ->with('baniere', $baniere);
    }



    public function team()
    {
        $baniere = Baniere::forPage('equipe');

        $team_personnel = Team::Where('type_membre', 'Personnel')->orderBy('id', 'ASC')->get();
        $team_conseil_ad = Team::Where('type_membre', 'Conseil d\'administration')->orderBy('ordre', 'ASC')->get();
        $team = Team::orderBy('ordre', 'ASC')->get();

        return view('pages.team')
        ->with('team_personnel', $team_personnel)
        ->with('baniere', $baniere)
        ->with('team_conseil_ad', $team_conseil_ad)
        ->with('team', $team);

    }



    public function sondage()
    {
        return view('pages.sondage');
    }



    public function sondageCreate(Request $request)
    {

        if ( !isset($request->name) || empty($request->name) ) {

            $request->session()->put('msg_error', 'Vous devez saisir le nom et prenom');

        }elseif( !isset($request->email) || empty($request->email) ){

            $request->session()->put('msg_error', 'Vous devez saisir un email valide');

        }elseif (!isset($request->ville) || empty($request->ville)) {

            $request->session()->put('msg_error', 'Vous devez saisir la ville');

        }elseif (!isset($request->age) || empty($request->age)) {

            $request->session()->put('msg_error', 'Vous devez saisir votre age');

        }else{





            //Insertion dans la base de donnees

            Inscription::create([

                'name' => $request->name,

                'email' => $request->email,

                'ville' => $request->ville,

                'age' => $request->age,

            ]);

            $request->session()->flash('msg_success', 'Vous avez ajouté vos informations avec succès!');

        }

        return back();

    }



    public function about()
    {

        $title = "Qui sommes-nous";
        $baniere = Baniere::forPage('about');

        // Contenu gere dans Admin > Rubriques > A propos.
        $apropos = \App\Models\Apropo::first();

        return view('pages.about')
        ->with('apropos', $apropos)
        ->with('baniere', $baniere);

    }

    public function temoignage()
    {
        $baniere = Baniere::forPage('temoignage');

        $temoignages = Temoignage::latest()->get();
        return view('pages.temoignage')
        ->with('baniere', $baniere)
        ->with('temoignages', $temoignages);
    }

    public function login()

    {

        return view('admin.login');

    }



    public function forgot()

    {

        return view('admin.forgot-password');

    }


    public function compteEmbed1()

    {

        return view('pages.embed_1');

    }

    public function carrers()

    {

        return view('pages.carrers')
        ->with('baniere', Baniere::forPage('publication'))
        ->with('pubs', Publication::where('type', 'emploi')->orderBy('date_pub', 'DESC')->get());

    }

    public function generateCaptcha()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $captcha = substr(str_shuffle($chars), 0, 6);
        Session::put('captcha', $captcha);
        Session::put('captcha_time', time());
        return $captcha;
    }

    public function createCaptchaImage()
    {
        $captcha = $this->generateCaptcha();
        
        $image = imagecreatetruecolor(120, 40);
        $bg = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        
        imagefilledrectangle($image, 0, 0, 120, 40, $bg);
        
        for ($i = 0; $i < 1000; $i++) {
            $pixel_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagesetpixel($image, rand(0, 120), rand(0, 40), $pixel_color);
        }
        
        imagettftext($image, 20, 0, 15, 30, $text_color, public_path('/frontend/assets/fonts/captcha5.ttf'), $captcha);
        
        ob_start();
        imagepng($image);
        $image_data = ob_get_clean();
        imagedestroy($image);
        
        return base64_encode($image_data);
    }

}

