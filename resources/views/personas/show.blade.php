@include('layouts.header')

<body class="theme-green font-montserrat light_version">

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <div id="wrapper">
    @include('layouts.top_nave')
    @include('layouts.panel_izq')
    <div id="main-content">
      @include('layouts.alertas')
      <div class="container-fluid">
        <div class="block-header">
          <div class="row clearfix ">
            <div class="col-md-6 col-sm-12">
              <h2>Ficha de Caracterización</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="/personas">Buscar Usuarios</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ficha de Caracterización</li>
                </ol>
              </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
              <a href="{{route('personas.edit', $persona->id)}}" class="btn btn-sm btn-primary btn-round">Actualizar Datos</a>
              <a href="{{route('atencion.create', $persona->id)}}" class="btn btn-sm btn-primary btn-round">Registrar Atención</a>
              <a href="{{route('personas.index')}}" class="btn btn-sm btn-primary btn-round">Volver</a>
            </div>
          </div>
        </div>

        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <!--div class="header">
              </div-->
              <div class="body">
                <h2>{{$persona->primerNombre}} {{$persona->segundoNombre}} {{$persona->primerApellido}}</h2>
                <div class="form-group required-control">
                  <label class="control-label" for="number_944611">ID consecutivo</label>
                  <p class="form-control">{{$persona->id}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_824547">Primer Nombre</label>
                  <p class="form-control">{{$persona->primerNombre}}</p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_808880">Segundo Nombre</label>
                  @if($persona->segundoNombre != null)
                  <p class="form-control">{{$persona->segundoNombre}}</p>
                  @else
                  <p class="form-control">N/A</p>
                  @endif
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_424108">Primer Apellido</label>
                  <p class="form-control">{{$persona->primerApellido}}</p>
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_192231"> Segundo Apellido </label>
                  @if($persona->segundoApellido != null)
                  <p class="form-control">{{$persona->segundoApellido}}</p>
                  @else
                  <p class="form-control">N/A</p>
                  @endif
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_82620">Tipo de Documento</label>
                  <p class="form-control">{{$personas->documentos->titulo}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_779456">Número Documento</label>
                  <p class="form-control">{{$persona->identificacion}}</p>
                </div>

                <!-- Number -->
                <div class="form-group required-control">
                  <label class="control-label" for="number_462541">Fecha de Nacimiento</label>
                  <p class="form-control">{{$persona->fechaNacimiento}}</p>
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Edad</label>
                  <p class="form-control">{{Carbon\Carbon::createFromDate($persona->fechaNacimiento)->age}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group">
                  <label class="control-label" for="selectlist_721011">Grado</label>
                  <p class="form-control">{{$personas->grados->titulo}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Teléfono</label>
                  <p class="form-control">{{$persona->telefono}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Area</label>
                  @if($persona->area == '1')
                  <p class="form-control">Urbano</p>
                  @else
                  <p class="form-control">Rural</p>
                  @endif
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Estrato</label>
                  @if($persona->estrato == '1')
                  <p class="form-control">Entre 1 y 2</p>
                  @else
                  <p class="form-control">Entre 3 y 4</p>
                  @endif
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_125219">Salud </label>
                  @if($persona->salud == '1')
                  <p class="form-control">Contributivo</p>
                  @elseif($persona->salud == '2')
                  <p class="form-control">Subsidiado</p>
                  @else
                  <p class="form-control">N/A</p>
                  @endif

                </div>

                <!-- Checkbox -->
                <div class="form-group">
                  <label class="control-label" for="etnia">Género</label>
                  <p class="form-control">
                    {{$persona->name}}
                  </p>
                </div>

                <!-- Checkbox -->
                <div class="form-group">
                  <label class="control-label" for="especial">Tipo Poblacion</label>
                  <p class="form-control">
                    {{$tipo->name}}
                  </p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_99422">Grupo Étnico</label>
                  <p class="form-control">{{$enfoque->name}}</p>
                </div>

                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_99422">Hecho Victimizante</label>
                  @if($hecho->isEmpty())
                    <p class="form-control">Ninguno</p>
                  @else
                  @foreach($hecho as $hechos)
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          {!! Form::checkbox('hechosV[]', 'N', 1, ['class' => 'field', 'disabled' => 'disabled']) !!}
                        </div>
                      </div>
                      {{ Form::text('titulos', null, ['class' => 'form-control', 'placeholder'=>$hechos->name, 'disabled' => 'disabled']) }}
                  </div>
                  @endforeach

                  @endif
                </div>

                <!-- Text -->
                <!--<div class="form-group required-control">-->
                <!--    <label class="control-label" for="text_646479">Víctima</label>-->
                <!--    <p class="form-control"></p>-->
                <!--</div>-->
                <a href="{{route('personas.edit', $persona->id)}}" class="btn btn-primary">Editar Usuario</a>
                <a href="{{route('personas.index')}}" class="btn btn-primary">Volver</a>
              </div>
            </div>
          </div>
        </div>
        @can('atencion.create')
        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                  <a class="btn btn-primary " id="boton_consulta" href="" onclick="$('#tabla_atencion').slideToggle(function(){$('#boton_consulta').html($('#tabla_atencion').is(':hidden')?'Mostrar Atenciones':'Ocultar Atenciones');});return false">Mostrar Atenciones</a>
                  <a href="{{route('atencion.create', $persona->id)}}" class="btn btn-primary">Registrar Nueva Atención</a>
                  <div class="col-lg-12 col-md-12" id="tabla_atencion" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <td>Accion</td>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Ver</th>
                      </thead>
                      <tbody>
                        @foreach($atenciones as $atencion)
                        <tr>
                          <td>{{$atencion->id}}</td>
                          <td>{{$atencion->variable}}</td>
                          <td>{{$atencion->evento}}</td>
                          <td>{{$atencion->fecha}}</td>
                          <td>
                            <a href="{{route('atencion.show', $atencion->id)}}" class="btn btn-primary btn-sm btn-round">Ver Accion</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endcan
        @can('psicosocial.create')
        @if(!$hecho->isEmpty())
        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                  <a class="btn btn-primary" id="boton_consulta" href="" onclick="$('#tabla_atencionP').slideToggle(function(){$('#boton_consulta').html($('#tabla_atencion').is(':hidden')?'Mostrar Atenciones':'Ocultar Atenciones');});return false">Mostrar Atenciones</a>
                  <a href="{{route('psicosocial.create', $persona->id)}}" class="btn btn-primary">Registrar Nueva Atención Psicosocial</a>
                  <div class="col-lg-12 col-md-12" id="tabla_atencionP" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Ver</th>
                      </thead>
                      <tbody>
                        @foreach($atencionP as $atencion)
                        <tr>
                          <td>{{$atencion->id}}</td>
                          <td>{{$atencion->fechaAtencion}}</td>
                          <td>
                            <a href="{{route('psicosocial.show', $atencion->id)}}" class="btn btn-primary btn-sm btn-round">Ver Atencion</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endcan
        @can('atencionJuridica.create')
        @if(!$hecho->isEmpty())
        <!-- Inicio atencion juridica--->
        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                  <a class="btn btn-primary" id="boton_consulta_aten_juri" href="" onclick="$('#tabla_atencion_juricaP').slideToggle(function(){$('#boton_consulta_aten_juri').html($('#tabla_atencion_juricaP').is(':hidden')?'Mostrar Atencion Jurica':'Ocultar Atencion Jurica');});return false">Mostrar Atencion Juridica</a>
                  <a href="javascript:void(0);" class="btn btn-primary" title="" data-toggle="modal" data-target=".new-atencion-jurica-modal">Registrar Atencion Juridica</a>
                  <div class="col-lg-12 col-md-12" id="tabla_atencion_juricaP" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <th>Chequeo</th>
                        <th>Fecha</th>
                        <th>Ver</th>
                      </thead>
                      <tbody>
                        @foreach($aten_juridicas as $aten_juridica)
                        <tr>
                          <td>{{$aten_juridica->id}}</td>
                          <td>
                            @if( $aten_juri_lista_chequeo[$aten_juridica->chequeo] == 'Otros')
                            {{$aten_juridica->otros_texto}}
                            @else
                            {{$aten_juri_lista_chequeo[$aten_juridica->chequeo]}}
                            @endif
                          </td>
                          <td>{{date('Y-m-d',strtotime($aten_juridica->created_at))}}</td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-round" title="" data-toggle="modal" data-target=".ver-aten-juridica-modal-{{$aten_juridica->id}}">Ver Atencion Jueridica</a>

                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin atencion juridica--->
        @endif

        @endcan

        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                  <a class="btn btn-primary" id="boton_consulta" href="" onclick="$('#tabla_benef').slideToggle(function(){$('#boton_consulta').html($('#tabla_atencion').is(':hidden')?'Mostrar Atenciones':'Ocultar Atenciones');});return false">Mostrar Beneficiarios</a>
                    <a href="javascript:void(0);" class="btn btn-primary" title="" data-toggle="modal" data-target=".new-plan-modal">Registrar Beneficiarios</a>
                  <div class="col-lg-12 col-md-12" id="tabla_benef" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <th>Nombre y Apellido</th>
                        <th>Ver</th>
                      </thead>
                      <tbody>
                        @foreach($beneficiarios as $beneficiario)
                        <tr>
                          <td>{{$beneficiario->id}}</td>
                          <td>{{$beneficiario->primerNombre}} {{$beneficiario->primerApellido}}</td>
                          <td>
                            <a href="{{route('beneficiarios.show', $beneficiario->id)}}" class="btn btn-primary btn-sm btn-round">Ver</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @can('ayudavictimas.create')
        @if(!$hecho->isEmpty())
         <!-- Inicio Ayuda Victimas--->
        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                   <a class="btn btn-primary" id="boton_consulta" href="" onclick="$('#tabla_ayudasP').slideToggle(function(){$('#boton_consulta').html($('#tabla_ayudas').is(':hidden')?'Mostrar Ayudas':'Ocultar Ayudas');});return false">Mostrar Ayudas</a>
                  <a href="javascript:void(0);" class="btn btn-primary" title="" data-toggle="modal" data-target=".new-ayuda-modal">Registrar Ayuda</a>
                  <div class="col-lg-12 col-md-12" id="tabla_ayudasP" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <th>Ayudas</th>
                        <th>valor</th>
                        <th>Ver</th>
                      </thead>
                      <tbody>
                        @foreach($registro_ayudas as $ayuda)
                        <tr>
                          <td>{{$ayuda->id}}</td>
                          <td>
                            @php
                            $ids_ayudasA = $ayuda->ids_ayudas;
                            $ids_ayudas =explode(",", $ids_ayudasA);
                            foreach($ids_ayudas as $id_ayuda){
                            foreach($ayudas as $lista_ayudas){
                            if($id_ayuda == $lista_ayudas['id']){
                            echo $lista_ayudas['nombre'].', ';
                            }
                            }
                            }
                            @endphp
                          </td>
                          <td>{{$ayuda->valor_ayudas}}</td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-round" title="" data-toggle="modal" data-target=".edita-ayuda-modal-{{$ayuda->id}}">Ver Ayuda</a>
                            <!-- <a href="{{route('ayudavictimas.show', $ayuda->id)}}" class="btn btn-primary btn-sm btn-round">Ver Atencion</a> -->
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin Ayuda Victimas--->
        @endif
        @endcan
        @can('seguimientoayudavictimas.create')
        @if(!$hecho->isEmpty())
        <!-- Inicio Seguimiento Victimas--->
        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                  <a class="btn btn-primary" id="boton_consulta" href="" onclick="$('#tabla_seguimientoP').slideToggle(function(){$('#boton_consulta').html($('#tabla_ayudas').is(':hidden')?'Mostrar Seguimiento':'Ocultar Seguimiento');});return false">Mostrar Seguimiento Psicosocial</a>
                  <a href="javascript:void(0);" class="btn btn-primary" title="" data-toggle="modal" data-target=".new-seguimiento-modal">Registrar Seguimiento Psicosocial</a>
                  <div class="col-lg-12 col-md-12" id="tabla_seguimientoP" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <th>motivo</th>
                        <th>fecha</th>
                        <th>Ver</th>
                      </thead>
                      <tbody>
                        @foreach($seguimientos as $seguimiento_ayuda)
                        <tr>
                          <td>{{$seguimiento_ayuda->id}}</td>
                          <td>
                            {{$seguimiento_ayuda->motivo_desarrollo_de_la_intervencion}}
                          </td>
                          <td>{{$seguimiento_ayuda->fecha_seguimiento}}</td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-round" title="" data-toggle="modal" data-target=".ver-seguimiento-modal-{{$seguimiento_ayuda->id}}">Ver Seguimiento</a>
                            <!-- <a href="{{route('ayudavictimas.show', $ayuda->id)}}" class="btn btn-primary btn-sm btn-round">Ver Atencion</a> -->
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin Seguimiento Victimas--->
        @endif
        @endcan
        @can('bitacora.create')
        @if(!$hecho->isEmpty())
        <!-- Inicio bitacora--->
        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <div class="body">
                <div class="dropdown d-inline-block ml-2">
                  <a class="btn btn-primary" id="boton_consulta" href="" onclick="$('#tabla_BitacoraP').slideToggle(function(){$('#boton_consulta').html($('#tabla_Bitacora').is(':hidden')?'Mostrar Bitacora':'Ocultar Bitacora');});return false">Mostrar Bitacora Restitución de Tierras</a>
                  <a href="javascript:void(0);" class="btn btn-primary" title="" data-toggle="modal" data-target=".new-Bitacora-modal">Registrar Bitacora Restitución de Tierras</a>
                  <div class="col-lg-12 col-md-12" id="tabla_BitacoraP" style="display: none;">
                    <table class="table">
                      <thead>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Ver</th>
                        <th>Editar</th>
                      </thead>
                      <tbody>
                        @if(!$Bitacora->isEmpty())
                        @foreach($Bitacora as $Bitacora_ayuda)
                        <tr>
                          <td>{{$Bitacora_ayuda->id}}</td>
                          <td>
                            {{$Bitacora_ayuda->titulo}}
                          </td>
                          <td>{{$Bitacora_ayuda->fecha}}</td>
                          <td>
                            <span class="badge badge-success">
                              {{ $Bitacora_ayuda->estado ?? '' }}
                            </span>
                          </td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-round" title="" data-toggle="modal" data-target=".ver-Bitacora-modal-{{$Bitacora_ayuda->id}}">Ver</a>
                            <!-- <a href="{{route('ayudavictimas.show', $ayuda->id)}}" class="btn btn-primary btn-sm btn-round">Ver Atencion</a> -->
                          </td>
                          <td>
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm btn-round" title="" data-toggle="modal" data-target=".editar-Bitacora-modal-{{$Bitacora_ayuda->id}}">Editar</a>
                            <!-- <a href="{{route('ayudavictimas.show', $ayuda->id)}}" class="btn btn-primary btn-sm btn-round">Ver Atencion</a> -->
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin Bitacora --->
        @endif
        @endcan
        <!-- acciones de creacion de los formularios -->

        <!-- Modal Crear Hecho Victimizante -->
        <div class="modal fade new-plan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Beneficiarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(['route' => 'beneficiarios.store','data-parsley-validate']) }}
                <input type="hidden" name="user_create_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="persona_id" value="{{$persona->id}}">
                {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary btn-round']) }}
                <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
                <h2>Registro de Beneficiarios</h2>
                @include('beneficiarios.form.form')
                {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary btn-round']) }}
                <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
                {{ Form::close() }}

              </div>

            </div>
          </div>
        </div>
        <!-- Fin Modal Crear Hecho Victimizante--->

        <!-- Modal Crear ayuda Victima -->
        <div class="modal fade new-ayuda-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Registrar Ayuda</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
               <div class="modal-body" id="formAyudaVic">
                {{ Form::open(['route' => 'ayudavictimas.store','files'=>'true']) }}
                <input type="hidden" name="user_create_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="persona_id" value="{{$persona->id}}">
                @include('personas.form.ayudas')
                {{ Form::close() }}

              </div>

            </div>
          </div>
        </div>
        <!-- Fin Modal Crear ayuda Victima -->

        <!-- Modal Crear Seguimiento Victima -->
        <div class="modal fade new-seguimiento-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Registrar Seguimiento Psicosocial</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(['route' => 'seguimientoayudavictimas.store','files'=>'true']) }}
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="persona_id" value="{{$persona->id}}">
                @include('personas.form.seguimiento')
                {{ Form::close() }}

              </div>

            </div>
          </div>
        </div>
        <!-- Fin Modal Crear Seguimiento Victima -->

         <!-- Modal Crear Atencion Jurica -->
        <div class="modal fade new-atencion-jurica-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Registrar Atencion Jurica</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(['route' => 'atencionJuridica.store','files'=>'true']) }}
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="persona_id" value="{{$persona->id}}">
                @include('personas.form.atencionJuridica')
                {{ Form::close() }}

              </div>

            </div>
          </div>
        </div>
        <!-- Fin Modal Crear Atencion Jurica -->

        <!-- Modal Crear Bitacora -->
        <div class="modal fade new-Bitacora-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Registrar Bitacora</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(['route' => 'bitacora.store','files'=>'true']) }}
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="persona_id" value="{{$persona->id}}">
                @include('personas.form.bitacora')
                {{ Form::close() }}

              </div>

            </div>
          </div>
        </div>
        <!-- Fin Modal Crear Bitacora -->

        <!-- acciones de edicion o mostrar datos en cada uno de los formularios -->

        <!-- Modal edicat ayuda Victima -->
        @can('ayudavictimas.create')
        @foreach($registro_ayudas as $ayudas_edita)
        <div class="modal fade  bd-example-modal-lg edita-ayuda-modal-{{$ayudas_edita->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Ver Ayuda</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @include('personas.form.verAyuda')
              </div>

            </div>
          </div>
        </div>
        @endforeach
        @endcan
        <!-- Fin Modal editar ayuda Victima -->

        <!-- Modal Seguimiento Victima -->
        @foreach($seguimientos as $seguimiento)
        <div class="modal fade  bd-example-modal-lg ver-seguimiento-modal-{{$seguimiento->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Ver Ayuda</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               @include('personas.form.verSeguimiento')
              </div>

            </div>
          </div>
        </div>
        @endforeach
        <!-- Fin Modal Seguimiento Victima -->

        <!-- Modal Atencion Jurica -->
        @foreach($aten_juridicas as $aten_juridica)
        <div class="modal fade  bd-example-modal-lg ver-aten-juridica-modal-{{$aten_juridica->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Ver Atencion Juridica</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @include('personas.form.verAtencionJuridica')
              </div>

            </div>
          </div>
        </div>
        @endforeach
        <!-- Fin Modal Atencion Jurica -->


        <!-- Modal Bitacora ver -->
        @can('bitacora.create')

        @foreach($Bitacora as $Bitacora_vista)
        <div class="modal fade  bd-example-modal-lg ver-Bitacora-modal-{{$Bitacora_vista->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Ver Bitacora</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @include('personas.form.verBitacora')
              </div>

            </div>
          </div>
        </div>
        @endforeach
        @endcan
        <!-- Fin Modal Bitacora ver -->

        <!-- Modal Bitacora editar -->
        @can('bitacora.create')

        @foreach($Bitacora as $Bitacora_vista)
        <div class="modal fade  bd-example-modal-lg editar-Bitacora-modal-{{$Bitacora_vista->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Editar Bitacora</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(['route' => ['bitacora.update',$Bitacora_vista->id],'method' => 'POST']) }}
                @include('personas.form.editarBitacora')
                {{ Form::close() }}
              </div>

            </div>
          </div>
        </div>
        @endforeach
        @endcan
        <!-- Fin Modal Bitacora editar -->

      </div>
    </div>
</body>
@include('layouts.footer')
