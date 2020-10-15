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
          @include('layouts.alertas')
        </div>

        <div class="row clearfix justify-content-center">
          <div class="col-md-10 col-xl-8 col-xs-12 col-sm-12">
            <div class="card">
              <!--div class="header">
              </div-->
              <div class="body">
                <h2>Atención No {{$atencionPsicosocial->id}}</h2>

                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_824547">Fecha Atención</label>
                  <p class="form-control">{{$atencionPsicosocial->fechaAtencion}}</p>
                </div>
                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_808880">Entidad que Canaliza</label>

                  <p class="form-control">{{$atencionPsicosocial->entidad}}</p>

                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_424108">Tipo de Intervencion</label>
                  <p class="form-control">{{$atencionPsicosocial->tipoIntervencion}}</p>
                </div>
                <h2>DATOS GENERALES</h2>
                <div class="form-group required-control">
                  <label class="control-label" for="number_462541">Nombres y Apellidos</label>
                  <p class="form-control">{{$persona->primerNombre}} {{$persona->primerApellido}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="number_462541">Tipo de Documento</label>
                  <p class="form-control">{{$persona->tipoDoc}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="number_462541">No Identificación</label>
                  <p class="form-control">{{$persona->identificacion}}</p>
                </div>
                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Municipio</label>
                  <p class="form-control">{{$atencionPsicosocial->municipio}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group">
                  <label class="control-label" for="selectlist_721011">Barrio/Vereda/Corregimiento</label>
                  <p class="form-control">{{$atencionPsicosocial->barrio}}</p>
                </div>
                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Dirección</label>
                  <p class="form-control">{{$atencionPsicosocial->direccion}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group">
                  <label class="control-label" for="selectlist_721011">Tiempo de residencia en el municipio</label>
                  <p class="form-control">{{$atencionPsicosocial->tiempoResidencia}}</p>
                </div>
                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Teléfono</label>
                  <p class="form-control">{{$atencionPsicosocial->telefono}}</p>
                </div>
                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Nombre de Contacto</label>
                  <p class="form-control">{{$atencionPsicosocial->nombreContacto}}</p>
                </div>
                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Teléfono del Contacto</label>
                  <p class="form-control">{{$atencionPsicosocial->telContacto}}</p>
                </div>
                <h2>INFORMACIÓN DE DESPLAZAMIENTO</h2>
                <!-- Number -->
                <div class="form-group required-control">
                  <label class="control-label" for="number_462541">Departamento</label>
                  <p class="form-control">{{$atencionPsicosocial->departamentoD}}</p>
                </div>

                <!-- Text -->
                <div class="form-group required-control">
                  <label class="control-label" for="text_371934">Municipio</label>
                  <p class="form-control">{{$atencionPsicosocial->municipioD}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group">
                  <label class="control-label" for="selectlist_721011">Barrio/Vereda/Corregimiento</label>
                  <p class="form-control">{{$atencionPsicosocial->barrioD}}</p>
                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Fecha de Desplazamiento</label>
                  <p class="form-control">{{$atencionPsicosocial->fechaDesplazamiento}}</p>
                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Fecha de Declaración</label>

                  <p class="form-control">{{$atencionPsicosocial->fechaDeclaracion}}</p>

                </div>
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_324043">Fecha de Inclusión</label>

                  <p class="form-control">{{$atencionPsicosocial->fechaInclusion}}</p>

                </div>

                <!-- Select List -->
                <div class="form-group required-control">
                  <label class="control-label" for="selectlist_125219">Hechos Victimizantes </label>

                  <p class="form-control">{{$atencionPsicosocial->hechoVictimizante}}</p>


                </div>
                <h2>TENENCIA</h2>
                <!-- Checkbox -->
                <div class="form-group">
                  <label class="control-label" for="etnia">Tipo de Vivienda</label>
                  <p class="form-control">
                    {{$atencionPsicosocial->tipoVivienda}}
                  </p>
                </div>

                <!-- Checkbox -->
                <div class="form-group">
                  <label class="control-label" for="especial">Tipo de Familia</label>
                  <p class="form-control">
                    {{$atencionPsicosocial->tipoFamilia}}
                  </p>
                </div>
                <!-- Select List -->

                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="duelos" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->duelos ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">1. DUELOS NO ELABORADOS</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="violenciaI" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->violenciaI ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">2. VIOLENCIA INTRAFAMILIAR</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="conflictoPareja" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->conflictoPareja ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">3. CONFLICTO DE PAREJA</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="violenciaG" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->violenciaG ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">4. VIOLENCIA DE GENERO </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="maltratoI" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->maltratoI ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">5. MALTRATO INFANTIL </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="violenciaS" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->violenciaS ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">6. VIOLENCIA SEXUAL </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="transtornoP" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->transtornoP ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">7. TRASTORNO PSIQUIATRICO </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="dificultadesA" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->dificultadesA ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">8. DIFICULTADES DE ADAPTACIÓN </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="otro" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->otro ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">9. OTRO </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-dark  custom-control-lg mb-1">
                  <input type="checkbox" class="custom-control-input" name="ninguno" disabled id="checkbox_Remi_0" value="1" {{ $atencionPsicosocial->ninguno ? 'checked':'1' }}><label for="checkbox_Remi_0" class="custom-control-label">10. NINGUNO </label>
                </div>

                  <a href="{{route('psicosocial.edit', $atencionPsicosocial->id)}}" class="btn btn-primary">Editar Usuario</a>
                  <a href="{{route('personas.show', $atencionPsicosocial->persona_id)}}" class="btn btn-primary">Volver</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </body>
  @include('layouts.footer')
