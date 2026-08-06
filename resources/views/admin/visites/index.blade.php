@extends('layouts.admin')

@section('title', 'Statistiques de visites')
@section('link', 'visites')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Statistiques de visites</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Statistiques</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Compteurs -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Visites aujourd'hui</span>
                <span class="info-box-number">{{ number_format($visitesAujourdhui, 0, ',', ' ') }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Visiteurs uniques aujourd'hui</span>
                <span class="info-box-number">{{ number_format($visiteursAujourdhui, 0, ',', ' ') }}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-chart-line"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Visites (30 jours)</span>
                <span class="info-box-number">{{ number_format($visites30j, 0, ',', ' ') }} <small class="text-muted">/ {{ number_format($visiteurs30j, 0, ',', ' ') }} visiteurs</small></span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-globe"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total depuis l'activation</span>
                <span class="info-box-number">{{ number_format($visitesTotal, 0, ',', ' ') }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Graphique 30 jours -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-area"></i> Évolution des visites — 30 derniers jours</h3>
              </div>
              <div class="card-body">
                <canvas id="visitesChart" style="min-height: 250px; height: 250px; max-height: 250px;"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

          <!-- Pages les plus visitées -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-file-alt"></i> Pages les plus visitées (30 jours)</h3>
              </div>
              <div class="card-body p-0">
                @if($topPages->isNotEmpty())
                <table class="table table-striped mb-0">
                  <thead>
                    <tr><th>Page</th><th class="text-right" style="width: 110px;">Visites</th></tr>
                  </thead>
                  <tbody>
                    @foreach($topPages as $p)
                    <tr>
                      <td class="text-truncate" style="max-width: 320px;"><a href="{{ url($p->page) }}" target="_blank">{{ $p->page }}</a></td>
                      <td class="text-right"><span class="badge badge-info">{{ number_format($p->total, 0, ',', ' ') }}</span></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <p class="p-3 mb-0 text-muted">Pas encore de données. Les visites du site public s'enregistrent automatiquement.</p>
                @endif
              </div>
            </div>
          </div>

          <!-- Sources de trafic -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-external-link-alt"></i> Sources de trafic (30 jours)</h3>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped mb-0">
                  <thead>
                    <tr><th>Source</th><th class="text-right" style="width: 110px;">Visites</th></tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><i class="fas fa-keyboard text-muted"></i> Accès direct <small class="text-muted">(URL tapée, favoris...)</small></td>
                      <td class="text-right"><span class="badge badge-secondary">{{ number_format($accesDirects, 0, ',', ' ') }}</span></td>
                    </tr>
                    @foreach($sources as $s)
                    <tr>
                      <td><i class="fas fa-link text-muted"></i> {{ $s->referer_host }}</td>
                      <td class="text-right"><span class="badge badge-info">{{ number_format($s->total, 0, ',', ' ') }}</span></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>

        <div class="row">

          <!-- Appareils -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-mobile-alt"></i> Appareils (30 jours)</h3>
              </div>
              <div class="card-body">
                @php $totalAppareils = max(1, $appareils->sum('total')); @endphp
                @forelse($appareils as $a)
                @php $pct = round($a->total * 100 / $totalAppareils); @endphp
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>
                      <i class="fas {{ $a->device == 'mobile' ? 'fa-mobile-alt' : ($a->device == 'tablette' ? 'fa-tablet-alt' : 'fa-desktop') }}"></i>
                      {{ ucfirst($a->device) }}
                    </span>
                    <span>{{ number_format($a->total, 0, ',', ' ') }} ({{ $pct }}%)</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: {{ $pct }}%"></div>
                  </div>
                </div>
                @empty
                <p class="text-muted mb-0">Pas encore de données.</p>
                @endforelse
              </div>
            </div>
          </div>

          <!-- Navigateurs -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-window-maximize"></i> Navigateurs (30 jours)</h3>
              </div>
              <div class="card-body">
                @php $totalNav = max(1, $navigateurs->sum('total')); @endphp
                @forelse($navigateurs as $n)
                @php $pct = round($n->total * 100 / $totalNav); @endphp
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>{{ $n->browser }}</span>
                    <span>{{ number_format($n->total, 0, ',', ' ') }} ({{ $pct }}%)</span>
                  </div>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-info" style="width: {{ $pct }}%"></div>
                  </div>
                </div>
                @empty
                <p class="text-muted mb-0">Pas encore de données.</p>
                @endforelse
              </div>
            </div>
          </div>

        </div>

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
