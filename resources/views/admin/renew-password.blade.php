   @extends('admin.master-connexion')

  @section('title', 'Changer le mot de passe')
  @section('section')

 <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Vous etes sur l'étape de changement de mot de passe, donc changer maintenant.</p>

      <form action="#" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Nouveau mot de passe" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirmer nouveau mot de passe" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Changer le mot de passe</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('admin-login') }}">Connexion</a>
      </p>
    </div>
    <!-- /.login-card-body -->

    @endsection