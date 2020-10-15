{!! Form::open(['route' => 'perfil.editar', 'method' => 'put', 'files' => true]) !!}
<div class="form-actualiza-data">
    <div class="form-group">
        {{ Form::text('mail', auth()->user()->email , ['class' => 'form-control', 'placeholder'=> 'Correo']) }}
    </div>
    <div class="form-group">
        {{ Form::label('pass', 'Cambiar contraseña', ['class' => 'control-label']) }}
        <br>
        {{ Form::password('pass', ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::select('tipo_Documento', $tipoDocument, auth()->user()->tipoDocumento,  ['class' => 'form-control', 'placeholder' => 'Selecione tipo de documento']) }}
    </div>
    <div class="form-group">
        {{ Form::text('document', auth()->user()->documento, ['class' => 'form-control', 'placeholder'=> 'Documento de identidad']) }}
    </div>
    <div class="form-group">
        {{ Form::text('nombres', auth()->user()->name, ['class' => 'form-control', 'placeholder'=> 'Nombres y apellidos completos']) }}
    </div>
    <div class="form-group">
        {{ Form::text('movil', auth()->user()->movil, ['class' => 'form-control', 'placeholder'=> 'Celular']) }}
    </div>
    <div class="form-group">
        {{ Form::select('dependencia', $grupo, auth()->user()->dependencia,  ['class' => 'form-control', 'placeholder' => 'Selecione dependencia']) }}
    </div>
    <div class="form-group">
        {{ Form::label('fin_de_contrato', 'Ingrese la fecha de fin de contrato', ['class' => 'control-label']) }}
        {{ Form::date('fin_de_contrato', auth()->user()->finContrato, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        <a href="{{ route('descargar.DC') }}" class="btn btn-round btn-primary" target="_blank">Descargar Pdf De Acuerdo de confidencialidad</a>
    </div>
    <div class="form-group">
        {{ Form::label('file_Acuerdo', 'Cargar Archivo Pdf', ['class' => 'control-label']) }}
        <br>
        {{ Form::file('file_Acuerdo',['class' => '']) }}
    </div>
    <br>
    {{ Form::submit('Guardar', ['class' => 'btn btn-round btn-primary']) }}
</div>
{!! Form::close() !!}

<style>
    .btn-edit-user {
        width: 100%;
    }
</style>
