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
            Accion
        </div>

        <div class="panel-body">
            <p><strong>Titulo: </strong>{{ $accion->titulo}}</p>
        </div>



      </div>
    </div>
  </body>
  @include('layouts.footer')
