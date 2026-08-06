  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    @php
      // Logo gere dans Admin > General (settings.logo). Avec un logo
      // personnalise (couleur) : fond blanc. Sans logo configure : repli sur
      // le logo blanc embarque, sur fond sombre (sinon il serait invisible).
      $logoPerso   = !empty($setting?->logo) && file_exists(public_path('frontend/assets/images/' . $setting->logo));
      $sidebarLogo = $logoPerso
          ? '/frontend/assets/images/' . $setting->logo
          : '/frontend/assets/images/logo-white.png';
    @endphp

    <!-- Brand Logo en haut de la sidebar : toujours sur fond blanc -->

    <a href="{{ route('admin-dashboard') }}" class="brand-link text-center"
       style="background: #ffffff !important; padding: 10px 8px; border-bottom: 1px solid #dee2e6;">

      @if($logoPerso)
        <img src="{{ $sidebarLogo }}" alt="Logo Sofifran"
             style="max-height: 44px; width: auto; background: #ffffff; padding: 2px 8px; border-radius: 4px;">
      @else
        {{-- Pas de logo personnalise : le logo blanc embarque serait invisible
             sur fond blanc, on affiche le nom en toutes lettres --}}
        <span style="color: #b05329; font-weight: 700; font-size: 1.2rem; letter-spacing: 1px;">SOFIFRAN</span>
      @endif

    </a>



    <!-- Sidebar -->

    <div class="sidebar">

      <!-- Sous le logo : simple mention Admin -->

      <div class="user-panel mt-3 pb-3 mb-3 text-center">

        <a href="{{ route('admin-dashboard') }}" class="d-block" style="color: #c2c7d0; font-weight: 600; letter-spacing: 3px;">ADMIN</a>

      </div>



      <!-- Sidebar Menu -->

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->

          

          <li class="nav-item">

            <a href="{{ route('admin-dashboard') }}" class="nav-link" id="Li_dashboard">

              <i class="nav-icon fas fa-home"></i>

              <p>

                Tableau de Bord

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-visites') }}" class="nav-link" id="Li_visites">

              <i class="nav-icon fas fa-chart-line"></i>

              <p>

                Statistiques de visites

              </p>

            </a>

          </li>



         

          <li class="nav-item">

            <a href="{{ route('admin-projet') }}" class="nav-link" id="Li_projet">

              <i class="nav-icon fas fa-th"></i>

              <p>

                Projets

              </p>

            </a>

          </li>

       



          

          <li class="nav-item">

            <a href="{{ route('admin-equipe') }}" class="nav-link" id="Li_equipe">

              <i class="nav-icon fas fa-users"></i>

              <p>

                Equipe

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-galerie') }}" class="nav-link" id="Li_galerie">

              <i class="nav-icon fas fa-image"></i>

              <p>

                Galerie Photos

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-galerie-video') }}" class="nav-link" id="Li_video">

              <i class="nav-icon fas fa-video"></i>

              <p>

                Galerie Vidéos

              </p>

            </a>

          </li>

          



          

          <li class="nav-item">

            <a href="{{ route('admin-temoignage') }}" class="nav-link" id="Li_temoignage">

              <i class="nav-icon fas fa-user"></i>

              <p>

                Témoignages

              </p>

            </a>

          </li>

        



          

          <li class="nav-item">

            <a href="{{ route('admin-partenaire') }}" class="nav-link" id="Li_partenaire">

              <i class="nav-icon fas fa-list"></i>

              <p>

                Partenaires

              </p>

            </a>

          </li>

         

            


          

          <li class="nav-item">

            <a href="{{ route('admin-atelier') }}" class="nav-link" id="Li_atelier">

              <i class="nav-icon fas fa-calendar-alt"></i>

              <p>

                Calendrier

              </p>

            </a>

          </li>

          


          

          <li class="nav-item">

            <a href="{{ route('admin-infolettre') }}" class="nav-link" id="Li_infolettre">

              <i class="nav-icon far fa-envelope"></i>

              <p>

                Infolettre (abonnés)

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-publication') }}" class="nav-link" id="Li_publication">

              <i class="nav-icon far fa-file-pdf"></i>

              <p>

                Publications &amp; Documents

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-categorie') }}" class="nav-link" id="Li_categorie">

              <i class="nav-icon fas fa-layer-group"></i>

              <p>

                Catégories d'activités

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-popups') }}" class="nav-link" id="Li_popup">

              <i class="nav-icon far fa-window-restore"></i>

              <p>

                Popups d'annonce

              </p>

            </a>

          </li>

          <li class="nav-item">

            <a href="{{ route('admin-inscriptions') }}" class="nav-link" id="Li_inscription">

              <i class="nav-icon fas fa-user-plus"></i>

              <p>

                Inscriptions

              </p>

            </a>

          </li>

          



         

          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-chart-pie"></i>

              <p>

                Rubriques

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="{{ route('admin-apropos') }}" class="nav-link">

                  <i class="far fa-circle nav-icon"></i>

                  <p>A propos de nous</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="{{ route('admin-banieres') }}" class="nav-link">

                  <i class="far fa-circle nav-icon"></i>

                  <p>Bannières</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="{{ route('admin-activite') }}" class="nav-link" id="Li_activite">

                  <i class="far fa-circle nav-icon"></i>

                  <p>Activités</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="{{ route('admin-blog') }}" class="nav-link">

                  <i class="far fa-circle nav-icon"></i>

                  <p>Blog/Actualités</p>

                </a>

              </li>

          	</ul>

          </li>

         

          
          <li class="nav-item">

            <a href="{{ route('admin-list-contacts') }}" class="nav-link" id="Li_list_contact">

              <i class="nav-icon far fa-envelope"></i>

              <p>

                Nos contacts

              </p>

            </a>

          </li>

          


          <li class="nav-header">PARAM&Eacute;TRAGE</li>

          



          <li class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fas fa-circle"></i>

              <p>

                Paramètres Généraux

                <i class="right fas fa-angle-left"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              @can('parametre_view')

              <li class="nav-item">

                <a href="{{ route('admin-general') }}" class="nav-link">

                  <i class="far fa-circle nav-icon"></i>

                  <p>Information Site</p>

                </a>

              </li>

              @endcan

			

			@can('user_view')

              <li class="nav-item has-treeview">

                <a href="#" class="nav-link">

                  <i class="far fa-circle nav-icon"></i>

                  <p>

                    Utilisateurs

                    <i class="right fas fa-angle-left"></i>

                  </p>

                </a>

                <ul class="nav nav-treeview">

                  

                  <li class="nav-item">

                    <a href="{{ route('admin-user') }}" class="nav-link">

                      <i class="far fa-dot-circle nav-icon"></i>

                      <p>Utilisateurs</p>

                    </a>

                  </li>

                  



                  <li class="nav-item">

                    <a href="{{ route('admin-role') }}" class="nav-link">

                      <i class="far fa-dot-circle nav-icon"></i>

                      <p>Roles</p>

                    </a>

                  </li>

                  <li class="nav-item">

                    <a href="{{ route('admin-permission') }}" class="nav-link">

                      <i class="far fa-dot-circle nav-icon"></i>

                      <p>Permissions</p>

                    </a>

                  </li>

                </ul>

              </li>

              @endcan



              <li class="nav-item">

                <a href="{{ route('admin-user-reset-password') }}" class="nav-link">

                  <i class="far fa-circle nav-icon"></i>

                  <p>Changer Mot de passe</p>

                </a>

              </li>

            </ul>

          </li>



          <li class="nav-item">

            <form action="{{ route('admin-logout') }}" method="post" id="logout-form">
              {{ csrf_field() }}
              <a href="javascript:;" onclick="document.getElementById('logout-form').submit();" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Déconnexion</p>
              </a>
            </form>

          </li>

        </ul>

      </nav>

      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>



  <script>

    document.getElementById("Li_"+li).setAttribute("class","nav-link active");

  </script>