<div class="input-group mb-3">
  {{ Form::text('name', $genero->name, ['class' => 'form-control', 'placeholder'=>'Nombre del Género']) }}
</div>
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
