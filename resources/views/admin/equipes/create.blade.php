@extends('layouts.admin')



@section('title', 'Creation de membre')

@section('link', 'equipe')



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Ajouter un membre</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Ajouter un membre</li>

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

                <h2 class="card-title">Ajouter un membre</h2>

                <a href="{{ route('admin-equipe') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des membres</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  <form action="{{ route('admin-equipe-create-valid') }}" method="post"  enctype="multipart/form-data">



                  		{{ csrf_field() }}

                        <div class="row">

                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Photo du membre (300x266)</label>

                                  <input type="file" name="photo" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Nom complet</label>

                                  <input type="text" placeholder="Nom complet du membre" name="nom" value="{{ old('nom') }}" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Fonction En Francais</label>

                                  <input type="text" value="{{ old('fonction_fr') }}" placeholder="Fonction" name="fonction_fr" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Fonction en Anglais</label>

                                  <input type="text" value="{{ old('fonction_en') }}" placeholder="Fonction" name="fonction_en" class="form-control" required>

                              </div>

                          </div>

                          <div class="col-md-4">

                              <div class="form-group">

                                  <label>Type de membre *</label>

                                  <select class="form-control" name="type_membre" required>
                                    <option value="Conseil d'administration">Conseil d'administration</option>
                                    <option value="Personnel">Personnel</option>
                                  </select>

                              </div>

                          </div>


                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Facebook</label>

                                  <input type="text" value="{{ old('facebook') }}" placeholder="Facebook" name="facebook" class="form-control">

                              </div>

                          </div>

                          <div class="col-md-6">

                              <div class="form-group">

                                  <label>Instagram</label>

                                  <input type="text" value="{{ old('instagram') }}" placeholder="Instagram" name="instagram" class="form-control">

                              </div>

                          </div>



                          <div class="col-md-12">

                            <div class="form-group">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Creer</button>

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