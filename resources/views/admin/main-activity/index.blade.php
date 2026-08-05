@extends('layouts.admin')

@section('title', "Catégories d'activités")
@section('link', 'categorie')

@section('style')
  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catégories d'activités</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Catégories d'activités</li>
            </ol>
          </div>
        </div>
      </div>
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

          @if( session()->has('msg_error') )
          <div class="col-md-12">
            <div class="alert alert-danger">{{ session()->get('msg_error') }}</div>
          </div>
          @endif

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des catégories</h3>
                <div class="card-tools">
                  <a href="{{ route('admin-categorie-create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Ajouter une catégorie</a>
                </div>
              </div>

              <div class="card-body">
                @if( $categories->isNotEmpty() )
                <table id="table_categories" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Image</th>
                      <th>Titre (FR)</th>
                      <th>Titre (EN)</th>
                      <th>Activités rattachées</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 1; @endphp
                    @foreach( $categories as $c )
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td><img src="/frontend/assets/images/activites/categories/{{ $c->image }}" alt="{{ $c->titre_fr }}" width="80"></td>
                      <td>{{ $c->titre_fr }}</td>
                      <td>{{ $c->titre_en }}</td>
                      <td><span class="badge badge-info">{{ $c->activites_count }}</span></td>
                      <td>
                        <a href="{{ route('admin-categorie-edit', $c->id) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:;" data-toggle="modal" data-target="#del_categorie" data-id="{{ $c->id }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Il n'y a pas de catégorie disponible en ce moment! Veuillez en créer.
                </div>
                @endif
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- /.content -->

    <div class="modal fade" id="del_categorie" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="delCategorieTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="delCategorieTitle">Suppression de la catégorie</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-categorie-delete') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p>Voulez-vous supprimer cette catégorie ?</p>
              <p class="text-muted">La suppression est refusée si des activités y sont encore rattachées.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-primary">Oui</button>
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
    $('#table_categories').DataTable({
      "responsive": true,
      "autoWidth": false,
    });

    $('#del_categorie').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      $(this).find('#id').val(id);
    });
  });
</script>
@endsection
