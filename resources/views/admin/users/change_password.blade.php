@extends('layouts.admin')

@section('title', 'Changer Mot de passe')
@section('link', 'change')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Changer mot de passe</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Changer mot de passe</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->

        <div class="row">
          @if( session()->has('msg') )
          <div class="col-md-12">
            <div class="alert alert-success">{{ session()->get('msg') }}</div>
          </div>
          @endif
          @if( session()->has('msg_error') )
          <div class="col-md-12">
            <div class="alert alert-danger">{{ session()->get('msg_error') }}</div>
          </div>
          @endif
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Changer son mot de passe</h2>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  <form action="{{ route('admin-change-valide') }}" method="post">

                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Ancien Mot de passe *</label>
                      <input type="password" name="old_password" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <label>Nouveau Mot de passe *</label>
                      <input type="password" name="new_password" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <label>Confirmer Nouveau Mot de passe *</label>
                      <input type="password" name="conf_password" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Changer</button>
                    </div>
                  </form>

              </div>
            </div>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  <div class="modal fade" id="del_role" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-user-del-role-valide') }}" id="del" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p> Voulez-vous supprimer cet role ? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
              <button type="submit" id="del" class="btn btn-primary">Oui</button>
            </div>
          </form>

        </div>
      </div>
  </div>

@endsection

@section('js')

<script>

  $(function () {

    $("#del_role").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        modal.find('#id').val(id);
    });

  });
</script>

@endsection