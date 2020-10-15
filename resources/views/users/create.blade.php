@include('layouts.header')
<body class="theme-green font-montserrat light_version">

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <div id="wrapper">
    @include('layouts.top_nave')
    @include('layouts.panel_izq')
    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
            @include('layouts.alertas')
        </div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12">
                  <div class="card">
                      <div class="header">
                          <h2>Crear Usuarios</h2>
                      </div>
                      <div class="body">

                        {{ Form::open(['route' => 'users.store','files' => true ]) }}

                        {{ Form::label('nombre', 'Nick Usuario') }}

                        <div class="input-group mb-3">
                          {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
                        </div>
                        {{ Form::label('correo', 'Correo') }}

                        <div class="input-group mb-3">
                          {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                        {{ Form::label('contraseña', 'Contraseña') }}

                        <div class="input-group mb-3">
                          {{ Form::password('password', ['class' => 'form-control']) }}
                        </div>

                        <div class="input-group mb-3">
                          {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }} &nbsp;&nbsp;
                            <a href="{{ URL('/users') }}" class="btn btn-sm btn-danger"> Cancelar</a>
                        </div>


                        {{ Form::close() }}
                          </div>
                        </div>
                      </div>
                    </div>



      </div>
    </div>
  </body>
  @include('layouts.footer')
