@extends('layouts.admin')

@section('title', 'Modifier la catégorie')
@section('link', 'categorie')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modifier la catégorie</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin-categorie') }}">Catégories</a></li>
              <li class="breadcrumb-item active">Modifier</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $categorie->titre_fr }}</h3>
              </div>

              <form method="POST" action="{{ route('admin-categorie-edit-valid') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="categorie_id" value="{{ $categorie->id }}">

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Titre en français *</label>
                        <input type="text" class="form-control" name="titre_fr" value="{{ old('titre_fr', $categorie->titre_fr) }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Titre en anglais *</label>
                        <input type="text" class="form-control" name="titre_en" value="{{ old('titre_en', $categorie->titre_en) }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Description en français *</label>
                        <textarea class="form-control" name="description_fr" rows="5" required>{{ old('description_fr', $categorie->description_fr) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Description en anglais *</label>
                        <textarea class="form-control" name="description_en" rows="5" required>{{ old('description_en', $categorie->description_en) }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nouvelle image</label>
                        <input type="file" name="image" accept="image/*" class="form-control">
                        <small class="text-muted">Laisser vide pour conserver l'image actuelle.</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Image actuelle</label><br>
                        <img src="/frontend/assets/images/activites/categories/{{ $categorie->image }}" alt="{{ $categorie->titre_fr }}" width="200">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Modifier</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /.content -->

@endsection
