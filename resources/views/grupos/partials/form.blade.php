{{ Form::label('name', 'Nombre') }}

<div class="input-group mb-3  {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::text('titulo',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('name','<span class="control-label">:message</span>') !!}
</div>

<div class="input-group mb-3">
    {{ Form::submit('Guardar', ['class'=>'btn btn-primary']) }}
</div>
