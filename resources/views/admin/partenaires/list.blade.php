@extends('layouts.admin')



@section('title', 'Partenaires')

@section('link', 'partenaire')



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

            <h1 class="m-0 text-dark">Nos Partenaires</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Partenaires</li>

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

                <h2 class="card-title">Nos Partenaires</h2>

                <a href="{{ route('admin-partenaire-create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer un nouveau</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">
                  
                  @include('admin.partenaires.master._table')

              </div>

            </div>

          </div>

          <div class="col-md-12 mt-3">

            <div class="card">

              <div class="card-header">
                <h2 class="card-title">Ordonner les partenaires</h2>
              </div>

              <!-- /.card-header -->

              <div class="card-body">
                  <h4 class="mb-4">Ordre des partenaires</h4>
                  @foreach($partnersByType as $type => $partners)
                  <h5 class="mt-4 text-uppercase text-primary">{{ ucfirst($type) }}</h5>

                  <ul id="sortable-{{ Str::slug($type) }}" class="list-unstyled d-flex flex-wrap bg-light p-3 rounded">
                      @foreach($partners as $partner)
                          <li class="m-2 p-2 border rounded bg-white text-center shadow-sm"
                              data-id="{{ $partner->id }}"
                              style="cursor: move; width: 150px;">
                              <img src="/frontend/assets/images/partenaires/{{ $partner->image }}" alt="{{ $partner->name }}"
                                   style="width:100%; height:auto; border-radius:8px;">
                              <p class="small mt-2 mb-0">{{ $partner->name }}</p>
                          </li>
                      @endforeach
                  </ul>

                  <button class="btn btn-sm btn-primary save-order" data-type="{{ Str::slug($type) }}">
                      💾 Enregistrer l’ordre
                  </button>
                  <hr>
              @endforeach
                
              </div>

            </div>

          </div>
          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->

    <div class="modal fade" id="del_partenaire" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression du Partenaire</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-partenaire-delete') }}" id="del" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cet Partenaire ? </p>

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

      "buttons": ["excel"]

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





      $("#del_partenaire").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });





  });

</script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(function() {
    @foreach($partnersByType as $type => $partners)
        (function() {
            var typeSlug = '{{ Str::slug($type) }}';
            $('#sortable-' + typeSlug).sortable();

            $('[data-type="' + typeSlug + '"]').on('click', function() {
                var order = [];
                $('#sortable-' + typeSlug + ' li').each(function(index, element) {
                    order.push({
                        id: $(this).data('id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route("partners.reorder") }}',
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        alert('Ordre mis à jour pour {{ ucfirst($type) }} ✅');
                    },
                    error: function() {
                        alert('Erreur lors de la mise à jour ❌');
                    }
                });
            });
        })();
    @endforeach
});
</script>


@endsection