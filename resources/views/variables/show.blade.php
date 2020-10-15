@can('planes.show')
@include('layouts.header')
<body class="theme-cyan font-montserrat light_version">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

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
               <div class="row clearfix">
                   <div class="col-md-6 col-sm-12">
                       <h2>{{ $variable->variable }}</h2>
                       <p>
                       <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{ route('planes.show',$variable->atributos->plan_id) }}">{{ $variable->atributos->planes->titulo  }}</a></li>
                             @foreach($variable->ancestors as $ancestros)
                                 <li class="breadcrumb-item"><a href="{{ route('variables.show',$ancestros->id) }}">{{ $ancestros->variable }}</a></li>
                             @endforeach
                           </ol>
                       </nav>
                   </div>

               </div>
           </div>
           <div class="row clearfix">


             <!-- Modal Crear Variable Hijos-->
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
                                @if($variable->atributos->siguiente()->tipo == '2')
                                   @include('variables.form.formIdentificacion')
                                @else
                                  @include('variables.form.form')
                                @endif
                               {{ Form::close() }}

                             </div>

                         </div>
                     </div>
                 </div>
             <!-- Fin Modal Crear Variable Hijos--->

             @foreach($variable->children as $hijo)
             <!-- Modal Editar Variable Hijos-->

                 <div class="modal fade new-variable-modal{{ $hijo->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Editar Variable</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                               {!! Form::model($hijo, ['route' => ['variables.update', $hijo->id], 'method' => 'PUT','files' => true]) !!}
                                @if($variable->atributos->siguiente()->tipo == '2')
                                   @include('variables.form.formIdentificacion')
                                @else
                                  @include('variables.form.form')
                                @endif
                                 {!! Form::close() !!}


                             </div>

                         </div>
                     </div>
                 </div>
             <!-- Fin Modal Editar Variable Hijos--->
             @endforeach





                        <div class="col-12">
                          @include('layouts.alertas')

                          <div class="card">

                              <div class="tab-content mt-0">
                                  <div class="tab-pane active show" id="Users">
                                    <div class="row clearfix">
                                        <div class="col-md-6 col-sm-12">

                                        </div>
                                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                                          @can('variables.create')
                                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".new-variable-modal">Crear Variable</button>
                                          @endcan
                                        </div>
                                    </div>
                                      <div class="table-responsive">
                                          <table class="table table-hover table-custom spacing8">

                                              <thead>
                                                  <tr>
                                                      @if($variable->atributos->siguiente()->tipo == '2')
                                                      <th class="w60" >{{ $variable->atributos->siguiente()->titulo }}</th>

                                                        <th class="w100" >Eliminar</th>
                                                      @else
                                                      <th class="w60" >{{ $variable->atributos->siguiente()->titulo }}</th>
                                                      <th></th>
                                                      <th></th>
                                                      <th>Fecha de Creación</th>
                                                      <th class="w100">Acción</th>
                                                      @endif

                                                  </tr>
                                              </thead>
                                              <tbody>

                                                @php $estadoPrevio = "";    @endphp
                                                <!--- Busqueda de los hijos de la variable -->
                                                @foreach($variable->children as $hijo)



                                                          @php $estado = $hijo->id; @endphp


                                                          <!-- Pregunta si el identificador de variables es igual al estado anterior. -->

                                                          @if(auth()->user()->hasRole('Admin') or auth()->user()->hasRole('Auditor') )
                                                          <!-- Pregunta si el identificador de variables es igual al estado anterior. -->

                                                            @if($estadoPrevio != $estado)
                                                              @php $estadoPrevio = $estado; @endphp
                                                                <tr>

                                                                    <td >
                                                                      <!-- Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->

                                                                      @if($variable->atributos->siguiente()->tipo == '2')
                                                                      <table>
                                                                        <tr>
                                                                          <td>
                                                                            @can('variables.edit')<a href="{{ route('variables.edit', $hijo->id) }}"><i class="fa fa-edit"></i></a>@endcan</td><td rowspan="2"><a href="{{ route('variables.accion',$hijo->id) }}">{{ $hijo->variable }}</a>
                                                                            <p class="text-info">@if(isset($hijo->tipo))Acción de tipo {{ $hijo->ayudas->titulo }}@endif</p>
                                                                          </td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td><a href="{{ route('variables.estado', $hijo->id) }}">
                                                                            @if($hijo->estado == 0)
                                                                              <i class="fa fa-check"></i>
                                                                            @else
                                                                              <i class="fa fa-circle"></i>
                                                                            @endif
                                                                          </a></td>
                                                                        </tr>
                                                                      </table>

                                                                      @else
                                                                        <a href="{{ route('variables.show',$hijo->id) }}">{{ $hijo->variable }}</a>
                                                                      @endif

                                                                      <!-- Cierra Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->


                                                                     </td>
                                                                      <!-- Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->

                                                                          @if($variable->atributos->siguiente()->tipo == '2')

                                                                                  @else
                                                                                  <td></td>
                                                                                  <td></td>
                                                                                  <td>{{ $variable->created_at }}</td>

                                                                                  @endif
                                                                                  <!-- Cierra Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->


                                                                                <td>
                                                                                <!-- Pregunta si el atributo de la variable es de identificacion -->

                                                                                  @if($variable->atributos->siguiente()->tipo == '2')
                                                                                  @else
                                                                                  @can('variables.edit')
                                                                                  <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-variable-modal{{ $hijo->id }}"><i class="fa fa-edit"></i></button>
                                                                                  @endcan
                                                                                  @endif
                                                                                  <!-- Ciera  Pregunta si el atributo de la variable es de identificacion -->

                                                                                  @can('variables.destroy')
                                                                                  {!! Form::open(['route' => ['variables.destroy', $hijo->id],'method' => 'DELETE']) !!}

                                                                                    <button class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>

                                                                                  {!! Form::close() !!}
                                                                                  @endcan
                                                                                </td>

                                                              </tr>


                                                          @endif
                                                          <!-- Cierra Pregunta si el identificador de variables es igual al estado anterior. -->
                                                          @endif
                                                          <!--- Cierre si Es administrador -->

                                                          <!--- Busqueda de los descendientes de los hijos -->
                                                              @foreach($hijo->descendants as $nietos)
                                                                <!-- Pregunta si los descendientes son del tipo 3 -->
                                                                @if($nietos->atributos->tipo=='3')

                                                                  <!-- Pregunta si los descendientes del tipo 3 son los mismos que el grupo del usuario -->

                                                                    @if($nietos->variable == !isset(auth()->user()->grupos[0]->id))

                                                                      <!-- Pregunta si el identificador de variables es igual al estado anterior. -->

                                                                        @if($estadoPrevio != $estado)
                                                                          @php $estadoPrevio = $estado; @endphp
                                                                            <tr>

                                                                                <td >
                                                                                  <!-- Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->
                                                                                  @if($variable->atributos->siguiente()->tipo == '2')
                                                                                        {{ $hijo->variable }}
                                                                                  @else
                                                                                    <a href="{{ route('variables.show',$hijo->id) }}">{{ $hijo->variable }}</a>
                                                                                  @endif

                                                                                  <!-- Cierra Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->


                                                                                 </td>
                                                                                  <!-- Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->

                                                                                      @if($variable->atributos->siguiente()->tipo == '2')
                                                                                          <!-- Busqueda de los siguientes atributos si el atributo principal es de identificacion -->

                                                                                              @foreach($hijo->atributos->siguientes() as $siguientes)


                                                                                                <td>
                                                                                                  <!-- Busqueda de las siguientes variables-->

                                                                                                    @foreach($siguientes->variables as $var)
                                                                                                    <!-- Pregunta si la variable si la variable es del mismo padre que el hijo -->

                                                                                                      @if($var->parent_id == $hijo->id)

                                                                                                      <!-- Pregunta si el atributo de la variable es seleccionable, Grupo y Sumatorio -->


                                                                                                        @if($var->atributos->tipo == '10')

                                                                                                          @php
                                                                                                          $valor = $var->variable;
                                                                                                          $seleccionables = explode(',',$var->atributos->valor);

                                                                                                          @endphp
                                                                                                            {{ $seleccionables[$valor] }}
                                                                                                        @elseif($var->atributos->tipo == '3')
                                                                                                          {{ $var->grupo->titulo }}
                                                                                                        @elseif($var->atributos->tipo == '9')
                                                                                                          x
                                                                                                        @else
                                                                                                          {{ $var->variable }}
                                                                                                        @endif
                                                                                                        <!-- Cierra Pregunta si el atributo de la variable es seleccionable, Grupo y Sumatorio  -->



                                                                                                      @endif
                                                                                                      <!-- Cierra Pregunta si la variable si la variable es del mismo padre que el hijo -->

                                                                                                    @endforeach

                                                                                                    <!-- Cierra Busqueda de las siguientes variables-->

                                                                                                  </td>




                                                                                                @endforeach
                                                                                                <!-- Cierra Busqueda de los siguientes atributos si el atributo principal es de identificacion -->

                                                                                              @else
                                                                                              <td></td>
                                                                                              <td></td>
                                                                                              <td>{{ $variable->created_at }}</td>

                                                                                              @endif
                                                                                              <!-- Cierra Pregunta si el atributo de las variables siguientes es del tipo atributo identificacion -->


                                                                                            <td>
                                                                                            <!-- Pregunta si el atributo de la variable es de identificacion -->

                                                                                              @if($variable->atributos->siguiente()->tipo == '2')
                                                                                              @else
                                                                                              @can('variables.edit')
                                                                                              <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-variable-modal{{ $hijo->id }}"><i class="fa fa-edit"></i></button>
                                                                                              @endcan
                                                                                              @endif
                                                                                              <!-- Ciera  Pregunta si el atributo de la variable es de identificacion -->

                                                                                              @can('variables.destroy')
                                                                                              {!! Form::open(['route' => ['variables.destroy', $hijo->id],'method' => 'DELETE']) !!}

                                                                                                <button class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>

                                                                                              {!! Form::close() !!}
                                                                                              @endcan
                                                                                            </td>

                                                                          </tr>


                                                                      @endif
                                                                      <!-- Cierra Pregunta si el identificador de variables es igual al estado anterior. -->


                                                            @else
                                                            <!--- Pregunta si el estado anterior es igual al estado actual-->
                                                            @if($estadoPrevio != $estado)
                                                              @php $estadoPrevio = $estado; @endphp
                                                                <tr>


                                                                   <td >

                                                                    @if($variable->atributos->siguiente()->tipo == '2')
                                                                          @can('variables.edit')<a href="{{ route('variables.edit', $hijo->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $hijo->variable }}
                                                                    @else
                                                                      <a href="{{ route('variables.show',$hijo->id) }}">{{ $hijo->variable }}</a>
                                                                    @endif

                                                                   </td>
                                                                      @if($variable->atributos->siguiente()->tipo == '2')
                                                                        @foreach($hijo->atributos->siguientes() as $siguientes)


                                                                          <td>
                                                                            @foreach($siguientes->variables as $var)
                                                                              @if($var->parent_id == $hijo->id)
                                                                                @if($var->atributos->tipo == '10')

                                                                                  @php
                                                                                  $valor = $var->variable;
                                                                                  $seleccionables = explode(',',$var->atributos->valor);

                                                                                  @endphp
                                                                                  @can('variables.edit')<a href="{{ route('variables.edit', $var->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $seleccionables[$valor] }}
                                                                                @elseif($var->atributos->tipo == '3')
                                                                                  @can('variables.edit')<a href="{{ route('variables.edit', $var->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $var->grupo->titulo }}
                                                                                  @elseif($var->atributos->tipo == '9')
                                                                                  @else
                                                                                  @can('variables.edit')<a href="{{ route('variables.edit', $var->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $var->variable }}
                                                                                @endif



                                                                              @endif
                                                                            @endforeach
                                                                          </td>




                                                                        @endforeach
                                                                      @else
                                                                      <td></td>
                                                                      <td></td>
                                                                      <td>{{ $variable->created_at }}</td>

                                                                      @endif

                                                                        <td>
                                                                          @if($variable->atributos->siguiente()->tipo == '2')
                                                                            @else
                                                                            @can('variables.edit')
                                                                              <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-variable-modal{{ $hijo->id }}"><i class="fa fa-edit"></i></button>
                                                                            @endcan
                                                                          @endif

                                                                            @can('variables.destroy')
                                                                            {!! Form::open(['route' => ['variables.destroy', $hijo->id],'method' => 'DELETE']) !!}

                                                                              <button class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>

                                                                            {!! Form::close() !!}
                                                                            @endcan
                                                                        </td>

                                                                    </tr>

                                                                  @endif
                                                                  <!--- Cierra Pregunta si el estado anterior es igual al estado actual-->




                                                          @endif
                                                          <!-- Cierra Pregunta si los descendientes del tipo 3 son los mismos que el grupo del usuario -->



                                                        @endif
                                                        <!-- Cierra Pregunta si los descendientes son del tipo 3 -->




                                                    @endforeach
                                                    <!---Cierra  Busqueda de los descendientes de los hijos -->


                                                @endforeach
                                                <!--- Cierra Busqueda de los hijos de la variable -->


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
</div>


</div>
</body>
@include('layouts.footer')
@endcan
