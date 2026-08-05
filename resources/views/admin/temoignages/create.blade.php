@extends('layouts.admin')

@section('title', 'Témoignages')

@section('style')
  <link rel="stylesheet" href="/admin/plugins/toastr/toastr.min.css">
@endsection
@section('link', 'temoignage')




@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Création de témoignage</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Création de témoignage</li>
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
                <h2 class="card-title">Création de témoignage</h2>
                <a href="{{ route('admin-temoignage') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des témoignages</a>
              </div>
              <!-- /.card-header -->

              @include('admin.temoignages.master._form')

            </div>
          </div>
         
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
  <script type="text/javascript">
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready( function(){
        
        /* Create new Post */
        $("#createProject").click(function(e) {
          e.preventDefault();

          
          var form_action = $("#form").attr("action");
          var titre = $("#titre").val();
          var soustitre = $("#soustitre").val();
          var description = $("#description").val();
          var objectif = $("#objectif").val();
          var customFile = $("#customFile").val();

          $.ajax({
              dataType: 'json',
              type:'POST',
              url: form_action,
              data:{titre:titre, sous_titre:soustitre, objectif:objectif, description:description}
          }).done(function(data){

              toastr.success('Projet posté avec succès!', 'Success Alert', {timeOut: 3000});
              
              $("#titre").val("");
              $("#soustitre").val("");
              $("#description").val("");
              $("#objectif").val("");
              $("#customFile").val("");
              
          });

        });

        //console.log('ok Ajax');
    });
  </script>
@endsection