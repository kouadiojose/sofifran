@extends('layouts.admin')



@section('title', 'Publication')

@section('link', 'publication')


@section('content')



<!-- Content Header (Page header) -->

    <div class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Creation d'une publication</h1>

          </div><!-- /.col -->

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Tableau de Bord</a></li>

              <li class="breadcrumb-item active">Creation d'une publication</li>

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

          @if( session()->has('msg_del') )

          <div class="col-md-12">

            <div class="alert alert-danger">{{ session()->get('msg_del') }}</div>

          </div>

          @endif

          <div class="col-md-12">

            <div class="card">

              <div class="card-header">

                <h2 class="card-title">Creation d'une publication</h2>



            

                <a href="{{ route('admin-publication') }}" style="" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Liste des publications</a>

                

              </div>

              <!-- /.card-header -->

              <div class="card-body">



                  <form method="POST" action="{{ route('admin-publication-create-valide') }}"  enctype="multipart/form-data">



                      {{ csrf_field() }}

                      <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Titre en francais *</label>

                                <input type="text" class="form-control" name="titre_fr" required="required">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Titre en anglais *</label>

                                <input type="text" class="form-control" name="titre_en" required="required">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Date de publication *</label>

                                <input type="date" class="form-control" name="date_pub" required="required">

                            </div>

                        </div>
                          
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Joindre le fichier (pdf) *</label>
                                <input type="file" name="file_name" accept=".pdf" class="form-control" required>

                            </div>

                        </div>



                        <div class="col-md-12">

                            <div class="form-group">

                                <button type="submit" class="btn btn-primary">Créer</button>

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

    <!-- /.content 

   -->





@endsection



@section('js')







@endsection