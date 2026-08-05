@extends('layouts.admin')

@section('title', 'Role')
@section('link', 'role')

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
            <h1 class="m-0 text-dark">Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Roles</li>
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
          @if( session()->has('msg_error') )
          <div class="col-md-12">
            <div class="alert alert-danger">{{ session()->get('msg_error') }}</div>
          </div>
          @endif
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Créer un role</h2>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <form action="{{ route('admin-valid-role') }}" method="post">

                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Admin" required="required">
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea rows="5" name="description" placeholder="Description..." class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Créer</button>
                    </div>
                  </form>

              </div>
            </div>
          </div>
          <!-- /.col -->

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Liste roles</h2>
                <a href="{{ route('admin-permission') }}" class="btn btn-primary float-right"> <i class="fa fa-pencil-alt"></i> Permissions</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table class="table table-bordered" id="example1">
                    <thead>
                      <th>N°</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      @php
                      $i = 1;
                      @endphp

                      @foreach( $roles as $r )
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $r->name }}</td>
                        <td>{{ $r->description }}</td>
                        <td width="150" align="center">
                          <a href="{{ route('admin-edit-role', $r->id) }}" class="btn btn-secondary btn-sm" title="Modifier"><i class="fa fa-pencil-alt"></i></a>
                          <a href="javascript();" title="Supprimer" data-toggle="modal" data-target="#del_role" data-id="{{ $r->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  <div class="modal fade" id="del_role" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-user-del-role-valide') }}" id="del" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p> Voulez-vous supprimer cet role ? </p>
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

    $("#del_role").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        modal.find('#id').val(id);
    });

  });
</script>

@endsection