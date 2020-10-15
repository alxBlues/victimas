{{ method_field('PUT') }}
<div class="form-group required-control">
  {{ Form::label('bitacora_fecha', 'Fecha de Bitacora')}}
  {!! Form::date('bitacora_fecha', $Bitacora_vista->fecha, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>
<div class="form-group required-control">
  {{ Form::label('bitacora_titulo', 'Titulo Bitacora')}}
  {!! Form::text('bitacora_titulo', $Bitacora_vista->titulo, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>
<div class="form-group required-control">
  {{ Form::label('bitacora_descripcion', 'Descripcion')}}
  {!! Form::textarea('bitacora_descripcion', $Bitacora_vista->descripcion, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>
<div class="form-group required-control">
  {{ Form::label('bitacora_estado', 'Estado(Debe selecionar el estado siempre) ')}}
  @php
  $estadosLis = array(
  ""=>"",
  "Entregado"=>"Entregado",
  "Archivado"=>"Archivado",
  "Solicitado"=>"Solicitado",
  "En Espera"=>"En Espera"
  );
  @endphp
  {!! Form::select('bitacora_estado',[$estadosLis[$Bitacora_ayuda->estado] => $Bitacora_ayuda->estado]+ $estadosLis, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>
<div class="">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
  <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>