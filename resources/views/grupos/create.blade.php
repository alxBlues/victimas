@include('layouts.header')
<body class="theme-green font-montserrat light_version">

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <div id="wrapper">
    @include('layouts.top_nave')
    @include('layouts.panel_izq')
    <div id="main-content">
      <div class="container-fluid">
        <div class="block-header">
            @include('layouts.alertas')
        </div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12">
                  <div class="card">
                      <div class="header">
                          <h2>Grupo</h2>
                      </div>
                      <div class="body">

                        {!! Form::open([
                              'route'=>['grupos.store'],
                            ])
                        !!}
                            @include('grupos.partials.form')

                        {!! Form::close()!!}
                          </div>
                        </div>
                      </div>
                    </div>
    


      </div>
    </div>
  </body>
  @include('layouts.footer')
