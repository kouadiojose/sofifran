<!-- form start -->
<form role="form" action="{{ route('admin-blog-edit-valid') }}" method="POST" enctype="multipart/form-data">

  {{ csrf_field() }}
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <img src="/frontend/assets/images/blog/{{ $blog->image }}" width="200">
          <input type="hidden" name="id" id="id" value="{{ $blog->id }}">
          <input type="hidden" name="img_up" id="img_up" value="{{ $blog->image }}">
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="image">Image (850x550)*</label>
          <input type="file" class="form-control" name="image" id="image">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="titre_fr">Titre Français *</label>
          <input type="text" name="title_fr" required="required" class="form-control" id="titre_fr" value="{{ $blog->title_fr }}">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="titre_en">Titre Anglais *</label>
          <input type="text" name="title_en" required="required" class="form-control" id="titre_en" value="{{ $blog->title_en }}">
        </div>
      </div>

    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="description_fr">Description Français</label>
              <textarea class="form-control" id="description_fr" name="description_fr" rows="5" required="required">{{ $blog->description_fr }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="description_en">Description Anglais</label>
              <textarea class="form-control" id="description_en" name="description_en" rows="5" required="required">{{ $blog->description_en }}</textarea>
            </div>
        </div>
    </div>
    

  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" id="createBlog" class="btn btn-primary"><i class="fas fa-pencil"></i> Editer</button>
  </div>
</form>