@include('layouts.header')
<body class="theme-green font-montserrat light_version">

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">
        @include('layouts.top_nave')
        @include('layouts.panel_izq')
    </div>
    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
            @include('layouts.alertas')
        </div>
          <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>{{ $plan->titulo }}<small> Activo desde {{ $plan->desde }} hasta {{ $plan->hasta }}</small></h2>
                        <ul class="header-dropdown dropdown">

                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                        </ul>
                    </div>
                    <div class="body">

                        <div class="table-responsive">
                            <table id="example" class="display nowrap" width="100%">
                                <thead>
                                    <tr>
                                      @foreach($plan->atributos as $atributos)
                                        <th id="{{ $atributos->id }}">{{ $atributos->titulo }}</th>
                                      @endforeach
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      @foreach($plan->atributos as $atributos)
                                        <th id="{{ $atributos->id }}">{{ $atributos->titulo }}</th>
                                      @endforeach
                                    </tr>
                                </tfoot>
                                <tbody>
                                  @foreach($acciones as $filas)

                                    @php $estadoPrevio = "";    @endphp
                                      @php $estado = $filas->id; @endphp
                                      @foreach($filas->descendants as $nietos)

                                        @if($estadoPrevio != $estado)
                                          <tr>
                                          @php $estadoPrevio = $estado; @endphp
                                            @foreach($filas->ancestors as $ancestros)
                                              <td >{{ $ancestros->variable }}</td>
                                            @endforeach
                                                <td >{{ $filas->variable }}</td>
                                              @foreach($filas->atributos->siguientes() as $siguientes)
                                                <td>
                                                    @foreach($siguientes->variables as $var)
                                                      @if($var->parent_id == $filas->id)
                                                        @if($var->atributos->tipo == '10')

                                                          @php
                                                          $valor = $var->variable;
                                                          $seleccionables = explode(',',$var->atributos->valor);

                                                          @endphp
                                                          {{ $seleccionables[$valor] }}
                                                        @endif
                                                        @if($var->atributos->tipo == '8')
                                                          {{ $var->variable }}
                                                        @endif
                                                        @if($var->atributos->tipo == '7')
                                                          $ {{ $var->variable }}
                                                        @endif
                                                        @if($var->atributos->tipo == '3')
                                                          {{ $var->grupo->titulo }}
                                                        @endif
                                                        @if($var->atributos->tipo == '4')
                                                          {{ $var->variable }}
                                                        @endif
                                                        @if($var->atributos->tipo == '9')
                                                          @php

                                                          $algo = json_decode($var->atributos->valor,true);

                                                          $desde = $algo['d'];
                                                          $hasta = $algo['h'];


                                                          @endphp
                                                            @if($filas->tipo == '19')
                                                              @php $fecAtencion = Carbon\Carbon::parse($var->atencionAyudas->created_at)->format('m/d/Y'); @endphp
                                                            @elseif($filas->tipo == '18')
                                                                @php $fecAtencion = Carbon\Carbon::parse($var->comites->created_at)->format('m/d/Y'); @endphp
                                                            @elseif($filas->tipo == '11')
                                                                @php $fecAtencion = Carbon\Carbon::parse($var->psicosocial->fechaAtencion)->format('m/d/Y'); @endphp
                                                            @elseif($filas->tipo == '35')
                                                                @php $fecAtencion = Carbon\Carbon::parse($var->juridica->created_at)->format('m/d/Y'); @endphp
                                                            @else
                                                              @php $fecAtencion = Carbon\Carbon::parse($var->atencion->fecha)->format('m/d/Y'); @endphp

                                                            @endif
                                                            @if(($fecAtencion >= $desde) && ($fecAtencion <= $hasta))
                                                              {{ $var->registros() }}
                                                              @break
                                                            @endif
                                                        @endif
                                                        @if($var->atributos->tipo == '5')
                                                          {{ $var->registros() }}
                                                          @break
                                                        @endif
                                                      @endif
                                                    @endforeach
                                                 </td>
                                              @endforeach
                                          </tr>
                                        @endif

                                      @endforeach

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
