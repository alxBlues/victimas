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
           Rol
        </div>

        <div class="panel-body">
            <p><strong>Nombre: </strong>{{ $role->name}}</p>
            <p><strong>Slug: </strong>{{ $role->slug}}</p>
            <p><strong>Descripcion: </strong>{{ $role->description}}</p>
        </div>



      </div>
    </div>
  </body>
  @include('layouts.footer')
