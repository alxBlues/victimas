<div class="form-group required-control">
    <strong>{{ Form::label('Atencion_juridica_fecha', 'Feha de creacion')}}</strong><br>
    {{date('Y-m-d',strtotime($aten_juridica->created_at))}}
</div>
<div class="form-group required-control">
    <strong>{{ Form::label('Atencion_juridica_lista_chequeo', 'Chequeo')}}</strong><br>
    @if( $aten_juri_lista_chequeo[$aten_juridica->chequeo] == 'Otros')
    {{$aten_juridica->otros_texto}}
    @else
    {{$aten_juri_lista_chequeo[$aten_juridica->chequeo]}}
    @endif
</div>

<div class="form-group required-control">
    <strong>{{ Form::label('Atencion_juridica_decripcion', 'Observaciones')}}</strong><br>
    {{$aten_juridica->observaciones}}
</div>