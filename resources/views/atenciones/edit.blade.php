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
                    <h2>Editar Atencion</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Oculux</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Atencion</li>
                        </ol>
                    </nav>
                </div>
                <!-- <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="" data-toggle="modal" data-target=".new-plan-modal">Agregar Nuevo</a>
                </div> -->
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card planned_task">
                    <div class="header">
                        <h2>Editar Atencion</h2>
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

                              <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                                  <div class="block">
                                      <div class="block-content block-content-full">
                                        {{ Form::open(['route' => ['atencion.update', $atenciones->id]]) }}

                                          @include('atenciones.form.form')

                                        {{ Form::close() }}

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
