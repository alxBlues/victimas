@include('layouts.header')


<body class="theme-cyan font-montserrat light_version">

    <!-- Page Loader -->

<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
          <img src="/assets/images/maatLogoWeb.png" width="120" height="auto" class="d-inline-block align-top mr-2" alt="">
        </div>
        <div class="card forgot-pass">
            <div class="body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif
                <p class="lead mb-3"><strong>Oops</strong>,<br> Olvidaste algo?</p>
                <p>Ingresa tu correo para recuperaciones.</p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-round btn-primary btn-lg btn-block">Recuperar Contraseña</button>
                    <div class="bottom">
                        <span class="helper-text">Te acordaste? <a href="../">Ingresa</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->
</body>
@include('layouts.footer')
