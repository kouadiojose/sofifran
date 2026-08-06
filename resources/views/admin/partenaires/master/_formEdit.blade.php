

<!-- form start -->

<form role="form" action="{{ route('admin-partenaire-edit-valid') }}" method="POST" enctype="multipart/form-data">



  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">



      <div class="col-md-12">

        <div class="form-group">

          <img src="/frontend/assets/images/partenaires/{{ $partenaire->image }}" width="200">

          <input type="hidden" value="{{ $partenaire->image }}" name="img_up">

          <input type="hidden" value="{{ $partenaire->id }}" name="id">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="image">Logo </label>

          <input type="file" name="image" class="form-control" id="image">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="name">Nom entreprise *</label>

          <input type="text" name="name" required="required" value="{{ $partenaire->name }}" class="form-control" id="name">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="orders">Ordre d'affichage</label>

          <input type="number" min="0" name="orders" value="{{ $partenaire->orders }}" class="form-control mb-3">

          <label for="link">Lien du site(Exemple: https://site.com ou http://site.com) *</label>

          <input type="text" name="link" value="{{ $partenaire->link }}" required="required" class="form-control" id="link">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="type">Type partenaire *</label>

          <select class="form-control" name="type" id="type" required="required">

            

            <option value="0">Selectionner</option>

            <option value="financier" <?php if( $partenaire->type == "financier" ){ ?> selected = "selected" <?php } ?>>Partenaire Financier</option>

            <option value="communautaire"  <?php if( $partenaire->type == "communautaire" ){ ?> selected = "selected" <?php } ?>>Partenaire Communautaire </option>
            <option value="commanditaire" <?php if( $partenaire->type == "commanditaire" ){ ?> selected = "selected" <?php } ?>> Commanditaire </option>
            <option value="autre" <?php if( $partenaire->type == "autre" ){ ?> selected = "selected" <?php } ?>>Autre Partenaire </option>
 




          </select>

        </div>

      </div>



    </div>

    



  </div>

  <!-- /.card-body -->



  <div class="card-footer">

    <button type="submit" id="createProject" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Editer</button>

  </div>

</form>