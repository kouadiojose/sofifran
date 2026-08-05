<!-- form start -->
<form role="form" action="{{ route('admin-galerie-valid') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone" name="dropzone">

  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">

      

      <!--<div class="col-md-6">

        <div class="form-group">

          <label for="title_fr">Titre en Français *</label>

          <input type="text" class="form-control" name="title_fr" id="title_fr" required="required">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="title_en">Titre en Anglais *</label>

          <input type="text" class="form-control" name="title_en" id="title_en" required="required">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="description_fr">Description en Français *</label>

          <textarea class="form-control" required="required" name="description_fr" rows="5"></textarea>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="description_en">Description en Anglais *</label>

          <textarea class="form-control" required="required" name="description_en" rows="5"></textarea>

        </div>

      </div>-->


      <div class="col-md-12">

        <div class="form-group">

          <label for="activite">Selectionner une Activité *</label>
          <select class="form-control select2" name="activite" id="activite" required>
            <option value="">Selectionner</option>
            @foreach( $activites as $a )
            <option value="{{ $a->id }}">{{ $a->title_fr }}</option>
            @endforeach
          </select>

        </div>

      </div>

      <div class="col-md-12">

        <div class="form-group">
          <label>Ajouter des photos *</label>
          <input type="file" multiple name="photos[]" class="form-control" required>
        </div>

      </div>



    </div>
  </div>

  <!-- /.card-body -->



  <div class="card-footer">

    <button type="submit" id="createBlog" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>

  </div>

</form>