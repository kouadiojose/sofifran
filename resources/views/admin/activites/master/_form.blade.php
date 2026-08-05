<!-- form start -->

<form role="form" action="{{ route('admin-activite-valid') }}" method="POST" enctype="multipart/form-data">



  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">

      <div class="col-md-6">

        <div class="form-group">

          <label for="image">Image de l'activité *</label>

          <input type="file" class="form-control" name="image" id="image" required="required">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="title_fr">Type activité </label>
          <select class="form-control" name="type" id="type">
            <option value="autre">Selectionner</option>
            @foreach( $categories as $c )
            <option value="{{ $c->slug }}">{{ $c->titre_fr }}</option>
            @endforeach
            
          </select>

          <!--<option value="autre">Autre</option><input type="text" style="display: none;" id="titre_aute" placeholder="Ajouter un titre" class="form-control" name="titre_autre">-->
        </div>

      </div>

      <div class="col-md-6">

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

          <label for="summernote_fr">Description en Français *</label>

          <textarea class="form-control" id="summernote_fr" required="required" name="description_fr" rows="5"></textarea>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="summernote_en">Description en Anglais *</label>

          <textarea class="form-control" id="summernote_en" required="required" name="description_en" rows="5"></textarea>

        </div>

      </div>



      <!--

      <div class="col-md-12">

        <div class="form-group">

          <label for="img">Ajouter les images de cette activités </label>

          <input type="file" name="img[]" class="form-control" multiple="multiple">

        </div>

      </div>



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

    -->

    </div>

  </div>

  <!-- /.card-body -->



  <div class="card-footer">

    <button type="submit" id="createBlog" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>

  </div>

</form>