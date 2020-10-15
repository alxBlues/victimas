<div class="input-group mb-3">
  {{ Form::text('titulo', null, ['class' => 'form-control', 'placeholder'=>'Nombre del Plan']) }}
</div>
<div class="tiempo" >
  <div class="input-daterange input-group" data-provide="datepicker">
  {{ Form::text('fecha_inicial', null, ['class' => 'input-sm form-control', 'placeholder'=>'Desde','data-date-format'=>'yyyy-mm-dd']) }}
  <span class="input-group-addon range-to">a</span>
  {{ Form::text('fecha_final', null, ['class' => 'input-sm form-control', 'placeholder'=>'Hasta','data-date-format'=>'yyyy-mm-dd']) }}
  </div>
</div>
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
