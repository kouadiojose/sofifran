<!-- form start -->

<form role="form" id="form" action="{{ route('admin-temoignage-edit-valid') }}" method="post" enctype="multipart/form-data">

  {{ csrf_field() }}

  <div class="card-body">

    <input type="hidden" name="temoignage_id" value="{{ $temoignage->id }}">
    <input type="hidden" name="photo_up" value="{{ $temoignage->image }}">

    <div class="row">

      <div class="form-group col-md-12">
        <img src="/frontend/assets/images/temoignages/{{ $temoignage->image }}" width="90">
      </div>

      <div class="form-group col-md-6">

        <label for="photo">Changer Photo du témoin(90x90)</label>
        <input type="file" name="photo" class="form-control" id="photo">

      </div>

      <div class="form-group col-md-6">

        <label for="name">Nom du témoin *</label>

        <input type="text" name="name" required="required" class="form-control" id="name" value="{{ $temoignage->name }}">

      </div>



      <div class="form-group col-md-6">

        <label for="description">Temoignage En Français</label>

        <textarea class="form-control" id="description" name="contenu_fr" rows="5" required="required">{{ $temoignage->content_fr }}</textarea>

      </div>



      <div class="form-group col-md-6">

        <label for="description">Temoignage En Anglais</label>

        <textarea class="form-control" id="description" name="contenu_en" rows="5" required="required">{{ $temoignage->content_en }}</textarea>

      </div>

    </div>

    



  </div>

  <!-- /.card-body -->



  <div class="card-footer">

    <button type="submit" id="createProject" class="btn btn-primary"><i class="fa fa-plus"></i> Editer</button>

  </div>

</form>