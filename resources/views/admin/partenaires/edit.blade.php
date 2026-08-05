@extends('layouts.admin')
@section('title', 'Partenaires')
@section('link', 'partenaire')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modification de partenaire</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Modification de partenaire</li>
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
                <h2 class="card-title">Modification de partenaire</h2>
                <a href="{{ route('admin-partenaire') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des partenaires</a>
              </div>
              <!-- /.card-header -->

              
              @include('admin.partenaires.master._formEdit')

            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection