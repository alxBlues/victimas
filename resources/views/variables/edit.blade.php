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
                       <h2>
                         Editar Variables Fijas

                       </h2>
                       <p>
                           <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{ route('planes.show',$variable->atributos->plan_id) }}">{{ $variable->atributos->planes->titulo  }}</a></li>
                             @foreach($variable->ancestors as $ancestros)
                                 <li class="breadcrumb-item"><a href="{{ route('variables.show',$ancestros->id) }}">{{ $ancestros->variable }}</a></li>
                             @endforeach
                           </ol>
                       </nav>

                   </div>

               </div>
           </div>
           <div class="row clearfix">

             <div class="col-lg-12 col-md-12">
                   <div class="card">
              
                       @include('layouts.alertas')
                       <div class="body">

                            {!! Form::model($variable, ['route' => ['variables.update', $variable->id], 'method' => 'PUT','files' => true]) !!}
                              @include('variables.form.formEditar')
                            {!! Form::close() !!}

                          </div>
                        </div>


                </div>
            </div>


        </div>
    </div>
</div>

</body>
@include('layouts.footer')
