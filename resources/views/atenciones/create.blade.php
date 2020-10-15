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
          <div>
              @include('layouts.alertas')
          </div>
          <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
              <h2>Registrar Nueva Atencion</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="#">Atención al Usuario</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Registrar Nueva Atención</li>
                </ol>
              </nav>
            </div>
            <!-- <div class="col-md-6 col-sm-12 text-right hidden-xs">
            <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target=".new-plan-modal">Agregar Nuevo</a>
            </div> -->
          </div>
        </div>
        <div class="row clearfix justify-content-center">
          <div class="col-lg-8 col-md-12">
            <div class="card">
              <div class="body">
                {{ Form::open(['route' => 'atencion.store']) }}
                {{ Form::hidden('persona_id', $persona->id) }}

                @include('atenciones.form.form')

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
