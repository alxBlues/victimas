<div class="input-group mb-3">
  @if($variable->atributos->tipo == '3')
  {!! Form::select($variable->id, [null=>$variable->grupo->titulo] + $grupos ,null, ['class' => 'form-control']) !!}
  @elseif($variable->atributos->tipo == '10')
  @php $seleccionables = explode(',',$variable->atributos->valor); @endphp
  @php
  $valor = $variable->variable;
  $seleccionables = explode(',',$variable->atributos->valor);
  @endphp
  {!! Form::select($variable->id, [null=>$seleccionables[$valor]] + $seleccionables ,null, ['class' => 'form-control']) !!}
  @else
  {{ Form::text($variable->id, $variable->variable, ['class' => 'form-control', 'placeholder'=>$variable->atributos->siguiente()->titulo]) }}
  @endif
</div>

  {{ Form::hidden('tipo', 2, ['class' => 'form-control', 'placeholder'=>'TipoFormulario']) }}

  @if($variable->atributos->tipo == '2')
  <div class="input-group mb-3">
    @if(!isset($variable->tipo))
    {!! Form::select('tipo_accion', [null=>'Seleccionar'] + $acciones ,null, ['class' => 'form-control']) !!}
    @else
    {!! Form::select('tipo_accion', [null=>$variable->ayudas->titulo .' (Actual Seleccionado)'] + $acciones ,null, ['class' => 'form-control']) !!}
    @endif
  </div>
  @endif
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}

    <a href="{{ url()->previous() }}"><button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button></a>
</div>
