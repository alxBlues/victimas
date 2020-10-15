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
                            <h2>Gestion de ayudas</h2>
                            <p>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                        <li class="breadcrumb-item"><a href="#">Ajustes</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Gestion de ayudas</li>
                                    </ol>
                                </nav>
                        </div>

                    </div>
                </div>
                <div class="row clearfix">


                    <!-- Modal Crear Ayuda-->
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
                                    {{ Form::open(['route' => 'gestionayudas.store','files' => true ]) }}
                                    @include('gestionAyudas.form.formCrear')
                                    {{ Form::close() }}
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal Crear Variable Hijos--->

                    <!-- Modal Editar Variable Hijos-->
                    @foreach($ayudas as $ayudaM)
                    <div class="modal fade new-ayuda-modal{{ $ayudaM->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Ayuda</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                {!! Form::model($ayudaM, ['route' => ['gestionayudas.update', $ayudaM->id], 'method' => 'PUT','files' => true]) !!}
                                    @include('gestionAyudas.form.formEditar')
                                    {{ Form::close() }}
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Fin Modal Editar Variable Hijos--->





                    <div class="col-12">
                        @include('layouts.alertas')

                        <div class="card">

                            <div class="tab-content mt-0">
                                <div class="tab-pane active show" id="Users">
                                    <div class="row clearfix">
                                        <div class="col-md-6 col-sm-12">

                                        </div>
                                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".new-variable-modal">Crear Ayuda</button>

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-custom spacing8">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Estado</th>
                                                        <th class="w200">Tipo de ayuda</th>
                                                        <th>Costo</th>
                                                        <th>Cantidad</th>
                                                        <th class="w100">Descripcion</th>
                                                        <th class="w100">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($ayudas)
                                                    @foreach($ayudas as $ayuda)
                                                    <tr>
                                                        <td>
                                                            <h6 class="mb-0" style="white-space:nowrap; overflow: hidden; text-overflow:ellipsis; max-width: 200px;">{{$ayuda->nombre}}</h6>
                                                        </td>
                                                        <td>
                                                            @php
                                                            $lisEstado = array(array("css"=>"danger", "text"=>"Desactivo"), array("css"=>"success", "text"=>"Activo"));

                                                            @endphp
                                                            <span class="badge badge-{{ $lisEstado[$ayuda->estado]['css'] ?? '' }}">
                                                                {{ $lisEstado[$ayuda->estado]['text'] ?? '' }}
                                                            </span></td>
                                                        <td>{{$ayuda->tipo}}</td>
                                                        <td><span class="text-warning">{{$ayuda->costo}}</span></td>
                                                        <td>{{$ayuda->cantidad}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="popover" title="Descricon de ayuda" data-content="{{$ayuda->descripcion}}">Descripcion</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-default" title="Editar" data-toggle="modal" data-target=".new-ayuda-modal{{ $ayuda->id }}"><i class="fa fa-edit"></i></button>
                                                            {!! Form::open(['route' => ['gestionayudas.destroy', $ayuda->id], 'method' => 'POST']) !!}
                                                            <button class="btn btn-sm btn-default js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o text-danger"></i></button>
                                                            {!! Form::close() !!}
                                                        </td>
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


                </div>
            </div>


        </div>
    </div>
    </div>


    </div>
</body>
@include('layouts.footer')
