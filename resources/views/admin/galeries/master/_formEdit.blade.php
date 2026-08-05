<!-- form start -->

<form role="form" action="{{ route('admin-galerie-edit-valid') }}" method="POST" enctype="multipart/form-data">



  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">

      <div class="col-md-12">

        <div class="form-group">

          <img src="/frontend/assets/img/gallery/{{ $galerie->image }}" width="200">

          <input type="hidden" name="id" id="id" value="{{ $galerie->id }}">

          <input type="hidden" name="img_up" id="img_up" value="{{ $galerie->image }}">

        </div>

      </div>



      <div class="col-md-12">

        <div class="form-group">

          <label for="image">Image *</label>

          <input type="file" class="form-control" name="image" id="image">

        </div>

      </div>


      <div class="col-md-12">

        <div class="form-group">

          <label for="activite">Selectionner une Activité *</label>
          <select class="form-control select2" name="activite" id="activite" required>
            <option value="">Selectionner</option>
            @foreach( $activites as $a )
            <option value="{{ $a->id }}" <?php if($a->id == $galerie->galerie_id){ echo "selected"; } ?>>{{ $a->title_fr }}</option>
            @endforeach
          </select>

        </div>

      </div>




      <div class="col-md-12">

        <div class="form-group">

          <label for="img">Ajouter les images de cette activités *</label>

          <input type="file" name="img[]" class="form-control" multiple="multiple">

        </div>

      </div>



      @if( $img->isNotEmpty() )



      @foreach( $img as $img )

      <div class="col-md-2">



        <img class="card-img-top" src="/assets/img/gallery/sous_galerie/{{ $img->image }}">

        <div class="card-img-overlay d-flex flex-column justify-content-end">

            <a href="javascript();" data-toggle="modal" data-target="#del_sous_galerie" data-id="{{ $img->id }}" class="btn btn-primary"> <i class="fas fa-trash"></i> Supprimer cette image ?</a>

        </div>

      </div>

      @endforeach



      @else

      <div class="col-md-12">

        <div class="alert alert-warning alert-dismissible">

          <button class="close" data-dismiss="alert" aria-hidden = "true" type="button">x</button>

          <h5><i class="icon fas fa-exclamation-triangle"></i> Message!</h5>

          Il n'y a pas d'images de galerie disponible pour le moment

        </div>

      </div>

        

      @endif

      <div class="row" style="width: 100%;" id="rowInput">

        <div class="col-md-8">

          <div class="form-group">

            <label for="img">Ajouter une vidéo *</label>

            <input type="text" class="form-control" name="videos[]" placeholder="https://www.youtube.com/embed/tkwVg47D4m4">

          </div>

        </div>

        <div class="col-md-4">

          <div class="form-group">

            <label> &nbsp; </label> <br>

            <button type="button" class="btn-success btn" id="add">Ajouter une autre</button>

          </div>

        </div>



      </div>

      <div id="new_input" style="width: 100%;"></div>

      @if( $video->isNotEmpty() )

      @foreach( $video as $video )

      <div class="row" style="width: 100%;" id="rowInput">

        <div class="col-md-8">

          <div class="form-group">

            <label for="img">Modifier lien de la vidéo *</label>

            <input type="text" value="{{ $video->lien }}" class="form-control" name="videos[]" placeholder="https://www.youtube.com/embed/tkwVg47D4m4">

          </div>

        </div>

        <div class="col-md-4">

          <div class="form-group">

            <label> &nbsp; </label> <br>

            <button type="button" class="btn-danger btn" id="del">Supprimer</button>

          </div>

        </div>



      </div>

      @endforeach

      @else

      <div class="col-md-12">

        <div class="alert alert-info alert-dismissible">

          <button class="close" data-dismiss="alert" aria-hidden = "true" type="button">x</button>

          <h5><i class="icon fas fa-exclamation-triangle"></i> Message!</h5>

          Il n'y a pas de videos de galerie disponible pour le moment

        </div>

      </div>



      @endif

    </div>

  </div>

  <!-- /.card-body -->



  <div class="card-footer">

    <button type="submit" id="createBlog" class="btn btn-primary"><i class="fas fa-pencil"></i> Editer</button>

  </div>

</form>





<div class="modal fade" id="del_sous_galerie" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLongTitle">Suppression d'une image galerie</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form action="{{ route('admin-sous-galerie-delete') }}" method="post">



        {{ csrf_field() }}

        <input type="hidden" name="del_id" id="id">

        <div class="modal-body">

          <p> Voulez-vous supprimer cette image ? </p>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>

          <button type="submit" id="del" class="btn btn-primary">Oui</button>

        </div>

      </form>



    </div>

  </div>

</div>

