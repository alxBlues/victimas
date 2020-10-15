<div class="input-group mb-3">
  {{ Form::text('name', $tipo->name, ['class' => 'form-control', 'placeholder'=>'Nombre del Tipo de Poblacion']) }}
</div>
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
