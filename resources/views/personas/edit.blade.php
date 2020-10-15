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
          <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
              <h2>Edición de Usuarios</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="#">Atencion al Usuario</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edición de Usuarios</li>
                </ol>
              </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
              {{ Form::model($personas, ['route' => ['personas.update', $personas->id], 'method' => 'put']) }}
              {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary btn-round']) }}
              <a href="{{route('personas.show', $personas->id)}}" class="btn btn-sm btn-primary btn-round">Volver</a>
            </div>
          </div>
        </div>

        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <h2>Actualización de Datos</h2>
                @include('personas.form.edit')
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@include('layouts.footer')
