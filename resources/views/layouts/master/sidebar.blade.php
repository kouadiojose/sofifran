  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    @php
      // Logo gere dans Admin > General (settings.logo), avec repli sur le
      // logo blanc embarque si le fichier configure est absent.
      $sidebarLogo = '/frontend/assets/images/logo-white.png';
      if (!empty($setting?->logo) && file_exists(public_path('frontend/assets/images/' . $setting->logo))) {
          $sidebarLogo = '/frontend/assets/images/' . $setting->logo;
      }
    @endphp

    <!-- Brand Logo -->

    <a href="{{ route('admin-dashboard') }}" class="brand-link text-center">

      <img src="{{ $sidebarLogo }}" alt="Logo Sofifran" class="brand-image"

           style="opacity: .9; max-height: 33px; width: auto; float: none;">

      <span class="brand-text font-weight-light">Admin Sofifran</span>

    </a>



    <!-- Sidebar -->

    <div class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">

        <div class="image">

          <img src="{{ $sidebarLogo }}" class="elevation-2" alt="Logo Sofifran" style="max-height: 34px; width: auto; border-radius: 4px; background: rgba(255,255,255,.9); padding: 2px;">

        </div>

        <div class="info">

          <a href="{{ route('admin-dashboard') }}" class="d-block">{{ auth('admin')->user()->name ?? 'Sofifran' }}</a>

        </div>

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