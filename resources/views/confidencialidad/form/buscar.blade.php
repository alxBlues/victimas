{{ Form::open(['route' => 'acuerdo.buscar.consulta']) }}
<div class="input-group mb-3">
    {{ Form::text('data', null, ['class' => 'form-control', 'placeholder'=>'Nombres | Documento | Dependencia']) }}
    <div class="input-group-append">
        {{ Form::submit('Buscar', ['class' => 'btn btn-outline-secondary']) }}
    </div>
</div>
{{ Form::close() }}