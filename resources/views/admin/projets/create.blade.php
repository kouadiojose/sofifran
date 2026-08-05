@extends('layouts.admin')



@section('title', 'Projets')



@section('style')
  <link rel="stylesheet" href="/admin/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('link', 'projet')









@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Création de projet</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Création de projet</li>

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

          	<div class="alert alert-success alert-dismissible">

							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

							<h5><i class="icon fas fa-check"></i> Bravo!</h5>

							{{ session()->get('msg') }}

						</div>

          </div>

          @endif 



          @if( session()->has('msg_error') )

          <div class="col-md-12">

          	<div class="alert alert-danger alert-dismissible">

						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

						  <h5><i class="icon fas fa-ban"></i> Attention!</h5>

						  {{ session()->get('msg_error') }}

						</div>

          </div>

          @endif



          <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Création de projet</h2>

                <a href="{{ route('admin-projet') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des projets</a>

              </div>

              <!-- /.card-header -->



              

              @include('admin.projets.master._form')



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



  <script type="text/javascript">

    /*

   	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    $(document).ready( function(){

        

        $.validator.setDefaults({

		    submitHandler: function () {

	    		  var form_action = $("#formSelect").attr("action");

		          var titre = $("#titre").val();

		          var soustitre = $("#sous_titre").val();

		          var description = $("#description").val();

		          var objectif = $("#objectif").val();

		          var customFile = $("#img_project").val();



		          $.ajax({

			          dataType: 'json',

			          type:'POST',

			          url: form_action,

			          data:{titre:titre, sous_titre:soustitre, objectif:objectif, image:customFile, description:description}

			      }).done(function(data){



			          toastr.success('Projet posté avec succès!', 'Success Alert', {timeOut: 3000});

			          

			          $("#titre").val("");

			          $("#sous_titre").val("");

			          $("#description").val("");

			          $("#objectif").val("");

			          $("#img_project").val("");

			          $("#img_project").val("");

			          

			      });



		    }

		  });



        $('#formSelect').validate({

		    rules: {

		      titre: {

		        required: true

		      },

		      sous_titre: {

		        required: true

		      },

		      objectif: {

		        required: true

		      },

		      description: {

		        required: true

		      },

		    },

		    messages: {

		      titre: {

		        required: "Veuillez entrer le titre du projet",

		      },

		      sous_titre: {

		        required: "Veuillez entrer le sous titre du projet",

		      },

		      objectif: {

		        required: "Veuillez entrer l'objectif du projet",

		      },

		      description: {

		        required: "Veuillez entrer la description du projet",

		      }

		    },

		    errorElement: 'span',

		    errorPlacement: function (error, element) {

		      error.addClass('invalid-feedback');

		      element.closest('.form-group').append(error);

		    },

		    highlight: function (element, errorClass, validClass) {

		      $(element).addClass('is-invalid');

		    },

		    unhighlight: function (element, errorClass, validClass) {

		      $(element).removeClass('is-invalid');

		    }

		  });

    });

    */



  </script>

@endsection