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
                                                      <th class="w60" >Atributo </th>
                                                      <th>Valor</th>


                                                  </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($variable->atributos->siguientes() as $atributos)
                                                  <tr>
                                                    @foreach($atributos->variables as $var)
                                                      @if($var->parent_id == $variable->id)
                                                        @if($var->atributos->tipo == '10')
                                                          <td>{{ $var->atributos->titulo }}</td>
                                                          <td>
                                                            @php
                                                            $valor = $var->variable;
                                                            $seleccionables = explode(',',$var->atributos->valor);

                                                            @endphp
                                                              @can('variables.edit')<a href="{{ route('variables.edit', $var->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $seleccionables[$valor] }}
                                                          </td>
                                                        @elseif($var->atributos->tipo == '3')
                                                          <td>{{ $var->atributos->titulo }}</td>
                                                          <td>@can('variables.edit')<a href="{{ route('variables.edit', $var->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $var->grupo->titulo }}</td>
                                                        @elseif($var->atributos->tipo == '5')
                                                          <td>{{ $var->atributos->titulo }}</td>
                                                          <td>
                                                            {{ $var->registros() }}

                                                            @if($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros()) <= 33 )
                                                               <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros())}} %</p>
                                                            @elseif($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros()) >= 34 && $var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros()) <= 66 )
                                                              <p class="text-warning">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros())}} %</p>
                                                            @else
                                                              <p class="text-success">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros())}} %</p>
                                                            @endif
                                                          </td>
                                                          @break
                                                        @elseif($var->atributos->tipo == '9')
                                                          <td>{{ $var->atributos->titulo }}</td>
                                                          <td>
                                                            @php

                                                            $algo = json_decode($var->atributos->valor,true);

                                                            $desde = $algo['d'];
                                                            $hasta = $algo['h'];


                                                            @endphp
                                                            @if($variable->tipo == '19')
                                                              @php $fecAtencion = Carbon\Carbon::parse($var->atencionAyudas->created_at)->format('m/d/Y'); @endphp
                                                            @elseif($variable->tipo == '18')
                                                                @php $fecAtencion = Carbon\Carbon::parse($var->comites->created_at)->format('m/d/Y'); @endphp
                                                            @else
                                                              @php $fecAtencion = Carbon\Carbon::parse($var->atencion->fecha)->format('m/d/Y'); @endphp

                                                            @endif

                                                              @if(($fecAtencion >= $desde) && ($fecAtencion <= $hasta))
                                                                {{ $var->registros() }}

                                                                @if($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros()) <= 33 )
                                                                   <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros())}} %</p>
                                                                @elseif($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros()) >= 34 && $var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros()) <= 66 )
                                                                  <p class="text-warning">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros())}} %</p>
                                                                @else
                                                                  <p class="text-success">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->registros())}} %</p>
                                                                @endif

                                                                @break
                                                              @endif
                                                          </td>
                                                        @elseif($var->atributos->tipo == '7')
                                                          <td>{{ $var->atributos->titulo }}</td>
                                                          <td>
                                                            $  {{ $var->variable }}

                                                            @if($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->variable) <= 33 )
                                                               <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->variable)}} %</p>
                                                            @elseif($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->variable) >= 34 && $var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->variable) <= 66 )
                                                              <p class="text-warning">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->variable)}} %</p>
                                                            @else
                                                              <p class="text-success">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$var->atributos->anterior()->id)->variable,$var->variable)}} %</p>
                                                            @endif
                                                          </td>
                                                          @else
                                                            <td>{{ $var->atributos->titulo }}</td>
                                                            <td>@can('variables.edit')<a href="{{ route('variables.edit', $var->id) }}"<i class="fa fa-edit"></i></a>@endcan{{ $var->variable }}</td>
                                                        @endif

                                                      @endif
                                                    @endforeach
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
            </div>


        </div>
    </div>
</div>


</div>
</body>
@include('layouts.footer')
@endcan
