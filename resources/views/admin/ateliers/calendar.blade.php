@extends('layouts.admin')



@section('title', 'Ateliers')

@section('link', 'atelier')



@section('style')



  <link rel="stylesheet" href="/assets/calendar/main.css">



@endsection



@section('content')



    <!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Nos Ateliers</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Ateliers</li>

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


          </div>



          <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Nos Ateliers</h2>

                <a style="margin-left: 5px;" href="{{ route('admin-atelier-list') }}" class="btn btn-secondary float-right"> <i class="fa fa-eye"></i> Voir la liste des ateliers</a>

                <a href="{{ route('admin-atelier-create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer un nouveau</a>



              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  <div id="calendar"></div>

              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->



    <!-- Modal -->

    <div class="modal fade" id="createAtelier" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Créer un atelier</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-atelier-valid') }}" id="create_new" method="post">



            {{ csrf_field() }}

            <div class="modal-body">

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Titre Evènement en Français *</label>

                    <input type="text" name="title_fr" required="required" id="title_fr" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Titre Evènement en Anglais *</label>

                    <input type="text" name="title_en" required="required" id="title_en" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Début *</label>

                    <input type="date" name="start" required="required" id="start" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Fin *</label>

                    <input type="date" name="end" required="required" id="end" class="form-control">

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Description en Français</label>

                    <textarea name="description_fr" rows="5" id="description_fr" class="form-control"></textarea>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Description en Anglais</label>

                    <textarea name="description_en" rows="5" id="description_en" class="form-control"></textarea>

                  </div>

                </div>



                <div class="col-md-12">

                  <div class="form-group">

                    <label>Couleur Evènement *</label>

                    <select class="form-control" name="color" required="required">

                      <option value="#dc3545">Rouge</option>

                      <option value="#007bff">Bleu</option>

                      <option value="#ffc107">Jaune</option>

                      <option value="#28a745">Vert</option>

                      <option value="#0b0001">Noir</option>

                    </select>

                  </div>

                </div>

              </div>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

              <button type="submit" id="create" class="btn btn-primary">Créer</button>

            </div>

          </form>



        </div>

      </div>

    </div>



@endsection



@section('js')



<script src='/assets/calendar/main.js'></script>

<script src='/assets/calendar/locales-all.js'></script>

<script>



      document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

          initialView: 'dayGridMonth',

          events: [

            @foreach($calendar as $c)

                {

                    title : '{{ $c->title_fr }}',

                    start : '{{ $c->start }}',

                    color: "{{$c->color}}",

                    url: "#",

                    @if ($c->end)

                            end: '<?= date("Y-m-d", strtotime($c->end. " +1 day")); ?>',

                    @endif

                },

                

            @endforeach

        ],

        });

        calendar.render();

        calendar.setOption('locale', 'fr');

      });



</script>



@endsection