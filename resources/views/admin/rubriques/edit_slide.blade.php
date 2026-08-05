@extends('layouts.admin')



@section('title', 'Banieres')

@section('link', 'baniere')



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="fas fa-pencil-alt"></i> Editer Slider</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Editer Slider</li>

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

                <h2 class="card-title"><i class="fas fa-pencil-alt"></i> Editer Slider</h2>

                <a href="{{ route('admin-banieres') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des Banières</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  

                    <form action="{{ route('admin-slide-edit-valide') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="row">

                          <div class="col-md-12">

                            <div class="form-group">

                              <img src="/assets/images/main-slider/{{ $slide->image }}" width="500">

                              <input type="hidden" name="img_up" value="{{ $slide->image }}">

                              <input type="hidden" name="id" value="{{ $slide->id }}">

                            </div>

                          </div>

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

                                <option <?php if( $slide->btn_color == 'common-btn' ){ ?> selected="selected" <?php } ?> value="common-btn">Jaune du logo</option>

                                <option <?php if( $slide->btn_color == 'common-btn banner-btn' ){ ?> selected="selected" <?php } ?> value="common-btn banner-btn">Rouge du logo</option>

                              </select>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Libellé du bouton en Français</label>

                              <input type="text" class="form-control" name="btn_name_fr" value="{{ $slide->btn_name_fr }}">

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Libellé du bouton en Anglais</label>

                              <input type="text" class="form-control" name="btn_name_en" value="{{ $slide->btn_name_en }}">

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Lien du bouton</label>

                              <input type="text" class="form-control" name="btn_link" value="{{ $slide->btn_link }}">

                            </div>

                          </div>



                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Français</label>

                              <input type="text" class="form-control" name="title_fr" value="{{ $slide->title_fr }}">

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Anglais</label>

                              <input type="text" class="form-control" name="title_en" value="{{ $slide->title_en }}">

                            </div>

                          </div>





                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Description courte en Français</label>

                              <textarea class="form-control" name="description_fr" rows="3">{{ $slide->description_fr }}</textarea>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Description courte en Anglais</label>

                              <textarea class="form-control" name="description_en" rows="3">{{ $slide->description_en }}</textarea>

                            </div>

                          </div>



                          <div class="col-md-12">

                            <div class="form-group">

                              <label>Positionner</label>

                              <select class="form-control" name="orders">

                                <option>Positionner</option>

                                <option <?php if( $slide->orders == '1' ){ ?> selected="selected" <?php } ?> value="1">1</option>

                                <option <?php if( $slide->orders == '2' ){ ?> selected="selected" <?php } ?> value="2">2</option>

                                <option <?php if( $slide->orders == '3' ){ ?> selected="selected" <?php } ?> value="3">3</option>

                                <option <?php if( $slide->orders == '4' ){ ?> selected="selected" <?php } ?> value="4">4</option>
                                <option <?php if( $slide->orders == '5' ){ ?> selected="selected" <?php } ?> value="5">5</option>
                                <option <?php if( $slide->orders == '6' ){ ?> selected="selected" <?php } ?> value="6">6</option>
                                <option <?php if( $slide->orders == '7' ){ ?> selected="selected" <?php } ?> value="7">7</option>
                                <option <?php if( $slide->orders == '8' ){ ?> selected="selected" <?php } ?> value="8">8</option>

                              </select>

                            </div>

                          </div>





                          <div class="col-md-12">

                            <div class="form-group">

                              <button name="edit" type="submit" class="btn btn-success"><i class="fas fa-pencil-alt"></i> Editer</button>

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