@can('planes.show')
@include('layouts.header')
<body class="theme-green font-montserrat light_version">
  <style>
    i {
      cursor:hand;
      display: inline-block;
      width: 40px;
      margin: 0;
      text-align: center;
      vertical-align: middle;
      -webkit-transition: font-size 0.2s;
      -moz-transition: font-size 0.2s;
      transition: font-size 0.2s;
    }

    i:hover {
      font-size: 26px;
    }
  </style>

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <div id="wrapper">
    @include('layouts.top_nave')
    @include('layouts.panel_izq')

    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
          <div class="block-header">
              @include('layouts.alertas')
          </div>
          <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
              <h2>{{ $plan->titulo }}</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="#">Gestión de PAT</a></li>
                  <li class="breadcrumb-item"><a href="/planes">Planes</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $plan->titulo }}</li>
                </ol>
              </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
              @can('atributos.create')<button type="button" class="btn btn-sm btn-primary btn-round" data-toggle="modal" data-target=".new-project-modal">Crear Atributo</button>@endcan
              @can('variables.create')<button type="button" class="btn btn-sm btn-primary btn-round" data-toggle="modal" data-target=".new-variable-modal">Crear
                @foreach($plan->atributos as $atr)
                  @if($loop->first)
                  {{ $atr->titulo }}
                  @endif
                @endforeach
              </button>@endcan
            </div>
          </div>
        </div>


        <div class="row clearfix">
          <!-- Modal Crear Atributo -->
                          @can('atributos.create')
                            <div class="modal fade new-project-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Crear Atributo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          {{ Form::open(['route' => 'atributos.store','plan' => $plan,'files' => true ]) }}

                                              @include('atributos.form.form')

                                          {{ Form::close() }}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <!-- Fin Modal Crear Atributo--->
                        @endcan

                        @can('atributos.edit')
                        @foreach($plan->atributos as $atri)
                        <!-- Modal Editar Atributo -->
                            <div class="modal fade new-atr-modal{{ $atri->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Atributo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                {!! Form::model($atri, ['route' => ['atributos.update', $atri->id], 'method' => 'PUT','files' => true]) !!}

                                                    @include('atributos.form.form')

                                                {!! Form::close() !!}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <!-- Fin Modal editar Atributo--->
                        @endforeach
                        @endcan


                        <!-- Modal Crear Variable Padre-->
                            <div class="modal fade new-variable-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Crear Variable</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          {{ Form::open(['route' => 'variables.store','files' => true ]) }}

                                              @include('variables.form.form')

                                          {{ Form::close() }}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <!-- Fin Modal Crear Variable Padre--->

                      @foreach($plan->atributos as $atr)
                        @foreach($atr->variables as $var)
                        <!-- Modal Editar Variables -->
                            <div class="modal fade new-variable-modal{{ $var->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar Variable</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                          {!! Form::model($var, ['route' => ['variables.update', $var->id], 'method' => 'PUT','files' => true]) !!}

                                              @include('variables.form.form')

                                          {!! Form::close() !!}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <!-- Fin Modal Editar Variables--->
                        @endforeach
                      @endforeach


          <div class="col-12">
            <div class="card">
              <div class="body margin-0 padding-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#atributos"><i class="fa fa-filter"></i> Atributos</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#componentes"><i class="fa fa-tasks"></i>
                      @foreach($plan->atributos as $atr)
                        @if($loop->first)
                        {{ $atr->titulo }}
                        @endif
                      @endforeach
                    </a></li>
                </ul>
              </div>
                <div class="tab-content m-t-0">
                    <div class="tab-pane show active" id="atributos">
                      <div class="table-responsive">
                        <table class="table header-border table-hover table-custom spacing5">
                          <thead>
                            <tr>
                              <th style="width: 50%;">Atributo</th>
                              <th style="width: 20%;">Fecha</th>
                              <th style="width: 15%;">Prioridad</th>
                              <th style="width: 15%;">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($plan->atributos as $atr)
                            <tr>
                              <td ><a href="">{{ $atr->titulo }}</a></td>
                              <td>{{ $atr->created_at }}</td>
                              <td>{{ $atr->categorias->titulo }}</td>
                              <td>
                                  @can('atributos.edit')<button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-atr-modal{{ $atr->id }}"><i class="fa fa-edit"></i></button>@endcan
                                  @can('atributos.destroy')
                                {!! Form::open(['route' => ['atributos.destroy', $atr->id], 'onsubmit' => 'return confirmarBorrado()', 'method' => 'DELETE']) !!}
                                <button class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                {!! Form::close() !!}
                                @endcan
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="componentes">
                      <div class="table-responsive">
                        <table class="table header-border table-hover table-custom spacing5">
                          <thead>
                            <tr>
                              <th style="width: 50%;">
                                @foreach($plan->atributos as $atr)
                                  @if($loop->first)
                                  {{ $atr->titulo }}
                                  @endif
                                @endforeach
                              </th>
                              <th style="width: 20%;">Fecha</th>
                              <th style="width: 15%;">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- Busca todos los atributos en un plan -->
                                                @foreach($plan->atributos as $atr)
                                                @php $prevState = "";    @endphp

                                                <!-- Busca todas las variables en un atributo -->

                                                  @foreach($atr->variables as $var)

                                                  <!-- Pregunta si es una variable del tipo Padre -->

                                                    @if(empty($var->parent_id))
                                                        @php $state = $var->id; @endphp

                                                        <!-- Pregunta si tiene descendientes -->

                                                    @if(count($var->descendants)>0)

                                                    <!-- Busca todos los descendientes de la variable -->

                                                      @foreach($var->descendants as $hijos)

                                                      <!-- Pregunta si el usuario conectado es administrador -->

                                                        @if(auth()->user()->hasRole('Admin') or auth()->user()->hasRole('Auditor'))

                                                        <!-- Pregunta si la variable buscada es igual a la encontrada evita repetidos -->

                                                          @if($prevState != $state)
                                                            @php $prevState = $state; @endphp
                                                          <tr>
                                                            <td><a href="{{ route('variables.show',$var->id) }}">{{ $var->variable }}</a></td>

                                                            <td>{{ $var->created_at }}</td>
                                                            <td>
                                                              @can('variables.edit')
                                                              <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-variable-modal{{ $var->id }}"><i class="fa fa-edit"></i></button>
                                                              @endcan
                                                              @can('variables.destroy')
                                                              {!! Form::open(['route' => ['variables.destroy', $var->id], 'onsubmit' => 'return confirmarBorrado()','method' => 'DELETE']) !!}
                                                              <button class="btn btn-sm btn-default js-sweetalert" title="Eliminar" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                                              {!! Form::close() !!}
                                                              @endcan
                                                            </td>
                                                          </tr>

                                                          <!-- Fin de la Pregunta si la variable buscada es igual a la encontrada evita repetidos -->
                                                          @endif


                                                        <!-- Condicion si el usuario no es dl tipo administrador -->
                                                        @else

                                                        <!-- Pregunta si las variables hijos tienen atributos del tipo permisos-->
                                                          @if($hijos->atributos->tipo=='3')

                                                          <!-- Pregunta si el permiso de las variables es igual al grupo del usuario conectado -->
                                                            @if($hijos->variable == isset(auth()->user()->grupos[0]->id))

                                                              <!-- Pregunta si la variable buscada es igual a la encontrada evita repetidos -->
                                                              @if($prevState != $state)
                                                                @php $prevState = $state; @endphp
                                                              <tr>
                                                                <td><a href="{{ route('variables.show',$var->id) }}">{{ $var->variable }}</a></td>

                                                                <td>{{ $var->created_at }}</td>
                                                                <td>
                                                                  @can('variables.edit')
                                                                  <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-variable-modal{{ $var->id }}"><i class="fa fa-edit"></i></button>
                                                                  @endcan
                                                                  @can('variables.destroy')
                                                                  {!! Form::open(['route' => ['variables.destroy', $var->id], 'onsubmit' => 'return confirmarBorrado()','method' => 'DELETE']) !!}
                                                                  <button class="btn btn-sm btn-default js-sweetalert" title="Eliminar" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                                                  {!! Form::close() !!}
                                                                  @endcan
                                                                </td>
                                                              </tr>

                                                                <!-- Fin de la Pregunta si la variable buscada es igual a la encontrada evita repetidos -->
                                                              @endif

                                                                <!-- Fin de la Pregunta si el permiso de las variables es igual al grupo del usuario conectado-->
                                                            @endif

                                                              <!-- Fin de la Pregunta si las variables hijos tienen atributos del tipo permisos-->
                                                          @endif

                                                          <!-- Fin de la Pregunta si las variables hijos tienen atributos del tipo permisos-->
                                                        @endif

                                                        <!-- Fin del Buscar todos los descendientes de la variable -->
                                                      @endforeach


                                                      <!-- Pregunta si no tiene descendientes -->

                                                    @else

                                                    <tr>
                                                      <td><a href="{{ route('variables.show',$var->id) }}">{{ $var->variable }}</a></td>

                                                      <td>{{ $var->created_at }}</td>
                                                      <td>
                                                        @can('varaibles.edit')
                                                        <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-variable-modal{{ $var->id }}"><i class="fa fa-edit"></i></button>
                                                        @endcan
                                                        @can('variables.destroy')
                                                          {!! Form::open(['route' => ['variables.destroy', $var->id], 'onsubmit' => 'return confirmarBorrado()','method' => 'DELETE']) !!}
                                                          <button class="btn btn-sm btn-default js-sweetalert" title="Eliminar" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                                          {!! Form::close() !!}
                                                          @endcan
                                                      </td>
                                                    </tr>

                                                      <!-- Fin de la pregunta si tiene descendientes -->
                                                    @endif

                                                    <!-- Fin de la pregunta si es del tipo padre -->

                                                    @endif
                                                    <!-- Fin de la busqueda de las variables segun el atributo -->
                                                  @endforeach
                                                  <!-- Fin de los atributos segun el plan -->
                                                @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@include('layouts.footer')
@endcan
