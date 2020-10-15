<div class="input-group mb-3">
  {{ Form::text('name', $hecho->name, ['class' => 'form-control', 'placeholder'=>'Nombre del Hecho Victimizante']) }}
</div>
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
