<div class="form-group required-control">
  <strong>{{ Form::label('bitacora_fecha', 'Fecha de Bitacora')}}</strong><br>
  {{$Bitacora_vista->fecha}}
</div>
<div class="form-group required-control">
  <strong>{{ Form::label('bitacora_titulo', 'Titulo Bitacora')}}</strong><br>
  {{$Bitacora_vista->titulo}}
</div>
<div class="form-group required-control">
  <strong>{{ Form::label('bitacora_descripcion', 'Descripcion')}}</strong><br>
  {{$Bitacora_vista->descripcion}}
</div>
<div class="form-group required-control">
  <strong>{{ Form::label('bitacora_estado', 'Estado')}}</strong><br>
  {{$Bitacora_ayuda->estado}}
</div>