@extends('layouts.admin')
@section('title', 'Edition Calendrier')
@section('link', 'atelier')


@section('style')
  <link rel="stylesheet" href="/admin/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/admin/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark"> Edition Calendrier</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Edition Calendrier</li>

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

                <h2 class="card-title">Edition Calendrier</h2>

                <a href="{{ route('admin-atelier') }}" class="btn btn-secondary float-right"> <i class="fa fa-eye"></i> Voir calendrier</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  <form action="{{ route('admin-atelier-edit-valid') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                      <div class="row">

                        <div class="col-md-12">
                          <div class="form-group">
                            <?php if ( $atelier->image != Null ): ?>
                              <img src="/assets/images/ateliers/{{ $atelier->image }}" width="200">
                            <?php endif ?>
                            

                            <input type="hidden" value="{{ $atelier->image }}" name="img_up">
                            <input type="hidden" value="{{ $atelier->id }}" name="atelier_id">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Changer l'Image de L'evenement (850x550) </label>
                            <input type="file" name="img" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Titre Evènement en Français *</label>
                            <input type="text" value="{{ $atelier->title_fr }}" name="title_fr" required="required" id="title_fr" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Titre Evènement en Anglais *</label>
                            <input type="text" name="title_en" value="{{ $atelier->title_en }}" required="required" id="title_en" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Date Début *</label>
                            <input type="date" name="start" value="{{ $atelier->start }}" required="required" id="start" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Heure Début *</label>
                            <input type="time" name="hour_start" value="{{ $atelier->hour_start }}" required="required" id="hour_start" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Date Fin *</label>
                            <input type="date" name="end" value="{{ $atelier->end }}" required="required" id="end" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Heure Fin *</label>
                            <input type="time" name="hour_end" value="{{ $atelier->hour_end }}" required="required" id="hour_end" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>Description en Français</label>

                            <textarea name="description_fr" rows="5" id="description_fr" class="form-control">{{ $atelier->description_fr }}</textarea>

                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>Description en Anglais</label>

                            <textarea name="description_en" rows="5" id="description_en" class="form-control">{{ $atelier->description_en }}</textarea>

                          </div>

                        </div>



                        <div class="col-md-12">

                          <div class="form-group">

                            <label>Couleur Evènement *</label>

                            <select class="form-control" name="color" id="color" required="required">

                              <option value="#dc3545" <?php if( $atelier->color=="#dc3545" ){ echo "selected"; } ?>>Rouge</option>

                              <option value="#007bff" <?php if( $atelier->color=="#007bff" ){ echo "selected"; } ?>>Bleu</option>

                              <option value="#ffc107" <?php if( $atelier->color=="#ffc107" ){ echo "selected"; } ?>>Jaune</option>

                              <option value="#28a745" <?php if( $atelier->color=="#28a745" ){ echo "selected"; } ?>>Vert</option>

                              <option value="#0b0001" <?php if( $atelier->color=="#0b0001" ){ echo "selected"; } ?>>Noir</option>

                            </select>

                          </div>

                        </div>

                        <div class="col-md-12">

                          <div class="form-group">

                            <button type="submit" class="btn btn-info"><i class="fa fa-pencil-alt"></i> Editer</button>

                          </div>

                        </div>

                    </div>

                  </form>

              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->


    <div class="modal fade" id="del_atelier" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de l'atelier</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

          </div>

          <form action="{{ route('admin-atelier-delete') }}" method="post">



            {{ csrf_field() }}

            <input type="hidden" name="del_id" id="id">

            <div class="modal-body">

              <p> Voulez-vous supprimer cet atelier ? </p>

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
<script src="/admin/plugins/summernote/summernote-bs4.min.js"></script>

<script>



  $(function () {



  	$('#description_fr').summernote();

  	$('#description_en').summernote();



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



    $("#del_atelier").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var modal = $(this);



        modal.find('#id').val(id);

    });



    $("#edit_atelier").on('show.bs.modal', function(e){

        var button = $(e.relatedTarget);

        var id = button.data('id');

        var title_fr = button.data('title_fr');

        var title_en = button.data('title_en');

        var description_fr = button.data('description_fr');

        var description_en = button.data('description_en');

        var start = button.data('start');

        var end = button.data('end');

        var color = button.data('color');

        var modal = $(this);



        modal.find('#id').val(id);

        modal.find('#title_fr').val(title_fr);

        modal.find('#title_en').val(title_en);

        modal.find('#description_fr').val(description_fr);

        modal.find('#description_en').val(description_en);

        modal.find('#start').val(start);

        modal.find('#end').val(end);

        modal.find('#color').val(color);

    });



  });

</script>



@endsection