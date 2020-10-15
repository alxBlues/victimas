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
                    <h2>Stater Page</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Oculux</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Stater Page</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-round" title="">Add New</a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card planned_task">
                    <div class="header">
                        <h2>Stater Page</h2>
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
                    <div class="body">
                        <h4>Atributos del Plan</h4>

                        <button type="button" class="btn btn-round btn-primary" data-toggle="modal" data-target=".new-project-modal">Crear Atributo</button>


                    </div>
                </div>
            </div>
            <style>
            i {
                  cursor:hand;
                  display: inline-block;
                  width: 40px;
                  margin: 0;
                  text-align: center;
                  vertical-align: middle;
                  -webkit-transition: font-size 0.2s;
                  -moz-transition: font-size 0.2s;
                  transition: font-size 0.2s;
                  cursor: hand;
              }
              i:hover {
                  font-size: 26px;
                  cursor: hand;
              }

              table, th, td {
                  border: 1px solid black;
                  border-collapse: collapse;
                }
            </style>

            <div class="col-12">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>

                                  @foreach($atributos as $atributo)



                                    <th scope="col">{{ $atributo->titulo }}

                                    </th>





                                  @endforeach

                                </tr>
                            </thead>
                            <tbody >
                              @foreach($variables as $var)
                                <tr>
                                  <td>{{ $var->variable }}</td>
                                  @foreach($var->children as $d)
                                    <td>{{ $d->variable }}</td>
                                  @endforeach
                                </tr>
                                {{$var->atributos->id}}
                              @endforeach



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
