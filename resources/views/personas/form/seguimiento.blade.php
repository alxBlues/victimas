<div class="row">
    <div class="col-sm-12">
        {{ Form::label('seguimiento_fecha', 'Fecha de Seguimiento')}}
        {{ Form::date('seguimiento_fecha', null, ['class'=>'form-control']) }}
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {{ Form::label('seguimiento_moivo', 'Motivo Y Desarrollo De La Intervención')}}
        {{ Form::textarea('seguimiento_moivo', null, ['class'=>'form-control', 'placeholder'=>'Escriba El Motivo Y Desarrollo De La Intervención']) }}
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {{ Form::label('seguimiento_acuerdos_observaciones', 'Acuerdos / Observaciones')}}
        {{ Form::textarea('seguimiento_acuerdos_observaciones', null, ['class'=>'form-control', 'placeholder'=>'Escriba Los Acuerdos / Observaciones']) }}
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        {{ Form::label('documento', 'Adjunte Registro Fisico En Pdf')}}
        {{ Form::file('documento',['class' => 'form-control']) }}
    </div>
</div>
<hr class="mb-4">
<div class="">
    {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancelar</button>
</div>