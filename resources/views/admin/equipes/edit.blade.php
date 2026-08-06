@extends('layouts.admin')



@section('title', 'Edition de membre')

@section('link', 'equipe')



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Modifier un membre</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Modifier un membre</li>

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

          <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Modifier un membre</h2>

                <a href="{{ route('admin-equipe') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des membres</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  <form action="{{ route('admin-equipe-edit-valid') }}" method="post"  enctype="multipart/form-data">



                  		{{ csrf_field() }}

                  		<input type="hidden" value="{{ $team->id }}" name="team_id">



                        <div class="row">

                        <div class="col-md-12">

                              <div class="form-group">

                                  <img src="/frontend/assets/images/team/{{ $team->image }}">

                                  <input type="hidden" name="photo_up" value="{{ $team->image }}">

                              </div>

                          </div>



                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Changer la Photo du membre (300x266)</label>

                                  <input type="file" name="photo" class="form-control">

                              </div>

                          </div>

                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Nom complet *</label>

                                  <input type="text" placeholder="Nom complet du membre" name="nom" value="{{ $team->name }}" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Fonction En Francais *</label>

                                  <input type="text" value="{{ $team->post_fr }}" placeholder="Fonction" name="fonction_fr" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Fonction en Anglais *</label>

                                  <input type="text" value="{{ $team->post_en }}" placeholder="Fonction" name="fonction_en" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Type de membre *</label>

                                  <select class="form-control" name="type_membre" required>
                                    <option {{ $team->type_membre == "Conseil d'administration" ? 'selected' : '' }} value="Conseil d'administration">Conseil d'administration</option>
                                    <option {{ $team->type_membre == 'Personnel' ? 'selected' : '' }} value="Personnel">Personnel</option>
                                  </select>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Ordre d'affichage</label>

                                  <input type="number" min="0" value="{{ old('ordre', $team->ordre ?? 0) }}" name="ordre" class="form-control">
                                  <small class="text-muted">Les plus petits numéros s'affichent en premier.</small>

                              </div>

                          </div>



                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Facebook</label>

                                  <input type="text" value="{{ $team->facebook }}" placeholder="Facebook" name="facebook" class="form-control">

                              </div>

                          </div>

                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Instagram</label>

                                  <input type="text" value="{{ $team->instagram }}" placeholder="Instagram" name="instagram" class="form-control">

                              </div>

                          </div>



                          <div class="col-md-12">

                            <div class="form-group">

                                <button type="submit" class="btn btn-info"><i class="fa fa-pencil-alt"></i> Editer</button>

                            </div>

                          </div>

                        </div>



                  </form>



              </div>

            </div>

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->



      </div><!--/. container-fluid -->

    </section>

    <!-- /.content -->



@endsection