@include('layouts.header')
<body class="theme-cyan font-montserrat light_version">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>

<style>
    i {
        cursor:hand;
        display: inline-block;
        width: 40px;
        margin: 0;
        text-align: center;
        vertical-align: middle;
        -webkit-transition: font-size 0.2s;
        -moz-transition: font-size 0.2s;
        transition: font-size 0.2s;
    }
    i:hover {
        font-size: 26px;
    }
</style>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">
@include('layouts.top_nave')
@include('layouts.panel_izq')


        <div id="main-content">
       <div class="container-fluid">
           <div class="block-header">
               <div class="row clearfix">
                   <div class="col-md-6 col-sm-12">
                       <h2>Titulo</h2>
                       <p>
                       <nav aria-label="breadcrumb">
                           miga de pan
                       </nav>
                   </div>

               </div>
           </div>
           <div class="row clearfix">


             <!-- Modal Crear Variable Hijos-->
                 <div class="modal fade new-variable-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Crear Variable</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">


                             </div>

                         </div>
                     </div>
                 </div>
             <!-- Fin Modal Crear Variable Hijos--->

             <!-- Modal Editar Variable Hijos-->

                 <div class="modal fade new-variable-modal{{ $hijo->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Editar Variable</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">



                             </div>

                         </div>
                     </div>
                 </div>
             <!-- Fin Modal Editar Variable Hijos--->





                        <div class="col-12">
                          @include('layouts.alertas')

                          <div class="card">

                              <div class="tab-content mt-0">
                                  <div class="tab-pane active show" id="Users">
                                    <div class="row clearfix">
                                        <div class="col-md-6 col-sm-12">

                                        </div>
                                        <div class="col-md-6 col-sm-12 text-right hidden-xs">
                                          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".new-variable-modal">Crear Variable</button>

                                        </div>
                                    </div>
                                      <div class="table-responsive">
                                          hola vista Gestion Ayudas
                                      </div>
                                  </div>

                              </div>
                          </div>
                        </div>


                </div>
            </div>


        </div>
    </div>
</div>


</div>
</body>
@include('layouts.footer')
