<div class="input-group mb-3">
  {{ Form::text('data', null, ['class' => 'form-control', 'placeholder'=>'Nombres | Apellidos | Documento | Dirección...']) }}
	<div class="input-group-append">
	  {{ Form::submit('Buscar', ['class' => 'btn btn-outline-secondary']) }}
	</div>
</div>

