@extends('layouts.admin')

@section('title', 'Equipe')
@section('link', 'equipe')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Notre Equipe</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Notre Equipe</li>
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


          <div class="col-md-12 text-right mb-4">
              <a href="{{ route('admin-equipe-create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter un nouveau membre</a>
          </div>

          @foreach( $teams as $t )
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                {{ $t->post_fr }}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{ $t->name }}</b></h2>
                      <p class="text-muted text-sm"><b>Fonction: </b> {{ $t->post_fr }} </p>
                      <!--<ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                      </ul>-->
                    </div>
                    <div class="col-5 text-center">
                    <img src="/frontend/assets/images/team/{{ $t->image }}" width="80" height="100" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    
                    <a href="{{ route('admin-equipe-edit', $t->id) }}" class="btn btn-sm btn-success">
                      <i class="fas fa-pencil-alt"></i> Modifier
                    </a>

                    <a href="javascript" data-toggle="modal" data-target="#del_team" data-id="{{ $t->id }}" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i> Supprimer
                    </a>

                  </div>
                </div>
              </div>
            </div>
          @endforeach
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="del_team" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Suppression de membre</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin-equipe-delete') }}" id="del" method="post">

            {{ csrf_field() }}
            <input type="hidden" name="del_id" id="id">
            <div class="modal-body">
              <p> Voulez-vous supprimer cet membre ? </p>
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
  <script type="text/javascript">
       $(function () {

          $("#del_team").on('show.bs.modal', function(e){
              var button = $(e.relatedTarget);
              var id = button.data('id');
              var modal = $(this);

              modal.find('#id').val(id);
          });

        });
  </script>
@endsection