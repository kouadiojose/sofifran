@extends('layouts.admin')

@section('title', 'Évènements')
@section('link', 'atelier')

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
            <h1 class="m-0 text-dark">Évènements</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Évènements</li>
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

          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Tous les évènements — affichés sur la page « Évènements » du site et sur l'accueil tant qu'ils ne sont pas passés</h3>
                <div class="card-tools">
                  <a href="{{ route('atelier') }}" target="_blank" class="btn btn-default btn-sm"><i class="fas fa-external-link-alt"></i> Voir sur le site</a>
                  <a href="{{ route('admin-atelier-create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Créer un évènement</a>
                </div>
              </div>

              <div class="card-body">
                @if($calendar->isNotEmpty())
                <table id="table_ateliers" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 90px;">Image</th>
                      <th>Évènement</th>
                      <th style="width: 170px;">Début</th>
                      <th style="width: 170px;">Fin</th>
                      <th style="width: 90px;">Statut</th>
                      <th style="width: 110px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($calendar as $c)
                    <tr>
                      <td>
                        @if($c->image)
                          <img src="/frontend/assets/images/ateliers/{{ $c->image }}" width="80" alt="{{ $c->title_fr }}">
                        @else
                          <span class="text-muted"><i class="far fa-image"></i></span>
                        @endif
                      </td>
                      <td>
                        <span class="d-inline-block rounded-circle mr-1" style="width: 10px; height: 10px; background: {{ $c->color ?: '#007bff' }};"></span>
                        <strong>{{ $c->title_fr }}</strong>
                        @if($c->title_en)<br><small class="text-muted">{{ $c->title_en }}</small>@endif
                      </td>
                      <td>{{ $c->start ? date('d/m/Y', strtotime($c->start)) : '-' }} @if($c->hour_start)<small class="text-muted">à {{ substr($c->hour_start, 0, 5) }}</small>@endif</td>
                      <td>{{ $c->end ? date('d/m/Y', strtotime($c->end)) : '-' }} @if($c->hour_end)<small class="text-muted">à {{ substr($c->hour_end, 0, 5) }}</small>@endif</td>
                      <td>
                        @if($c->start >= now()->format('Y-m-d'))
                          <span class="badge badge-success">À venir</span>
                        @else
                          <span class="badge badge-secondary">Passé</span>
                        @endif
                      </td>
                      <td style="white-space: nowrap;">
                        @if($c->slug)
                        <a href="{{ route('detail-atelier', $c->slug) }}" target="_blank" class="btn btn-default btn-sm" title="Voir sur le site"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ route('admin-atelier-edit', $c->id) }}" class="btn btn-info btn-sm" title="Modifier"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:;" data-toggle="modal" data-target="#del_atelier" data-id="{{ $c->id }}" class="btn btn-danger btn-sm" title="Supprimer"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <div class="alert alert-info mb-0">
                  Aucun évènement pour le moment. Créez-en un avec le bouton « Créer un évènement ».
                </div>
                @endif
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal suppression -->
    <div class="modal fade" id="del_atelier" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Suppression de l'évènement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-atelier-delete') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p>Voulez-vous supprimer cet évènement ?</p>
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
    $('#table_ateliers').DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": [],
      "language": { "search": "Rechercher :", "paginate": { "previous": "Préc.", "next": "Suiv." }, "info": "_TOTAL_ évènement(s)", "infoFiltered": "", "infoEmpty": "", "lengthMenu": "Afficher _MENU_", "zeroRecords": "Aucun évènement trouvé" }
    });

    $('#del_atelier').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      $(this).find('#id').val(button.data('id'));
    });
  });
</script>
@endsection
