<div class="input-group mb-3">
  {{ Form::text($variable->atributos->siguiente()->id, null, ['class' => 'form-control', 'placeholder'=>$variable->atributos->siguiente()->titulo]) }}
</div>
@if(isset($variable))
  {{ Form::hidden('atributo', $variable->atributos->id, ['class' => 'form-control', 'placeholder'=>'Atributo']) }}
  {{ Form::hidden('variable', $variable->id, ['class' => 'form-control', 'placeholder'=>'Variable']) }}
@endif
<div class="input-group mb-3">
  {!! Form::select('tipoAyuda', [null=>'Tipo de Acción'] + $ayudas ,null, ['class' => 'form-control']) !!}
</div>
@if(isset($plan))
<div class="input-group mb-3">
  {{ Form::hidden('plan', $plan->id, ['class' => 'form-control', 'placeholder'=>'Variable']) }}
</div>
@endif
  {{ Form::hidden('tipo', 2, ['class' => 'form-control', 'placeholder'=>'TipoFormulario']) }}
@foreach($variable->atributos->siguiente()->siguientes() as $siguiente)
@if($siguiente->tipo == '4')
<div class="input-group mb-3">
  {{ Form::text($siguiente->id, null, ['class' => 'form-control', 'placeholder'=>$siguiente->titulo]) }}
</div>
@endif
@if($siguiente->tipo == '3')
<div class="input-group mb-3">
  {!! Form::select($siguiente->id, [null=>$siguiente->titulo] + $grupos ,null, ['class' => 'form-control']) !!}
</div>
@endif
@if($siguiente->tipo == '10')
<div class="input-group mb-3">
  @php $seleccionables = explode(',',$siguiente->valor); @endphp
  {!! Form::select($siguiente->id, [null=>$siguiente->titulo] + $seleccionables ,null, ['class' => 'form-control']) !!}
</div>
@endif
@if($siguiente->tipo == '8')
<div class="input-group mb-3">
  @php $seleccionables = explode(',',$siguiente->valor); @endphp
  {{ Form::text($siguiente->id, null, ['class' => 'form-control', 'placeholder'=>$siguiente->titulo]) }}
</div>
@endif
@endforeach
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
