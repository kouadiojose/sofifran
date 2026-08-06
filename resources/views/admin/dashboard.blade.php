@extends('layouts.admin')

@section('title', 'Tableau de Bord')
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

        <!-- Indicateurs essentiels -->
        <div class="row">

          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ number_format($visitesAujourdhui, 0, ',', ' ') }}</h3>
                <p>Visites aujourd'hui</p>
              </div>
              <div class="icon"><i class="fas fa-eye"></i></div>
              <a href="{{ route('admin-visites') }}" class="small-box-footer">Statistiques détaillées <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ number_format($visites30j, 0, ',', ' ') }}</h3>
                <p>Visites — 30 derniers jours</p>
              </div>
              <div class="icon"><i class="fas fa-chart-line"></i></div>
              <a href="{{ route('admin-visites') }}" class="small-box-footer">Statistiques détaillées <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ number_format($countContacts, 0, ',', ' ') }}</h3>
                <p>Messages de contact</p>
              </div>
              <div class="icon"><i class="far fa-envelope"></i></div>
              <a href="{{ route('admin-list-contacts') }}" class="small-box-footer">Voir les messages <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ number_format($countInfolettre, 0, ',', ' ') }}</h3>
                <p>Abonnés infolettre</p>
              </div>
              <div class="icon"><i class="fas fa-at"></i></div>
              <a href="{{ route('admin-infolettre') }}" class="small-box-footer">Voir les abonnés <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
        <!-- /.row -->

        <!-- Graphique des visites + inventaire du contenu -->
        <div class="row">

          <div class="col-lg-8">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-area"></i> Visites du site — 30 derniers jours</h3>
              </div>
              <div class="card-body">
                <canvas id="visitesChart" style="min-height: 260px; height: 260px; max-height: 260px;"></canvas>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card card-outline card-secondary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-database"></i> Contenu du site</h3>
              </div>
              <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin-projet') }}">Projets en cours</a>
                    <span class="badge badge-danger badge-pill">{{ $countPorjetCours }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin-projet') }}">Projets terminés</a>
                    <span class="badge badge-success badge-pill">{{ $countPorjetEnd }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin-activite') }}">Activités</a>
                    <span class="badge badge-info badge-pill">{{ $countActivite }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin-publication') }}">Publications &amp; documents</a>
                    <span class="badge badge-primary badge-pill">{{ $countPub }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin-temoignage') }}">Témoignages</a>
                    <span class="badge badge-secondary badge-pill">{{ $countTemoignages }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin-atelier') }}">Évènements à venir</a>
                    <span class="badge badge-warning badge-pill">{{ $countEvenements }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->

        <!-- Actions rapides -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bolt"></i> Actions rapides</h3>
              </div>
              <div class="card-body pad">
                <div class="row">

                  <div class="col-md-2 col-6 mb-3">
                    <a style="width: 100%; height: 100%;" href="{{ route('admin-projet-create') }}" class="btn btn-app bg-info m-0">
                      <i class="fas fa-th"></i> Nouveau projet
                    </a>
                  </div>

                  <div class="col-md-2 col-6 mb-3">
                    <a style="width: 100%; height: 100%;" href="{{ route('admin-atelier-create') }}" class="btn btn-app bg-primary m-0">
                      <i class="fas fa-calendar-alt"></i> Nouvel évènement
                    </a>
                  </div>

                  <div class="col-md-2 col-6 mb-3">
                    <a style="width: 100%; height: 100%;" href="{{ route('admin-publication-create') }}" class="btn btn-app bg-warning m-0">
                      <i class="fas fa-file"></i> Nouvelle publication
                    </a>
                  </div>

                  <div class="col-md-2 col-6 mb-3">
                    <a style="width: 100%; height: 100%;" href="{{ route('admin-popups-create') }}" class="btn btn-app bg-danger m-0">
                      <i class="far fa-window-restore"></i> Popup d'annonce
                    </a>
                  </div>

                  <div class="col-md-2 col-6 mb-3">
                    <a style="width: 100%; height: 100%;" href="{{ route('admin-galerie') }}" class="btn btn-app bg-success m-0">
                      <i class="fas fa-image"></i> Albums photos
                    </a>
                  </div>

                  <div class="col-md-2 col-6 mb-3">
                    <a style="width: 100%; height: 100%;" href="{{ route('admin-blog-create') }}" class="btn btn-app bg-secondary m-0">
                      <i class="fas fa-newspaper"></i> Nouvel article
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

@section('js')
<script src="/admin/plugins/chart.js/Chart.min.js"></script>
<script>
  $(function () {
    var ctx = document.getElementById('visitesChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($chartLabels),
        datasets: [{
          label: 'Visites',
          data: @json($chartData),
          backgroundColor: 'rgba(0, 123, 255, 0.15)',
          borderColor: 'rgba(0, 123, 255, 0.9)',
          pointRadius: 3,
          pointBackgroundColor: 'rgba(0, 123, 255, 1)',
          fill: true,
          tension: 0.3,
        }]
      },
      options: {
        maintainAspectRatio: false,
        legend: { display: false },
        scales: {
          yAxes: [{ ticks: { beginAtZero: true, precision: 0 } }],
          xAxes: [{ gridLines: { display: false } }]
        }
      }
    });
  });
</script>
@endsection
