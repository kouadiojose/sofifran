<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vision;
use App\Models\Popup;
use App\Models\Projet;
use App\Models\Partenaire;
use App\Models\Atelier;
use App\Models\Temoignage;
use App\Models\Publication;
use App\Models\Infolettre;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Bloc;
use App\Models\Galerie;
use App\Models\Galerie_photo;
use App\Models\Galerie_video;

use App\Models\Sondage;

use App\Models\Setting;

use App\Models\Team;

use App\Models\Inscription;
use App\Models\Baniere;

use App\Models\Activite;
use App\Models\Categorie_activitie;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Laravel\Facades\Image;

use Calendar;
use Session;
use Str;



class PageController extends Controller

{

    public $m_sujet = null ;
      public $reply_to = null ;
      public $reply_from = null ;


    public function index()
    {

        //dd(bcrypt('12345678'));

        $popup = Popup::where('id', 1)->first();

        $projets = Projet::Where('ended', 'no')->orderBy('id', 'DESC')->paginate(4);

    	$blogs = Blog::orderBy('id', 'DESC')->paginate(6);
    	$blogs2 = Blog::orderBy('id', 'ASC')->paginate(8);


        //$atelier = Atelier::where('end', '>=', now())->orderBy('start', 'ASC')->get();
        $atelier = Atelier::whereRaw(
            "TIMESTAMP(`end`, `hour_end`) >= ?",
            [now()->format('Y-m-d H:i:s')]
        )
        ->orderByRaw("TIMESTAMP(`start`, `hour_start`) ASC")
        ->get();

        //dd($atelier);

        $slide = Slider::orderBy('id', 'DESC')->get();

        $bloc = Bloc::all();
        $sondage = Bloc::first();
        $galerie = Galerie::latest()->paginate(4);

        $last_activites = Activite::orderBy('id', 'DESC')->paginate(4);

        $last_projet = Projet::latest()->paginate(4);


        $header = DB::table('entete_activites')->first();
        $temoignages = Temoignage::orderBy('id', 'DESC')->get();

        $partenaires = DB::table('partenaires')->orderBy('orders', 'asc')->get();

        $pubs = Publication::orderBy('date_pub', 'DESC')->paginate(2);
        $videos = Galerie_video::latest()->get();

        $activites = Categorie_activitie::orderBy('id', 'ASC')->get();

        //dd($activites);
        return view('pages.index')
        ->with('atelier', $atelier)
        ->with('videos', $videos)
        ->with('activites', $activites)
        ->with('popup', $popup)
        ->with('pubs', $pubs)
        ->with('last_projet', $last_projet)

        ->with('slide', $slide)
        ->with('temoignages', $temoignages)

        ->with('blogs', $blogs)
        ->with('blogs2', $blogs2)
        ->with('partenaires', $partenaires)

        ->with('sondage', $sondage)

        ->with('bloc', $bloc)

        ->with('galerie', $galerie)

        ->with('last_activites', $last_activites)

        ->with('header', $header)

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

        return view('pages.infolettre');

    }
    
    
    public function atelier()
    {
        $baniere = Baniere::Where('id', 9)->first();

        //$data = Atelier::all();
        $data = Atelier::where('start', '>=', now())->orderBy('start', 'ASC')->get();
        return view('pages.calendrier')
        ->with('baniere', $baniere)
        ->with('calendar', $data);
    }





    public function Detailatelier($slug)
    {
        $baniere = Baniere::Where('id', 9)->first();
        $atelier = Atelier::Where('slug', $slug)
        ->first();
        $ateliers = Atelier::where('start', '>=', now())->orderBy('start', 'ASC')->get();        
        return view('pages.detail_atelier')
        ->with('baniere', $baniere)
        ->with('ateliers', $ateliers)
        ->with('atelier', $atelier);

    }



    public function partenaire()
    {

        $baniere = Baniere::Where('id', 7)->first();

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

        $baniere = Baniere::Where('id', 15)->first();
        $videos = Galerie_video::latest()->paginate(9);

        return view('pages.galerie_video')
        ->with('baniere', $baniere)
        ->with('videos', $videos);

    }



    public function GaleriePhoto()

    {
        $baniere = Baniere::Where('id', 14)->first();

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

        $activite = Activite::where('slug', $get)->first();

        $baniere = Baniere::Where('id', 14)->first();

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
        $baniere = Baniere::Where('id', 17)->first();
        return view('pages.engagez')
        ->with('baniere', $baniere);

    }



    public function projet()

    {
        $baniere = Baniere::Where('id', 10)->first();
    	$projets = Projet::Where('ended', 'no')->orderBy('id', 'DESC')->paginate(9);
        $projet_termines = Projet::Where('ended', 'yes')->orderBy('id', 'DESC')->paginate(9);

        return view('pages.projets')
        ->with('projet_termines', $projet_termines)
        ->with('baniere', $baniere)
        ->with('projets', $projets);

    }



    public function projetTermines()

