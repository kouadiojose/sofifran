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

          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-body py-2 d-flex align-items-center justify-content-between flex-wrap">
                <div class="flex-grow-1 mr-3" style="max-width: 420px;">
                  <input type="text" id="album-search" class="form-control" placeholder="🔍 Rechercher un album...">
                </div>
                <div>
                  <a href="{{ route('admin-galerie-create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter des photos</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" id="albums-grid">

          @forelse($albums as $a)
          <div class="col-lg-3 col-md-4 col-sm-6 album-card" data-title="{{ mb_strtolower($a->title_fr) }}">
            <div class="card">
              <a href="{{ route('admin-galerie-album', $a->id) }}">
                <img src="/frontend/assets/images/activites/{{ $a->image }}" class="card-img-top" alt="{{ $a->title_fr }}" style="height: 160px; object-fit: cover;">
              </a>
              <div class="card-body p-3">
                <h3 class="card-title d-block mb-2" style="font-size: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;" title="{{ $a->title_fr }}">
                  {{ $a->title_fr }}
                </h3>
                <div class="d-flex align-items-center justify-content-between">
                  <span class="badge {{ $a->photos_count > 0 ? 'badge-info' : 'badge-secondary' }}">
                    <i class="far fa-images"></i> {{ $a->photos_count }} photo(s)
                  </span>
                  <a href="{{ route('admin-galerie-album', $a->id) }}" class="btn btn-sm btn-outline-primary">
                    Ouvrir l'album <i class="fas fa-arrow-right"></i>
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
