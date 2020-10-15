@include('layouts.header')
<body class="theme-green font-montserrat light_version">

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <div id="wrapper">
    @include('layouts.top_nave')
    @include('layouts.panel_izq')
    <div id="main-content">



      <!-- Modal Crear Plan -->

      <div class="modal fade new-entregable-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Crear Entregable</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      {{ Form::open(['route' => 'entregables.store','files'=>'true']) }}

                      @include('entregables.partials.form')

                      {{ Form::close() }}
                  </div>
              </div>
          </div>
      </div>

      <!-- Fin Modal Crear Plan--->

      <div class="container-fluid">
        <div class="block-header">
            @include('layouts.alertas')
        </div>
          <div class="card">
              <div class="body">
                  <form action="{{ url('entregables') }}" method="POST" class="form">
                    {!! csrf_field() !!}
                      <div class="input-group mb-0">
                          <input type="text" class="form-control" name="palabra" placeholder="Buscar | Nombre Usuario | Correo Usuario | Observación | Acción Entregable...">
                          <div class="input-group-append">
                              <button type="submit" class="btn btn-success"><i class="icon-magnifier"></i></button>
                          </div>
                      </div>
                    <div class="col-lg-6 col-md-12">
                      <label>Rango de Fechas</label>
                                        <div class="input-group mb-0">
                                          <input type="date" class="input-sm form-control" name="desde" placeholder="Desde" autocomplete="off" spellcheck="false">
                                          <span class="input-group-addon range-to">a</span>
                                          <input type="date" class="input-sm form-control" name="hasta" placeholder="Hasta" autocomplete="off" spellcheck="false">
                                      </div>
                      </div>
                  </form>
              </div>
          </div>
        <div class="panel panel-default">

          <div class="panel-heading">
              Acciones del Tipo Entregable
              @can('entregables.create')
                <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target=".new-entregable-modal">Crear Entregable</a>
              @endcan
          </div>

          @can('entregables.show')
          <div class="panel-body">
              <table class="table table-striped table-hover">
                  <thead>
                      <tr>
                          <th width="10px">ID</th>
                          <th>Acción</th>
                          <th>Creado</th>
                          <th colspan="3">&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($entregables as $entregable)
                      <tr>
                          <td>{{ $entregable->id }}</td>
                          <td >{{ $entregable->variables->variable }}</td>
                          <td>{{ date('d/m/Y', strtotime($entregable->created_at)) }}</td>
                          <!--<td width="10px">
                              @can('entregables.edit')
                                  <a
                                      href="{{ route('entregables.edit',$entregable->id)}}"
                                      class="btn btn-sm btn-primary"
                                  >
                                      Editar
                                  </a>
                              @endcan
                          </td>-->
                          <td width="10px">
                               @can('entregables.delete')
                                  {!! Form::open([
                                          'route' => ['entregables.destroy',$entregable->id], 'method'=>'DELETE'
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
                    {!! $entregables->render() !!}

                </ul>
            </nav>
          </div>
          @endcan
        </div>

      </div>
    </div>
  </body>
  @include('layouts.footer')
