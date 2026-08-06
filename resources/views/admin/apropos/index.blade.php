@extends('layouts.admin')

@section('title', 'A propos de nous')
@section('link', 'apropos')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Page « Qui sommes-nous ? »</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">A propos</li>
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

          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-edit"></i> Contenu de la page — chaque section correspond à un bloc de la page publique</h3>
                <div class="card-tools">
                  <a href="{{ route('about') }}" target="_blank" class="btn btn-default btn-sm"><i class="fas fa-external-link-alt"></i> Voir la page</a>
                </div>
              </div>

              <form method="POST" action="{{ route('admin-apropos-edit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="apropos_id" value="{{ $apropos->id }}">

                <div class="card-body">

                  <h5 class="text-primary border-bottom pb-2">Bloc d'introduction</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Titre (FR)</label>
                        <input type="text" class="form-control" name="experience_fr" value="{{ old('experience_fr', $apropos->experience_fr) }}" placeholder="Plus de 15 ans d'expérience">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Titre (EN)</label>
                        <input type="text" class="form-control" name="experience_en" value="{{ old('experience_en', $apropos->experience_en) }}" placeholder="Over 15 years experience">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Texte d'introduction (FR)</label>
                        <textarea rows="6" class="form-control" name="intro_fr">{{ old('intro_fr', $apropos->intro_fr) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Texte d'introduction (EN)</label>
                        <textarea rows="6" class="form-control" name="intro_en">{{ old('intro_en', $apropos->intro_en) }}</textarea>
                      </div>
                    </div>
                  </div>

                  <h5 class="text-primary border-bottom pb-2 mt-4">Images de la page</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Image d'introduction</label><br>
                        <img src="{{ $apropos->imageUrl('image_intro', '/frontend/assets/images/resource/about_who.jpg') }}" width="100%" style="max-width: 260px; border-radius: 8px;" class="mb-2"><br>
                        <input type="file" name="image_intro" accept="image/*" class="form-control">
                        <small class="text-muted">Laisser vide pour conserver l'image actuelle.</small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Image de la Mission</label><br>
                        <img src="{{ $apropos->imageUrl('image_mission', '/frontend/assets/images/resource/mission.jpg') }}" width="100%" style="max-width: 260px; border-radius: 8px;" class="mb-2"><br>
                        <input type="file" name="image_mission" accept="image/*" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Image du Mandat</label><br>
                        <img src="{{ $apropos->imageUrl('image_mandat', '/frontend/assets/images/resource/mandat.jpg') }}" width="100%" style="max-width: 260px; border-radius: 8px;" class="mb-2"><br>
                        <input type="file" name="image_mandat" accept="image/*" class="form-control">
                      </div>
                    </div>
                  </div>

                  <h5 class="text-primary border-bottom pb-2 mt-4">Notre Historique</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Historique (FR)</label>
                        <textarea rows="10" class="form-control" name="historique_fr">{{ old('historique_fr', $apropos->historique_fr) }}</textarea>
                        <small class="text-muted">Une ligne vide crée un nouveau paragraphe.</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Historique (EN)</label>
                        <textarea rows="10" class="form-control" name="historique_en">{{ old('historique_en', $apropos->historique_en) }}</textarea>
                      </div>
                    </div>
                  </div>

                  <h5 class="text-primary border-bottom pb-2 mt-4">Notre Mission</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mission (FR)</label>
                        <textarea rows="5" class="form-control" name="mission_fr">{{ old('mission_fr', $apropos->mission_fr) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mission (EN)</label>
                        <textarea rows="5" class="form-control" name="mission_en">{{ old('mission_en', $apropos->mission_en) }}</textarea>
                      </div>
                    </div>
                  </div>

                  <h5 class="text-primary border-bottom pb-2 mt-4">Mandat</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mandat (FR)</label>
                        <textarea rows="5" class="form-control" name="mandat_fr">{{ old('mandat_fr', $apropos->mandat_fr) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mandat (EN)</label>
                        <textarea rows="5" class="form-control" name="mandat_en">{{ old('mandat_en', $apropos->mandat_en) }}</textarea>
                      </div>
                    </div>
                  </div>

                  <h5 class="text-primary border-bottom pb-2 mt-4">Nos Objectifs</h5>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Objectifs (FR)</label>
                        <textarea rows="8" class="form-control" name="objectifs_fr">{{ old('objectifs_fr', $apropos->objectifs_fr) }}</textarea>
                        <small class="text-muted">Un objectif par ligne — chaque ligne devient une puce avec son icône sur la page.</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Objectifs (EN)</label>
                        <textarea rows="8" class="form-control" name="objectifs_en">{{ old('objectifs_en', $apropos->objectifs_en) }}</textarea>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer les modifications</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /.content -->

@endsection
