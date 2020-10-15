@include('layouts.header')
<body class="theme-green font-montserrat light_version">

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <div id="wrapper">
    @include('layouts.top_nave')
    @include('layouts.panel_izq')
    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
          <div class="row clearfix ">
            <div class="col-md-6 col-sm-12">
              <h2>Ficha de Caracterización</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ficha de Caracterización</li>
                </ol>
              </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
              <a href="{{route('beneficiarios.edit', $beneficiario->id)}}" class="btn btn-sm btn-primary btn-round">Editar Beneficiario</a>
              <a href="{{route('personas.show', $beneficiario->persona_id)}}" class="btn btn-sm btn-primary btn-round">Volver</a>
            </div>

          </div>
        </div>

        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <!--div class="header">
              </div-->
              <div class="body">
                <h2>{{$beneficiario->primerNombre}} {{$beneficiario->segundoNombre}} {{$beneficiario->primerApellido}}</h2>
                <div class="form-group required-control">
                  <label class="control-label" for="number_944611">ID consecutivo</label>
                  <p class="form-control">{{$beneficiario->id}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_824547">Primer Nombre</label>
                  <p class="form-control">{{$beneficiario->primerNombre}}</p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_808880">Segundo Nombre</label>
                  @if($beneficiario->segundoNombre != null)
                  <p class="form-control">{{$beneficiario->segundoNombre}}</p>
                  @else
                  <p class="form-control">N/A</p>
                  @endif
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_424108">Primer Apellido</label>
                  <p class="form-control">{{$beneficiario->primerApellido}}</p>
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_192231"> Segundo Apellido </label>
                  @if($beneficiario->segundoApellido != null)
                  <p class="form-control">{{$beneficiario->segundoApellido}}</p>
                  @else
                  <p class="form-control">N/A</p>
                  @endif
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_82620">Tipo de Documento</label>
                  <p class="form-control">{{$beneficiario->tipoDoc}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_779456">Número Documento</label>
                  <p class="form-control">{{$beneficiario->identificacion}}</p>
                </div>

                <!-- Number -->
                <div class="form-group required-control">
                  <label class="control-label" for="number_462541">Fecha de Nacimiento</label>
                  <p class="form-control">{{$beneficiario->fechaNacimiento}}</p>
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Edad</label>
                  <p class="form-control">{{Carbon\Carbon::createFromDate($beneficiario->fechaNacimiento)->age}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group">
                  <label class="control-label" for="selectlist_721011">Género</label>
                  <p class="form-control">{{$beneficiario->genero_id}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Estado Civil</label>
                  <p class="form-control">{{$beneficiario->estaCivil}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Relación</label>
                  <p class="form-control">{{$beneficiario->relacion}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Enfoque Poblacional</label>
                  <p class="form-control">{{$beneficiario->enfoqueP_id}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_125219">Salud </label>
                  <p class="form-control">{{$beneficiario->afiSalud}}</p>
                </div>

                <!-- Checkbox -->
                <div class="form-group">
                  <label class="control-label" for="etnia">Último Grado Aprobado</label>
                  <p class="form-control">
                    {{$beneficiario->grado}}
                  </p>
                </div>

                <!-- Checkbox -->
                <div class="form-group">
                  <label class="control-label" for="especial">Tipo Poblacion</label>
                  <p class="form-control">
                    {{$beneficiario->name}}
                  </p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_99422">Estudia Actualmente</label>
                  <p class="form-control">{{$beneficiario->estudia}}</p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_99422">Lee y Escribe?</label>
                  <p class="form-control">{{$beneficiario->leerEscribir}}</p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_99422">Programa</label>
                  <p class="form-control">{{$beneficiario->SNprograma}}</p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_99422">¿Cual Programa?</label>
                  <p class="form-control">{{$beneficiario->programa}}</p>
                </div>

                  <a href="{{route('beneficiarios.edit', $beneficiario->id)}}" class="btn btn-primary">Editar Beneficiario</a>
                  <a href="{{route('personas.show', $beneficiario->persona_id)}}" class="btn btn-primary">Volver</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  @include('layouts.footer')
