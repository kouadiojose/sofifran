@extends('layouts.admin')

@section('title', 'Infolettre')
@section('link', 'infolettre')

@section('style')
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">

@endsection

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Composer un email</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Composer un email</li>
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
          <div class="col-md-3">
            <a href="{{ route('admin-infolettre') }}" class="btn btn-primary btn-block mb-3">Liste des Emails</a>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Dossiers</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-envelope"></i> Envoyés
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-trash-alt"></i> Corbeille
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Composer Nouveau Message</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{ route('admin-infolettre-create-valide') }}" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  {{ csrf_field() }}
                <div class="form-group">
                  <select name="type_send" id="type_send" class="form-control">
                    <option value="individuel">Email Individuel</option>
                    <option value="groupe">Email Groupé</option>
                  </select>
                </div>
                <div class="form-group" id="chp_individuel">
                  <input class="form-control" type="email" name="to" placeholder="A: adresse@email.com">
                </div>
                <div class="form-group" id="chp_groupe" style="display: none;">
                  <select class="select2 form-control" multiple="multiple" data-placeholder="Selectionner au moins un email" name="mailgroupe[]" style="width: 100%;">
                    @foreach( $infolettre as $i )
                    <option value="{{ $i->email }}">{{ $i->email }}</option>
                    @endforeach
                  </select>

                </div>

                <div class="form-group">
                  <input class="form-control" type="text" required="required" name="sujet" placeholder="Sujet:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="contenu" class="form-control" style="height: 300px"></textarea>
                </div>
                <div class="form-group">
                  <label>Attacher un fichier (Max. 32MB)</label>
                  <input type="file" class="form-control" name="attachment">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Annuler</button>
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Envoyer le message</button>
                </div>
              </div>
              <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('js')
<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/admin/plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {

    $('.select2').select2();
    $('#compose-textarea').summernote();

    //Selection des choix

    $('#type_send').change(function(){

        $('#type_send option:selected').each(function(){
            
            var type = $('#type_send').val();
            if( type == 'individuel' ){

              $('#chp_individuel_default').hide();
              $('#chp_individuel').show();
              $('#chp_groupe').hide();

            }else if( type == 'groupe' ){

              $('#chp_individuel_default').hide();
              $('#chp_individuel').hide();
              $('#chp_groupe').show();

            }else{

              $('#chp_individuel_default').show();
              $('#chp_individuel').hide();
              $('#chp_groupe').hide();

            }
        });
    });
  })
</script>

@endsection