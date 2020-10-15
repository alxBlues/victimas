<div class="row">
  <!-- <div class="col-md-6 mb-3">
  {{ Form::label('comite_acciones', 'Acciones')}}
  
    <div class="invalid-feedback">
      Valid first name is required.
    </div>
  </div> -->
  <div class="col-md-6 mb-3">
    {{ Form::label('comite_fecha', 'Fecha de Comite')}}
    {{ Form::date('comite_fecha', null, ['class' => 'form-control']) }}
    <div class="invalid-feedback">
      Valid last name is required.
    </div>
  </div>
</div>

<div class="mb-3 form-group required-control">
  @php
   $listaTipo = array(
  "Comite Territorial de Justicia Transicional"=>"Comite Territorial de Justicia Transicional",
  "Sub-Comite de Atencion y Asistencia"=>"Sub-Comite de Atencion y Asistencia",
  "Sub-Comite de Reparacion Integral"=>"Sub-Comite de Reparacion Integral",
  "Sub-Comite de Tierras, Retornos y Reubicaciones"=>"Sub-Comite de Tierras, Retornos y Reubicaciones",
  "Sub-Comite de Sistemas de Informacion"=>"Sub-Comite de Sistemas de Informacion",
  "Sub-Comite de Prevencion y Proteccion"=>"Sub-Comite de Prevencion y Proteccion"
  );
  @endphp
  {{ Form::label('comite_nombre', 'Nombre de Comite')}}
  {{ Form::select('comite_nombre', $listaTipo, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opci¨®n']) }}
</div>
<div class="mb-3">
  {{ Form::label('comite_acta', 'Adjuntar Acta de Comite')}}<br>
  {{ Form::file('comite_acta', null, ['class' => 'form-control', 'placeholder'=>'Nombre de la Ayuda']) }}
  <div class="invalid-feedback">
    Please enter your shipping address.
  </div>
</div>
<div class="mb-3">
  {{ Form::label('comite_descripcion', 'Descripcion de Comite')}}
  {{ Form::textarea ('comite_descripcion', null, ['class' => 'form-control', 'placeholder'=>'Nombre de la Ayuda']) }}
</div>
<hr class="mb-4">
{{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
<button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
