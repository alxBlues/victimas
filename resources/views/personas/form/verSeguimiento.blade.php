<div class="row">
    <div class="col-sm-12">
        <h3>ID De Seguimiento: <strong class="text-green">{{$seguimiento->id}}</strong></h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('seguimiento_fecha', 'Fecha de Seguimiento')}}</strong><br>
            {{$seguimiento->fecha_seguimiento}}
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 p-3">
        <h4>
            <strong>{{ Form::label('seguimiento_motivo', 'Motivo Y Desarrollo De La Intervención')}}</strong><br>
            {{$seguimiento->motivo_desarrollo_de_la_intervencion}}
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 p-3">
        <h4>
            <strong>{{ Form::label('seguimiento_acuerdos_observaciones', 'Acuerdos / Observaciones')}}</strong><br>
            {{$seguimiento->acuerdos_observaciones}}
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 p-3">
        <h4>
            <strong>{{ Form::label('seguimiento_url_adjunto', 'Registro Fisico')}}</strong><br>
            <a href="{{$seguimiento->url_adjunto}}" target="_blank">Ver archivo</a>
        </h4>
    </div>
</div>