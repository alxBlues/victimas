{!! Form::open(['route' => 'acuerdo.cargar', 'method' => 'put', 'files' => true]) !!}
<div class="form-acuerdo">
    <div class="form-group">
        <a href="{{ route('descargar.DC') }}" class="btn btn-round btn-primary" target="_blank">Descargar Pdf De Acuerdo de confidencialidad</a>
    </div>
    <div class="form-group">
        {{ Form::label('file_Acuerdo', 'Cargar Archivo Pdf', ['class' => 'control-label']) }}
        <br>
        {{ Form::file('file_Acuerdo',['class' => '']) }}
    </div>
    <br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
    @endif
    {{ Form::submit('Cargar Comprobante De Acuerdo', ['class' => 'btn btn-round btn-success']) }}&nbsp;&nbsp;&nbsp;

    <button type="button" class="btn btn-round btn-success" data-dismiss="modal">Cerrar</button>
</div>
{!! Form::close() !!}


<style>
    .form-acuerdo {
        position: relative;
        margin: 10px auto;
        width: 50vw;
    }
</style>