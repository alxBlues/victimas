<div class="form-group required-control">
  {{ Form::label('primerNombre', 'Primer Nombre')}}
  {{ Form::text('primerNombre', null, ['class' => 'form-control', 'placeholder'=>'Primer Nombre','required']) }}
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
  {{ Form::select('tipoDoc', $tipoDocumentos, null, ['class' => 'form-control', 'placeholder'=>'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('documento', 'N° de Documento')}}
  {{ Form::text('documento', null, ['class' => 'form-control', 'placeholder'=>'Identificación']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('fechaNacimiento', 'Fecha de Nacimiento')}}
  {{ Form::date('fechaNacimiento', null, ['class' => 'form-control']) }}
</div>
<div class="form-group required-control">
{{ Form::label('edad', 'Edad')}}
{{ Form::number('edad', null, ['class' => 'form-control', 'placeholder'=>'Edad']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('genero_id', 'Genero')}}
  {{ Form::select('genero_id', $genero, null ,array('class' => 'form-control', 'placeholder'=>'Seleccione una Opción'), ['placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('estaCivil', 'Estado Civil')}}
  {{ Form::select('estaCivil', ['1' => 'Union marital de hecho', '2' => 'Casado(A)', '3' => 'Viudo (A)', '4' => 'Separado (A)/ Divorciado (A)', '5' => 'Soltero', '6' => 'Otro'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('relacion', 'Relacion')}}
  {{ Form::select('relacion', ['1' => 'Jefe de Hogar', '2' => 'Esposo (A)', '3' => 'Hijo (A) Hijastro (A)', '4' => 'Yerno/Nuera', '5' => 'Nieto (A)', '6' => 'Padre o Madre', '7' => 'Suegros', '8' => 'Hermanos o Cuñados', '9' => 'Otros parientes', '10' => 'No Parientes'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="input-group mb-3">
  {{ Form::label('enfoqueP_id', 'Grupo Étnico')}}
  {{ Form::select('enfoqueP_id', $enfoqueP, null ,array('class' => 'form-control', 'placeholder'=>'Seleccione una Opción'), ['placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('afiSalud', 'Afiliacion a Salud')}}
  {{ Form::select('afiSalud', ['1' => 'Contributivo', '2' => 'Subsidiado', '3' => 'Especial', '4' => 'Ninguno'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('grado', 'Ultimo grado aprovado')}}
    <div class="multiselect_div">

  {{ Form::select('grado', $grados, null ,array('class'=>'multiselect multiselect-custom','id'=> 'multiselect2')) }}
  </div>
</div>
<div class="form-group required-control">
  {{ Form::label('estudia', 'Estudia Actualmente')}}
  {{ Form::select('estudia', ['1' => 'Si', '2' => 'No'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('leerEscribir', 'Lee y Escribe')}}
  {{ Form::select('leerEscribir', ['1' => 'Si', '2' => 'No'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('SNprograma', 'Programa')}}
  {{ Form::select('SNprograma', ['1' => 'Si', '2' => 'No'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('programa', 'Cual Programa')}}
  {{ Form::select('programa', ['1' => 'Familias en Accion', '2' => 'Colombia Mayor', '3' => 'Atencion Discapacidad', '4' => 'Apoyo Psicoterapeutico', '5' => 'Centros Vida', '6' => 'Alimentacion', '7' => 'ICBF', '8' => 'SENA', '9' => 'Apoyo Retorno/Reubicacion', '10' => 'Otro'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción']) }}
</div>
<input type="hidden" name="user_update_id" value="{{Auth::user()->id}}">
