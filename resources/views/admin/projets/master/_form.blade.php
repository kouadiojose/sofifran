
<!-- form start -->
<form role="form" action="{{ route('admin-projet-valid') }}" method="POST" enctype="multipart/form-data">

  {{ csrf_field() }}
  <div class="card-body">
    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="img_project">Image Projet(850x550) *</label>
          <input type="file" class="form-control" value="{{ old('img_project') }}" name="img_project" id="img_project" required="required">
          
        </div>
      </div>
      
        
        <div class="col-md-6">
            <div class="form-group">
              <label for="file">Partenaires(facultatif): 450x300</label>
              <input type="file" name="file[]" multiple class="form-control" id="file">
            </div>
          </div>
          
      <div class="col-md-6">
        <div class="form-group">
          <label for="titre_fr">Titre Français *</label>
          <input type="text" name="titre_fr" value="{{ old('titre_fr') }}" required="required" class="form-control" id="titre_fr" placeholder="Titre Français...">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="titre_en">Titre Anglais *</label>
          <input type="text" name="titre_en" value="{{ old('titre_en') }}" required="required" class="form-control" id="titre_en" placeholder="Titre Anglais...">
        </div>
      </div>

    </div>

    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="summernote_fr">Description Français</label>
              <textarea class="form-control" id="summernote_fr" name="description_fr" rows="5" placeholder="Mettez une description en Français..." required="required">{{ old('description_fr') }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="summernote_en">Description Anglais</label>
              <textarea class="form-control" id="summernote_en" name="description_en" rows="5" placeholder="Mettez une description en Anglais..." required="required">{{ old('description_en') }}</textarea>
            </div>
        </div>
        
          
      
    </div>
    

  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" id="createProject" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>
  </div>
</form>