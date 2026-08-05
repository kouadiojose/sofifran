
<!-- form start -->
<form role="form" action="{{ route('admin-projet-edit-valid') }}" method="POST" enctype="multipart/form-data">

  {{ csrf_field() }}
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <img src="/frontend/assets/images/projects/{{ $projet->image }}" width="200">
        <input type="hidden" name="img_up" value="{{ $projet->image }}">
        <input type="hidden" name="id" value="{{ $projet->id }}">
      </div>
      
      <div class="col-md-6">
          <div class="row">
                <?php $partenaires = DB::table('partenaire_projets')->where('projet_id', $projet->id)->get(); foreach($partenaires as $p){ ?>
                    <div class="col-md-2 text-center">
                        <img src="/frontend/assets/images/projects/partenaires/{{ $p->image }}" width="100%" class="mb-1">
                       <a href="javascript(0);"  data-toggle="modal" data-id="{{ $p->id }}" data-target="#del" class="" title="Supprimer cette image"><i class="fa fa-trash"></i></a> 
                    </div>
                <?php } ?>
          </div>
      </div>
      
      
      <div class="col-md-6">
        <div class="form-group">
          <label for="img_project">Changer Image Projet *</label>
          <input type="file" class="form-control" name="img_project" id="img_project">
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
          <input type="text" name="titre_fr" value="{{ $projet->titre_fr }}" required="required" class="form-control" id="titre_fr" placeholder="Titre Français...">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="titre_en">Titre Anglais *</label>
          <input type="text" name="titre_en" value="{{ $projet->titre_en }}" required="required" class="form-control" id="titre_en" placeholder="Titre Anglais...">
        </div>
      </div>

    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="summernote_fr">Description Français</label>
              <textarea class="form-control" id="summernote_fr" name="description_fr" rows="5" placeholder="Mettez une description en Français..." required="required">{{ $projet->description_fr }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="summernote_en">Description Anglais</label>
              <textarea class="form-control" id="summernote_en" name="description_en" rows="5" placeholder="Mettez une description en Anglais..." required="required">{{ $projet->description_en }}</textarea>
            </div>
        </div>
    </div>
    

  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" id="createProject" class="btn btn-primary"><i class="fa fa-plus"></i> Modifier</button>
  </div>
</form>

<div class="modal fade" id="del">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Supprimer cette image</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('del-image') }}" method="POST">
        
        @csrf
        <input type="hidden" name="id" id="del_id">
        <div class="modal-body">
          <p>Etes-vous sûre de supprimer cette image ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
          <button type="submit" class="btn btn-danger">Oui</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
      