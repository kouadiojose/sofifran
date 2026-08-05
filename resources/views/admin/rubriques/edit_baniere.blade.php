@extends('layouts.admin')



@section('title', 'Banieres')

@section('link', 'baniere')



@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark"><i class="fas fa-pencil-alt"></i> Editer Banière</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Editer Banière</li>

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

                <h2 class="card-title"><i class="fas fa-pencil-alt"></i> Editer Banière</h2>

                <a href="{{ route('admin-banieres') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des Banières</a>

              </div>

              <!-- /.card-header -->

              <div class="card-body">

                  

                  

                    <form action="{{ route('admin-banieres-edit-valide') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="row">

                          <div class="col-md-12">

                            <div class="form-group">

                              <img src="/assets/images/resource/{{ $baniere->image }}" width="500">

                              <input type="hidden" name="img_up" value="{{ $baniere->image }}">

                              <input type="hidden" name="id" value="{{ $baniere->id }}">

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Charger une nouvelle image</label>

                              <input type="file" class="form-control" name="new_img">

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Page</label>

                              <input type="text" class="form-control" name="page" value="{{ $baniere->page }}">

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Français</label>

                              <input type="text" class="form-control" name="title_fr" value="{{ $baniere->title_fr }}">

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Titre en Anglais</label>

                              <input type="text" class="form-control" name="title_en" value="{{ $baniere->title_en }}">

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