@extends('layouts.admin')
@section('title', 'Activites')
@section('link', 'activite')

@section('style')
  <link rel="stylesheet" href="/admin/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')s
<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Création Activités</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Création Activités</li>

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

                <h2 class="card-title">Création Activités</h2>

                <a href="{{ route('admin-activite') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des Activités</a>

              </div>

              <!-- /.card-header -->



              

              @include('admin.activites.master._form')



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



  <script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>

  <script>

      $(function () {

        // Summernote

        $('#summernote_en').summernote();

        $('#summernote_fr').summernote();

      });

  </script>



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



          $("#type").change(function () {
         
         //console.log(" Change Etablissement ");

          $("#type option:selected").each(function () {

                var type = $("#type").val();

                if (type == 'autre') {
                  console.log('autre');
                  
                }else{
                  console.log('non autre');
                }
                return false;
              });

        })
      
        .trigger('change');


      });



      	// remove row

	    $(document).on('click', '#del', function () {

	        $(this).closest('#rowInput').remove();

	    });






  </script>

@endsection