@extends('layouts.admin')



@section('title', 'Creation Slider')

@section('link', 'baniere')



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="fas fa-pencil-alt"></i> Creation Slider</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Creation Slider</li>

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

            <div class="card card-primary card-outline">

              <div class="card-header">

                <h2 class="card-title"><i class="fas fa-pencil-alt"></i> Creation Slider</h2>

                <a href="{{ route('admin-banieres') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des Slides</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">
                  
                    <form action="{{ route('admin-slide-create-valide') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Charger une nouvelle image (1920x800)</label>

                              <input type="file" class="form-control" name="new_img">

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Couleur du bouton</label>

                              <select class="form-control" name="btn_color">

                                <option>Selectionner</option>

                                <option value="common-btn">Jaune du logo</option>
                                <option value="common-btn banner-btn">Rouge du logo</option>

                              </select>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Libellé du bouton en Français *</label>
                              <input type="text" class="form-control" name="btn_name_fr" required>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Libellé du bouton en Anglais *</label>

                              <input type="text" class="form-control" name="btn_name_en" required>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Lien du bouton</label>

                              <input type="text" class="form-control" name="btn_link">

                            </div>

                          </div>



                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Français *</label>

                              <input type="text" class="form-control" name="title_fr" required>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Anglais *</label>

                              <input type="text" class="form-control" name="title_en" required>

                            </div>

                          </div>





                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Description courte en Français *</label>

                              <textarea class="form-control" name="description_fr" rows="3"></textarea>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Description courte en Anglais *</label>

                              <textarea class="form-control" name="description_en" rows="3"></textarea>

                            </div>

                          </div>



                          <div class="col-md-12">

                            <div class="form-group">

                              <label>Positionner</label>

                              <select class="form-control" name="orders">

                                <option>Positionner</option>

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>

                              </select>

                            </div>

                          </div>





                          <div class="col-md-12">

                            <div class="form-group">

                              <button name="edit" type="submit" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Creer</button>

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