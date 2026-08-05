@extends('layouts.admin')

@section('title', 'A propos de nous')
@section('link', 'apropos')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">A propos de nous</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">A propos de nous</li>
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
            <div class="alert alert-success">{{ session()->get('msg') }}</div>
          </div>
          @endif
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">A propos de nous</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <form action="{{ route('admin-apropos-edit') }}" method="post">

                  		{{ csrf_field() }}
                  		<input type="hidden" name="apropos_id" value="{{ $apropos->id }}">
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Nom Rubrique en Français</label>
                                  <input type="text" placeholder="Nom rubrique en Français" name="nom_fr" value="{{ $apropos->nom_fr }}" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Nom Rubrique en Anglais</label>
                                  <input type="text" placeholder="Nom rubrique en Anglais" name="nom_en" value="{{ $apropos->nom_en }}" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Titre en Français</label>
                                  <input type="text" value="{{ $apropos->title_fr }}" placeholder="Titre en Français" name="title_fr" class="form-control">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Titre en Anglais</label>
                                  <input type="text" value="{{ $apropos->title_en }}" placeholder="Titre en Anglais" name="title_en" class="form-control">
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Description en Français</label>
                                  <textarea rows="5" class="form-control" name="description_fr" placeholder="Une description en Français">{{ $apropos->description_fr }}</textarea>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Description en Anglais</label>
                                  <textarea rows="5" class="form-control" name="description_en" placeholder="Une description en Anglais">{{ $apropos->description_en }}</textarea>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label>Clé de la vidéo</label>
                                  <input type="text" class="form-control" name="cle_video" required="required" value="{{ $apropos->cle_video }}">
                              </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Valider</button>
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
    <!-- /.content -->

@endsection