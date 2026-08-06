@extends('layouts.admin')

@section('title', 'Bannieres')

@section('link', 'baniere')

@section('style')
    <!-- DataTables -->
  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bannières des pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Bannières</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">

          @if( session()->has('msg') )
          <div class="col-md-12">
            <div class="alert alert-success">{{ session()->get('msg') }}</div>
          </div>
          @endif

          @if( session()->has('msg_baniere') )
          <div class="col-md-12">
            <div class="alert alert-success">{{ session()->get('msg_baniere') }}</div>
          </div>
          @endif

          @if( session()->has('msg_error') )
          <div class="col-md-12">
            <div class="alert alert-danger">{{ session()->get('msg_error') }}</div>
          </div>
          @endif

          @if( count($pagesManquantes) )
          <div class="col-md-12">
            <div class="alert alert-warning">
              <i class="fas fa-exclamation-triangle"></i>
              Pages sans bannière : <strong>{{ implode(', ', $pagesManquantes) }}</strong> — ces pages s'affichent sans image d'en-tête.
            </div>
          </div>
          @endif

          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="far fa-image"></i> Une bannière par page du site</h3>
                <div class="card-tools">
                  <a href="{{ route('admin-banieres-create') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Ajouter une bannière</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <table id="table_banieres" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Image</th>
                          <th>Page du site</th>
                          <th>Titre Français</th>
                          <th>Titre Anglais</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $i = 1; ?>
                        @foreach( $baniere as $p )
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td><img src="/frontend/assets/images/resource/{{ $p->image }}" width="120" alt="{{ $p->page_label }}"></td>
                          <td><span class="badge badge-info">{{ $p->page_label }}</span></td>
                          <td>{{ $p->title_fr }}</td>
                          <td>{{ $p->title_en }}</td>
                          <td style="white-space: nowrap;">
                            <a href="{{ route('admin-banieres-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:;" data-toggle="modal" data-target="#del_baniere" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>
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

    <div class="modal fade" id="del_baniere" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Suppression de la bannière</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-baniere-delete') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p>Voulez-vous supprimer cette bannière ?</p>
              <p class="text-muted">La page concernée s'affichera sans image d'en-tête tant qu'une nouvelle bannière ne lui est pas assignée.</p>
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
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(function () {
    $('#table_banieres').DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": false,
      "info": false,
    });

    $('#del_baniere').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      $(this).find('#id').val(button.data('id'));
    });
  });
</script>
@endsection
