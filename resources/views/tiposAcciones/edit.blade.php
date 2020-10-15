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

        <div class="panel-heading">
            Acciones
        </div>

        <div class="panel-body">
            {!! Form::model(
                    $accion,
                    [ 'route'=>['categorias.actualizarAcciones',$accion->id],
                       'method' => 'PUT'
                    ]
                )
            !!}
                @include('tiposAcciones.partials.form')

            {!! Form::close()!!}
        </div>



      </div>
    </div>
  </body>
  @include('layouts.footer')
