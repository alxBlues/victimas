
<div class="form-group required-control">
  {{ Form::label('primerNombre', 'Primer Nombre')}}
  {{ Form::text('primerNombre', null, ['class' => 'form-control', 'placeholder'=>'Primer Nombre']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('segundoNombre', 'Segundo Nombre')}}
  {{ Form::text('segundoNombre', null, ['class' => 'form-control', 'placeholder'=>'Segundo Nombre']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('primerApellido', 'Primer Apellido')}}
  {{ Form::text('primerApellido', null, ['class' => 'form-control', 'placeholder'=>'Primer Apellido']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('segundoApellido', 'Segundo Apellido')}}
  {{ Form::text('segundoApellido', null, ['class' => 'form-control', 'placeholder'=>'Segundo Apellido']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('tipoDoc', 'Tipo de Documento')}}
  {{ Form::select('tipoDoc', $documentos, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('identificacion', 'N° de Documento')}}
  {{ Form::text('identificacion', null, ['class' => 'form-control', 'placeholder'=>'Identificación']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('fechaNacimiento', 'Fecha de Nacimiento')}}
  {{ Form::date('fechaNacimiento', null, ['class' => 'form-control']) }}
</div>
<!--<div class="form-group required-control">-->
<!--  {{ Form::label('edad', 'Edad')}}-->
<!--  {{ Form::number('edad', null, ['class' => 'form-control', 'placeholder'=>'Edad']) }}-->
<!--</div>-->
<div class="form-group required-control">
  {{ Form::label('grado', 'Escolaridad')}}
  <div class="multiselect_div">
  {{ Form::select('grado', [null=>'Seleccionar Escolaridad'] + $grados, null ,array('class'=>'multiselect multiselect-custom','id'=> 'multiselect2')) }}
  </div>
</div>
<div class="form-group required-control">
  {{ Form::label('telefono', 'Teléfono')}}
  {{ Form::number('telefono', null, ['min'=>'0', 'class' => 'form-control', 'placeholder'=>'Teléfono']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('area', 'Área')}}
  {{ Form::select('area', ['1' => 'Urbano', '2' => 'Rural'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('estrato', 'Estrato')}}
  {{ Form::select('estrato', ['1' => 'Entre 1 y 2', '2' => 'Entre 3 y 4'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('salud', 'Salud')}}
  {{ Form::select('salud', ['1' => 'Contributivo', '2' => 'Subsidiado'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('genero_id', 'Género')}}
  {{ Form::select('genero_id', $genero, null ,array('class' => 'form-control', 'placeholder'=>'Seleccione una Opción'), ['placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('tipoP_id', 'Tipo de Población')}}
  {{ Form::select('tipoP_id', $tipoP, null ,array('class' => 'form-control', 'placeholder'=>'Seleccione una Opción'), ['placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('enfoqueP_id', 'Grupo Étnico')}}
  {{ Form::select('enfoqueP_id', $enfoqueP, null ,array('class' => 'form-control', 'placeholder'=>'Seleccione una Opción'), ['placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('hechosV', 'Hecho Victimizante')}}
  @foreach($hechosV as $hechos)
  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          {!! Form::checkbox('hechosV[]', $hechos->id, null, ['class' => 'field']) !!}
        </div>
      </div>
      {{ Form::text('titulos', null, ['class' => 'form-control', 'placeholder'=>$hechos->name, 'disabled' => 'disabled']) }}
  </div>
  @endforeach
</div>

<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
<div class="">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
</div>
