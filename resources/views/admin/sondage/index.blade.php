@extends('layouts.admin')

@section('title', 'Sondage')
@section('link', 'sondage')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sondage</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Sondage</li>
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
              <div class="alert alert-success">
                {{session()->get('msg')}}
              </div>
          </div>
          @endif
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Sondage</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <form action="{{ route('admin-sondage-valide') }}" method="POST">

                    {{ csrf_field() }}
                    <input type="hidden" name="sondage_id" value="{{ $sondage->id }}">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Titre en français</label>
                            <input type="text" name="title_fr" class="form-control" value="{{ $sondage->title_fr }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Titre en Anglais</label>
                            <input type="text" name="title_en" class="form-control" value="{{ $sondage->title_en }}">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Contenu en français</label>
                            <textarea class="form-control" rows="5" name="description_fr">{{ $sondage->description_fr }}</textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Contenu en Anglais</label>
                            <textarea class="form-control" rows="5" name="description_en">{{ $sondage->description_en }}</textarea>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Lien</label>
                            <input type="text" name="link" class="form-control" value="{{ $sondage->link }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nom du Bouton en français</label>
                            <input type="text" name="btn_name_fr" class="form-control" value="{{ $sondage->btn_name_fr }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nom du Bouton en Anglais</label>
                            <input type="text" name="btn_name_en" class="form-control" value="{{ $sondage->btn_name_en }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <button class="btn btn-primary" type="submit">Editer</button>
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

    <div class="modal fade" id="del_project" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression du projet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-projet-delete') }}" id="del" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p> Voulez-vous supprimer cet projet ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" id="del" class="btn btn-primary">Oui</button>
            </div>
          </form>

        </div>
      </div>
    </div>

@endsection