<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="/panel"><img src="{{ asset('assets/images/maatLogoWeb.png') }}" alt="Maat Logo" class="img-fluid logoMaat"></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{ asset('assets/images/user.png') }}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Hola,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ auth()->user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a class="dropdown-item" href="{{ route('perfil.index') }}">
                            <i class="icon-user"></i>Perfil
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-power"></i>Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="header">Menú General</li>
                @php
                if(isset($validaDataUser)){
                //echo $validaDataUser;
                }else{
                $validaDataUser = 'true';
                }

                //var_dump(!empty($validaDataUser));
                @endphp
                @if(auth()->user()->acepConfidencialidad != '' && auth()->user()->finContrato != '')
                <li class=" {{ (request()->is('home')) ? 'active' : '' }}">
                    <a href="{{route('home')}}" class=" has-arrow" aria-expanded="false"><i class="icon-home"></i><span>Mi Maat</span></a>

                </li>
                @can('personas.show')<li class="{{ (request()->is('personas')) ? 'open active' : '' }}">
                    <a href="#AtencionUsuario" class="has-arrow " aria-expanded="false"><i class="icon-users"></i><span>Atención al Usuario</span></a>
                    <ul>
                        <li><a href="{{route('personas.index')}}">Buscar Usuarios</a></li>
                        <li><a href="/personas/registro">Registro de Usuarios</a></li>
                    </ul>
                </li>@endcan
                @can('planes.show')<li class="{{ (request()->is('planes')) ? 'active' : '' }}">
                    <a href="#PAT" class="has-arrow" aria-expanded="false"><i class="icon-rocket"></i><span>Gestión de Planes</span></a>
                    <ul>
                        <li><a href="/planes">Planes</a></li>
                        @can('entregables.show')<li><a href="/entregables">Entregables</a></li>@endcan
                        <!--li><a href="#">Acciones</a></li>
                        <li><a href="#">Actividades</a></li>
                        <li><a href="#">Dependencias</a></li>
                        <li><a href="#">Responsables</a></li>
                        <li><a href="#">Ciclo</a></li-->
                        @can('planes.show')<li><a href="/exportar">Matriz de Seguimiento</a></li>@endcan
                    </ul>
                </li>@endcan

                @can('comites.show')<li class="{{ (request()->is('comite')) ? 'open active' : '' }}">
                    <a href="#Comites" class="has-arrow" aria-expanded="false"><i class="fa fa-object-group"></i><span>Comités</span></a>
                    <ul>
                        <li><a href="{{route('comite.index')}}">Registrar Acta</a></li>
                        <li ><a href="{{route('comite.searchview')}}">Buscar Actas</a></li>
                    </ul>
                </li>@endcan
                @can('users.create')<li>
                    <a href="#Indicadores" class="has-arrow" aria-expanded="false"><i class="fa fa-bar-chart-o"></i><span>Indicadores</span></a>
                    <ul>
                        <li class="active"><a href="#">Indicadores</a></li>
                    </ul>
                </li>@endcan
                  @can('ayudavictimas.create')<li>
                    <a href="#OtrosDatos" class="has-arrow" aria-expanded="false"><i class="fa fa-gears"></i><span>Ajustes</span></a>
                    <ul>
                        @can('planes.create')<li><a href="{{route('enfoqueP.index')}}">Enfoque Poblacional</a></li>@endcan
                        @can('planes.create')<li><a href="{{route('tipoP.index')}}">Población Especial</a></li>@endcan
                        @can('planes.create')<li><a href="{{route('genero.index')}}">Gestionar Géneros</a></li>@endcan
                        @can('planes.create')<li><a href="{{route('hechos.index')}}">Hechos Victimizantes</a></li>@endcan
                        <li><a href="{{route('gestionayudas.index')}}">Gestionar Ayudas</a></li>
                    </ul>
                </li>@endcan
                @can('users.create')<li>
                    <a href="#Admin" class="has-arrow" aria-expanded="false"><i class="fa fa-gear"></i><span>Administración</span></a>
                    <ul>

                        <li><a href="{{route('users.index')}}">Usuarios</a></li>
                        <li><a href="{{route('roles.index')}}">Roles</a></li>
                        <li><a href="{{route('grupos.index')}}">Grupos</a></li>
                        <li><a href="{{route('categorias.indexAcciones')}}">Tipos Acciones</a></li>
                        <li><a href="{{route('acuerdo.buscar')}}">Acuerdor de confidencialidad</a></li>

                    </ul>
                </li>@endcan
                <li>
                    <a href="#Ayuda" class="has-arrow" aria-expanded="false"><i class="icon-question"></i><span>Ayuda</span></a>
                    <ul>
                        <li><a href="{{route('ayuda')}}">FAQ</a></li>
                        <li><a href="{{route('ayuda')}}">Manual de Usuario</a></li>
                        <li><a href="{{route('ayuda')}}">Acerca del Proyecto</a></li>
                    </ul>
                </li>
                @else
                @endif
            </ul>
        </nav>
    </div>
</div>
