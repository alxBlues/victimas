@if (session('infoModal'))
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="myModal">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title h4" id="mySmallModalLabel">Small modal</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <p>Woohoo, you're reading this text in a modal!</p>
             </div>
         </div>
     </div>
 </div>
@endif
@if (session('info'))

                              <div class="alert alert-success alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <i class="fa fa-check-circle"></i> {{ session('info') }}
                              </div>

@endif
@if (session('infoError'))

                              <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <i class="fa fa-check-circle"></i> {{ session('infoError') }}
                              </div>

@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
      <p>Corrige los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
