<div class="form-group required-control">
  {{ Form::label('bitacora_fecha', 'Fecha de Bitacora')}}
  {!! Form::date('bitacora_fecha', null, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>
<div class="form-group required-control">
  {{ Form::label('bitacora_titulo', 'Titulo Bitacora')}}
  {!! Form::text('bitacora_titulo', null, ['class'=>'form-control', 'placeholder'=>'Titulo o Explicación']) !!}
</div>
<div class="form-group required-control">
  {{ Form::label('bitacora_descripcion', 'Descripcion')}}
  {!! Form::textarea('bitacora_descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripcion del proceso']) !!}
</div>
<div class="form-group required-control">
  {{ Form::label('bitacora_estado', 'Estados')}}
  @php
  $estados = array(
  ""=>"",
  "Entregado"=>"Entregado",
  "Archivado"=>"Archivado",
  "Solicitado"=>"Solicitado",
  "En Espera"=>"En Espera"
  );
  @endphp
  {!! Form::select('bitacora_estado', $estados, null ,array('class'=>'form-control')) !!}
</div>
<div class="">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
  <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
