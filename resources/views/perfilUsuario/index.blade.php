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
                                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                            <!-- cargar botones -->
                        </div>
                    </div>
                </div>
                <!-- inicio de contenido - perfil -->
                <div class="row clearfix justify-content-center">
                    <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                @include('perfilUsuario.form.editar')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- fin de contenido - perfil -->
            </div>
        </div>
</body>
@include('layouts.footer')