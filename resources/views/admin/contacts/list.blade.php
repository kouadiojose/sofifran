@extends('layouts.admin')
@section('title', 'Nos contacts')
@section('link', 'contacts')

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

            <h1 class="m-0 text-dark">Nos contacts</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Nos contacts</li>

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

                <h2 class="card-title">Nos Contacts</h2>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  @if( $contacts->isNotEmpty() )

                  <table id="example1" class="table table-bordered table-striped">

                      <thead>

                        <tr>

                          <th class="text-center">N°</th>

                          <th class="text-center">Date</th>

                          <th class="text-center">Nom et Prenom(s)</th>

                          <th class="text-center">Email</th>

                          <th class="text-center">Phone</th>

                          <th class="text-center">Message</th>

                          <th class="text-center">Action</th>

                        </tr>

                      </thead>

                      <tbody>

                      

                      <?php $i = 1; ?>

                      @foreach( $contacts as $p )

                      <tr>

                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-center">{{ $p->created_at ? $p->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td class="text-center">{{ $p->name }}</td>
                        <td class="text-center"><a href="mailto:{{ $p->email }}">{{ $p->email }}</a></td>
                        <td class="text-center">{{ $p->phone }}</td>
                        <td>
                          {{ \Illuminate\Support\Str::limit($p->message, 80) }}
                          @if(mb_strlen($p->message) > 80)
                            <a href="javascript:;" data-toggle="modal" data-target="#view_message"
                               data-name="{{ $p->name }}" data-message="{{ $p->message }}">Lire tout</a>
                          @endif
                        </td>
                        <td class="text-center" style="white-space: nowrap;">
                          <a href="mailto:{{ $p->email }}?subject=Re: votre message à Sofifran" class="btn btn-info btn-sm" title="Répondre par email"><i class="fas fa-reply"></i></a>
                          <a href="javascript:;" data-toggle="modal" data-target="#del_contact" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"><i class="fas fa-trash"></i></a>
                        </td>

                      </tr>

                      @endforeach



                     

                    </tbody>

                  </table> 

                  @else

                  <div class="alert alert-info alert-dismissible">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    <h5><i class="icon fas fa-info"></i> Info!</h5>

                    Vous n'avez pas encore de nos contacts disponible.

                  </div>

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



    <!-- Modal : lecture du message complet -->
    <div class="modal fade" id="view_message" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Message de <span id="msg-name"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="msg-body" style="white-space: pre-line;"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal : suppression d'un message -->
    <div class="modal fade" id="del_contact" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Suppression du message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-contact-delete') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p>Voulez-vous supprimer ce message de contact ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-danger">Oui, supprimer</button>
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



    $("#del_contact").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        $(this).find('#id').val(button.data('id'));

    });

    $("#view_message").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        $(this).find('#msg-name').text(button.data('name'));
        $(this).find('#msg-body').text(button.data('message'));

    });

  });

</script>



@endsection