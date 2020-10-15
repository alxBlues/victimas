@include('layouts.header')
<body class="theme-cyan font-montserrat light_version">

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
                    <h2>Atencion # {{$atenciones->id}}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Oculux</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Atencion # {{$atenciones->id}}</li>
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
              <div class="block">
                  <div class="block-header">
                      <h3 class="block-title">Atencion</h3>
                  </div>
                  <div class="block-content block-content-full">
                    <div class="col-lg-8 col-xl-8">


                      <!-- Heading -->
                      <div class="center">
                          <h2 class="center">Atencion # {{$atenciones->id}}</h2>
                      </div>

                      <!-- Heading -->

                      <!-- Number -->
                      <div class="form-group required-control">
                          <label class="control-label" for="number_944611">ID Atencion</label>
                          <p>{{$atenciones->id}}</p>
                      </div>
                      <div class="form-group required-control">
                        <label class="control-label" for="selectlist_824547">Accion</label>
                        <p>
                          {{$atenciones->variable}}
                        </p>
                      </div>
                      <!-- Select List -->
                      <div class="form-group required-control">
                          <label class="control-label" for="selectlist_808880">Descripción</label>

                          <p>{{$atenciones->descripcion}}</p>

                      </div>

                      <!-- Text -->
                      <div class="form-group required-control">
                          <label class="control-label" for="text_424108">Lugar</label>
                          <p>{{$atenciones->lugar}}</p>
                      </div>

                      <!-- Text -->
                      <div class="form-group required-control">
                          <label class="control-label" for="text_192231"> Fecha </label>
                          <p>{{$atenciones->fecha}}</p>
                      </div>


                      <a href="{{route('atencion.edit', $atenciones->id)}}" class="btn btn-primary">Editar</a>
                      <a href="{{route('atencion.index', $atenciones->persona_id)}}" class="btn btn-primary">Volver</a>

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
