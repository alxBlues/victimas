<div class="input-group mb-3">
  {{ Form::text('Ayuda_nombre', null, ['class' => 'form-control', 'placeholder'=>'Nombre de la Ayuda']) }}
</div>
<!-- <div class="input-group mb-3">
  @php
  $listaTipo = array("Atencion Humanitaria Inmediata"=>"Atencion Humanitaria Inmediata", "Atencion Humanitaria Transicional"=>"Atencion Humanitaria Transicional");
  @endphp
  {!! Form::select('Ayuda_tipo', $listaTipo, null, ['class' => 'form-control']) !!}
</div> -->
<div class="input-group mb-3">
  {{ Form::text('Ayuda_costo', null, ['class' => 'form-control', 'placeholder'=>'Costo de la Ayuda']) }}
</div>
<div class="input-group mb-3">
  {{ Form::text('Ayuda_cantidad', null, ['class' => 'form-control', 'placeholder'=>'Cantidad de la Ayuda']) }}
</div>
<div class="input-group mb-3">
  {!! Form::textarea('Ayuda_descripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>

<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
  <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>