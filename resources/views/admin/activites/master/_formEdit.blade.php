<!-- form start -->

<form role="form" action="{{ route('admin-activite-edit-valid') }}" method="POST" enctype="multipart/form-data">



  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">

      <div class="col-md-12">

        <div class="form-group">

          <img src="/frontend/assets/images/activites/{{ $galerie->image }}" width="200">

          <input type="hidden" name="id" id="id" value="{{ $galerie->id }}">

          <input type="hidden" name="img_up" id="img_up" value="{{ $galerie->image }}">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="image">Image *</label>

          <input type="file" class="form-control" name="image" id="image">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="title_fr">Type activité *</label>
          <select class="form-control" name="type" required>
            <option value="">Selectionner</option>
            @foreach( $categories as $c )
            <option value="{{ $c->slug }}" <?php if( $galerie->categorie_activity_slug == $c->slug ){ echo "selected"; } ?>>{{ $c->titre_fr }}</option>
            @endforeach
          </select>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="title_fr">Titre en Français *</label>

          <input type="text" value="{{ $galerie->title_fr }}" class="form-control" name="title_fr" id="title_fr" required="required">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="title_en">Titre en Anglais *</label>

          <input type="text" value="{{ $galerie->title_en }}" class="form-control" name="title_en" id="title_en" required="required">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="summernote_fr">Description en Français *</label>

          <textarea class="form-control" id="summernote_fr" required="required" name="description_fr" rows="5">{{ $galerie->description_fr }}</textarea>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="summernote_en">Description en Anglais *</label>

          <textarea class="form-control" id="summernote_en" required="required" name="description_en" rows="5">{{ $galerie->description_en }}</textarea>

        </div>

      </div>
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

