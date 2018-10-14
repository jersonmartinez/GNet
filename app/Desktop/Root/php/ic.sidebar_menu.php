<!-- Start: Sidebar Menu -->
<ul class="nav sidebar-menu NAC_SB_ID">
    <li class="sidebar-label pt20">GESTIÓN DE RED</li>

    <li>
        <a href="#" id="sb_item_ResourcesMonitor">
            <span class="fa fa-tachometer"></span>
            <span class="sidebar-title">Mi servidor</span>
        </a>
    </li>

    <!-- Se gestionan los dispositivos -->
    <li>
        <a class="accordion-toggle" href="#">
            <span class="fa fa-th"></span>
            <span class="sidebar-title">Dispositivos</span>
          
            <span class="caret"></span>
        </a>
    
        <ul class="nav sub-nav">
            <li>
                <a href="#" id="sb_item_DevicesManagement">
                    <span class="fa fa-dashboard"></span>
                    Gestionar
                </a>
            </li>

            <li>
                <a href="#" id="sb_item_AddDeviceManagement">
                    <span class="fa fa-keyboard-o"></span>
                    Agregar nuevo
                </a>
            </li>

            <?php
              //Sidebar Menu Host
              $SMHost = $CN_Global->getAllHost();

              if ($SMHost->num_rows > 0){
                ?>
                  <li>
                      <a href="#" id="sb_subitem_NetworkMap">
                          <span class="fa fa-sitemap"></span>
                          Topología de red
                      </a>
                  </li> 
                <?php
              }
            ?>     
        </ul>
    </li>
    
    <!-- Se aplica el sondeo de Red -->
    <li>
        <a href="#" id="sb_item_TrackingNetwork">
            <span class="fa fa-sitemap"></span>
            <span class="sidebar-title">Autodescubrimiento</span>
        </a>
    </li>

    <!-- Gestionar servicios de red -->
    <li>
        <a class="accordion-toggle" href="#">
            <span class="glyphicon glyphicon-book"></span>
            <span class="sidebar-title">Servicios de red</span>
          
            <span class="caret"></span>
        </a>
    
        <ul class="nav sub-nav">
            <li>
                <a href="#" id="sb_item_ServicesManagement">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    Gestionar servicios
                </a>
            </li>

            <li>
                <a href="#" id="sb_item_AddServicesManagement">
                    <span class="glyphicon glyphicon-text-height"></span>
                    Agregar servicios
                </a>
            </li>      
        </ul>
    </li>

    <!-- <li>
        <a class="accordion-toggle" href="#">
            <span class="glyphicon glyphicon-book"></span>
            <span class="sidebar-title">Documentación</span>
          
            <span class="caret"></span>
        </a>
    
        <ul class="nav sub-nav">
            <li>
                <a href="#" id="sidebar_show_documentation">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    Mostrar
                </a>
            </li>
            
            <li>
                <a href="#" id="sidebar_redactDocumentation">
                    <span class="glyphicon glyphicon-text-height"></span>
                    Redactar
                </a>
            </li>
          
        </ul>
    </li> -->


  <?php
    if (REM_NOTIFY_NECESSARY){
      ?>
        <li class="sidebar-label pt15">Otras configuraciones</li>
          <li>
            <a class="accordion-toggle" href="#">
              <span class="glyphicon glyphicon-fire"></span>
              <span class="sidebar-title">...</span>
              <span class="caret"></span>
            </a>
            <ul class="nav sub-nav">
              <li>
                <a href="admin_plugins-panels.html">
                  <span class="glyphicon glyphicon-book"></span>Crear usuario</a>
              </li>
              <li>
                <a href="admin_plugins-modals.html">
                  <span class="glyphicon glyphicon-modal-window"></span>Actualizar datos</a>
              </li>
              <li>
                <a href="admin_plugins-dock.html">
                  <span class="glyphicon glyphicon-equalizer"></span>Cambiar contraseña </a>
              </li>
            </ul>
          </li>
      <?php
    }
  ?>

  <!-- <li>
    <a class="accordion-toggle" href="#">
      <span class="glyphicon glyphicon-duplicate"></span>
      <span class="sidebar-title">...</span>
      <span class="caret"></span>
    </a>
    <ul class="nav sub-nav">
      <li>
        <a class="accordion-toggle" href="#">
          <span class="fa fa-gears"></span> ...
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li>
            <a href="pages_login.html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_login(alt).html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_register.html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_register(alt).html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_screenlock.html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_screenlock(alt).html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_forgotpw.html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_forgotpw(alt).html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="pages_confirmation.html" target="_blank"> ... </a>
          </li>
          <li>
            <a href="landing-page/landing1/index.html" target="_blank">...</a>
          </li>
          <li>
            <a href="pages_404.html">...</a>
          </li>
          <li>
            <a href="pages_404(alt).html">...</a>
          </li>
          <li>
            <a href="pages_500.html"> ... </a>
          </li>
          <li>
            <a href="pages_500(alt).html"> ... </a>
          </li>
        </ul>
      </li>
      <li>
        <a class="accordion-toggle" href="#">
          <span class="fa fa-desktop"></span> ...
          <span class="caret"></span>
        </a>
        <ul class="nav sub-nav">
          <li>
            <a href="pages_search-results.html">...</a>
          </li>
          <li>
            <a href="pages_profile.html">...</a>
          </li>
          <li>
            <a href="pages_timeline.html"> ... </a>
          </li>
          <li>
            <a href="pages_timeline-single.html"> ... </a>
          </li>
          <li>
            <a href="pages_faq.html">...</a>
          </li>
          <li>
            <a href="pages_calendar.html">...</a>
          </li>
          <li>
            <a href="pages_messages.html">...</a>
          </li>
          <li>
            <a href="pages_messages(alt).html">...</a>
          </li>
          <li>
            <a href="pages_gallery.html">...</a>
          </li>
        </ul>
      </li>
    </ul>
  </li> -->

  <!-- sidebar bullets -->
  <!-- <li class="sidebar-label pt20">Proyectos</li>
  <li class="sidebar-proj">
    <a href="#projectOne">
      <span class="fa fa-dot-circle-o text-warning"></span>
      <span class="sidebar-title">Una opción más.</span>
    </a>
  </li> -->


