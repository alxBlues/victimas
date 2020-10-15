@include('layouts.header')


<body class="theme-cyan font-montserrat light_version">


<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
          <img src="/assets/images/maatLogoWeb.png" width="120" height="auto" class="d-inline-block align-top mr-2" alt="">
        </div>
        <div class="card forgot-pass">
            <div class="body">
                <p class="lead mb-3"><strong>Email</strong>,<br> verificado</p>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">


                    <div class="form-group row">

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Correo Electronico" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>

                    <div class="form-group row">



                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nueva Contraseña" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>

                    <div class="form-group row">

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
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
