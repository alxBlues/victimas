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
            cursor: hand;
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
                            <h2>Buscar Actas de Comite</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                    <li class="breadcrumb-item"><a href="#">Comite</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Buscar Actas de Comite</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
                <div class="row clearfix">

                    <!-- Modal Ver Comite -->
                    @isset($resultado_comite)
                    @foreach($resultado_comite as $comiteModal)
                    <div class="modal fade view-comite-modal-{{$comiteModal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel">Comite</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <h4>Comite #{{$comiteModal->id}}</h4>
                                    <div class="row">
                                        <div class="mb-3 px-md-5">
                                            <strong>{{ Form::label('nombre', 'Nombre de Comite')}}</strong><br>
                                            {{$comiteModal->nombre}}
                                        </div>
                                    </div>
                                    <div class="row">
                                       <!-- <div class="col-md-6 mb-3 px-md-5">
                                            <strong>{{ Form::label('Accion', 'Accion')}}</strong><br>
                                           
                                        </div>-->
                                        <div class="col-md-6 mb-3 px-md-5">
                                            <strong>{{ Form::label('comite_fecha', 'Fecha de Comite')}}</strong><br>
                                            {{$comiteModal->fecha_comite}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3 px-md-5">
                                            <strong>{{ Form::label('acta', 'Acta de Comite')}}</strong><br>
                                            <a href="{{$comiteModal->url_adjunto}}" target="_blanck">Acta Adjunta</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 px-md-5">
                                            <strong>{{ Form::label('descripcion', 'Descripcion de Comite')}}</strong><br>
                                            {{$comiteModal->descripcion}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endisset
                    <!-- Fin Modal Ver Comite --->





                    <div class="col-12">
                        @include('layouts.alertas')
                        <div class="card">
                            <div class="tab-content mt-0">
                                <div class="tab-pane active show" id="Users">
                                    <div class="body">
                                        {{ Form::open(['route' => 'comite.search']) }}
                                        @include('comite.form.search')
                                        {{ Form::close() }}
                                    </div>
                                    @isset($resultado_comite)
                                    <table class="table table-hover table-custom spacing8">
                                        <thead>
                                            <tr>
                                                <th>Acta #</th>
                                                <th>Comite</th>
                                                <th>Fecha de Comite</th>
                                                <th>Ver Comite</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($resultado_comite as $comite)
                                            <tr>
                                                <td>{{$comite->id}}</td>
                                                <td>{{$comite->nombre}}</td>
                                                <td>{{$comite->fecha_comite}}</td>
                                                <td>
                                                    <div class="col-md-6 col-sm-12 text-right hidden-xs">
                                                        <button type="button" class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target=".view-comite-modal-{{$comite->id}}">Ver</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endisset
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