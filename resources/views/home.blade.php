@include('layouts.header')
<body class="theme-green font-montserrat light_version">

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">
        @include('layouts.top_nave')
        @include('layouts.panel_izq')

        <div id="main-content">
            <div id="hero-area" class="hero-area-bg">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="img-thumb text-center wow fadeInUp animated" data-wow-delay="0.6s" style="visibility: visible;-webkit-animation-delay: 0.6s; -moz-animation-delay: 0.6s; animation-delay: 0.6s;">
                                <img class="img-fluid" src="assets/images/maatLogoWeb.png" alt="" style="margin-top: 30px; width: 300px;">
                            </div>
                            <div class="contents text-center">
                                <h2 class="head-title wow fadeInUp animated" style="visibility: visible; line-height: 100%; margin-bottom: 10px;">Sistema de Información y Planeación</h2>
                                <h6 class="wow fadeInUp animated" style="visibility:visible; color:rgb(88, 91, 96);
                                ">Oficina de Víctimas - Acacías.</h6>
                                <div class="header-button wow fadeInUp animated" data-wow-delay="0.3s" style="visibility: visible;-webkit-animation-delay: 0.3s; -moz-animation-delay: 0.3s; animation-delay: 0.3s; margin-bottom: 20px;">
                                    <a href="#" class="btn btn-primary"><i class="fa fa-info-circle mr-1"></i>  Acerca del Proyecto</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <h6><i class="fa fa-clock-o"></i> Último Acceso</h6>
                                <div class="card-value text-danger mr-3 float-left pr-2 border-right">{{$ultima_session_date ?? ''}}</div>
                                <div class="font-10">Con su usuario<span class="float-right"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <h6><i class="fa fa-dashboard"></i> Ingresos</h6>
                                <div class="card-value float-left mr-3 text-info pr-2 border-right">{{$contar_sessiones ?? ''}}</div>
                                <div class="font-12">Inicios en el sistema con su usuario<span class="float-right"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <h6><i class="fa fa-user"></i> Perfil</h6>
                                <div class="font-24 float-left text-green pr-2"><p>@if(isset(auth()->user()->roles)){{ auth()->user()->roles[0]->name }}@else Invitado @endif</p></div>
                                <div class="font-12"><br><br><span class="float-right"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <h6><i class="fa fa-tasks"></i> Acciónes Asignadas</h6>
                                <div class="card-value text-orange mr-3 float-left pr-2 border-right">@if($variables->count()){{ $variables->count() }} @else 0 @endif</div>
                                <div class="font-12">Total de acciones a su nombre<span class="float-right"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table id="example" class="display nowrap" width="100%">
                                <thead>
                                    <tr>

                                        <th >Acción</th>
                                        <th >Metas Cuatrenio</th>
                                        <th >Presupuesto Cuatrienio</th>
                                        <th >Meta  {{ date('Y') }}</th>
                                        <th >Presupuesto {{ date('Y') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                  @if($variables->count())
                                  @foreach($variables as $var)


                                    <tr>
                                      <td>
                                          {{$var->parent->variable}}
                                      </td>

                                          <td>

                                            @foreach($var->atributos->siguientes() as $siguientes)

                                            @if($siguientes->tipo == '5')
                                              Meta Cuatrienio: {{ $var->valorBusqueda($var->parent->id,$siguientes->anterior()->id)->variable }}</p>
                                              @foreach($siguientes->variables as $hijos)
                                                @if(empty($var->valorBusqueda($var->parent_id,$hijos->atributos->id)->variable))
                                                Sin Datos Registrados
                                                @break
                                                @endif
                                                  @if($var->parent->id == $hijos->parent->id)

                                                  Cumplimiento Cuatrienio: {{ $hijos->registros() }}</p>
                                                  Porcentaje Cumplimiento :

                                                    @if($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$siguientes->anterior()->id)->variable,$var->registros()) <= 33 )
                                                       <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$siguientes->anterior()->id)->variable,$var->registros())}} %</p>
                                                    @elseif($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$siguientes->anterior()->id)->variable,$var->registros()) >= 34 && $var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$siguientes->anterior()->id)->variable,$var->registros()) <= 66 )
                                                      <p class="text-warning">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$siguientes->anterior()->id)->variable,$var->registros())}} %</p>
                                                    @else
                                                      <p class="text-success">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$siguientes->anterior()->id)->variable,$var->registros())}} %</p>
                                                    @endif

                                                    @break

                                                  @endif
                                            @endforeach
                                            @endif
                                            @endforeach

                                          </td>
                                          <td>
                                            @foreach($var->atributos->siguientes() as $siguientes)

                                              @if($siguientes->tipo == '7')
                                                Presupuesto Cuatrenio: $ {{ $var->valorBusqueda($var->parent->id,$siguientes->anterior()->id)->variable }}</p>
                                                @break
                                              @endif
                                            @endforeach
                                            @foreach($var->atributos->siguientesTiempos() as $tiempos)

                                                @foreach($tiempos->siguiente()->siguiente()->variables as $hijos)
                                                  @foreach($hijos->atributos->padreAtributo()->variables as $nietos)
                                                    @if(empty($var->valorBusqueda($var->parent->id,$nietos->atributos->id)->variable))
                                                    Sin Datos Registrados
                                                    @break
                                                    @endif
                                                    @if($var->parent->id == $nietos->parent->id)

                                                      Cumplimiento Cuatrienio: {{ $var->valorBusqueda($var->parent_id,$nietos->atributos->id)->variable }}</p>
                                                      Porcentaje Cumplimiento :
                                                      <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$nietos->atributos->anterior()->id)->variable,$var->valorBusqueda($var->parent_id,$nietos->atributos->id)->variable)}} %</p>

                                                      @break

                                                      @endif
                                                  @endforeach
                                                  @break
                                                @endforeach
                                            @endforeach

                                          </td>
                                          <td>
                                            @foreach($var->atributos->siguientesTiempos() as $tiempos)
                                             @if($hoy<=$tiempos->tiempoHasta() && $hoy>=$tiempos->tiempoDesde())
                                             @if(!empty($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable))
                                             Meta Anual: {{ $var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable }}</p>
                                             @endif
                                              @foreach($tiempos->variables as $hijos)

                                                @if($var->parent->id == $hijos->parent->id)
                                                Cumplimiento : {{ $hijos->registros() }}</p>
                                                Porcentaje Cumplimiento :
                                                @if($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable,$var->registros()) <= 33 )
                                                   <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable,$var->registros())}} %</p>
                                                @elseif($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable,$var->registros()) >= 34 && $var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable,$var->registros()) <= 66 )
                                                  <p class="text-warning">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable,$var->registros())}} %</p>
                                                @else
                                                  <p class="text-success">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->anterior()->id)->variable,$var->registros())}} %</p>
                                                @endif
                                                @else
                                                Sin Datos Registrados
                                                @endif
                                                @break
                                              @endforeach

                                             @endif
                                            @endforeach
                                          </td>
                                          <td>
                                            @foreach($var->atributos->siguientesTiempos() as $tiempos)
                                               @if($hoy<=$tiempos->tiempoHasta() && $hoy>=$tiempos->tiempoDesde())
                                                @foreach($tiempos->siguiente()->variables as $hijos)
                                                  @if($var->parent->id == $hijos->parent->id)
                                                  Presupuesto Anual: $ {{ $var->valorBusqueda($var->parent_id,$tiempos->siguiente()->id)->variable }}</p>
                                                  @endif
                                                @endforeach
                                                @foreach($tiempos->siguiente()->siguiente()->variables as $hijos)
                                                  @if($var->parent->id == $hijos->parent->id)
                                                  Cumplimiento : $ {{ $hijos->variable }}</p>
                                                  Porcentaje Cumplimiento :
                                                  @if($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->siguiente()->siguiente()->id)->variable,$var->variable) <= 33 )
                                                     <p class="text-danger">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->siguiente()->siguiente()->id)->variable,$var->variable)}} %</p>
                                                  @elseif($var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->siguiente()->siguiente()->id)->variable,$var->variable) >= 34 && $var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->siguiente()->siguiente()->id)->variable,$var->variable) <= 66 )
                                                    <p class="text-warning">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->siguiente()->siguiente()->id)->variable,$var->variable)}} %</p>
                                                  @else
                                                    <p class="text-success">{{$var->porcentajeCumplimiento($var->valorBusqueda($var->parent_id,$tiempos->siguiente()->siguiente()->id)->variable,$var->variable)}} %</p>
                                                  @endif
                                                  @else
                                                  Sin Datos Registrados
                                                  @endif
                                                  @break
                                                @endforeach
                                               @endif
                                             @endforeach

                                          </td>




                                    </tr>
                                    @endforeach
                                    @else

                                    <tr>
                                      <td colspan="5" >No cuenta con actividades registradas.</td>
                                    </tr>

                                    @endif

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
@include('completaDatosUser.modal')
