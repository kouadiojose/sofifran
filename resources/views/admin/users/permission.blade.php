@extends('layouts.admin')

@section('title', 'Permissions')
@section('link', 'permission')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Permissions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Permissions</li>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Assigner une permission</h2>
              </div>
              <!-- /.card-header -->
              <form action="{{ route('admin-permission-valid') }}" method="post">
              <div class="card-body">
                  
                    {{ csrf_field() }}
                    <div class="row">
                      
                      <div class="col-md-12">
                         <div class="form-group">
                            
                            <select name="role_id" id="role_id" class="form-control" required="required">
                              <option value="">--Selectionnez--</option>
                              @foreach( $roles as $r )
                              <option value="{{ $r->id }}">{{ $r->name }}</option>
                              @endforeach
                            </select>
                            
                          </div> 
                      </div>
 
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="button"  id="select-all" class="btn btn-info" value="Cocher Tout" />
                          <input type="button"  id="deselect-all" class="btn btn-warning" value="Décocher Tout"/> 
                        </div>
                      </div>

                      @foreach( $groupe as $g )
                      <div class="col-md-3">
                          <h4>{{ $g->name }}</h4>
                          <?php foreach (DB::table('permissions')->where('groupe_id', $g->id)->get() as $p): ?>
                            <div class="form-group">
                              <div class="form-check" style="">
                              
                              <input type="checkbox" class="form-check-input" value="{{$p->id}}" name="permissions[]" id="{{$p->name}}">
                              <label class="form-check-label mr-4" for="{{$p->name}}">{{$p->description}} </label> <br>

                              </div>
                            </div>
                            
                          <?php endforeach ?>
                      </div>
                      <br>
                      @endforeach

                    </div>
                    
                  

              </div>
              <div class="card-footer">
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-secondary"><i class="fa fa-valid"></i> Valider les permissions</button>
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

  <div class="modal fade" id="change_password" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Changer mon mot de passe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-change-valide') }}" id="change" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="change_id" id="id">
            <div class="modal-body">


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


            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Changer</button>
            </div>
          </form>

        </div>
      </div>
  </div>

@endsection

@section('js')

<script>

  $(function () {

    $("#change_password").on('show.bs.modal', function(e){
        var button = $(e.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        modal.find('#id').val(id);
    });

  });
</script>

<script>
  
    $(document).ready(function(){

        $("#select-all").on("click",function(){
            $("input[type='checkbox'] ").attr("checked", "checked");
        });

        $("#deselect-all").on("click",function(){
            $("input[type='checkbox'] ").removeAttr("checked");
        });

        $("#role_id").on("change",function(){

            var role_id = $("#role_id").val();

            

            $.get("{{ url("admin-sofifran/permission_per_role") }}/"+role_id, function(data, status){

                $("input[type='checkbox'] ").removeAttr("checked");
                list = JSON.parse(data);

                //console.log(list);
                $.each(list, function(index, elt) {
                    $(":checkbox[value='"+ elt+"'] ").attr("checked", "checked");
                });

            });

        });
    });

  </script>


@endsection