<!-- Modal -->
<div class="modal fade @if(auth()->user()->copiaContrato != '') {{ $viewModal[$validaDataUser]}} @endif" id="updateDataUser" tabindex="-1" role="dialog" aria-labelledby="updateDataUserLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDataUserLabel">
                    @if(auth()->user()->acepConfidencialidad == '')
                    Acuerdo De Confidencialidad
                    @else
                    @if(auth()->user()->finContrato == '')
                    Actualiza Datos Personales
                    @else
                    @if(auth()->user()->copiaContrato == '')
                    Cargar Docuemento De Acuerdo De Confidencialidad
                    @endif
                    @endif
                    @endif
                </h5>
                @if(auth()->user()->acepConfidencialidad == '')
                <a class="close" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                @if(auth()->user()->finContrato == '')
                <a class="close" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                @if(auth()->user()->copiaContrato == '')
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @endif
                @endif
                @endif
            </div>
            <div class="modal-body">
                @if(auth()->user()->acepConfidencialidad == '')
                @include('completaDatosUser.form.aceptaConfiden')
                @else
                @if(auth()->user()->finContrato == '')
                @include('completaDatosUser.form.actuDataUser')
                @else
                @if(auth()->user()->copiaContrato == '')
                @include('confidencialidad.form.cargarAcuerdo')
                @endif
                @endif
                @endif

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#updateDataUser').modal('{{ $viewModal[$validaDataUser]}}');
</script>
