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
          @can('users.create')
            <a href="{{ route('users.create') }}"
            class="btn btn-sm btn-primary pull-right">
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
                        <th colspan="4">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>

                        <td>
                            @can('users.edit')
                                <a
                                    href="{{ route('users.edit',$user->id)}}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Editar
                                </a>
                            @endcan
                        </td>
                        <td>
                            @php
                            $estado = array("1" => "Activo", "0" => "Desactivo");
                            $estadoColor = array("1" => "btn-primary", "0" => "btn-danger");
                            @endphp
                                <a href="{{ route('perfil.estado',$user->id)}}" class="btn btn-sm {{ $estadoColor[$user->estado] }}">
                                    Cambiar estado ({{ $espuesta ?? $estado[$user->estado] }})
                                </a>
                        </td>
                        <td>
                            @can('users.destroy')
                                {{ Form::open([
                                        'route' => ['users.destroy',$user->id], 'onsubmit' => 'return confirmarBorrado()', 'method'=>'DELETE'
                                    ])
                                }}

                                    <button class="btn btn-sm btn-danger">Eliminar</button>

                                {{ Form::close() }}
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->render()}}
        </div>


      </div>
    </div>
  </body>
  @include('layouts.footer')
