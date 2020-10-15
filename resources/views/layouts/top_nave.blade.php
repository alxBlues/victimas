    <nav class="navbar top-navbar">
        <div class="container-fluid">
            <div class="navbar-left">
                <div class="navbar-btn">
                    <a href="/"><img src="{{ asset('assets/images/MaatLogoIcon.jpg') }}" alt="Maat Logo" class="img-fluid" style="width: 32px;"></a>
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
                <ul class="nav navbar-nav">
                    @php
                    if(isset($validaDataUser)){
                    //echo $validaDataUser;
                    }else{
                    $validaDataUser = 'true';
                    }

                    //var_dump(!empty($validaDataUser));
                    @endphp
                    @if(auth()->user()->acepConfidencialidad != '' && auth()->user()->finContrato != '' )
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                            <i class="fa fa-magic"></i>
                            <span class="">Acceso Rápido</span>
                        </a>
                        <ul class="dropdown-menu feeds_widget vivify fadeIn">
                            <li>
                                <a href="/personas">Buscar Usuario
                                </a>
                                <a href="/personas/registro">Registro de Usuarios
                                </a>
                                <a href="/personas">Registrar Atenciones
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="megamenu_toggle icon-menu" title="Manual de Usuario">Manual de Usuario</a></li>
                    <li class="p_social"><a href="javascript:void(0);" class="social icon-menu" title="FAQ">FAQ</a></li>
                    @endif
                </ul>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="megamenu_toggle icon-menu" title="Salir"><i class="icon-power"></i><span class=""> Salir</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </nav>

    <div id="rightbar" class="rightbar">
        <div class="body">
            <ul class="nav nav-tabs2">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Chat-one">Chat</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat-list">Funcionarios</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Chat-groups">Dependencias</a></li>
            </ul>
            <hr>
            <div class="tab-content">
                <div class="tab-pane vivify fadeIn delay-100 active" id="Chat-one">
                    <div class="chat_detail">
                        <ul class="chat-widget clearfix">
                            <li class="left float-left">
                                <div class="avtar-pic w35 bg-pink"><span>KG</span></div>
                                <div class="chat-info">
                                    <span class="message">Hello, John<br>What is the update on Project X?</span>
                                </div>
                            </li>
                            <li class="right">
                                <img src="../assets/images/xs/avatar1.jpg" class="rounded" alt="">
                                <div class="chat-info">
                                    <span class="message">Hi, Alizee<br> It is almost completed. I will send you an email later today.</span>
                                </div>
                            </li>
                            <li class="left float-left">
                                <div class="avtar-pic w35 bg-pink"><span>KG</span></div>
                                <div class="chat-info">
                                    <span class="message">That's great. Will catch you in evening.</span>
                                </div>
                            </li>
                            <li class="right">
                                <img src="../assets/images/xs/avatar1.jpg" class="rounded" alt="">
                                <div class="chat-info">
                                    <span class="message">Sure we'will have a blast today.</span>
                                </div>
                            </li>
                        </ul>
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <a href="javascript:void(0);" class=""><i class="icon-camera text-warning"></i></a>
                                </span>
                            </div>
                            <textarea type="text" row="" class="form-control" placeholder="Enter text here..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="tab-pane vvivify fadeIn delay-100" id="Chat-list">

                    <ul class="right_chat list-unstyled mb-0">

                        <li class="offline">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-red">s<span>FC</span></div>

                                    <div class="media-body">

                                        <span class="name">Folisise Chosielie</span>

                                        <span class="message">offline</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <img class="media-object " src="../assets/images/xs/avatar3.jpg" alt="">

                                    <div class="media-body">

                                        <span class="name">Marshall Nichols</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-red"><span>FC</span></div>

                                    <div class="media-body">

                                        <span class="name">Louis Henry</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-orange"><span>DS</span></div>

                                    <div class="media-body">

                                        <span class="name">Debra Stewart</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="offline">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-green"><span>SW</span></div>

                                    <div class="media-body">

                                        <span class="name">Lisa Garett</span>

                                        <span class="message">offline since May 12</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <img class="media-object " src="../assets/images/xs/avatar5.jpg" alt="">

                                    <div class="media-body">

                                        <span class="name">Debra Stewart</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="offline">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <img class="media-object " src="../assets/images/xs/avatar2.jpg" alt="">

                                    <div class="media-body">

                                        <span class="name">Lisa Garett</span>

                                        <span class="message">offline since Jan 18</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-indigo"><span>FC</span></div>

                                    <div class="media-body">

                                        <span class="name">Louis Henry</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-pink"><span>DS</span></div>

                                    <div class="media-body">

                                        <span class="name">Debra Stewart</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="offline">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-info"><span>SW</span></div>

                                    <div class="media-body">

                                        <span class="name">Lisa Garett</span>

                                        <span class="message">offline since May 12</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                    </ul>

                </div>

                <div class="tab-pane vivify fadeIn delay-100" id="Chat-groups">

                    <ul class="right_chat list-unstyled mb-0">

                        <li class="offline">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-cyan"><span>DT</span></div>

                                    <div class="media-body">

                                        <span class="name">Designer Team</span>

                                        <span class="message">offline</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-azura"><span>SG</span></div>

                                    <div class="media-body">

                                        <span class="name">Sale Groups</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                        <li class="online">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-orange"><span>NF</span></div>

                                    <div class="media-body">

                                        <span class="name">New Fresher</span>

                                        <span class="message">online</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>
                                    s
                                </div>

                            </a>

                        </li>

                        <li class="offline">

                            <a href="javascript:void(0);">

                                <div class="media">

                                    <div class="avtar-pic w35 bg-indigo"><span>PL</span></div>

                                    <div class="media-body">

                                        <span class="name">Project Lead</span>

                                        <span class="message">offline since May 12</span>

                                        <span class="badge badge-outline status"></span>

                                    </div>

                                </div>

                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>
    </div>