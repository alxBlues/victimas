@isset($aten_juri_lista_chequeo)
@if(!empty($aten_juri_lista_chequeo))
<div class="form-group required-control">
  {{ Form::label('Atencion_juridica_lista_chequeo', 'Lista De Chequeo')}}
  {{ Form::select('Atencion_juridica_lista_chequeo', $aten_juri_lista_chequeo, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opción', 'id'=>'selet_list_chequeo']) }}
</div>
<script>
  $(document).ready(function(e) {
    // alert('hola selet');
    $("#selet_list_chequeo")
      .change(function() {
        var str = "";
        $("#selet_list_chequeo option:selected").each(function() {
          str += $(this).text();
        });
        console.log(str);

        if(str == 'Otros'){
          $('#divOtros').show();
        }else{
          $('#divOtros').hide();
        }
      });
  });
</script>
<div class="form-group required-control" id="divOtros" style="display: none;">
  {{ Form::label('Atencion_juridica_otro', 'Valor Otro')}}
  {{ Form::text('Atencion_juridica_otro', null, ['class' => 'form-control', 'placeholder'=>'Ingrese el Valor de Otros']) }}
</div>
@else
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  La lista de Chequeo no asido creada, por favor cree una opcion o comuniquese con soporte.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@endisset
<!-- <div class="card">
  <div class="card-body">
    <div class="form-group required-control">
      {{ Form::label('Atencion_juridica_documento', 'Soportes')}}
      {{ Form::file('Atencion_juridica_documento',['class' => 'form-control', 'placeholder' => 'Seleccione un Soportes en Pdf']) }}
    </div>
  </div>
</div> -->
<div class="form-group required-control">
  {{ Form::label('Atencion_juridica_decripcion', 'Observaciones')}}
  {!! Form::textarea('Atencion_juridica_decripcion', null, ['class'=>'form-control', 'placeholder'=>'Observaciones de la Atencion Juridica']) !!}
</div>
<div class="">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
  <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>