    {
        $baniere = Baniere::Where('id', 10)->first();
        $projets = Projet::Where('ended', 'yes')->orderBy('id', 'DESC')->paginate(9);

        return view('pages.projet_termines')
        ->with('baniere', $baniere)
        ->with('projets', $projets);

    }





    public function projetDetail($slug)
    {
        $baniere = Baniere::Where('id', 10)->first();
        $projet= Projet::where('slug', $slug)->first();
    	$projets= Projet::orderBy('id', 'DESC')->paginate(5);

        return view('pages.projet_detail')
        ->with('projets', $projets)
        ->with('baniere', $baniere)
        ->with('projet', $projet);

    }



    public function ValidInfolettre(Request $request)

    {

        $email = Infolettre::Where('email', strtolower($request->email))->first();



        if ( $email ) {

          return response()->json(['code'=>500, 'error'=>'Cette adresse email existe déjà!']);

        }else{

          $post = Infolettre::create([

            'email' => strtolower($request->email)

          ]);

          return response()->json([ 'code'=>200, 'succes'=>'Votre email a été bien enregistré avec succès!', 'data'=>$post ]);

        }



        return response()->json();

    }





    public function DetailBlog($slug)
    {


        $baniere = Baniere::Where('id', 16)->first();
        $blog = Blog::where('slug', $slug)

        ->first();

        $blogs = Blog::latest()->paginate(4);



        return view('pages.detail_blog')
        ->with('blog', $blog)
        ->with('baniere', $baniere)

        ->with('blogs', $blogs);

    }



    public function Blog()
    {
      $baniere = Baniere::Where('id', 16)->first();
      $blog = Blog::latest()->paginate(6);
      return view('pages.blog')
      ->with('baniere', $baniere)
      ->with('blog', $blog);

    }


    public function main_activites()
    {

      $baniere = Baniere::Where('id', 2)->first();
      $activites = Categorie_activitie::orderBy('id', 'ASC')->get();
      return view('pages.main-activity')
      ->with('baniere', $baniere)
      ->with('activites', $activites);

    }

    public function rapport_annuel()
    {
        return view('pages.rapport_annuel');
    }
    public function rapport_projet()
    {
        return view('pages.rapport_projet');
    }
    public function communique()
    {
        return view('pages.communique');
    }

    public function article_presse()
    {
        return view('pages.article_presse');
    }


    public function activites($slug)
    {

      $title = ucfirst($slug);
      $titlesimple = $slug;

      $activites = Activite::Where('categorie_activity_slug', $slug)->orderBy('id', 'DESC')->paginate(6);

      $cat = Categorie_activitie::Where('slug', $slug)->first();
      $baniere = Baniere::Where('id', 2)->first();

      return view('pages.activites')
      ->with('title', $title)
      ->with('titlesimple', $titlesimple)
      ->with('cat', $cat)
      ->with('baniere', $baniere)
      ->with('activites', $activites);

    }



    public function SingleActivite($slug_cat, $slug)
    {

        $baniere = Baniere::Where('id', 2)->first();
        $activite = Activite::where('slug', $slug)
            ->first();

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
        $baniere = Baniere::Where('id', 6)->first();
        $setting = Setting::first();
        $captcha_image = $this->createCaptchaImage();

        return view('pages.contact')
        ->with('captcha_image', $captcha_image)
        ->with('baniere', $baniere)
        ->with('setting', $setting);

    }

    public function contactSendMail(Request $request)
    {

        // Vérifier si le délai minimum est respecté
        if (Session::has('captcha_time') && (time() - Session::get('captcha_time') < 10)) {
            session()->flash('message_error', 'Veuillez attendre 10 secondes avant de réessayer.');
            return back();
        }

        if ($request->input('captcha') !== Session::get('captcha')) {
            $attempts = Session::get('captcha_attempts', 0) + 1;
            Session::put('captcha_attempts', $attempts);

            if ($attempts >= 3) {
                session()->flash('message_error', 'Vous avez dépassé le nombre maximum de tentatives. Veuillez réessayer plus tard.');
                return back();
            } else {
                session()->flash('message_error', 'CAPTCHA incorrect. Tentative'. $attempts.' sur 3.');
                return back();
            }
        }

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

        $request->session()->put('msg_success', 'Nous avons bien recu votre message et nous vous repondons dans un bref delai. Merci!');
        

        return back();
    }

    public function publication()
    {
        // code...
        $baniere = Baniere::Where('id', 6)->first();
        $pubs = Publication::orderBy('date_pub', 'DESC')->get();

        return view('pages.publication')
        ->with('pubs', $pubs)
        ->with('baniere', $baniere);
    }



    public function team()
    {
        $baniere = Baniere::Where('id', 4)->first();

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

        }

        $request->session()->put('msg_success', 'Vous avez ajouté vos informations avec succès!');

        //dd('Bon');

        return back();

    }



    public function about()
    {

        $title = "Qui sommes-nous";
        $baniere = Baniere::Where('id', 5)->first();

        return view('pages.about')
        ->with('baniere', $baniere);

    }

    public function temoignage()
    {
        $baniere = Baniere::Where('id', 5)->first();

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

        return view('pages.carrers');

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

