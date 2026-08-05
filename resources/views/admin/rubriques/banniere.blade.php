@extends('layouts.admin')



@section('title', 'Bannieres')

@section('link', 'baniere')



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

            <h1 class="m-0 text-dark">Bannières</h1>

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

        <!-- Info boxes -->



        <div class="row">

          @if( session()->has('msg_slide') )

          <div class="col-md-12">

            <div class="alert alert-success">{{ session()->get('msg_slide') }}</div>

          </div>

          @endif
 
          <div class="col-md-12">

            <div class="card card-primary card-outline">

              <div class="card-header">

                <h2 class="card-title">Liste des Sliders</h2>

                <a href="{{ route('admin-slide-create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer un nouveau slider</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  <div class="row">

                    @foreach( $slide as $s )

                    <div class="col-md-4 text-center">

                      <img src="/assets/images/main-slider/{{ $s->image }}" width="100%" style="">
                      <h4 class="mt-3">{{ $s->title_fr }}</h4>
                      <p>{{ $s->description_fr }}</p>
                      <div class="text-center" style="margin-top: 15px;">

                        <a href="{{ route('admin-slide-edit', $s->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>

                        <a href="javascript();" data-toggle="modal" data-target="#del_slide" data-id="{{ $s->id }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>

                      </div>

                    </div>

                    @endforeach

                  </div>



              </div>

            </div>

          </div>

          <!-- /.col -->



          @if( session()->has('msg_baniere') )

          <div class="col-md-12">

            <div class="alert alert-success">{{ session()->get('msg_baniere') }}</div>

          </div>

          @endif



          <div class="col-md-12">

            <div class="card card-primary card-outline">

              <div class="card-header">

                <h2 class="card-title">Les Pages</h2>

                <a href="{{ route('admin-banieres-create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  <div class="row">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>

                          <th>N°</th>

                          <th>Image</th>

                          <th>Titre Français</th>

                          <th>Titre Anglais</th>

                          <th>Page</th>

                          <th>Action</th>

                        </tr>

                      </thead>



                      <tbody>

                        <?php $i = 1; ?>

                        @foreach( $baniere as $p )

                        <tr>

                          <td>{{ $i++ }}</td>

                          <td><img src="/assets/images/resource/{{ $p->image }}" width="50">

                          </td> 

                          <td>{{ $p->title_fr }}

                          </td> 

                          <td>{{ $p->title_en }}

                          </td>

                          <td>{{ $p->page }}

                          </td> 

                          <td>

                            <a href="{{ route('admin-banieres-edit', $p->id) }}" class="btn btn-info btn-sm" title="Modifier"> <i class="fas fa-pencil-alt"></i></a>

                            <a href="javascript();" data-toggle="modal" data-target="#del_baniere" data-id="{{ $p->id }}" class="btn btn-danger btn-sm" title="Supprimer"> <i class="fas fa-trash"></i></a>

                          </td>

                        </tr>

                        @endforeach

                      </tbody>

                    </table>

                  </div>



              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->



    <div class="modal fade" id="del_slide" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression du Slide</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-slide-delete') }}" id="del" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cet Slide ? </p>

            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>

              <button type="submit" id="del" class="btn btn-primary">Oui</button>

            </div>

          </form>



        </div>

      </div>

    </div>



    <div class="modal fade" id="del_baniere" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression du baniere</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-baniere-delete') }}" id="del" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cette banière ? </p>

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

  <script>

    $(document).ready(function(){

      $("#del_slide").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });



    $("#del_baniere").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });

    

    });

  </script>

@endsection