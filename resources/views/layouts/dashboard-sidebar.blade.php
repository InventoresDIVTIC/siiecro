<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <img src="{{ asset('/img/sii-ecro.png') }}" class="img-responsive">
                <div class="dropdown profile-element m-t-md">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> 
                            <span class="text-muted text-xs block">{{ Auth::user()->rol()->first()->nombre }} <b class="caret"></b></span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="javascript:misDatos()">Mis datos</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    ECRO
                </div>
            </li>

            <li class="{{ $menu == "dashboard" ? "active" : "" }}">
                <a href="{{ route('dashboard.dashboard.index') }}"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="{{ in_array($menu, ["obras", "solicitudes-intervencion"]) ? "active" : "" }}">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Obras</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @if (Auth::user()->rol->captura_solicitud_obra)
                        <li class="{{ $menu == "solicitudes-intervencion" ? "active" : "" }}">
                            <a href="{{ route('dashboard.obras.solicitudes') }}">Solicitudes</a>
                        </li>
                    @endif
                    <li class="{{ $menu == "obras" ? "active" : "" }}">
                        <a href="{{ route('dashboard.obras.index') }}">Listado</a>
                    </li>
                </ul>
            </li>

            @if (Auth::user()->rol->captura_de_catalogos_avanzada)
                <li class="{{ $menu == "proyectos" ? "active" : "" }}">
                    <a href="{{ route('dashboard.proyectos.index') }}"><i class="fa fa-bookmark"></i> <span class="nav-label">Proyectos de la ECRO</span></a>
                </li>
            @endif

            @if (Auth::user()->rol->captura_de_catalogos_basica || Auth::user()->rol->captura_de_catalogos_avanzada)
                <li class="{{ in_array($menu, ["tipo-objeto", "tipo-bien-cultural", "temporalidad", "epoca", "area"]) ? "active" : "" }}">
                    <a href="#"><i class="fa fa-book" aria-hidden="true"></i><span class="nav-label">Catálogos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        @if (Auth::user()->rol->captura_de_catalogos_avanzada)
                            <li><a href="{{ route('dashboard.areas.index') }}">Áreas de la ECRO</a></li>
                        @endif

                        <li><a href="{{ route('dashboard.obras-epoca.index') }}">Época</a></li>
                        <li><a href="{{ route('dashboard.obras-temporalidad.index') }}">Temporalidad</a></li>
                        <li><a href="{{ route('dashboard.obras-tipo-bien-cultural.index') }}">Tipo Bien Cultural</a></li>
                        <li><a href="{{ route('dashboard.obras-tipo-objeto.index') }}">Tipo Objeto</a></li>
                        <li><a href="{{ route('dashboard.obras-forma-obtencion-muestra.index') }}">Forma de Obtención de la Muestra</a></li>
                        <li><a href="{{ route('dashboard.obras-tipo-de-material.index') }}">Tipo de Material</a></li>
                        <li><a href="{{ route('dashboard.obras-informacion-por-definir.index') }}">Información por Definir</a></li>
                        <li><a href="{{ route('dashboard.obras-interpretacion-particular.index') }}">Interpretación Material</a></li>
                        <li><a href="{{ route('dashboard.obras-analisis-a-realizar.index') }}">Análisis a Realizar</a></li>
                        <li><a href="{{ route('dashboard.obras-informacion-del-equipo.index') }}">Información del equipo</a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->rol->creacion_usuarios_permisos)
                <li class="{{ $menu == "usuarios" ? "active" : "" }}">
                    <a href="{{ route('dashboard.usuarios.index') }}"><i class="fa fa-user-circle-o"></i> <span class="nav-label">Usuarios</span></a>
                </li>
                <li class="{{ $menu == "roles" ? "active" : "" }}">
                    <a href="{{ route('dashboard.roles.index') }}"><i class="fa fa-lock"></i> <span class="nav-label">Roles</span></a>
                </li>
            @endif
        </ul>
    </div>
</nav>