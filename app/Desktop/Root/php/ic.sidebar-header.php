<!-- Start: Sidebar Header -->
<header class="sidebar-header">

  <!-- Sidebar Widget - Author -->
  <div class="sidebar-widget author-widget">
    <div class="media">
      <a class="media-left" href="#">
        <img src="app/controller/src/logo/user.png" class="img-responsive">
      </a>
      <div class="media-body">
        <div class="media-links">
           <a href="#" class="sidebar-menu-toggle"> PANEL DE CONTROL </a>
        </div>
        <div class="media-author"><?php echo @$_SESSION['username']; ?></div>
      </div>
    </div>
  </div>

  <!-- Sidebar Widget - Menu (slidedown) -->
  <div class="sidebar-widget menu-widget menu-options-dashboard">
    <div class="row text-center mbn">
      <div class="col-xs-4">
        <a href="dashboard.html" class="text-primary" data-toggle="tooltip" data-placement="top" title="Principal">
          <span class="glyphicon glyphicon-home"></span>
        </a>
      </div>
      <div class="col-xs-4">
        <a href="pages_messages.html" class="text-info" data-toggle="tooltip" data-placement="top" title="Mensajes">
          <span class="glyphicon glyphicon-inbox"></span>
        </a>
      </div>
      <div class="col-xs-4">
        <a href="pages_profile.html" class="text-alert" data-toggle="tooltip" data-placement="top" title="Tareas">
          <span class="glyphicon glyphicon-bell"></span>
        </a>
      </div>
      <div class="col-xs-4">
        <a href="pages_timeline.html" class="text-system" data-toggle="tooltip" data-placement="top" title="Actividad">
          <span class="fa fa-desktop"></span>
        </a>
      </div>
      <div class="col-xs-4">
        <a href="pages_profile.html" class="text-danger" data-toggle="tooltip" data-placement="top" title="Configuración">
          <span class="fa fa-gears"></span>
        </a>
      </div>
      <div class="col-xs-4">
        <a href="pages_gallery.html" class="text-warning" data-toggle="tooltip" data-placement="top" title="Cronología de trabajo">
          <span class="fa fa-flask"></span>
        </a>
      </div>
    </div>
  </div>

  <!-- Sidebar Widget - Search (hidden) -->
  <div class="sidebar-widget search-widget hidden">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-search"></i>
      </span>
      <input type="text" id="sidebar-search" class="form-control" placeholder="Search...">
    </div>
  </div>

</header>
<!-- End: Sidebar Header -->