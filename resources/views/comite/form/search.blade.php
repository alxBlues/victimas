<div class="row">
  <div class="col input-group">
    {{ Form::text('comite_busqueda', null, ['class' => 'form-control', 'placeholder'=>'Ingrese el comite que desea buscar']) }}
    <div class="input-group-append">
      {{ Form::submit('Buscar', ['class' => 'btn btn-outline-secondary']) }}
    </div>
    <div class="invalid-feedback">
      Please enter a valid email address for shipping updates.
    </div>
  </div>
</div>