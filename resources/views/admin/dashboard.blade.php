@extends('layouts.admin')



@section('title', 'Dashboard')



@section('link', 'dashboard')



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Tableau de Bord</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Actuel</a></li>

              <li class="breadcrumb-item active">Tableau de Bord</li>

            </ol>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <!-- Info boxes -->

        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">

            <div class="info-box">

              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">Activités</span>

                <span class="info-box-number">

                  {{ $countActivite }}

                </span>

              </div>

              <!-- /.info-box-content -->

            </div>

            <!-- /.info-box -->

          </div>

          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">

            <div class="info-box mb-3">

              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">Projets en cours</span>

                <span class="info-box-number">{{ $countPorjetCours }}</span>

              </div>

              <!-- /.info-box-content -->

            </div>

            <!-- /.info-box -->

          </div>

          <!-- /.col -->



          <!-- fix for small devices only -->

          <div class="clearfix hidden-md-up"></div>



          <div class="col-12 col-sm-6 col-md-3">

            <div class="info-box mb-3">

              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">Projets terminés</span>

                <span class="info-box-number">{{ $countPorjetEnd }}</span>

              </div>

              <!-- /.info-box-content -->

            </div>

            <!-- /.info-box -->

          </div>

          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">

            <div class="info-box mb-3">

              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>



              <div class="info-box-content">

                <span class="info-box-text">Publications</span>

                <span class="info-box-number">{{ $countPub }}</span>

              </div>

              <!-- /.info-box-content -->

            </div>

            <!-- /.info-box -->

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->

        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="far fa-envelope"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Messages de contact</span>
                <span class="info-box-number">{{ $countContacts }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-at"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Abonnés infolettre</span>
                <span class="info-box-number">{{ $countInfolettre }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-secondary elevation-1"><i class="far fa-comments"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Témoignages</span>
                <span class="info-box-number">{{ $countTemoignages }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Évènements à venir</span>
                <span class="info-box-number">{{ $countEvenements }}</span>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-envelope"></i> Derniers messages de contact</h3>
                <div class="card-tools">
                  <a href="{{ route('admin-list-contacts') }}" class="btn btn-sm btn-primary">Voir tous les messages</a>
                </div>
              </div>
              <div class="card-body p-0">
                @if($derniersContacts->isNotEmpty())
                <table class="table table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Email</th>
                      <th>Téléphone</th>
                      <th>Message</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($derniersContacts as $c)
                    <tr>
                      <td>{{ $c->name }}</td>
                      <td><a href="mailto:{{ $c->email }}">{{ $c->email }}</a></td>
                      <td>{{ $c->phone }}</td>
                      <td>{{ \Illuminate\Support\Str::limit($c->message, 60) }}</td>
                      <td>{{ $c->created_at ? $c->created_at->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <p class="p-3 mb-0">Aucun message de contact pour le moment.</p>
                @endif
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                  <i class="fas fa-list"></i>
                    Liens racourcis
                  </h3>
                </div>
                
                <div class="card-body pad">

                  <div class="row">

                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-projet-create') }}" class="btn btn-app bg-info">
                          <i class="fas fa-th"></i>
                          Ajouter un nouveau projet
                      </a>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-atelier-create') }}" class="btn btn-app bg-primary">
                          <i class="fas fa-calendar-alt"></i>
                          Ajouter un nouvel évènement
                      </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-publication-create') }}" class="btn btn-app bg-warning">
                          <i class="fas fa-file"></i>
                          Ajouter une nouvelle publication
                      </a>
                    </div>

                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-popups-create') }}" class="btn btn-app bg-warning">
                          <i class="far fa-window-restore"></i>
                          Ajouter un popup d'annonce
                      </a>
                    </div>

                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-galerie-create') }}" class="btn btn-app bg-success">
                          <i class="fas fa-image"></i>
                          Ajouter une nouvelle photo dans la galerie
                      </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-galerie-video-create') }}" class="btn btn-app bg-secondary">
                          <i class="fas fa-video"></i>
                          Ajouter une nouvelle video dans la galerie
                      </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-activite-create') }}" class="btn btn-app bg-danger">
                          <i class="fas fa-list"></i>
                          Ajouter une nouvelle activité
                      </a>
                    </div>

                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-slide-create') }}" class="btn btn-app bg-primary">
                          <i class="fas fa-list"></i>
                          Ajouter une nouvelle banniere
                      </a>
                    </div>

                    <div class="col-md-3 mb-3">
                      <a style="width: 100%; height: 100%; font-size: 17px;" href="{{ route('admin-temoignage-create') }}" class="btn btn-app bg-secondary">
                          <i class="fas fa-list"></i>
                          Ajouter une nouveau temoignage
                      </a>
                    </div>

                  </div>
                </div>

            </div>


          </div>

        </div>
   

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->



@endsection



@section('js_dashboard')

<!-- jQuery Mapael -->

<script src="/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>

<script src="/admin/plugins/raphael/raphael.min.js"></script>

<script src="/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>

<script src="/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- ChartJS -->

<script src="/admin/plugins/chart.js/Chart.min.js"></script>



<!-- PAGE SCRIPTS -->

<script src="/admin/dist/js/pages/dashboard2.js"></script>

@endsection



