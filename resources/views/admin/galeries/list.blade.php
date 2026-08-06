@extends('layouts.admin')

@section('title', 'Galerie photos')
@section('link', 'galerie')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Galerie photos <small class="text-muted">— {{ $totalPhotos }} photo(s) dans {{ $albums->count() }} album(s)</small></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Galerie photos</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          @if( session()->has('msg') )
          <div class="col-md-12">
            <div class="alert alert-success">{{ session()->get('msg') }}</div>
          </div>
          @endif

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-images"></i> Albums photos</h3>
                <div class="card-tools">
                  <a href="{{ route('admin-galerie-create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Ajouter des photos</a>
                </div>
              </div>

              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-md-5">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                      </div>
                      <input type="text" id="album-search" class="form-control" placeholder="Rechercher un album...">
                    </div>
                  </div>
                </div>

                <div class="row" id="albums-grid">

                  @forelse($albums as $a)
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 album-card" data-title="{{ mb_strtolower($a->title_fr) }}">
                    <div class="card h-100 mb-0">
                      <a href="{{ route('admin-galerie-album', $a->id) }}">
                        <img src="/frontend/assets/images/activites/{{ $a->image }}" class="card-img-top" alt="{{ $a->title_fr }}" style="height: 160px; object-fit: cover;">
                      </a>
                      <div class="card-body p-3 d-flex flex-column">
                        <h5 class="text-truncate mb-3" style="font-size: 1rem;" title="{{ $a->title_fr }}">{{ $a->title_fr }}</h5>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge {{ $a->photos_count > 0 ? 'badge-info' : 'badge-secondary' }}">
                            <i class="far fa-images"></i> {{ $a->photos_count }}
                          </span>
                          <a href="{{ route('admin-galerie-album', $a->id) }}" class="btn btn-primary btn-sm">
                            Ouvrir l'album
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  <div class="col-12">
                    <div class="alert alert-info">
                      Aucune activité pour le moment. Les albums photos sont rattachés aux activités : créez d'abord une activité, puis ajoutez-y des photos.
                    </div>
                  </div>
                  @endforelse

                </div>
              </div>
            </div>
          </div>
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('js')
<script>
  // Filtre instantane des albums par titre.
  document.getElementById('album-search').addEventListener('input', function () {
    var q = this.value.toLowerCase().trim();
    document.querySelectorAll('#albums-grid .album-card').forEach(function (card) {
      card.style.display = card.dataset.title.indexOf(q) !== -1 ? '' : 'none';
    });
  });
</script>
@endsection