<?php 
  $CN = new ConnectSSH();
  $Otro = $CN->ConnectDB($H, $U, $P, $D, $X);

  // Credentials Local Machine
  $CLMUser = $CN->getCredentialsLocalMachine()['username'];
  $CLMPass = $CN->getCredentialsLocalMachine()['password'];

  $ConnectSSH = new ConnectSSH("127.0.0.1", $CLMUser, $CLMPass);
  
  if (!$ConnectSSH->CN){
      $StyleHidden = "visibility: hidden;";
  } else {
      $StyleHidden = "visibility: visible;";
  }

  $CpuStatus    = explode(",", $ConnectSSH->getCpuState());
  $MemoryStatus = explode(",", $ConnectSSH->getMemoryState());

  function PercentageCPU($UsoUser, $UsoSystem) {
    $cpuUsage = $UsoUser + $UsoSystem;
    return $cpuUsage."%";   
  }

  function PercenMemory($MemUsed) {
    $MemUsed = ($MemUsed * 100) / 1998;
    if(is_float($MemUsed)) {
      $PercenFloat = number_format($MemUsed, 2, '.', '');
      return $PercenFloat."%";   
    } 
    
    return $MemUsed."%";
  }


  /*function getServerCpuUsage(){
    $load = sys_getloadavg();
    return $load[0];
  }*/
?>

  <!-- sidebar progress bars -->
  <li class="sidebar-label pt25 pb10">Estadísticas del servidor</li>
  <li class="sidebar-stat SB_Medida_CPU" style="<?php echo @$StyleHidden; ?>">
    <a href="#projectOne" class="fs11">
      <span class="fa fa-adjust text-info"></span>
      <span class="sidebar-title text-muted">Uso de CPU</span>
      <span class="pull-right mr20 text-muted"><?php echo PercentageCPU($CpuStatus[1], $CpuStatus[2]);?></span>
      <div class="progress progress-bar-xs mh20 mb10">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo PercentageCPU($CpuStatus[1], $CpuStatus[2]);?>">
          <span class="sr-only"></span>
        </div>
      </div>
    </a>
  </li>

  <li class="sidebar-stat SB_Medida_RAM" style="<?php echo @$StyleHidden; ?>">
    <a href="#projectOne" class="fs11">
      <span class="fa fa-random text-warning"></span>
      <span class="sidebar-title text-muted">Uso de memoria</span>
      <span class="pull-right mr20 text-muted"><?php echo PercenMemory($MemoryStatus[1]); ?></span>
      <div class="progress progress-bar-xs mh20">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo PercenMemory($MemoryStatus[1]); ?> ">
          <span class="sr-only"></span>
        </div>
      </div>
    </a>
  </li>
  
</ul>
<!-- End: Sidebar Menu -->


<!-- Start: Sidebar Collapse Button -->
<div class="sidebar-toggle-mini">
  <a href="#">
    <span class="fa fa-sign-out"></span>
  </a>
</div>
<!-- End: Sidebar Collapse Button -->