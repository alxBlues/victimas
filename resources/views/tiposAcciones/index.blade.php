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

        <div class="panel panel-default">

            <div class="panel-heading">
                Tipos de Acciones
                @can('categorias.crearAcciones')
                    <a
                        href="{{ route('categorias.crearAcciones')}}"
                        class="btn btn-sm btn-primary pull-right"
                    >
                    Crear
                    </a>
                @endcan
            </div>

            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="10px">ID</th>
                            <th>Nombre</th>
                            <th colspan="3">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->titulo }}</td>

                            <td width="10px">
                                @can('categorias.editarAcciones')
                                    <a
                                        href="{{ route('categorias.editarAcciones',$categoria->id)}}"
                                        class="btn btn-sm btn-primary"
                                    >
                                        Editar
                                    </a>
                                @endcan
                            </td>
                            <td width="10px">
                                 @can('categorias.eliminarAcciones')
                                    {!! Form::open([
                                            'route' => ['categorias.eliminarAcciones',$categoria->id], 'method'=>'DELETE'
                                        ])
                                    !!}

                                        <button class="btn btn-sm btn-danger">Eliminar</button>

                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav>
                  <ul class="pagination justify-content-end">
                      {!! $categorias->render() !!}

                  </ul>
              </nav>
            </div>
        </div>

      </div>
    </div>
  </body>
  @include('layouts.footer')
