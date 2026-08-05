@extends('layouts.admin')

@section('title', 'Inscriptions')
@section('link', 'inscription')

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
            <h1 class="m-0 text-dark">Liste des inscrits</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Liste des inscrits</li>
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
                <h2 class="card-title">Liste des inscrits de 13 - 15</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <div class="table-responsive">
                      <table class="table table-bordered" id="example1">
                          <thead>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom(s)</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Ville</th>
                            <th>Province</th>
                            <th>Code Postal</th>
                            <th>Age</th>
                            <th>Adresse Complète</th>
                          </thead>
                          <tbody>
                            
                              @php
                                $i = 1;
                              @endphp
                              @foreach( $inscrits as $ins )

                              @if( $ins->age >= 13 && $ins->age <= 15 )
                              <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $ins->nom }}</td>
                                  <td>{{ $ins->prenom }}</td>
                                  <td>{{ $ins->email }}</td>
                                  <td>{{ $ins->telephone }}</td>
                                  <td>{{ $ins->ville }}</td>
                                  <td>{{ $ins->province }}</td>
                                  <td>{{ $ins->code_postal }}</td>
                                  <td>{{ $ins->age }}</td>
                                  <td>{{ $ins->adresse_complete }}</td>
                                  
                              </tr>
                              @endif

                              @endforeach

                          </tbody>
                      </table>
                  </div>

              </div>
            </div>
          </div>
          <!-- /.col -->

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Liste des inscrits de 16 - 18</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <div class="table-responsive">
                      <table class="table table-bordered" id="example1">
                          <thead>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom(s)</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Ville</th>
                            <th>Province</th>
                            <th>Code Postal</th>
                            <th>Age</th>
                            <th>Adresse Complète</th>
                          </thead>
                          <tbody>
                            
                              @php
                                $i = 1;
                              @endphp
                              @foreach( $inscrits as $ins )
                              @if( $ins->age >= 16 && $ins->age <= 18 )
                              <tr>
                                  <td>{{ $i++ }}</td>
                                  <td>{{ $ins->nom }}</td>
                                  <td>{{ $ins->prenom }}</td>
                                  <td>{{ $ins->email }}</td>
                                  <td>{{ $ins->telephone }}</td>
                                  <td>{{ $ins->ville }}</td>
                                  <td>{{ $ins->province }}</td>
                                  <td>{{ $ins->code_postal }}</td>
                                  <td>{{ $ins->age }}</td>
                                  <td>{{ $ins->adresse_complete }}</td>
                                  
                              </tr>
                              @endif
                              @endforeach

                          </tbody>
                      </table>
                  </div>

              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

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

  });
</script>

@endsection