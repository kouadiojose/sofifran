@extends('layouts.admin')

@section('title', 'Detail Projets')
@section('link', 'projet')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Détails du projet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Détails du projet</li>
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

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Image du projet</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <img width="100%" class="" src="/frontend/assets/images/projects/{{ $post->image }}">
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin-projet') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des projets</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h2>{{ $post->titre_fr }} </h2>
                  <p>
                    <?= $post->description_fr; ?>
                  </p>

                  <hr>
                  <h2>{{ $post->titre_en }} </h2>
                  <p>
                    <?= $post->description_en; ?>
                  </p>
              </div>

              <div class="card-footer">
                @if( $post->ended == 'no' )
                  <a href="javascript();" data-toggle="modal" data-target="#ended_project" data-id="{{ $post->id }}" class="btn btn-secondary btn" title="Terminer le projet"> <i class="fas fa-check"></i> Terminer le projet ?</a>
                @else
                  <a class="btn btn-success" title="Terminer le projet"> <i class="fas fa-check"></i> Ce projet est deja terminé</a>
                @endif
                <a href="{{ route('admin-projet-edit', $post->id) }}" class="btn btn-info btn" title="Modifier"> <i class="fas fa-pencil-alt"></i> Modifier</a>
                <a href="javascript();" data-toggle="modal" data-target="#del_project" data-id="{{ $post->id }}" class="btn btn-danger" title="Supprimer"> <i class="fas fa-trash"></i> Supprimer</a>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression du projet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-projet-delete') }}" id="del" method="post">

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

    <div class="modal fade" id="ended_project" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Mettre fin au projet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-projet-ended') }}" id="ended" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="ended_id" id="id">
            <div class="modal-body">
              <p> Voulez-vous vraiment terminer cet projet ? <br> <span style="color: #ff0000;">Nous vous rappellons que cette action n'est pas irreversible!</span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" id="ended" class="btn btn-primary">Oui</button>
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

    $("#del_project").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        modal.find('#id').val(id);
    });

    $("#ended_project").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        modal.find('#id').val(id);
    });

  });
</script>

@endsection