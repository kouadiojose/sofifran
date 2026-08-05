<!-- form start -->
<form role="form" action="{{ route('admin-galerie-edit-valid') }}" method="POST" enctype="multipart/form-data">

  {{ csrf_field() }}

  <div class="card-body">
    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label>Photo actuelle</label><br>
          <img src="/frontend/assets/images/gallery/photos/{{ $galerie->image }}" width="250" alt="Photo de galerie">
          <input type="hidden" name="id" value="{{ $galerie->id }}">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="image">Remplacer la photo</label>
          <input type="file" class="form-control" name="image" id="image" accept="image/*">
          <small class="text-muted">Laisser vide pour conserver la photo actuelle.</small>
        </div>

        <div class="form-group">
          <label for="activite">Activité liée *</label>
          <select class="form-control" name="activite" id="activite" required>
            <option value="">Selectionner</option>
            @foreach( $activites as $a )
            <option value="{{ $a->id }}" {{ $a->id == $galerie->galerie_id ? 'selected' : '' }}>{{ $a->title_fr }}</option>
            @endforeach
          </select>
          <small class="text-muted">La photo est affichée dans la galerie de cette activité.</small>
        </div>
      </div>

    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Modifier</button>
  </div>
</form>
