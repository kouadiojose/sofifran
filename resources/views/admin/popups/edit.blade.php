@extends('layouts.admin')

@section('title', 'Popup')
@section('link', 'popup')
@section('open', 'popup')
@section('sous_link', 'popup')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edition d'un Popup</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Edition d'un Popup</li>
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
          @if( session()->has('msg') )
          <div class="col-md-12">
            <div class="alert alert-info">{{ session()->get('msg') }}</div>
          </div>
          @endif
          @if( session()->has('msg_del') )
          <div class="col-md-12">
            <div class="alert alert-danger">{{ session()->get('msg_del') }}</div>
          </div>
          @endif
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Edition d'un Popup</h2>

            
                <a href="{{ route('admin-popups') }}" style="" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des popups</a>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                  <form method="POST" action="{{ route('admin-popups-edit-valide') }}"  enctype="multipart/form-data">

                      {{ csrf_field() }}
                      <input type="hidden" name="popup_id" value="{{ $popup->id }}">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Titre *</label>
                                <input type="text" value="{{ $popup->titre }}" class="form-control" name="titre" required="required">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Commence le *</label>
                                <input type="date" value="{{ $popup->start }}" class="form-control" name="start" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fini le *</label>
                                <input type="date" value="{{ $popup->end }}" class="form-control" name="end" required="required">
                            </div>
                        </div>
                          
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contenu</label>
                                <textarea class="form-control" rows="5" name="contenu"><?php if (isset($popup->contenu)): ?>{{ $popup->contenu }}<?php endif ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lien du contenu complet (bouton « Je continue »)</label>
                                <input type="url" class="form-control" name="link" id="popup-link" value="{{ old('link', $popup->link) }}" placeholder="https://... ou choisir à droite">
                                <small class="text-muted">Laisser vide pour renvoyer vers la page Infolettres.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ou choisir une page / un article du site</label>
                                <select class="form-control" id="popup-link-picker">
                                    <option value="">— Sélectionner pour remplir le lien —</option>
                                    @foreach($linkTargets as $groupe => $items)
                                    <optgroup label="{{ $groupe }}">
                                        @foreach($items as $url => $label)
                                        <option value="{{ $url }}" {{ $popup->link == $url ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <?php if ( isset($popup->image) ): ?>
                          <div class="col-md-12">
                            <div class="form-group">
                                <img src="/frontend/assets/images/popups/{{ $popup->image }}" width="80">
                                <input type="hidden" value="{{ $popup->end }}" name="img_up">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Changer l'image si necessaire</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                        </div>
                      <?php else: ?>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ajouter une image si necessaire</label>
                                <input type="file" class="form-control" name="img">
                            </div>
                        </div>
                        <?php endif ?>
                        

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Editer</button>
                            </div>
                        </div>
                      </div>
                  </form>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content 
   -->


@endsection

@section('js')
<script>
  document.getElementById('popup-link-picker').addEventListener('change', function () {
    if (this.value) {
      document.getElementById('popup-link').value = this.value;
    }
  });
</script>
@endsection