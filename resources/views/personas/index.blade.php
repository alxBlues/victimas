@include('layouts.header')
<body class="theme-green font-montserrat light_version">

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">
        @include('layouts.top_nave')
        @include('layouts.panel_izq')
        <div id="main-content">
            @include('layouts._mensajes')
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-12">
                            <h2>Buscar Usuarios</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="#">Atención al Usuario</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buscar Usuarios</li>
                                </ol>
                            </nav>
                        </div>            
                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                            <a href="{{route('personas.create')}}" class="btn btn-sm btn-primary btn-round" title="">Registrar Usuario</a>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="body">
                                {{ Form::open(['route' => 'personas.search']) }}
                                @include('personas.form.search')
                                {{ Form::close() }}
                                <strong> Escriba el nombre, n° de documento o la dirección del usuario y seleccione el botón <span class="text-green">Buscar</span></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')