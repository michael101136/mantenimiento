
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-truck"></i> <span>Mantenimiento</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/admin/login/usuario.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Usuario</span>
                <h2>{{ auth()->user()->privilege }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  {{-- <li><a><i class="fa fa-home"></i> Ponentes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('ponentes.index') }}">inicio</a></li>
                    </ul>
                  </li> --}}
                    @if(auth()->user()->hasRoles(['admin']))
                   <li><a><i class="fa fa-clipboard"></i> PROBLEMAS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('listarproblemas') }}">Reportar</a></li>
                    </ul>
                  </li>
                  
                   @endif
               
                    @if(auth()->user()->hasRoles(['admin','jefe']))
                  <li><a><i class="fa fa-bullhorn"></i> INCIDENCIAS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                         
                          <li><a href="{{ url('incidencias') }}">Ticket de atención</a></li>
                         @endif  
                       
                         @if(auth()->user()->hasRoles(['admin','supervisor']))
                          <li><a href="{{ url('ordenServicio') }}">Orden de servicio</a></li>
                        @endif  
                          
                         @if(auth()->user()->hasRoles(['admin','supervisor','tecnico']))
                              <li><a href="{{ url('programarOrdenServicio')}}">Programar O.S</a></li>
              
                         @endif
                       
                    </ul>
                  </li>
                     @if(auth()->user()->hasRoles(['admin','jefe']))
                  <li><a><i class="fa fa-clipboard"></i> EQUIPOS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('equipoPrincipal.index') }}">Inicio</a></li>
                    </ul>
                  </li>
                    @endif
        
                   @if(auth()->user()->hasRoles(['admin']))
                  <li><a><i class="fa fa-gears"></i> MANTENIMIENTOS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('tipoMantenimientos.index') }}">Tipo mantenimiento</a></li>

                      <li><a href="{{URL::route('areas.index') }}">Area</a></li>
                      <!--<li><a href="{{URL::route('equipos.index') }}">Equipos</a></li>-->
                      <li><a href="{{URL::route('marcas.index') }}">Marcas</a></li>
                      <li><a href="{{URL::route('unidadMedidas.index') }}">Unidad Medida</a></li>
                      <li><a href="{{URL::route('tipoEquipos.index') }}">Tipo de equipos</a></li>
                      <li><a href="{{URL::route('ubicacions.index') }}">Ubicacion</a></li>
                      <li><a href="{{URL::route('tipoInformes.index') }}">Tipo de informe</a></li>
                      <li><a href="{{URL::route('categorias.index') }}">Categoria</a></li>
                      <li><a href="{{URL::route('empresas.index') }}">Empresa</a></li>
                      <li><a href="{{URL::route('logiProveedores.index') }}">Proveedores</a></li>
                      <li><a href="{{URL::route('paises.index') }}">Paises</a></li>
                      <li><a href="{{URL::route('frecuencias.index') }}">Frecuencia</a></li>
                      <li><a href="{{URL::route('tipos.index') }}">Tipo</a></li>
                      <li><a href="{{URL::route('tipoIncidencias.index') }}">Tipo incidencias</a></li>
                      <li><a href="{{URL::route('medidors.index') }}">Medidores</a></li>
                      <li><a href="{{URL::route('tiendas.index') }}">Tiendas</a></li>
                         <li><a href="{{URL::route('tipoProgramacions.index') }}">tipo programacion</a></li>
                    </ul>
                  </li>
                    
                   <li><a><i class="fa fa-user"></i> USUARIOS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('usuarios.index') }}">inicio</a></li>
                    </ul>
                  </li>
                  @endif
                  
                @if(auth()->user()->hasRoles(['admin','visitante']))
                   <li><a><i class="fa fa-clipboard"></i> SEGUIMIENTO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ url('seguimiento') }}">Ver</a></li>
                    </ul>
                  </li>
                   @endif
                   @if(auth()->user()->hasRoles(['admin']))
                   <li><a><i class="fa fa-clipboard"></i>PREVENTIVO<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('listarticket') }}">Ticket</a></li>
                    </ul>
                  </li>
                  
                   @endif
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">

                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="/admin/login/usuario.jpg" alt="">{{ auth()->user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a><br>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                         <i class="fa fa-sign-out fa-lg"></i> {{ __('salir') }}
                        </a>
                    </li>

                    <div class="pull-right">

                        <form id="logout-form" class="btn btn-default btn-flat" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>

                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
