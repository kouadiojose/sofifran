@extends('layouts.admin')
@section('title', 'Engagez-vous')
@section('link', 'engagez')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Engagez-vous</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Engagez-vous</li>
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
                <h2 class="card-title">Engagez-vous</h2>
                <a href="{{ route('admin-blog') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Engagez-vous</a>
              </div>
              <!-- /.card-header -->

              
              <!-- form start -->
              <form role="form" action="{{ route('admin-blog-valid') }}" method="POST" enctype="multipart/form-data">
                
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="image">Image (850x550) *</label>
                        <input type="file" class="form-control" name="image" id="image" required="required">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="titre_fr">Titre Français *</label>
                        <input type="text" name="title_fr" required="required" class="form-control" id="titre_fr" placeholder="Titre Français...">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="titre_en">Titre Anglais *</label>
                        <input type="text" name="title_en" required="required" class="form-control" id="titre_en" placeholder="Titre Anglais...">
                      </div>
                    </div>

                  </div>
                  
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="description_fr">Description Français</label>
                            <textarea class="form-control" id="description_fr" name="description_fr" rows="5" placeholder="Mettez une description en Français..." required="required"></textarea>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="description_en">Description Anglais</label>
                            <textarea class="form-control" id="description_en" name="description_en" rows="5" placeholder="Mettez une description en Anglais..." required="required"></textarea>
                          </div>
                      </div>
                  </div>
                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="createBlog" class="btn btn-primary"><i class="fa fa-plus"></i> Créer</button>
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

@endsection