@extends('layouts.admin')



@section('title', 'Publication')

@section('link', 'publication')



@section('style')

    <!-- DataTables -->

  <link rel="stylesheet" href="/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



@endsection



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Publication</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Publication</li>

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

            <div class="alert alert-info">{{ session()->get('msg') }}</div>

          </div>

          @endif

          @if( session()->has('msg_del') )

          <div class="col-md-12">

            <div class="alert alert-danger">{{ session()->get('msg_del') }}</div>

          </div>

          @endif

          <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Publication</h2>



            

                <a href="{{ route('admin-publication-create') }}" style="" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer une publication</a>

                

              </div>

              <!-- /.card-header -->

              <div class="card-body">



                  <div class="table-responsive">

                      @if( $pubs->isNotEmpty() )

                      <table class="table table-bordered" id="example1">

                          <thead>

                              <th>N°</th>
                              <th>Type</th>

                              <th>Fichier</th>
                              <th>Titre en francais</th>
                              <th>Titre en anglais</th>
                              <th>Date de publication</th>

                              <th>Action</th>

                          </thead>

                          <tbody>



                            @php

                              $i = 1;

                            @endphp



                            @foreach( $pubs as $p )

                            <tr>

                              <td>{{ $i++ }}</td>
                              <td><span class="badge badge-info">{{ $p->type_label }}</span></td>
                              <td><a href="{{ $p->doc_url }}" target="_blank">{{ \Illuminate\Support\Str::limit(basename($p->doc), 40) }}</a></td>
                              <td>{{ $p->titre_fr }}</td>
                              <td>{{ $p->titre_en }}</td>
                              <td>{{ date('d m Y', strtotime($p->date_pub)) }}</td>


                              <td>
                                  <a href="{{ route('admin-publication-edit', $p->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                  <a href="javascript();" data-toggle="modal" data-target="#del_popup" data-id="{{ $p->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                              </td>

                            </tr>

                            @endforeach



                          </tbody>

                      </table>

                      @else

                      <div class="alert alert-danger alert-dismissible">

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>

                        Il n'y a pas de publication disponible en ce moment! Veuillez en créer

                      </div>

                      @endif

                  </div>

              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content 

   -->

    <div class="modal fade" id="del_popup" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de la publication</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-publication-del-valide') }}" id="del" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cette publication ? </p>

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

<script src="/backend/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="/backend/plugins/jszip/jszip.min.js"></script>

<script src="/backend/plugins/pdfmake/pdfmake.min.js"></script>

<script src="/backend/plugins/pdfmake/vfs_fonts.js"></script>

<script src="/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script src="/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script src="/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



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



    $("#del_popup").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });





  });

</script>



@endsection