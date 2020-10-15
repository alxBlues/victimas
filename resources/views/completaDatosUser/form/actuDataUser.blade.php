{!! Form::open(['route' => 'actualizardatos.datosPersonales']) !!}
<div class="form-actualiza-data">
    <div class="form-group">
        {{ Form::select('tipo_Documento', $tipoDocument, null,  ['class' => 'form-control', 'placeholder' => 'Selecione tipo de documento']) }}
    </div>
    <div class="form-group">
        {{ Form::text('document', null, ['class' => 'form-control', 'placeholder'=> 'Documento de identidad']) }}
    </div>
    <div class="form-group">
        {{ Form::text('nombres', null, ['class' => 'form-control', 'placeholder'=> 'Nombres y apellidos completos']) }}
    </div>
    <div class="form-group">
        {{ Form::text('movil', null, ['class' => 'form-control', 'placeholder'=> 'Celular']) }}
    </div>
    <div class="form-group">
        {{ Form::select('dependencia', $grupo, null,  ['class' => 'form-control', 'placeholder' => 'Selecione dependencia']) }}
    </div>
    <div class="form-group">
        {{ Form::select('contrato', ['CONTRATISTA' => 'CONTRATISTA', 'FUNCIONARIO' => 'FUNCIONARIO'], null,  ['class' => 'form-control', 'placeholder' => 'Selecione tipo de contrato']) }}
    </div>
    <div class="form-group">
        {{ Form::label('fin_de_contrato', 'Ingrese la fecha de fin de contrato', ['class' => 'control-label']) }}
        {{ Form::date('fin_de_contrato', null, ['class' => 'form-control']) }}
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
    <div class="form-group">
        {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-success']) }}&nbsp;&nbsp;&nbsp;

        <a class="btn btn-round btn-success" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</a>
    </div>
</div>
{!! Form::close() !!}
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<style>
    .form-actualiza-data {
        position: relative;
        margin: 0px auto;
        width: 50vw;
    }

    .btn-actua-data {
        width: 100%;
    }
</style>