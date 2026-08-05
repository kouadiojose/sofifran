@extends('layouts.admin')
@section('title', 'Galeries')
@section('link', 'galerie')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editer l'Activité</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Editer l'Activité</li>
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
                <h2 class="card-title">Editer l'Activités</h2>
                <a href="{{ route('admin-galerie') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des Activités</a>
              </div>
              <!-- /.card-header -->

              
              @include('admin.galeries.master._formEdit')

            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('js')

  <script type="text/javascript">
    
      $(document).ready(function(){


          $('#add').click(function(){

            var html = '';
            html += '<div class="row" id="rowInput">';
            html += '<div class="col-md-8"><div class="form-group"><label for="img">Ajouter une vidéo *</label><input type="text" class="form-control" name="videos[]" placeholder="https://www.youtube.com/embed/tkwVg47D4m4"></div></div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group"><label> &nbsp; </label> <br><button type="button" class="btn-danger btn" id="del">Supprimer</button></div></div></div>';

            $('#new_input').append(html);
            
          });

      });

        // remove row
      $(document).on('click', '#del', function () {
          $(this).closest('#rowInput').remove();
      });


      $(document).ready(function(){
        $("#del_sous_galerie").on('show.bs.modal', function(e){
              var button = $(e.relatedTarget);
              var id = button.data('id');
              var modal = $(this);

              modal.find('#id').val(id);
          });

      });
      
  </script>
@endsection