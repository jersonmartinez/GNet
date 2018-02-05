<!-- Start: Header -->
    <header class="navbar navbar-fixed-top navbar-shadow">
      <div class="navbar-branding">
        <a class="navbar-brand" href="dashboard.html">
          <b>TheCode</b>Brain
        </a>
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown menu-merge hidden-xs">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Servicios
            <span class="caret caret-tp"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li>
            	<a href="#" style="width: 250px; padding: 10px;">
            		<b>Todos los servicios</b>
      					<div class="switch switch-info round switch-inline" style="position: absolute; right: 10px; top: 5px;">
      				  		<input id="AllServices" type="checkbox">
      				  		<label for="AllServices" id="dropdown-allServices" class="notification" data-note-stack="stack_bottom_right" data-note-style="success"></label>
                    <input type="hidden" id="SwitchAllServices" value="Off">
                </div>
              </a>
            </li>

            <li class="divider"></li>
            <li id="ConfigNetwork"><a href="#" style="width: 250px; padding: 10px;">Configurar Red Hospedada</a>
            </li>
            <li>
              <a href="#" style="width: 250px; padding: 10px;">
                Apagar | Iniciar Red
                <div class="switch switch-info round switch-inline" style="position: absolute; right: 10px; margin-top: -3px;">
                    <input id="IniciarApagarRH" type="checkbox">
                    <label for="IniciarApagarRH" id="dropdown-Network" class="notification" data-note-stack="stack_bottom_right" data-note-style="success"></label>
                    <input type="hidden" id="SwitchNetwork" value="Off">
                </div>
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#" style="width: 250px; padding: 10px;">
                Apagar | Iniciar MySQL
                <div class="switch switch-info round switch-inline" style="position: absolute; right: 10px; margin-top: -3px;">
                  <input id="IAMySQL" type="checkbox" checked="">
                  <label for="IAMySQL" id="dropdown-MySQL" class="notification" data-note-stack="stack_bottom_right" data-note-style="success"></label>
                  <input type="hidden" id="SwitchMySQL" value="On">
                </div>
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#" style="width: 250px; padding: 10px;">
                Apagar | Iniciar Apache
                <div class="switch switch-info round switch-inline" style="position: absolute; right: 10px; margin-top: -3px;">
                    <input id="IAApache" type="checkbox" checked="">
                    <label for="IAApache" id="dropdown-Apache" class="notification" data-note-stack="stack_bottom_right" data-note-style="success"></label>
                    <input type="hidden" id="SwitchApache" value="On">
                </div>
              </a>
            </li>
            
            <li><a href="#" style="width: 250px; padding: 10px;">Estado</a></li>
          </ul>
        </li>
        <li class="hidden-xs">
          <a class="request-fullscreen toggle-active" href="#">
            <span class="ad ad-screen-full fs18"></span>
          </a>
        </li>
      </ul>
      <form class="navbar-form navbar-left navbar-search alt" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search..." autofocus />
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="navbar-btn btn-group">
            <a href="#" class="topbar-menu-toggle btn btn-sm" data-toggle="button">
              <span class="ad ad-wand"></span>
            </a>
          </div>
        </li>
        <li class="dropdown menu-merge">
          <div class="navbar-btn btn-group">
            <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
              <span class="fa fa-bell-o fs14 va-m"></span>
              <span class="badge badge-danger">14</span>
            </button>
            <div class="dropdown-menu dropdown-persist w350 animated animated-shorter fadeIn" role="menu">  
              <div class="panel mbn">
                  <div class="panel-menu">
                     <span class="panel-icon"><i class="fa fa-clock-o"></i></span>
                     <span class="panel-title fw600">Actividad reciente</span>
                     <button class="btn btn-default light btn-xs pull-right" type="button"><i class="fa fa-refresh"></i></button>
                  </div>
                  <div class="panel-body panel-scroller scroller-navbar scroller-overlay scroller-pn pn">
                      <ol class="timeline-list">
                        <li class="timeline-item">
                          <div class="timeline-icon bg-dark light">
                            <span class="fa fa-tags"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Michael</b> Added to his store:
                            <a href="#">Ipod</a>
                          </div>
                          <div class="timeline-date">1:25am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-dark light">
                            <span class="fa fa-tags"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Sara</b> Added his store:
                            <a href="#">Notebook</a>
                          </div>
                          <div class="timeline-date">3:05am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-success">
                            <span class="fa fa-usd"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Admin</b> created invoice for:
                            <a href="#">Software</a>
                          </div>
                          <div class="timeline-date">4:15am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-success">
                            <span class="fa fa-usd"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Admin</b> created invoice for:
                            <a href="#">Apple</a>
                          </div>
                          <div class="timeline-date">7:45am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-success">
                            <span class="fa fa-usd"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Admin</b> created invoice for:
                            <a href="#">Software</a>
                          </div>
                          <div class="timeline-date">4:15am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-success">
                            <span class="fa fa-usd"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Admin</b> created invoice for:
                            <a href="#">Apple</a>
                          </div>
                          <div class="timeline-date">7:45am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-dark light">
                            <span class="fa fa-tags"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Michael</b> Added his store:
                            <a href="#">Ipod</a>
                          </div>
                          <div class="timeline-date">8:25am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-system">
                            <span class="fa fa-fire"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Admin</b> created invoice for:
                            <a href="#">Software</a>
                          </div>
                          <div class="timeline-date">4:15am</div>
                        </li>
                        <li class="timeline-item">
                          <div class="timeline-icon bg-dark light">
                            <span class="fa fa-tags"></span>
                          </div>
                          <div class="timeline-desc">
                            <b>Sara</b> Added to his store:
                            <a href="#">Notebook</a>
                          </div>
                          <div class="timeline-date">3:05am</div>
                        </li>
                      </ol>
                  </div>
                  <div class="panel-footer text-center p7">
                    <a href="#" class="link-unstyled"> Ver todo </a>
                  </div>
              </div>
            </div>
          </div>
        </li>
        <li class="dropdown menu-merge">
          <div class="navbar-btn btn-group">
            <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
              <span class="ad ad-radio-tower fs14 va-m"></span>
              <span class="badge">5</span>
            </button>
            <div class="dropdown-menu dropdown-persist w350 animated animated-shorter fadeIn" role="menu">  
              <div class="panel mbn">
                  <div class="panel-menu">
                    <div class="btn-group btn-group-justified btn-group-nav" role="tablist">
                      <a href="#nav-tab1" data-toggle="tab" class="btn btn-default btn-sm active">Notificaciones</a>
                      <a href="#nav-tab2" data-toggle="tab" class="btn btn-default btn-sm br-l-n br-r-n">Mensajes</a>
                      <a href="#nav-tab3" data-toggle="tab" class="btn btn-default btn-sm">Actividad</a>
                    </div>
                  </div>
                  <div class="panel-body panel-scroller scroller-navbar pn">
                    <div class="tab-content br-n pn">
                      <div id="nav-tab1" class="tab-pane alerts-widget active" role="tabpanel">
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-user text-info"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Registration
                              <small class="text-muted"></small>
                            </h5> Tyler Durden - 16 hours ago
                            
                          </div>
                          <div class="media-right">
                            <div class="media-response"> Approve?</div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-check text-success"></i>
                              </button>
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-remove"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-shopping-cart text-success"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Order
                              <small class="text-muted"></small>
                            </h5> <a href="#">Apple Ipod</a> - 4 hours ago
                          </div>
                          <div class="media-right">
                            <div class="media-response"> Confirm?</div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-check text-success"></i>
                              </button>
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-print"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-comment text-system"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Comment
                              <small class="text-muted"></small>
                            </h5> Mike - I loved your article!                            
                          </div>
                          <div class="media-right">
                            <div class="media-response text-right"> Moderate?</div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-pencil"></i>
                              </button>
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-check text-success"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-star text-warning"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Review
                              <small class="text-muted"></small>
                            </h5> Sammy Hilton - 4 hours ago
                          </div>
                          <div class="media-right">
                            <div class="media-response"> Approve?</div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-check text-success"></i>
                              </button>
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-remove"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-user text-info"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Registration
                              <small class="text-muted"></small>
                            </h5> Michael Sober - 7 hours ago
                          </div>
                          <div class="media-right">
                            <div class="media-response"> Approve?</div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-check text-success"></i>
                              </button>
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-remove"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-usd text-alert"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Invoice
                              <small class="text-muted"></small>
                            </h5> <a href="#">Apple Ipod</a> - 4 hours ago
                            
                          </div>
                          <div class="media-right">
                            <div class="media-response single">#518358</div>
                          </div>
                        </div>
                        <div class="media">
                          <a class="media-left" href="#"> <span class="glyphicon glyphicon-shopping-cart text-success"></span> </a>
                          <div class="media-body">
                            <h5 class="media-heading">New Order
                              <small class="text-muted"></small>
                            </h5> <a href="#">Apple Ipod</a> - 4 hours ago
                          </div>
                          <div class="media-right">
                            <div class="media-response"> Confirm?</div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-check text-success"></i>
                              </button>
                              <button type="button" class="btn btn-default btn-xs light">
                                <i class="fa fa-print"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="nav-tab2" class="tab-pane chat-widget" role="tabpanel">
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" alt="64x64" src="app/controller/src/plugins/assets/img/avatars/3.jpg">
                            </a>
                          </div>
                          <div class="media-body">
                            <span class="media-status online"></span>
                            <h5 class="media-heading">Side Master
                              <small> - 12:30am</small>
                            </h5> Haciendo un par de pruebas a este diseño, esperando buenas respuestas por parte del navegador. ¡Todo genial!.
                          </div>
                        </div>
                        <div class="media">
                          <div class="media-body">
                            <span class="media-status offline"></span>
                            <h5 class="media-heading">Joe Gibbons
                              <small> - 12:30am</small>
                            </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
                          </div>
                          <div class="media-right">
                            <a href="#">
                              <img class="media-object" alt="64x64" src="app/controller/src/plugins/assets/img/avatars/1.jpg">
                            </a>
                          </div>
                        </div>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" alt="64x64" src="app/controller/src/plugins/assets/img/avatars/2.jpg">
                            </a>
                          </div>
                          <div class="media-body">
                            <span class="media-status online"></span>
                            <h5 class="media-heading">Courtney Faught
                              <small> - 12:30am</small>
                            </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metuscommodo.
                          </div>
                        </div>
                        <div class="media">
                          <div class="media-body">
                            <span class="media-status offline"></span>
                            <h5 class="media-heading">Joe Gibbons
                              <small> - 12:30am</small>
                            </h5> Cras sit amet nibh libero, in Nulla vel metus scelerisque antecommodo.
                          </div>
                          <div class="media-right">
                            <a href="#">
                              <img class="media-object" alt="64x64" src="app/controller/src/plugins/assets/img/avatars/1.jpg">
                            </a>
                          </div>
                        </div>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" alt="64x64" src="app/controller/src/plugins/assets/img/avatars/2.jpg">
                            </a>
                          </div>
                          <div class="media-body">
                            <span class="media-status online"></span>
                            <h5 class="media-heading">Courtney Faught
                              <small> - 12:30am</small>
                            </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque soltudino.
                          </div>
                        </div>
                        <div class="media">
                          <div class="media-body">
                            <span class="media-status offline"></span>
                            <h5 class="media-heading">Joe Gibbons
                              <small> - 12:30am</small>
                            </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                          </div>
                          <div class="media-right">
                            <a href="#">
                              <img class="media-object" alt="64x64" src="app/controller/src/plugins/assets/img/avatars/1.jpg">
                            </a>
                          </div>
                        </div>
                      </div>
                      <div id="nav-tab3" class="tab-pane scroller-nm" role="tabpanel">
                        <ul class="media-list" role="menu">
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/5.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading">Article
                                <small class="text-muted">- 08/16/22</small>
                              </h5> Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/2.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading mv5">Article
                                <small> - 08/16/22</small>
                              </h5>
                              Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/3.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading">Article
                                <small class="text-muted">- 08/16/22</small>
                              </h5> Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/4.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading mv5">Article
                                <small class="text-muted">- 08/16/22</small>
                              </h5> Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/5.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading">Article
                                <small class="text-muted">- 08/16/22</small>
                              </h5> Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/2.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading mv5">Article
                                <small> - 08/16/22</small>
                              </h5>
                              Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                          <li class="media">
                            <a class="media-left" href="#"> <img src="app/controller/src/plugins/assets/img/avatars/3.jpg" class="mw40" alt="avatar"> </a>
                            <div class="media-body">
                              <h5 class="media-heading">Article
                                <small class="text-muted">- 08/16/22</small>
                              </h5> Last Updated 36 days ago by
                              <a class="text-system" href="#"> Max </a>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer text-center p7">
                    <a href="#" class="link-unstyled"> Ver todo </a>
                  </div>
              </div>
            </div>
          </div>
        </li>
        <li class="dropdown menu-merge">
          <div class="navbar-btn btn-group">
            <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
              <span class="flag-xs flag-us"></span>
              <!-- <span class="caret"></span> -->
            </button>
            <ul class="dropdown-menu pv5 animated animated-short flipInX" role="menu">
              <li>
                <a href="javascript:void(0);">
                  <span class="flag-xs flag-fr mr10"></span> Francés </a>
              </li>
              <li>
                <a href="javascript:void(0);">
                  <span class="flag-xs flag-us mr10"></span> Inglés </a>
              </li>
              <li>
                <a href="javascript:void(0);">
                  <span class="flag-xs flag-es mr10"></span> Español </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="menu-divider hidden-xs">
          <i class="fa fa-circle"></i>
        </li>
        <li class="dropdown menu-merge">
          <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
            <img src="app/controller/src/plugins/assets/img/avatars/5.jpg" alt="avatar" class="mw30 br64">
            <span class="hidden-xs pl15"><?php echo @$_SESSION['username']; ?></span>
            <span class="caret caret-tp hidden-xs"></span>
          </a>
          <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
            <li class="dropdown-header clearfix">
              <div class="pull-left ml10">
                <select id="user-status">
                  <optgroup label="Estado de cuenta">
                    <option value="1-1">Ocupado</option>
                    <option value="1-2">Desconectado</option>
                    <option value="1-3" selected="selected">Disponible</option>
                  </optgroup>
                </select>
              </div>

              <div class="pull-right mr10">
                <select id="user-role">
                  <optgroup label="Logueado como: ">
                    <option value="1-1" selected="selected">Root</option>
                    <option value="1-2">Administrador</option>
                    <option value="1-3">Maestro</option>
                    <option value="1-4">Estudiante</option>
                    <option value="1-5">Tutor</option>
                  </optgroup>
                </select>
              </div>
            </li>
            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-envelope"></span> Mensajes
                <span class="label label-warning">25</span>
              </a>
            </li>
            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-user"></span> Amigos
                <span class="label label-warning">235</span>
              </a>
            </li>
            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-bell"></span> Notificaciones </a>
            </li>
            <li class="list-group-item">
              <a href="#" class="animated animated-short fadeInUp">
                <span class="fa fa-gear"></span> Configuración </a>
            </li>
            <li class="dropdown-footer" id="LogoutRoot">
              <a href="#" class="">
              <span class="fa fa-power-off pr5"></span> Cerrar sesión </a>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- End: Header -->