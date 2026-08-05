@extends('layouts.admin')
@section('title', 'Liste')
@section('link', 'atelier')

@section('style')

  <!-- DataTables -->
  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">

@endsection



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> Liste</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Liste</li>

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

                <h2 class="card-title">Liste</h2>

                <a href="{{ route('admin-atelier') }}" class="btn btn-secondary float-right"> <i class="fa fa-eye"></i> Voir calendrier</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  @if( $calendar->isNotEmpty() )



                  <table id="example1" class="table table-bordered table-striped">

                      <thead>

                        <tr>

                          <th>N°</th>

                          <th>Titre en francais</th>

                          <th>Titre en anglais</th>

                          <th>Début</th>

                          <th>Fin</th>

                          <th>Action</th>

                        </tr>

                      </thead>

                      <tbody>

                      

                      <?php $i = 1; ?>

                      @foreach( $calendar as $c )

                      <tr>

                        <td>{{ $i++ }}</td>

                        <td align="center">{{ $c->title_fr }}</td>

                        <td align="center">{{ $c->title_en }}</td>

                        <td align="center">{{ date('d/m/Y', strtotime($c->start)) }} à {{ date('H:s', strtotime($c->hour_start)) }}</td>

                        <td align="center">{{ date('d/m/Y', strtotime($c->end)) }} à {{ date('H:s', strtotime($c->hour_end)) }}</td>

                        <td width="100" align="center">

                          <a href="{{ route('admin-atelier-edit', $c->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>

                          <a href="javascript();" data-toggle="modal" data-target="#del_atelier" data-id="{{ $c->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>

                        </td>

                      </tr>

                      @endforeach





                    </tbody>

                  </table>    

                  @else

                  <p>

                    Pas de blog disponible en ce moment!

                  </p>

                  @endif



              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->

    <div class="modal fade" id="edit_atelier" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Modification de l'atelier</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="#" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="edit_id" id="id">



            

            <div class="modal-body">

              

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Titre Evènement en Français *</label>

                    <input type="text" name="title_fr" required="required" id="title_fr" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Titre Evènement en Anglais *</label>

                    <input type="text" name="title_en" required="required" id="title_en" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Début *</label>

                    <input type="date" name="start" required="required" id="start" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Fin *</label>

                    <input type="date" name="end" required="required" id="end" class="form-control">

                  </div>

                </div>

                <div class="col-md-12">

                  <div class="form-group">

                    <label>Description en Français</label>

                    <textarea name="description_fr" rows="5" id="description_fr" class="form-control"></textarea>

                  </div>

                </div>

                <div class="col-md-12">

                  <div class="form-group">

                    <label>Description en Anglais</label>

                    <textarea name="description_en" rows="5" id="description_en" class="form-control"></textarea>

                  </div>

                </div>



                <div class="col-md-12">

                  <div class="form-group">

                    <label>Couleur Evènement *</label>

                    <select class="form-control" name="color" id="color" required="required">

                      <option value="#dc3545">Rouge</option>

                      <option value="#007bff">Bleu</option>

                      <option value="#ffc107">Jaune</option>

                      <option value="#28a745">Vert</option>

                      <option value="#0b0001">Noir</option>

                    </select>

                  </div>

                </div>

              </div>



            </div>

            <div class="modal-footer">

              <button type="submit" class="btn btn-primary">Editer</button>

            </div>

          </form>



        </div>

      </div>

    </div>



    <div class="modal fade" id="del_atelier" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de l'atelier</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-atelier-delete') }}" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cet atelier ? </p>

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



<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>



<script>



  $(function () {



  	//$('#description_fr').summernote();

  	//$('#description_en').summernote();



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



    $("#del_atelier").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });



    $("#edit_atelier").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var title_fr = button.data('title_fr');

        var title_en = button.data('title_en');

        var description_fr = button.data('description_fr');

        var description_en = button.data('description_en');

        var start = button.data('start');

        var end = button.data('end');

        var color = button.data('color');

        var modal = $(this);



        modal.find('#id').val(id);

        modal.find('#title_fr').val(title_fr);

        modal.find('#title_en').val(title_en);

        modal.find('#description_fr').val(description_fr);

        modal.find('#description_en').val(description_en);

        modal.find('#start').val(start);

        modal.find('#end').val(end);

        modal.find('#color').val(color);

    });



  });

</script>



@endsection