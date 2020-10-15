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
            Roles
            @can('roles.create')
                <a
                    href="{{ route('roles.create')}}"
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
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>

                        <td width="10px">
                            @can('roles.edit')
                                <a
                                    href="{{ route('roles.edit',$role->id)}}"
                                    class="btn btn-sm btn-primary"
                                >
                                    Editar
                                </a>
                            @endcan
                        </td>
                        <td width="10px">
                             @can('roles.destroy')
                                {!! Form::open([
                                        'route' => ['roles.destroy',$role->id], 'method'=>'DELETE'
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

            {{ $roles->render()}}
        </div>

      </div>
    </div>
  </body>
  @include('layouts.footer')
