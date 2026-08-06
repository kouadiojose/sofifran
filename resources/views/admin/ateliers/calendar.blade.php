@extends('layouts.admin')

@section('title', 'Évènements / Calendrier')
@section('link', 'atelier')

@section('style')
  <link rel="stylesheet" href="/frontend/assets/calendar/main.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Évènements &amp; Calendrier</h1>
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

          <!-- Liste des evenements -->
          <div class="col-lg-5">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Tous les évènements</h3>
                <div class="card-tools">
                  <a href="{{ route('admin-atelier-create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Créer un évènement</a>
                </div>
              </div>
              <div class="card-body p-0">
                @if($calendar->isNotEmpty())
                <table id="table_ateliers" class="table table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Évènement</th>
                      <th style="width: 95px;">Date</th>
                      <th style="width: 80px;">Statut</th>
                      <th style="width: 90px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($calendar as $c)
                    <tr>
                      <td>
                        <span class="d-inline-block rounded-circle mr-1" style="width: 10px; height: 10px; background: {{ $c->color ?: '#007bff' }};"></span>
                        {{ \Illuminate\Support\Str::limit($c->title_fr, 40) }}
                      </td>
                      <td>{{ $c->start ? date('d/m/Y', strtotime($c->start)) : '-' }}</td>
                      <td>
                        @if($c->start >= now()->format('Y-m-d'))
                          <span class="badge badge-success">À venir</span>
                        @else
                          <span class="badge badge-secondary">Passé</span>
                        @endif
                      </td>
                      <td style="white-space: nowrap;">
                        <a href="{{ route('admin-atelier-edit', $c->id) }}" class="btn btn-info btn-sm" title="Modifier"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:;" data-toggle="modal" data-target="#del_atelier" data-id="{{ $c->id }}" class="btn btn-danger btn-sm" title="Supprimer"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <p class="p-3 mb-0 text-muted">Aucun évènement pour le moment. Créez-en un avec le bouton ci-dessus.</p>
                @endif
              </div>
            </div>
          </div>

          <!-- Calendrier -->
          <div class="col-lg-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-alt"></i> Vue calendrier</h3>
                <div class="card-tools">
                  <small class="text-muted">Cliquez sur un évènement pour le modifier</small>
                </div>
              </div>
              <div class="card-body">
                <div id="calendar"></div>
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
<script src='/frontend/assets/calendar/main.js'></script>
<script src='/frontend/assets/calendar/locales-all.js'></script>
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'fr',
      height: 620,
      events: [
        @foreach($calendar as $c)
        {
          title: @json($c->title_fr),
          start: '{{ $c->start }}',
          color: '{{ $c->color ?: "#007bff" }}',
          url: '{{ route('admin-atelier-edit', $c->id) }}',
          @if ($c->end)
          end: '<?= date("Y-m-d", strtotime($c->end . " +1 day")); ?>',
          @endif
        },
        @endforeach
      ],
    });
    calendar.render();
  });

  $(function () {
    $('#table_ateliers').DataTable({
      "responsive": true,
      "autoWidth": false,
      "pageLength": 10,
      "lengthChange": false,
      "order": [],
      "language": { "search": "Rechercher :", "paginate": { "previous": "Préc.", "next": "Suiv." }, "info": "_TOTAL_ évènement(s)", "infoFiltered": "", "infoEmpty": "" }
    });

    $('#del_atelier').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      $(this).find('#id').val(button.data('id'));
    });
  });
</script>
@endsection
