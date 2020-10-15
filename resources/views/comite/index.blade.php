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
                            <h2>Registrar Comite</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                        <li class="breadcrumb-item"><a href="#">Comite</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Registrar Comite</li>
                                    </ol>
                                </nav>
                        </div>

                    </div>
                </div>
                <div class="row clearfix">

                    <div class="col-12">
                        @include('layouts.alertas')

                        <div class="card">

                            <div class="tab-content mt-0">
                                <div class="tab-pane active show" id="Users">
                                    <div class="row clearfix">
                                        <div class="col-md-12 col-sm-12">

                                        </div>
                                    </div>
                                    <div class="body">
                                        {{ Form::open(['route' => 'comite.store','files'=>'true']) }}
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        @include('comite.form.formCrear')
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
@endcan