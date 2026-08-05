@extends('layouts.admin')
@section('title', 'Blogs')
@section('link', 'blog')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editer le blog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Editer le blog</li>
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
                <h2 class="card-title">Editer le blog</h2>
                <a href="{{ route('admin-blog') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des blogs</a>
              </div>
              <!-- /.card-header -->

              
              @include('admin.blogs.master._formEdit')

            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection