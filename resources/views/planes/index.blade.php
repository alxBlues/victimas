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
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-12">
                            <h2>Planes</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="/planes">Gestión de PAT</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Planes</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                            @can('planes.create')<a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target=".new-plan-modal">Crear Plan</a>@endcan
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Estado</th>

                                        <th class="w100">Duración</th>
                                        <th>Prioridad</th>
                                        <th class="w200">Cumplimiento Metas</th>
                                        <th class="w100">Reporte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($planes as $plan)
                                    <tr>
                                        <td>
                                          <h6 class="mb-0" style="white-space:nowrap; overflow: hidden; text-overflow:ellipsis; max-width: 200px;"><a href="{{ route('planes.show',$plan->id) }}" >{{ $plan->titulo }}</a></h6>
                                          <img src="../assets/images/xs/avatar.png" alt="Avatar" class="w30 rounded-circle mr-2"> <small>Oficina Víctimas</small></td>

                                        <td>
                                          @if($plan->planActivo($plan->desde,$plan->hasta)>0)
                                            <span class="badge badge-danger">Activo</span></td>
                                          @else
                                            <span class="badge badge-success">Inactivo</span></td>
                                          @endif


</td>
                                        <td>{{ $plan->duracion($plan->id) }} Días</td>
                                        <td>
                                          @if(empty($plan->referencia_variables))
                                            <span class="text-success">Principal</span>
                                          @else
                                            <span class="text-warning">Secundario</span>
                                          @endif

                                        </td>
                                        <td>
                                          @if($plan->cumplimientoMetas($plan->id) <= 33)
                                          <div class="progress">
                                               <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="{{ $plan->cumplimientoMetas($plan->id) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $plan->cumplimientoMetas($plan->id) }}%">
                                               </div>
                                           </div>
                                           @if($plan->cumplimientoMetas($plan->id)>0)
                                           <span class="align-center" style="font-size:12px;text-align:justify;">{{ number_format($plan->cumplimientoMetas($plan->id),2) }}% Completado</span>
                                           @else
                                           <span class="align-center" style="font-size:12px;text-align:justify;">Sin registros</span>
                                           @endif

                                          @elseif($plan->cumplimientoMetas($plan->id) <= 66)
                                          <div class="progress">
                                               <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="{{ $plan->cumplimientoMetas($plan->id) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $plan->cumplimientoMetas($plan->id) }}%">
                                               </div>
                                           </div>
                                          @else
                                          <div class="progress">
                                               <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="{{ $plan->cumplimientoMetas($plan->id) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $plan->cumplimientoMetas($plan->id) }}%">
                                               </div>
                                           </div>
                                          @endif

                                        </td>
                                        <td>  <a href="{{ route('planes.matriz',$plan->id) }}" > <button type="button" class="btn btn-success mb-2"><i class="fa fa-file-pdf-o"></i> <span>Seguimiento</span></button></a>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Crear Plan -->

        <div class="modal fade new-plan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(['route' => 'planes.store','files' => true ]) }}

                        @include('planes.form.form')

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Fin Modal Crear Plan--->

    </div>

</body>

@include('layouts.footer')
