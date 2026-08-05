@extends('layouts.admin')

@section('title', 'Les 3 blocs')
@section('link', 'bloc')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Les blocs de l'accueil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Les blocs de l'accueil</li>
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
                <h2 class="card-title">Editer Bloc</h2>
                <a href="{{ route('admin-bloc') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Voir les autres blocs</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <form action="{{ route('admin-bloc-edit-valide') }}" method="post">

                    {{ csrf_field() }}
                    <input type="hidden" name="bloc_id" value="{{ $bloc->id }}">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Titre en français *</label>
                          <input type="text" name="title_fr" class="form-control" value="{{ $bloc->title_fr }}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Titre en Anglais *</label>
                          <input type="text" name="title_en" class="form-control" required="required" value="{{ $bloc->title_en }}">
                        </div>                       
                      </div>   

                      <div class="col-md-6">                    
                        <div class="form-group">
                          <label>Libellé bouton en français *</label>
                          <input type="text" name="btn_name_fr" class="form-control" required="required" value="{{ $bloc->btn_name_fr }}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Libellé bouton en Anglais *</label>
                          <input type="text" name="btn_name_en" value="{{ $bloc->btn_name_en }}" class="form-control" required="required">
                        </div> 
                      </div> 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Lien du bouton *</label>
                          <input type="text" value="{{ $bloc->btn_link }}" name="btn_link" class="form-control" required="required">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Icon *</label>
                          <input type="text" value="{{ $bloc->icon }}" name="icon" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Description en français *</label>
                          <textarea name="description_fr" class="form-control" required="required" rows="5">{{ $bloc->description_fr }}</textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Description en Anglais *</label>
                          <textarea name="description_en" class="form-control" required="required" rows="5">{{ $bloc->description_en }}</textarea>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression du users</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" id="del" method="post">

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

  <div class="modal fade" id="change_password" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Changer mon mot de passe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-change-valide') }}" id="change" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="change_id" id="id">
            <div class="modal-body">


                  <div class="form-group">
                    <label>Ancien Mot de passe *</label>
                    <input type="password" name="old_password" class="form-control" required="required">
                  </div>
                  <div class="form-group">
                    <label>Nouveau Mot de passe *</label>
                    <input type="password" name="new_password" class="form-control" required="required">
                  </div>
                  <div class="form-group">
                    <label>Confirmer Nouveau Mot de passe *</label>
                    <input type="password" name="conf_password" class="form-control" required="required">
                  </div>


            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Changer</button>
            </div>
          </form>

        </div>
      </div>
  </div>

@endsection