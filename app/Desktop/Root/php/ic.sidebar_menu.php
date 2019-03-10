<?php
    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);
?>

<!-- Start: Sidebar Menu -->
<ul class="nav sidebar-menu NAC_SB_ID NAC_SB_First">
    <li class="sidebar-label pt20">GESTIÓN DE RED</li>

    <li>
        <a href="#" id="sb_item_ResourcesMonitor">
            <span class="fa fa-stack-exchange"></span>
            <span class="sidebar-title">Mi servidor</span>
        </a>
    </li>
    
    <!-- Se aplica el sondeo de Red -->
    <li class="class-sb_item_TrackingNetwork">
        <a href="#" id="sb_item_TrackingNetwork">
            <span class="fa fa-sitemap"></span>
            <span class="sidebar-title">Autodescubrimiento</span>
        </a>
    </li>

    <!-- Se gestionan los dispositivos -->
    <li class="parent-class-sb_item_DevicesManagement">
        <a class="accordion-toggle class-sb_item_DevicesManagement" href="#">
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

    <!-- Gestión de eventos -->
    <li class="parent-class-sb_item_MonitorLogs">
        <a class="accordion-toggle class-sb_item_MonitorLogs" href="#">
            <span class="fa fa-bell"></span>
            <span class="sidebar-title">Gestión de eventos</span>         
            <span class="caret"></span>
        </a>
    
        <ul class="nav sub-nav">
            <li>
              <a href="#" id="sb_item_MonitorLogs">
                  <span class="fa fa-dashboard"></span>
                  Visor de eventos
              </a>
            </li>

            <li>
                <a href="#" id="sb_item_ConfigureSyslog">
                    <span class="fa fa-cogs"></span>
                    Configurar Syslog
                </a>
            </li>    
        </ul>
    </li>

    <li>
        <a href="#" id="sb_item_VPS" title="Servidor Virtual Privado">
            <span class="fa fa-stack-exchange"></span>
            <span class="sidebar-title">VPS</span>
        </a>
    </li>

    <?php
        if ($CN->db_connect){
            $gCVPS = $CN->getCredentialsVPS();
            if ($gCVPS->num_rows > 0){
                ?>
                    <li class="sidebar-label pt20 SB_devicesVPS">DISPOSITIVOS VPS</li>
                <?php
                while ($row_gCVPS = $gCVPS->fetch_array(MYSQLI_ASSOC)){
                    ?>
                        <li class="sidebar-proj del_<?php echo str_replace(".","",$row_gCVPS['ip_host']); ?>" ip_host="<?php echo $row_gCVPS['ip_host']; ?>" onclick="javascript: getDataMyVPS(this);" >
                            <a href="#">
                                <span class="fa fa-dot-circle-o text-success"></span>
                                <span class="sidebar-title"><?php echo $row_gCVPS['alias']; ?></span>
                            </a>
                        </li>
                    <?php
                }
            }
        }
    ?>

</ul>
<!-- End: Sidebar Menu -->

<ul class="nav sidebar-menu NAC_SB_ID" style="margin-top: -15px;"> 
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

  <?php 
    $StyleHidden = "visibility: hidden;";
    
    if ($CN->db_connect){
        // Credentials Local Machine
        if ($CN->getCountCredentialsLocalMachine() > 0){

            $CLMUser = $CN->getCredentialsLocalMachine()['username'];
            $CLMPass = $CN->getCredentialsLocalMachine()['password'];

            $ConnectSSH = new ConnectSSH("127.0.0.1", $CLMUser, $CLMPass);

            if ($ConnectSSH->CN)
                $StyleHidden = "visibility: visible;";

            $CPUPercentaje      = $ConnectSSH->PercentageCPU();
            $MemoryPercentaje   = $ConnectSSH->PercentageMemory();

        }
    }

?>
    <li class="sidebar-label pt25 pb10 SB_Medida_Label" style="<?php echo @$StyleHidden; ?>">
      Rendimiento del servidor
    </li>

    <li class="sidebar-stat SB_Medida_CPU" style="<?php echo @$StyleHidden; ?>" title="Uso de CPU">
        <a href="#" class="fs11">
            <span class="fa fa-adjust text-info"></span>
            <span class="sidebar-title text-muted">CPU</span>
            <span class="pull-right mr20 text-muted ShowInfoPercentageCPUPull"><?php echo @$CPUPercentaje; ?>%</span>
            <div class="progress progress-bar-xs mh20">
                <div class="progress-bar progress-bar-info ShowInfoPercentageCPUProgress" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$CPUPercentaje; ?>%">
                    <span class="sr-only"></span>
                </div>
            </div>
        </a>
    </li>

    <li class="sidebar-stat SB_Medida_RAM" style="<?php echo @$StyleHidden; ?>" title="Uso de RAM">
        <a href="#" class="fs11">
            <span class="fa fa-ticket text-warning"></span>
            <span class="sidebar-title text-muted">RAM</span>
            <span class="pull-right mr20 text-muted ShowInfoPercentageRAMPull"><?php echo @$MemoryPercentaje; ?>%</span>
            <div class="progress progress-bar-xs mh20">
                <div class="progress-bar progress-bar-warning ShowInfoPercentageRAMProgress" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$MemoryPercentaje; ?>%">
                    <span class="sr-only"></span>
                </div>
            </div>
        </a>
    </li>
</ul>

<!-- Start: Sidebar Collapse Button -->
<div class="sidebar-toggle-mini">
  <a href="#">
    <span class="fa fa-sign-out"></span>
  </a>
</div>
<!-- End: Sidebar Collapse Button -->