<div class="form-group">
  {{ Form::label('observacion', 'Planes Activos en el Sistema') }}
  {{ Form::select('planes', [null=>'Seleccionar'] + $planes, null ,array('class' => 'form-control',)) }}
  {{ Form::hidden('tipo', 15, ['class' => 'form-control', 'id' => 'tipo']) }}
</div>
<div class="form-group" id="acciones" style="display:none;">
  {{ Form::label('Acciones', 'Acciones del Tipo Atención') }}
  {{ Form::select('accion_id', [null=>'Seleccionar'], null ,array('class' => 'select2 form-control')) }}
</div>
<div class="form-group required-control">
  {{ Form::label('descripcion', 'Descripción')}}
  {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder'=>'Descripción']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('lugar', 'Lugar')}}
  {{ Form::text('lugar', null, ['class' => 'form-control', 'placeholder'=>'Lugar']) }}
</div>
<div class="form-group required-control">
  {{ Form::label('fecha', 'Fecha de Atención')}}
  {{ Form::date('fecha', null, ['class' => 'form-control']) }}
</div>
<div class="modal-footer">
  {{ Form::submit('Registrar', ['class' => 'btn btn-round btn-success']) }}
</div>
