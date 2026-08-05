@extends('layouts.admin')



@section('title', 'Activités')

@section('link', 'activite')



@section('style')

    <!-- DataTables -->

  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



@endsection



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Nos Activités</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Activités</li>

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

          <!--<div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Bloc activités</h2>

              </div>

              

              <div class="card-body">

                  <form action="{{ route('admin-edit-headeractivite') }}" method="post" enctype="multipart/form-data">



                      {{ csrf_field() }}

                      <input type="hidden" name="activite_id" value="{{ $headerActivite->id }}">

                      <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">

                              <input type="hidden" class="form-control" value="{{ $headerActivite->image }}" name="img_up">

                              <img src="/assets/images/resource/{{ $headerActivite->image }}" width="250">

                            </div>

                        </div>



                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Changer l'image</label>

                              <input type="file" class="form-control" name="img">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Clé de la vidéo</label>

                              <input type="text" value="{{ $headerActivite->cle_video }}" class="form-control" name="cle_video">

                            </div>

                        </div>



                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Nom en français</label>

                              <input type="text" value="{{ $headerActivite->nom_fr }}" class="form-control" name="nom_fr">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Nom en Anglais</label>

                              <input type="text" value="{{ $headerActivite->nom_en }}" class="form-control" name="nom_en">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en français</label>

                              <input type="text" value="{{ $headerActivite->title_fr }}" class="form-control" name="title_fr">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Anglais</label>

                              <input type="text" value="{{ $headerActivite->title_en }}" class="form-control" name="title_en">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                              <button type="submit" class="btn-primary btn">Editer</button>

                            </div>

                        </div>

                      </div>

                      

                  </form>

              </div>

            </div>

          </div>-->

          

          <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Liste de Nos Activités</h2>

                <a href="{{ route('admin-activite-create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer un nouveau</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  @include('admin.activites.master._table')

              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->



    <div class="modal fade" id="del_galerie" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de l'Activé</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-activite-delete') }}" id="del" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cette Activé ? </p>

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



@section('js')

<!-- DataTables  & Plugins -->

<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="/admin/plugins/jszip/jszip.min.js"></script>

<script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>

<script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>

<script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



<script>



  $(function () {



    $("#example1").DataTable({

      "responsive": true, "lengthChange": false, "autoWidth": false,

      "buttons": ["copy", "excel"]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false,

      "responsive": true,

    });



    $("#del_galerie").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });



  });

</script>



@endsection