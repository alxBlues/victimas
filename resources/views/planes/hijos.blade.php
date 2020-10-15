@foreach($variables as $d)
<table border="1px">
  <td>{{ $d->variable }}<i class="fa fa-plus" data-toggle="modal" data-target=".new-variableh{{ $d->id }}-modal"></i></td>
  @if(count($d->children))
        @include('planes.hijos',['variables' => $d->children])
    @endif
</table>

@endforeach