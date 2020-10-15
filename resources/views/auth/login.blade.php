@include('layouts.header')

<body class="theme-green font-montserrat light_version">

    <div class="auth-main particles_js" >
        <div class="auth_div vivify popIn">
            <div class="card">
                <div class="auth_brand">
                    <img src="/assets/images/maatLogoWeb.png" width="120" height="auto" class="d-inline-block align-top mr-2" alt="">
                </div>
                <div class="body">
                    <div class="mb-3">
                        <p class="lead">Ingrese sus credenciales de acceso.</p>
                    </div>
                    @if(session('messageDisableUser'))
                    <div class="alert alert-danger">
                        {{ session('messageDisableUser') }}
                    </div>
                    @endisset
                    <form method="POST" class="form-auth-small" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="signin-email" class="control-label sr-only">{{ __('E-Mail Address') }}</label>
                            <input id="signin-email" type="email" class="form-control round @error('email') is-invalid @enderror" placeholder="Correo" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group">
                            <label for="signin-password" class="control-label sr-only">{{ __('Password') }}</label>
                            <input id="signin-password" type="password" placeholder="Password" class="form-control round @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group clearfix">
                            <label class="fancy-checkbox element-left">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Recordarme</span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-round btn-block">
                            Ingresar
                        </button>
                        <div class="mt-4">
                            @if (Route::has('password.request'))
                            <span class="helper-text m-b-10"><i class="fa fa-lock"></i><a href="{{ route('password.request') }}">
                                    {{ __('Recuperar Contraseña') }}
                                </a></span>
                            @endif
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
