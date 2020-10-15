<div class="form-group  {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('titulo',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('name','<span class="control-label">:message</span>') !!}
</div>

<div class="form-group">
    {{ Form::submit('Guardar', ['class'=>'btn btn-primary']) }}
</div>
