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
            Grupos
            @can('grupos.create')
                <a
                    href="{{ route('grupos.create')}}"
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
                    @foreach ($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->id }}</td>
                        <td>{{ $grupo->titulo }}</td>

                        <td width="10px">
                            @can('grupos.edit')
                                <a
                                    href="{{ route('grupos.edit',$grupo->id)}}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Editar
                                </a>
                            @endcan
                        </td>
                        <td width="10px">
                             @can('grupos.destroy')
                                {!! Form::open([
                                        'route' => ['grupos.destroy',$grupo->id], 'onsubmit' => 'return confirmarBorrado()', 'method'=>'DELETE'
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

            {{ $grupos->render()}}
        </div>

      </div>
    </div>
  </body>
  @include('layouts.footer')
