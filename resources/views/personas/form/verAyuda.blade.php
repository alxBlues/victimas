<div class="row">
    <div class="col-sm-12">
        <h2>Infomacion Ayuda de: <br>{{$persona->primerNombre.' '.$persona->primerApellido}} {{$ayudas_edita->created_at}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h3>ID: <strong>{{$ayudas_edita->id}}</strong></h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('acciones', 'Acciones')}}</strong><br>
            {{$acciones[$ayudas_edita->accion]}}
        </h4>
    </div>
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('Ayuda_tipo', 'Tipo de Ayuda')}}</strong><br>
            {{$ayudas_edita->tipo}}
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('Ayuda_lista', 'Lista Ayudas')}}</strong><br>
            @php
            $asx = $ayudas_edita->cantidad_ayudas;
            $repite = explode(',', $asx);

            foreach($repite as $repi){
                $repite_ayuda[] =  $repi;
            }
            (int)$key = 0;
            foreach($ids_ayudas as $k => $id_ayudaB){
            foreach($ayudas as $key => $lista_ayudasB){
            if($id_ayudaB == $lista_ayudasB['id']){
            echo $lista_ayudasB['nombre'].' (';
            echo $repite_ayuda[$k] ?? '';
            echo '), ';
            }
            }
            $key++;
            }
            @endphp</h4>
    </div>
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('Ayuda_lista', 'Tipo Ayuda')}}</strong><br>
            {{$ayudas_edita->tipo}}
        </h4>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('valor_ayudas', 'Valor total de ayudas')}}</strong><br>
            {{$ayudas_edita->valor_ayudas}}
        </h4>
    </div>
    <div class="col-sm-6 p-3">
        <h4>
            <strong>{{ Form::label('descripcion', 'Descripcion')}}</strong><br>
            {{$ayudas_edita->descripcion}}
        </h4>
    </div>
</div>