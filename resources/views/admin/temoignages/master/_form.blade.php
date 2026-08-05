<!-- form start -->

<form role="form" action="{{ route('admin-temoignage-valid') }}" method="post" enctype="multipart/form-data">

  {{ csrf_field() }}

  <div class="card-body">

    <div class="row">

      <div class="form-group col-md-6">

        <label for="photo">Photo du témoin(90x90) *</label>
        <input type="file" name="photo" accept=".png, .jpg, .jpeg, .gif" required="required" class="form-control" id="photo">

      </div>

      <div class="form-group col-md-6">

        <label for="name">Nom du témoin *</label>

        <input type="text" name="name" required="required" class="form-control" id="name" placeholder="Nom du témoin...">

      </div>

      <div class="form-group col-md-6">

        <label for="description">Temoignage En Français</label>

        <textarea class="form-control" id="description" name="contenu_fr" rows="5" placeholder="Mettez le contenu du témoignage en Français..." required="required"></textarea>

      </div>



      <div class="form-group col-md-6">

        <label for="description">Temoignage En Anglais</label>

        <textarea class="form-control" id="description" name="contenu_en" rows="5" placeholder="Mettez le contenu du témoignage en Anglais..." required="required"></textarea>

      </div>

      <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>
      </div>
    </div>

    



  </div>


</form>