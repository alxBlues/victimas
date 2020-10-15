<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('name','<span class="control-label">:mensaje</span>') !!}
</div>
<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'Correo') }}
    {{ Form::text('email',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('email','<span class="control-label">:mensaje</span>') !!}
</div>
<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
    {{ Form::label('password', 'Contraseña') }}
    {{ Form::password('password', ['class' => 'form-control']) }}
</div>
<hr>
<h3>Lista de Roles</h3>

<div class="form-group {{ $errors->first('roles') ? 'has-error' : '' }}">
    <ul class="list-unstyled">
        @foreach ($roles as $role)
            <li >
                <label>
                    {{ Form::checkbox('roles[]',$role->id) }}
                    {{ $role->name}}
                    <em>({{ $role->descritpion ?: 'Sin descripcion'}})</em>
                </label>
            </li>
        @endforeach
    </ul>
    {!! $errors->first('roles','<span class="control-label">:message</span>') !!}
</div>
<hr>
<h3>Lista de Grupos</h3>
<div class="form-group {{ $errors->first('grupos') ? 'has-error' : '' }}">
    <ul class="list-unstyled">
        @foreach ($grupos as $grupo)
            <li >
                <label>
                    {{ Form::checkbox('grupos[]',$grupo->id) }}
                    {{ $grupo->titulo}}
                    <em>({{ $grupo->descritpion ?: 'Sin descripcion'}})</em>
                </label>
            </li>
        @endforeach
    </ul>
    {!! $errors->first('grupos','<span class="control-label">:message</span>') !!}
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class'=>'btn btn-primary']) }}
</div>
