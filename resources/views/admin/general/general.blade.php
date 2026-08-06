@extends('layouts.admin')

@section('title', 'Général')
@section('link', 'general')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-settings-alt"></i> Paramètres Généraux </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Paramètres Généraux</li>
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
                <h2 class="card-title"><i class="fas fa-pencil-alt"></i> Paramètres Généraux</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                  
                    <form action="{{ route('admin-general-valide') }}" method="post" enctype="multipart/form-data">
                      
                        {{ csrf_field() }}
                        <div class="row">
                          
                          <div class="col-md-12">
                            <div class="form-group">
                                <img src="/frontend/assets/images/{{ $setting->logo }}" width="250">
                                <input type="hidden" value="{{ $setting->logo }}" name="img_up">
                                <input type="hidden" value="{{ $setting->id }}" name="id">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Charger un nouveau logo</label>
                              <input type="file" class="form-control" name="new_img">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Téléphone 1</label>
                              <input type="text" class="form-control" name="phone1" value="{{ $setting->phone1 }}">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" value="{{ $setting->email }}">
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Adresse 1</label>
                              <textarea class="form-control" name="adresse1">{{ $setting->adresse1 }}</textarea>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Adresse 2</label>
                              <textarea class="form-control" name="adresse2">{{ $setting->adresse2 }}</textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Facebook</label>
                              <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Instagram</label>
                              <input type="text" class="form-control" name="instagram" value="{{ $setting->instagram }}">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Twitter</label>
                              <input type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Youtube</label>
                              <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Linkedln</label>
                              <input type="text" class="form-control" name="linkedln" value="{{ $setting->linkedln }}">
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