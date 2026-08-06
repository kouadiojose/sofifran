@extends('layouts.admin')

@section('title', 'Album — ' . $album->title_fr)
@section('link', 'galerie')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">
              Album : {{ $album->title_fr }}
              <small class="text-muted">— {{ $album->photos_count }} photo(s)</small>
            </h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin-galerie') }}">Galerie photos</a></li>
              <li class="breadcrumb-item active">Album</li>
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

          @if ($errors->any())
          <div class="col-md-12">
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
          @endif

          <!-- Ajout rapide de photos dans CET album -->
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-upload"></i> Ajouter des photos à cet album</h3>
                <div class="card-tools">
                  <a href="{{ route('admin-galerie') }}" class="btn btn-default btn-sm">
                    <i class="fa fa-arrow-left"></i> Tous les albums
                  </a>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('admin-galerie-valid') }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" name="activite" value="{{ $album->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="custom-file">
                        <input type="file" name="photos[]" id="photos-input" class="custom-file-input" accept="image/*" multiple required>
                        <label class="custom-file-label" for="photos-input" id="photos-label">Choisir des photos...</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload"></i> Ajouter à cet album
                      </button>
                    </div>
                  </div>
                  <small class="text-muted d-block mt-2">
                    Vous pouvez sélectionner plusieurs photos à la fois (jpg, png, webp).
                    Limites du serveur : {{ round($maxFileBytes / 1048576) }} Mo par photo,
                    {{ round($maxPostBytes / 1048576) }} Mo par envoi au total.
                  </small>
                  <small id="upload-warning" class="text-danger d-none d-block mt-1"></small>
                </form>
              </div>
            </div>
          </div>

          <!-- Grille des photos de l'album -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-images"></i> Photos de l'album</h3>
                <div class="card-tools">
                  <span class="badge badge-info">{{ $album->photos_count }} photo(s)</span>
                </div>
              </div>
              <div class="card-body">
                <div class="row">

                  @forelse($photos as $p)
                  <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 mb-0">
                      <a href="/frontend/assets/images/gallery/photos/{{ $p->image }}" target="_blank" title="Voir en taille réelle">
                        <img src="/frontend/assets/images/gallery/photos/{{ $p->image }}" class="card-img-top" alt="Photo de l'album" style="height: 180px; object-fit: cover;">
                      </a>
                      <div class="card-body p-2">
                        <div class="d-flex justify-content-between align-items-center">
                          <small class="text-muted">{{ $p->created_at ? date('d/m/Y', strtotime($p->created_at)) : '' }}</small>
                          <div class="btn-group">
                            <a href="{{ route('admin-galerie-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier / déplacer vers un autre album"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:;" data-toggle="modal" data-target="#del_photo" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"><i class="fas fa-trash"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @empty
                  <div class="col-12">
                    <div class="alert alert-info mb-0">
                      Cet album est vide. Utilisez le formulaire ci-dessus pour y ajouter des photos.
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

    <!-- Modal de suppression -->
    <div class="modal fade" id="del_photo" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="delPhotoTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="delPhotoTitle">Suppression de la photo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-galerie-delete') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p>Voulez-vous supprimer cette photo de l'album ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-danger">Oui, supprimer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@section('js')
<script>
  $(function () {
    // Recupere l'id de la photo pour la modal de suppression.
    $('#del_photo').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      $(this).find('#id').val(button.data('id'));
    });

    // Affiche le nombre de fichiers selectionnes et verifie le poids total
    // AVANT l'envoi, pour eviter le rejet PHP (PostTooLargeException).
    var MAX_POST = {{ $maxPostBytes }};   // post_max_size
    var MAX_FILE = {{ $maxFileBytes }};   // upload_max_filesize
    var MARGIN   = 1024 * 512;            // marge pour les entetes du formulaire

    $('#photos-input').on('change', function () {
      var files = this.files;
      var total = 0, tooBig = [];

      for (var i = 0; i < files.length; i++) {
        total += files[i].size;
        if (files[i].size > MAX_FILE) tooBig.push(files[i].name);
      }

      var totalMo = (total / 1048576).toFixed(1);
      $('#photos-label').text(files.length > 0
        ? files.length + ' photo(s) — ' + totalMo + ' Mo'
        : 'Choisir des photos...');

      var warning = '';
      if (tooBig.length) {
        warning = 'Photo(s) trop lourde(s) (max ' + Math.round(MAX_FILE / 1048576) + ' Mo) : ' + tooBig.join(', ');
      } else if (total + MARGIN > MAX_POST) {
        warning = 'Poids total (' + totalMo + ' Mo) supérieur à la limite du serveur ('
          + Math.round(MAX_POST / 1048576) + ' Mo par envoi). Envoyez les photos en plusieurs fois.';
      }

      $('#upload-warning').text(warning).toggleClass('d-none', warning === '');
      $(this).closest('form').find('button[type=submit]').prop('disabled', warning !== '');
    });
  });
</script>
@endsection
