@extends('layouts.admin')

@section('title', 'Galerie Videos')
@section('link', 'video')


@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Galerie Videos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Galerie Videos</li>
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

          @if( session()->has('msg_error') )
          <div class="col-md-12">
            <div class="alert alert-danger">{{ session()->get('msg_error') }}</div>
          </div>
          @endif

          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h2 class="card-title">Galerie videos</h2>
                <a href="javascript();" data-toggle="modal" data-target="#add_video" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Créer un nouveau</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <div class="row">
                    @foreach( $videos as $s )
                    <div class="col-md-3 mb-4">
                      <iframe width="100%" height="300" src="https://www.youtube.com/embed/{{$s->link_video}}" title="{{ $s->titre_fr }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      
                      <h4>

                        {{ $s->titre_fr }}

                      </h4>
                      <p>
                          {{ $s->description_fr }}
                      </p>
                      <div class="text-center" style="margin-top: 15px;">
                        <a href="javascript();" data-toggle="modal" data-target="#edit_video" data-id="{{ $s->id }}" data-titre_fr="{{ $s->titre_fr }}" data-img_up="{{ $s->image }}" data-titre_en="{{ $s->titre_en }}" data-description_fr="{{ $s->description_fr }}" data-description_en="{{ $s->description_en }}" data-link_video="{{ $s->link_video }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript();" data-toggle="modal" data-target="#del_video" data-id="{{ $s->id }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </div>
                    @endforeach
                  </div>

              </div>
            </div>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="del_video" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de la video</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-galerie-video-del') }}" id="del" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p> Voulez-vous supprimer cette video ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" id="del" class="btn btn-primary">Oui</button>
            </div>
          </form>

        </div>
      </div>
    </div>

    <div class="modal fade" id="add_video" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une video</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-galerie-video-create') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="modal-body">
              
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Image de la vidéo *</label>
                          <input type="file" class="form-control" name="image_video" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titre en Francais *</label>
                          <input type="text" class="form-control" name="titre_fr" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titre en Anglais *</label>
                          <input type="text" class="form-control" name="titre_en" required>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Lien Youtube *</label>
                          <input type="text" placeholder="https://youtu.be/KNDsZiR9qzY" class="form-control" name="link_video" required>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Description en Francais *</label>
                          <textarea class="form-control" required rows="5" name="description_fr"></textarea>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Description en Anglais *</label>
                          <textarea class="form-control" required rows="5" name="description_en"></textarea>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>
                      </div>
                  </div>
              </div>
              


            </div>
            
          </form>

        </div>
      </div>
    </div>

    <div class="modal fade" id="edit_video" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modifier une vidéo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-galerie-video-edit') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
              
              <div class="row">
                  <div class="col-md-12">
                      <span id="show_img"></span>
                      <input type="hidden" name="img_up" id="img_up">
                      <div class="form-group"> 
                          <label>Changer l'Image de la vidéo</label>
                          <input type="file" class="form-control" name="image_video">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titre en Francais *</label>
                          <input type="text" id="titre_fr" class="form-control" name="titre_fr" required>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titre en Anglais *</label>
                          <input type="text" id="titre_en" class="form-control" name="titre_en" required>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Lien Youtube *</label>
                          <input type="text" id="link_video" placeholder="https://youtu.be/KNDsZiR9qzY" class="form-control" name="link_video" required>
                      </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Description en Francais *</label>
                          <textarea class="form-control" id="description_fr" required rows="5" name="description_fr"></textarea>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Description en Anglais *</label>
                          <textarea class="form-control" id="description_en" required rows="5" name="description_en"></textarea>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <button type="submit" class="btn btn-info"><i class="fa fa-pencil-alt"></i> Edit</button>
                      </div>
                  </div>
              </div>
              


            </div>
            
          </form>

        </div>
      </div>
    </div>

@endsection

@section('js')
  <script>
    $(document).ready(function(){
      $("#del_video").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        modal.find('#id').val(id);
    });

    $("#edit_video").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var titre_en = button.data('titre_en');
        var titre_fr = button.data('titre_fr');
        var description_en = button.data('description_en');
        var description_fr = button.data('description_fr');
        var link_video = button.data('link_video');
        var img_up = button.data('img_up');
        var modal = $(this);

        modal.find('#id').val(id);
        modal.find('#img_up').val(img_up);
        modal.find('#titre_fr').val(titre_fr);
        modal.find('#titre_en').val(titre_en);
        modal.find('#description_fr').val(description_fr);
        modal.find('#description_en').val(description_en);
        modal.find('#link_video').val('https://youtu.be/'+link_video);
        modal.find('#show_img').html('<img width="100" src="/frontend/assets/images/gallery/video/'+img_up+'" id="img_video">');
    });
    
    });
  </script>
@endsection