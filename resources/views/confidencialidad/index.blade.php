@include('layouts.header')

<body class="theme-cyan font-montserrat light_version">

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
                            <h2>Buscar Acuerdos De Confidencialidad</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="#">Acuerdos De Confidencialidad</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buscar Usuarios</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right hidden-xs">

                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="body">
                                @include('confidencialidad.form.buscar')
                                <strong> Escriba el nombre, n° de documento o la dependencia del usuario y seleccione el botón <span class="text-green">Buscar</span></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <thead>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>N° Documento</th>
                                    <th>Dependencia</th>
                                    <th>Descargar Acuerdo</th>
                                </thead>
                                <tbody>
                                    @isset($resultados)
                                    @foreach($resultados as $keyResultados => $valueResultados)
                                    <tr>
                                        <td>{{ $keyResultados+1 }}</td>
                                        <td>{{ $valueResultados->name }}</td>
                                        <td>{{ $valueResultados->documento }}</td>
                                        <td>{{ $valueResultados->dependencia }}</td>
                                        <td>@if($valueResultados->copiaContrato != '')<a href="/uploads{{ $valueResultados->copiaContrato }}" target="_blank">Descargar Pdf</a>@endif</td>
                                    </tr>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')