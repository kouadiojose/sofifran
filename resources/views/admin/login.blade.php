  @extends('admin.master-connexion')

  @section('title', 'Se connecter')
  @section('section')

  <div class="card">

    <div class="card-body login-card-body">
      @if( session()->has('error') )
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
      @endif

      <p class="login-box-msg">Se connecter pour demarrer votre Session</p>

      <form action="{{ route('login-submit') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" required name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="check" id="remember">
              <label for="remember">
                Se souvenir de moi
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('admin-forgot') }}">Mot de passe oublié ?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
