{{ Form::label('fechaAtencion', 'Fecha de Atención')}}

<div class="input-group mb-3">
  {{ Form::date('fechaAtencion', null, ['class' => 'form-control', 'placeholder'=>'Fecha de Atención']) }}
</div>
{{ Form::label('tipoIntervencion', 'Tipo de Intervención')}}

<div class="input-group mb-3">
  {{ Form::select('tipoIntervencion', ['1' => 'Individual', '2' => 'Familiar', '3' => 'Domiciliaria'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<label for="">DATOS GENERALES</label>
<label for="">Nombres y Apellidos</label>

<div class="input-group mb-3">
  <input type="text" name="" disabled value="{{$persona->primerNombre}} {{$persona->primerApellido}}" class="form-control">
</div>
<label for="">Tipo de Documento</label>

<div class="input-group mb-3">
  <input type="text" name="" disabled value="{{$persona->documentos->titulo}}" class="form-control">
</div>
<label for="">Número de Documento</label>

<div class="input-group mb-3">
  <input type="text" name="" disabled value="{{$persona->identificacion}}" class="form-control">
</div>
{{ Form::label('municipio', 'Municipio')}}

<div class="input-group mb-3">
  {{ Form::text('municipio', null, ['class' => 'form-control', 'placeholder'=>'Municipio']) }}
</div>
{{ Form::label('barrio', 'Barrio/Vereda/Corregimiento')}}

<div class="input-group mb-3">
  {{ Form::text('barrio', null, ['class' => 'form-control', 'placeholder'=>'Barrio/Vereda/Corregimiento']) }}
</div>
{{ Form::label('direccion', 'Dirección')}}

<div class="input-group mb-3">
  {{ Form::text('direccion', null, ['class' => 'form-control', 'placeholder'=>'Dirección']) }}
</div>
{{ Form::label('tiempoResidencia', 'Tiempo de Residencia en el Municipio')}}

<div class="input-group mb-3">
  {{ Form::text('tiempoResidencia', null, ['class' => 'form-control', 'placeholder'=>'Tiempo de Residencia en el Municipio']) }}
</div>
{{ Form::label('telefono', 'Teléfono')}}

<div class="input-group mb-3">
  {{ Form::text('telefono', null, ['class' => 'form-control', 'placeholder'=>'Teléfono']) }}
</div>
{{ Form::label('nombreContacto', 'Nombre de Contacto')}}

<div class="input-group mb-3">
  {{ Form::text('nombreContacto', null, ['class' => 'form-control', 'placeholder'=>'Nombre de Contacto']) }}
</div>
{{ Form::label('telContacto', 'Teléfono del Contacto')}}

<div class="input-group mb-3">
  {{ Form::text('telContacto', null, ['class' => 'form-control', 'placeholder'=>'Teléfono del Contacto']) }}
</div>
<label for="">INFORMACIÓN EVENTO DE DESPLAZAMIENTO</label>
{{ Form::label('departamentoD', 'Departamento')}}

<div class="input-group mb-3">
  {{ Form::text('departamentoD', null, ['class' => 'form-control', 'placeholder'=>'Departamento']) }}
</div>
{{ Form::label('municipioD', 'Municipio')}}

<div class="input-group mb-3">
  {{ Form::text('municipioD', null, ['class' => 'form-control', 'placeholder'=>'Municipio']) }}
</div>
{{ Form::label('barrioD', 'Barrio/Vereda/Corregimiento')}}

<div class="input-group mb-3">
  {{ Form::text('barrioD', null, ['class' => 'form-control', 'placeholder'=>'Barrio/Vereda/Corregimiento']) }}
</div>
{{ Form::label('tiempoResidenciaD', 'Tiempo de Residencia')}}

<div class="input-group mb-3">
  {{ Form::text('tiempoResidenciaD', null, ['class' => 'form-control', 'placeholder'=>'Tiempo de Residencia']) }}
</div>
{{ Form::label('fechaDesplazamiento', 'Fecha de Desplazamiento')}}

<div class="input-group mb-3">
  {{ Form::date('fechaDesplazamiento', null, ['class' => 'form-control', 'placeholder'=>'Fecha de Desplazamiento']) }}
</div>
{{ Form::label('fechaDeclaracion', 'Fecha de Declaración')}}

<div class="input-group mb-3">
  {{ Form::date('fechaDeclaracion', null, ['class' => 'form-control', 'placeholder'=>'Fecha de Declaración']) }}
</div>
{{ Form::label('fechaInclusion', 'Fecha de Inclusión')}}

<div class="input-group mb-3">
  {{ Form::date('fechaInclusion', null, ['class' => 'form-control', 'placeholder'=>'Fecha de Inclusión']) }}
</div>
<label for="">HECHOS VICTIMIZANTES</label>
<div class="input-group mb-3">

  @foreach($hechosV as $hechos)
  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          {!! Form::checkbox('hechosV[]', $hechos->id, ($hechos->siPersona($persona->id) != null?true:null), ['class' => 'field']) !!}
        </div>
      </div>
      {{ Form::text('titulos', null, ['class' => 'form-control', 'placeholder'=>$hechos->name, 'disabled' => 'disabled']) }}
  </div>
  @endforeach
</div>
<label for="">TENECIA</label>
{{ Form::label('tipoVivienda', 'Tipo de Vivienda')}}

<div class="input-group mb-3">
  {{ Form::select('tipoVivienda', ['1' => 'Propia', '2' => 'Arriendo', '3' => 'Familiar', '4' => 'Otra'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<label for="">TIPO DE FAMILIA</label>

<div class="input-group mb-3">
  {{ Form::select('tipoFamilia', ['1' => 'Nuclear', '2' => 'Compuesta', '3' => 'Extensa', '4' => 'Unipersonal', '5' => 'Monoparental', '6' => 'Tipo Acordeon', '7' => 'Ensamblada', '8' => 'Homoparental'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>

<label for="">RIESGOS PSICOSOCIALES</label>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('duelos', 1) }}
    </div>
  </div>
  {{ Form::text('x8', null, ['class' => 'form-control', 'placeholder'=>'Duelos no Elaborados', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('violenciaI', 1) }}

    </div>
  </div>
  {{ Form::text('x9', null, ['class' => 'form-control', 'placeholder'=>'Violencia Intrafamiliar', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('conflictoPareja', 1) }}

    </div>
  </div>
  {{ Form::text('x8', null, ['class' => 'form-control', 'placeholder'=>'Conflicto de Pareja', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('violenciaG', 1) }}

    </div>
  </div>
  {{ Form::text('x7', null, ['class' => 'form-control', 'placeholder'=>'Violencia de Género', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('maltratoI', 1) }}

    </div>
  </div>
  {{ Form::text('x6', null, ['class' => 'form-control', 'placeholder'=>'Maltrato Infantil', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('violenciaS', 1) }}

    </div>
  </div>
  {{ Form::text('x5', null, ['class' => 'form-control', 'placeholder'=>'Violencia Sexual', 'disabled' => 'disabled']) }}
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('transtornoP', 1) }}

    </div>
  </div>
  {{ Form::text('x4', null, ['class' => 'form-control', 'placeholder'=>'Transtorno Psicosocial', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('dificultadesA', 1) }}

    </div>
  </div>
  {{ Form::text('x3', null, ['class' => 'form-control', 'placeholder'=>'Dificultades de Adaptación', 'disabled' => 'disabled']) }}

</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('otro', 1) }}

    </div>
  </div>
  {{ Form::text('x2', null, ['class' => 'form-control', 'placeholder'=>'Otro', 'disabled' => 'disabled']) }}
</div>
{{ Form::label('cual', '¿Cual?')}}
<div class="input-group mb-3">
  {{ Form::text('cual', null, ['class' => 'form-control', 'placeholder'=>'¿Cual?']) }}
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      {{ Form::checkbox('ninguno', 1) }}

    </div>
  </div>
  {{ Form::text('x1', null, ['class' => 'form-control', 'placeholder'=>'Ninguno', 'disabled' => 'disabled']) }}
</div>


<input type="hidden" name="user_update_id" value="{{Auth::user()->id}}">
