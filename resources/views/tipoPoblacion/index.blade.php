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



<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">
@include('layouts.top_nave')
@include('layouts.panel_izq')

<div id="main-content">
  @include('layouts._mensajes')
  @include('layouts._error')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Tipo de Población</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Oculux</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tipo Población</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target=".new-plan-modal">Agregar Nuevo</a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card planned_task">
                    <div class="header">
                          <h2>Tipos de Población</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another Action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12">

                            <table class="table">
                              <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha Creación</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                              </thead>
                              <tbody>
                                @foreach($tipos as $tipo)
                                <tr>
                                  <td>{{$tipo->id}}</td>
                                  <td>{{$tipo->name}}</td>
                                  <td>{{$tipo->created_at}}</td>
                                  <td><a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target=".edit-{{$tipo->id}}-modal">Editar</a></td>
                                  <td>
                                    <a href="{{route('tipoP.destroy', $tipo->id)}}" class="btn btn-sm btn-danger btn-round" onclick="return confirm('¿Seguro desea eliminar?')">Eliminar</a>
                                  </td>
                                  <td>
                                    <!-- Modal editar Hecho Victimizante -->
                                        <div class="modal fade edit-{{$tipo->id}}-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Poblacion</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      {{ Form::open(['route' => ['tipoP.update', $tipo->id], 'method' => 'PUT' ]) }}

                                                          @include('tipoPoblacion.form.form')

                                                      {{ Form::close() }}

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <!-- Fin Modal editar Hecho Victimizante--->

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
</div>

<!-- Modal Crear Hecho Victimizante -->
    <div class="modal fade new-plan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Tipo de Poblacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  {{ Form::open(['route' => 'tipoP.store','files' => true ]) }}

                    <div class="input-group mb-3">
                      {{ Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Nombre del Tipo de Poblacion']) }}
                    </div>
                    <div class="modal-footer">
                      {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
                    </div>


                  {{ Form::close() }}

                </div>

            </div>
        </div>
    </div>
<!-- Fin Modal Crear Hecho Victimizante--->


</div>
</body>
@include('layouts.footer')
