<div class="input-group mb-3">
  {{ Form::text('titulo', null, ['class' => 'form-control', 'placeholder'=>'Nombre del Atributo']) }}
</div>
<div class="input-group mb-3">
  {{ Form::hidden('plan', $plan->id, ['class' => 'form-control', 'placeholder'=>'Nombre del Atributo']) }}
</div>
<div class="input-group mb-3">
    @if(isset($atri->categorias))

    @else
    {!! Form::select('categorias', $categorias,null, ['class' => 'form-control','id'=>'categorias']) !!}
    @endif
</div>
<div class="tiempo" id="tiempo" style="display:none">
  <div class="input-daterange input-group" data-provide="datepicker">
  {{ Form::text('desde', null, ['class' => 'input-sm form-control', 'placeholder'=>'Fecha Inicia','data-date-format'=>'dd/mm/yyyy']) }}
  <span class="input-group-addon range-to">a</span>
  {{ Form::text('hasta', null, ['class' => 'input-sm form-control', 'placeholder'=>'Fecha Final','data-date-format'=>'dd/mm/yyyy']) }}
  </div>
</div>
<div class="suma" id="suma" style="display:none">
  <div class="input-daterange input-group" data-provide="datepicker">
  {!! Form::select('atributouno', $atributos,null, ['class' => 'input-sm form-control']) !!}
  <span class="input-group-addon range-to">+</span>
  {!! Form::select('atributodos', $atributos,null, ['class' => 'input-sm form-control']) !!}
</div>
</div>
<div class="porcentajea" id="porcentajea" style="display:none">
  <div class="input-daterange input-group" data-provide="datepicker">
  {!! Form::select('atributouno', [null=>'Seleccionar'] + $atributos,null, ['class' => 'input-sm form-control']) !!}
  {!! Form::select('atributodos', [null=>'Seleccionar'] + $atributos,null, ['class' => 'input-sm form-control']) !!}
  {!! Form::select('atributotres', [null=>'Seleccionar'] + $atributos,null, ['class' => 'input-sm form-control']) !!}
</div>
</div>
<div class="seleccionar" id="seleccionar" style="display:none">
<div class="input-group demo-tagsinput-area">
  {{ Form::text('tags', null, ['class' => 'form-control', 'placeholder'=>'Seleccionables','data-role'=>'tagsinput']) }}
</div>
</div>
<div class="modal-footer">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>
