{{ Form::label('name', 'Nombre') }}

<div class="input-group mb-3  {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::text('name',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('name','<span class="control-label">:message</span>') !!}
</div>
{{ Form::label('slug', 'URL amigable') }}

<div class="input-group mb-3  {{ $errors->first('slug') ? 'has-error' : '' }}">
    {{ Form::text('slug',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('slug','<span class="control-label">:message</span>') !!}
</div>
{{ Form::label('description', 'Descripcion') }}

<div class="input-group mb-3 {{ $errors->first('description') ? 'has-error' : '' }}">
    {{ Form::textarea('description',$value=null, ['class'=>'form-control']) }}

    {!! $errors->first('description','<span class="control-label">:message</span>') !!}
</div>

<hr>
<h6>Permiso especial</h6>
<div class="input-group mb-3">
    <label>
        {{ Form::radio('special','all-access')}} Acceso Total
    </label>
    <label>
        {{ Form::radio('special','no-access')}} Ningun acceso
    </label>
</div>

<h6>Lista de Permisos</h6>

<div class="input-group mb-3">
    <ul class="list-unstyled">
        @foreach ($permissions as $permission)
            <li>
                <label>
                    {{ Form::checkbox('permissions[]',$permission->id) }}
                    {{ $permission->name}}
                    <em>({{ $permission->descritpion ?: 'Sin descripcion'}})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>

<div class="input-group mb-3">
    {{ Form::submit('Guardar', ['class'=>'btn btn-primary']) }}
</div>
