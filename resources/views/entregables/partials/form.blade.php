<div class="form-group">
  {{ Form::label('observacion', 'Planes Activos en el Sistema') }}
  {{ Form::select('planes', [null=>'Seleccionar'] + $planes, null ,array('class' => 'form-control')) }}
  {{ Form::hidden('tipo', 12, ['class' => 'form-control', 'id' => 'tipo']) }}
</div>

<div class="form-group" id="acciones" style="display:none;">
  {{ Form::label('Acciones', 'Acciones del Tipo Entregable') }}
  {{ Form::select('accion_id', [null=>'Seleccionar'], null ,array('class' => 'form-control')) }}
</div>

<div class="form-group  {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('comentario', 'Observación') }}
    {{ Form::textarea('comentario',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('comentario','<span class="control-label">:mensaje</span>') !!}
</div>
<div class="form-group">
    {!! Form::label('Archivo PDF') !!}
    {!! Form::file('archivo', array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {{ Form::submit('Guardar', ['class'=>'btn btn-primary']) }}
</div>
