<div class="form-group required-control">
  {{ Form::label('acciones', 'Acciones')}}
  {{ Form::select('acciones',$acciones, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opci¨®n']) }}
</div>
<div class="form-group required-control">
  @php
  $listaTipo = array("Atencion Humanitaria Inmediata"=>"Atencion Humanitaria Inmediata", "Atencion Humanitaria Transicional"=>"Atencion Humanitaria Transicional");
  @endphp
  {{ Form::label('Ayuda_tipo', 'Tipo de Ayuda')}}
  {{ Form::select('Ayuda_tipo', $listaTipo, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Opci¨®n']) }}
</div>
<div class="card">
  <div class="card-body">
    <script>
      var listIds = [];
      var listInputs = [];
      var listValor = [];
    </script>
    @if($ayudas)
    @foreach($ayudas as $key => $lista_ayudas)
    @if($lista_ayudas['estado'] == '1')
    @php
    $nombre = str_replace(" ", "_", $lista_ayudas['nombre']);
    @endphp
    <div class="form-group required-control input-group">
      {{ Form::label('ayuda', 'Ayuda '.$lista_ayudas['nombre'])}}<br>
      {{ Form::checkbox('ayuda_'.str_replace(' ', '_', $nombre), $lista_ayudas['id'], null, ['class' => 'form-control lista_ayudas', 'id'=> 'ayuda_'.str_replace(' ', '_', $nombre)]) }}
      {{ Form::text('ayuda_contar_'.str_replace(' ', '_', $nombre), 1, ['class' => 'form-control', 'id'=> 'ayuda_contar_'.str_replace(' ', '_', $nombre)]) }}
    </div>
    <script>
      $(document).ready(function(e) {
        listIds.push("{{$lista_ayudas['id']}}");
        listInputs.push({
          "{{$lista_ayudas['id']}}": "{{'#ayuda_'.str_replace(' ', '_', $nombre)}}"
        });

        listValor.push({
          "{{'ayuda_'.str_replace(' ', '_', $nombre)}}": "{{$lista_ayudas['costo']}}"
        });
      });
    </script>
    @else
    @if(array_count_values($lista_ayudas) > 1)
    @else
    <strong class="text-red">{{_('No existen ayudas activas, por favor cree o active una para realizar un registro.')}}</strong>
    @endif
    @endif
    @endforeach
    @else
    <strong class="text-red">{{_('No existen ayudas, por favor cree una para realizar un registro.')}}</strong>
    @endif
  </div>
</div>
<div class="form-group required-control">
  {{ Form::text('Ayudas_ids', '', ['class' => 'form-control', 'hidden' => 'true', 'id' => 'ayudas_ids']) }}
</div>
<div class="card">
  <div class="card-body">
    <div class="form-group required-control">
      {{ Form::label('documentoA', 'Soportes')}}
      {{ Form::file('documentoA',['class' => 'form-control', 'placeholder' => 'Seleccione un Soportes en Pdf']) }}
    </div>
    <!-- <div class="form-group required-control">
      {{ Form::label('documentoB', 'Tarjeta de identidad')}}
      {{ Form::file('documentoB',['class' => 'form-control', 'placeholder' => 'Seleccione una Documento']) }}
    </div> -->
  </div>
</div>
<div class="form-group required-control">
  {{ Form::label('decripcion', 'Descripcion')}}
  {!! Form::textarea('decripcion', null, ['class'=>'form-control', 'placeholder'=>'Descripcion de la Ayuda']) !!}
</div>
<div class="">
  {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
  <script>
    $(document).ready(function(e) {
      $('#formAyudaVic > form').on('submit', function(eventBtSA) {
        // alert($('#ayudas_ids').val());
        $('#ayudas_ids').val('');
        $.each(listInputs, function(indexA, elementA) {
          $.each(elementA, function(indexB, elementB) {
            if ($(elementB).prop('checked')) {
              var name = elementB.replace("#ayuda_", "");
              var idListValor = elementB.replace("#", "");
              var repit = $('#ayuda_contar_' + name).val();
              var as = '{"id":"' + listIds[indexA] + '", "name":"' + name + '", "valor": "' + listValor[indexA][idListValor] + '", "repite": "' + repit + '"}' + $('#ayudas_ids').val();
              $('#ayudas_ids').val(as);
            }
          });
        });
        // alert($('#ayudas_ids').val());
      });
    });
  </script>
  <button type="button" class="btn btn-round btn-default" id="bt_save_ayudas" data-dismiss="modal">Cancelar</button>
</div>