@extends('layouts.admin')

@section('title', 'Projets')

@section('link', 'projet')


@section('style')
  <link rel="stylesheet" href="/admin/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-pencil-alt"></i> Editer projet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Editer de projet</li>
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
                <h2 class="card-title">Editer du projet</h2>
                <a href="{{ route('admin-projet') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des projets</a>
              </div>
              <!-- /.card-header -->

              
              @include('admin.projets.master._edit_form')

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

  <script src="/admin/plugins/toastr/toastr.min.js"></script>
  <script src="/admin/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="/admin/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>
  <script>
      $(function () {
        // Summernote
        $('#summernote_en').summernote();
        $('#summernote_fr').summernote();
      });
  </script>
  
  <script>
      $('#del').on('show.bs.modal', function (e) {
        const id = $(e.relatedTarget).data('id');
        $('#del_id').val(id);
      });
  </script>

@endsection