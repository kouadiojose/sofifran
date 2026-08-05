@extends('layouts.admin')

@section('title', 'Galeries')

@section('link', 'galerie')



@section('style')
<link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Création galerie photos</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Création galerie photos</li>

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

                <h2 class="card-title">Création galerie photos</h2>

                <a href="{{ route('admin-galerie') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des galerie photos</a>

              </div>

              <!-- /.card-header -->



              

              @include('admin.galeries.master._form')



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
<script src="/admin/plugins/select2/js/select2.full.min.js"></script>

  <script type="text/javascript">

    $('.select2').select2();

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



  </script>

@endsection