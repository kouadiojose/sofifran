

<!-- form start -->

<form role="form" action="{{ route('admin-partenaire-valid') }}" method="POST" enctype="multipart/form-data">



  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">



      <div class="col-md-6">

        <div class="form-group">

          <label for="image">Logo *</label>

          <input type="file" name="image" required="required" class="form-control" id="image">

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group">

          <label for="name">Nom entreprise *</label>

          <input type="text" name="name" required="required" class="form-control" id="name" placeholder="Nom entreprise...">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="link">Lien du site(Exemple: https://site.com ou http://site.com) *</label>

          <input type="text" name="link" required="required" class="form-control" id="link" placeholder="Lien du site...">

        </div>

      </div>



      <div class="col-md-6">

        <div class="form-group">

          <label for="type">Type partenaire *</label>

          <select class="form-control" name="type" id="type" required="required">

            <option value="0">Selectionner</option>

            <option value="financier">Partenaire Financier</option>

            <option value="communautaire">Partenaire Communautaire </option>
            <option value="commanditaire"> Commanditaire </option>

            <option value="autre">Autre Partenaire</option>

          </select>

        </div>

      </div>



    </div>

    



  </div>

  <!-- /.card-body -->



  <div class="card-footer">

    <button type="submit" id="createProject" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>

  </div>

</form>