<div class="input-group mb-3">
  {{ Form::text('variable', null, ['class' => 'form-control', 'placeholder'=>'Nombre de la Variable']) }}
</div>
@if(isset($variable))
<div class="input-group mb-3">
  {{ Form::hidden('atributo', $variable->atributos->id, ['class' => 'form-control', 'placeholder'=>'Atributo']) }}
</div>

<div class="input-group mb-3">
  {{ Form::hidden('padre', $variable->id, ['class' => 'form-control', 'placeholder'=>'Variable']) }}
</div>
@endif
@if(isset($plan))
<div class="input-group mb-3">
  {{ Form::hidden('plan', $plan->id, ['class' => 'form-control', 'placeholder'=>'Variable']) }}
</div>
@endif
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
