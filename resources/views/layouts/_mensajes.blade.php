@if(session()->has('mensaje'))
	<div class="alert alert-success" role="alert">
		{{ session()->get('mensaje') }}
	</div>
@endif
@if(session()->has('mensajeE'))
	<div class="alert alert-danger" role="alert">
		{{ session()->get('mensajeE') }}
	</div>
@endif
