<?php
    #Importar constantes.
    @session_start();
    include (@$_SESSION['getConsts']); 
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $Otro = $CN->ConnectDB($H, $U, $P, $D, $X);

    // Credentials Local Machine
    $CLMUser = $CN->getCredentialsLocalMachine()['username'];
    $CLMPass = $CN->getCredentialsLocalMachine()['password'];

    $ConnectSSH = new ConnectSSH("127.0.0.1", $CLMUser, $CLMPass);

    if (!$ConnectSSH->CN){
        echo "Fail";
        exit();
    }

    /*foreach ($CpuState as $value) {
        echo $value."";
    }*/

    $MemoryState    = explode(",", $ConnectSSH->getMemoryState());
    $SwapState      = explode(",", $ConnectSSH->getSwapState());
    $CpuState       = explode(",", $ConnectSSH->getCpuState());
    $DiskUsage      = explode(",", $ConnectSSH->getDiskState());
    $Procesos       = explode(",", $ConnectSSH->getProcState());
    $NetAddress     = explode(",", $ConnectSSH->getNetAddress());
    $TableRoute     = explode(",", $ConnectSSH->getTableRoute());
    $PortsListen    = explode(",", $ConnectSSH->getPortsListen());
    $StatisticsIP   = explode(" ", explode("=", $ConnectSSH->getStatisticsNetwork())[0]);
    $StatisticsTCP  = explode(" ", explode("=", $ConnectSSH->getStatisticsNetwork())[1]);
    $StatisticsUDP  = explode(" ", explode("=", $ConnectSSH->getStatisticsNetwork())[2]);
    $BatteryState   = explode(",", $ConnectSSH->getBatteryState());
    $InfoOS         = explode(",", $ConnectSSH->getInfoOS());
    $UsersConnected = explode(",", $ConnectSSH->getUsersConnected());

    $NetworkServices = explode(",", $ConnectSSH->getNetworkServices());
    $VirtualHost     = explode(",", explode("=", $ConnectSSH->getWebServer())[0]);
    $WebServer       = explode(",", explode("=", $ConnectSSH->getWebServer())[1]);

    // Método para convertir a GB
    function ConvertUnit($InputValue) {
        if ($InputValue >= 1024) {
            $InputValue = ($InputValue / 1024);
            if(is_float($InputValue)) {
                $ValueFloat = number_format($InputValue, 2, '.', '');
                return $ValueFloat." GB";
            } else {
                return $InputValue." GB";
            }
        } else {
            $InputValue = $InputValue;
            return $InputValue." MB";
        }
    }

    // Método para calcular el uso de la CPU
    function OperacionCPU($UsoUser, $UsoSystem, $Operacion) {
        $UsoTotal = $UsoUser + $UsoSystem;
        if ($Operacion == "uso") {
            return $UsoTotal;   
        } else if ($Operacion == "disponible") {
            $Disponible = 100 - $UsoTotal;
            return $Disponible;
        }
    }

    // Conversión: Uso de memoria de los procesos
    function ConvertMemoryProc($MemoryProc) {
        if ($MemoryProc >= 1024) {
            $MemoryProc = ($MemoryProc / 1024);
            if(is_float($MemoryProc)) {
                $ValFloat = number_format($MemoryProc, 2, '.', '');
                return $ValFloat." MB";   
            } else {
                return $MemoryProc." MB";
            }
        } else {
            return $MemoryProc." KB";
        }
    }

?>


<div role="tab-block">
    <!-- Tab Content Panes -->
    <div class="tab-content"> 
        <div role="tabpanel" class="tab-pane active" id="graficos">
            <div class="row mix category-1">
                <div class="col-xs-6">
                    <div id="highchart-pie_memory" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 250px;"></div>
                    <div id="container_disk" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 300px; margin-top: 20px;"></div>
                </div>

                <div class="col-xs-6">
                    <div id="highchart-pie_swap" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 250px;"></div>
                    <div id="container_cpu" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 300px; margin-top: 20px"></div>
                </div>
            </div>
            <br>
        </div>

        <div role="tabpanel" class="tab-pane" id="system">
            <!-- Required .admin-panels wrapper-->
            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">
                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p1">
                            <div class="panel-heading">
                                <span class="fa fa-info-circle"></span>
                                <span class="panel-title">Información básica del equipo</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px;">
                            	<table class="table">
            						<tr>
            							<td>Nombre de equipo:</td>
            							<td><?php echo $InfoOS[0]; ?></td>
            						</tr>
            						<tr>
            							<td>Sistema Operativo:</td>
            							<td><?php echo $InfoOS[1]; ?></td>
            						</tr>
            						<tr>
            							<td>Versión del sistema:</td>
            							<td><?php echo $InfoOS[2]; ?></td>
            						</tr>
            						<tr>
            							<td>Tipo de sistema (Arquitectura):</td>
            							<td><?php echo $InfoOS[3]; ?></td>
            						</tr>
            						<tr>
            							<td>Versión de Kernel:</td>
            							<td><?php echo $InfoOS[4]; ?></td>
            						</tr>
            				    </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <i class="fa fa-battery-full" aria-hidden="true"></i>
                                <span class="panel-title">Estado de la batería</span>
                            </div>
                            <div class="panel-body">
                                <div id="battery" data-percent="<?php echo $BatteryState[0]; ?>"></div>
                                <br>
                            </div>
                            <div class="panel-heading">
                                <div class="charging_txt glow" id="charging_text"></div>
                                <!-- <span class="panel-title">Estado de la batería</span> -->
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->

            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">
                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p1">
                            <div class="panel-heading">
                                <span class="fa fa-users"></span>
                                <span class="panel-title">Usuarios con sesión iniciada</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px;">
                                <table class="table">
                                    <tr>
                                        <th>Nombre de usuario</th>
                                        <th>Login</th>
                                    </tr>
                                    <?php
                                        for ($i=0; $i < count($UsersConnected); $i++) { 
                                            $Firts = explode(" ", $UsersConnected[$i]);

                                            for ($j=0; $j < count($Firts); $j++) { 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $Firts[$j]; ?></td>
                                                        <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->
                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->
        </div>

        <div role="tabpanel" class="tab-pane" id="process">
            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-12 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="panel-title">Procesos iniciados</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                                <table class="table">
                                    <tr>
                                        <th>PID</th>
                                        <th>Nombre</th>
                                        <th>CPU</th>
                                        <th>Memoria</th>
                                        <th>Tiempo</th>
                                    </tr>
                                    <?php
                                        for ($i=0; $i < count($Procesos); $i++) { 
                                            $Firts = explode(" ", $Procesos[$i]);

                                            for ($j=0; $j < count($Firts); $j++) { 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $Firts[$j]; ?></td>
                                                        <td><?php echo $Firts[$j+4]; $j++; ?></td>
                                                        <td><?php echo "$Firts[$j]%"; $j++; ?></td>
                                                        <td><?php echo ConvertMemoryProc($Firts[$j]); $j++;#echo "$Firts[$j] kb"; $j++; ?></td>
                                                        <td><?php echo $Firts[$j]; $j++; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->
        </div>

        <div role="tabpanel" class="tab-pane" id="network">
            <!-- Required .admin-panels wrapper-->
            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">
                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p1">
                            <div class="panel-heading">
                                <span class="fa fa-dashboard"></span>
                                <span class="panel-title">Interfaces de red y direcciones asignadas</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px;">
                                <table class="table">
                                    <tr>
                                        <th>Interfaz de red</th>
                                        <th>Dirección IP</th>   
                                        <th>Dirección Ethernet</th> 
                                    </tr>
                                    <?php
                                        for ($i=0; $i < count($NetAddress); $i++) { 
                                            $Firts = explode("|", $NetAddress[$i]);

                                            for ($j=0; $j < count($Firts); $j++) { 
                                            ?>
                                                <tr>
                                                    <td><?php echo $Firts[$j]; ?></td>
                                                    <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                    <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">
                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p1">
                            <div class="panel-heading">
                                <span class="fa fa-dashboard"></span>
                                <span class="panel-title">Tabla de enrutamiento</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px;">
                                <table class="table">
                                    <tr>
                                        <th>Red destino</th>
                                        <th>Interfaz</th>
                                        <th>Pasarela</th>
                                    </tr>
                                    <?php
                                        for ($i=0; $i < count($TableRoute); $i++) { 
                                            $Firts = explode("|", $TableRoute[$i]);

                                            for ($j=0; $j < count($Firts); $j++) { 
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php 
                                                            if ($Firts[$j] == "default") {
                                                                $Firts[$j] = "0.0.0.0/0";
                                                            }
                                                            echo $Firts[$j]; 
                                                        ?>     
                                                    </td>
                                                    <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                    <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->

            <!-- Required .admin-panels wrapper-->
            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <span class="fa fa-dashboard"></span>
                                <span class="panel-title">Puertos Abiertos</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                                <table class="table">
                                    <tr style="background-color: #3b3f4f; color: #fff;">
                                        <th>Puerto</th>
                                        <th>Protocolo</th>
                                        <th>Tipo</th>   
                                        <th>Proceso</th>
                                    </tr>
                                    <style type="text/css">
                                        .bg_row {
                                            color: #000;
                                            background-color: #3c8dbc;
                                        }

                                        .nada {
                                            background-color: #9fc7de;
                                            color: #000;
                                        }
                                    </style>
                                    <?php
                                        for ($i=0; $i < count($PortsListen); $i++) { 
                                            $Firts = explode(" ", $PortsListen[$i]);

                                            for ($j=0; $j < count($Firts); $j++) { 
                                                ?>
                                                    <?php 
                                                       if ($Firts[$j] == "21" || $Firts[$j] == "22" || $Firts[$j] == "25" || $Firts[$j] == "53" || $Firts[$j] == "68" || $Firts[$j] == "80" || $Firts[$j] == "161" || $Firts[$j] == "162" || $Firts[$j] == "3306") {
                                                            $bg_row = "bg_row";
                                                        } else {
                                                            $bg_row = "nada";
                                                        }
                                                    ?>   
                                                    <tr class="<?php echo $bg_row; ?>">
                                                        <td><?php echo $Firts[$j]; ?></td>
                                                        <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                        <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                        <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    ?> 
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <span class="fa fa-dashboard"></span>
                                <span class="panel-title">Estadísticas de red | protocolo IP</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                                <table class="table">
                                    <tr>
                                        <td>Total de paquetes recibidos:</td>
                                        <td><?php echo $StatisticsIP[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Con direcciones incorrectas:</td>
                                        <td><?php echo $StatisticsIP[1]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes reenviados:</td>
                                        <td><?php echo $StatisticsIP[2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes entrantes desechados:</td>
                                        <td><?php echo $StatisticsIP[3]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes entrantes servidos:</td>
                                        <td><?php echo $StatisticsIP[4]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Peticiones enviadas:</td>
                                        <td><?php echo $StatisticsIP[5]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes salientes descartados:</td>
                                        <td><?php echo $StatisticsIP[6]; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->

            <!-- Required .admin-panels wrapper-->
            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <span class="fa fa-dashboard"></span>
                                <span class="panel-title">Estadísticas de red | protocolo TCP</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                                <table class="table">
                                    <tr>
                                        <td>Conexiones activas abiertas:</td>
                                        <td><?php echo $StatisticsTCP[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Conexiones pasivas abiertas:</td>
                                        <td><?php echo $StatisticsTCP[1]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Intentos de conexión fallidos:</td>
                                        <td><?php echo $StatisticsTCP[2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Reanudaciones de conexiones recibidas:</td>
                                        <td><?php echo $StatisticsTCP[3]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Conexiones establecidas:</td>
                                        <td><?php echo $StatisticsTCP[4]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Segmentos recibidos:</td>
                                        <td><?php echo $StatisticsTCP[5]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Segmentos enviados:</td>
                                        <td><?php echo $StatisticsTCP[6]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Segmentos retransmitidos:</td>
                                        <td><?php echo $StatisticsTCP[7]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Segmentos incorrectos recibidos:</td>
                                        <td><?php echo $StatisticsTCP[8]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Reinicios enviados:</td>
                                        <td><?php echo $StatisticsTCP[9]; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <span class="fa fa-dashboard"></span>
                                <span class="panel-title">Estadísticas de red | protocolo UDP</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                                <table class="table">
                                    <tr>
                                        <td>Total de paquetes recibidos:</td>
                                        <td><?php echo $StatisticsUDP[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes recibidos de puertos desconocidos:</td>
                                        <td><?php echo $StatisticsUDP[1]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes recibidos con errores:</td>
                                        <td><?php echo $StatisticsUDP[2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Paquetes enviados:</td>
                                        <td><?php echo $StatisticsUDP[3]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Errores recibidos en buffer:</td>
                                        <td><?php echo $StatisticsUDP[4]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Errores enviados en buffer:</td>
                                        <td><?php echo $StatisticsUDP[5]; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->
        </div>
        
        <div role="tabpanel" class="tab-pane" id="server">
            <!-- Required .admin-panels wrapper-->
            <div class="admin-panels">
                <!-- Create Row -->
                <div class="row">
                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">
                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p1">
                            <div class="panel-heading">
                                <span class="fa fa-server"></span>
                                <span class="panel-title">Servidor Web | Sitios virtuales</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px;">
                                <table class="table">
                                    <tr>
                                        <th>Sitio virtual</th>
                                        <th>Nombre de dominio</th> 
                                        <th>Estado</th>  
                                    </tr>
                                    <?php
                                        for ($i=0; $i < count($VirtualHost); $i++) { 
                                            $Firts = explode("|", $VirtualHost[$i]);

                                            for ($j=0; $j < count($Firts); $j++) { 
                                            ?>
                                                <tr>
                                                    <td><?php echo $Firts[$j]; ?></td>
                                                    <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                                    <td>
                                                        <?php
                                                            $SiteStatus = $Firts[$j+1];
                                                            if ($SiteStatus == "Habilitado") {
                                                                echo '<span style="color: green">Habilitado</span>';
                                                            } else if ($SiteStatus == "No habilitado") {
                                                                echo '<span style="color: red">No habilitado</span>';
                                                            }
                                                            $j++;
                                                            #echo $Firts[$j+1]; $j++;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                    <!-- Create Column with required .admin-grid class -->
                    <div class="col-md-6 admin-grid">

                        <!-- Create Panel with required unique ID -->
                        <div class="panel panel-dark" id="p3">
                            <div class="panel-heading">
                                <span class="fa fa-server"></span>
                                <span class="panel-title">Monitorización del servidor web</span>
                            </div>
                            <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                                <table class="table">
                                    <tr>
                                        <td>Número de accesos:</td>
                                        <td><?php echo $WebServer[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Conexiones establecidas al puerto 80:</td>
                                        <td><?php echo $WebServer[1]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Conexiones establecidas al puerto 443:</td>
                                        <td><?php echo $WebServer[2]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Conexiones en espera de cierre puerto 80:</td>
                                        <td><?php echo $WebServer[3]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Conexiones en espera de cierre puerto 443:</td>
                                        <td><?php echo $WebServer[4]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fecha y hora de inicio:</td>
                                        <td><?php echo "$WebServer[5] $WebServer[6]"; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Número de veces que ha sido reiniciado:</td>
                                        <td><?php echo $WebServer[7]; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Column -->

                </div>
                <!-- End Row -->

            </div>
            <!-- End .admin-panels Wrapper -->            
        </div>
    </div>

</div>    

<script type="text/javascript">
    var HighChartPie = $('#highchart-pie_memory');
    if (HighChartPie.length) {

        HighChartPie.highcharts({
            credits: false, // Disable HighCharts logo
            colors: ['#f6bb42', '#3bafda'], // Set Colors
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: "Estado de la memoria"
            },
            subtitle: {
                text: 'Memoria Total: <?php echo ConvertUnit($MemoryState[0]); ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    center: ['30%', '50%'],
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            legend: {
                x: 90,
                floating: true,
                verticalAlign: "middle",
                layout: "vertical",
                itemMarginTop: 10
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje de memoria',
                data: [
                    ['En uso: <?php echo ConvertUnit($MemoryState[1]); ?>', <?php echo $MemoryState[1]; ?>],
                    ['Disponible: <?php echo ConvertUnit($MemoryState[2]); ?>', <?php echo $MemoryState[2]; ?>],
                ]
            }]
        });
    }

    // Memoria Swap
    // Pie Chart
    var HighChartPie_MemoriaDos = $('#highchart-pie_swap');
    if (HighChartPie_MemoriaDos.length) {

        HighChartPie_MemoriaDos.highcharts({
            credits: false, // Disable HighCharts logo
            colors: ['#f6bb42', '#4a89dc'], // Set Colors
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false

            },
            title: {
                text: "Área de intercambio | Swap"
            },
            subtitle: {
                text: 'Espacio total: <?php echo ConvertUnit($SwapState[0]); ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    center: ['30%', '50%'],
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            legend: {
                x: 90,
                floating: true,
                verticalAlign: "middle",
                layout: "vertical",
                itemMarginTop: 10
            },
            series: [{
                type: 'pie',
                name: 'Memoria Swap',
                data: [

                    ['En uso: <?php echo ConvertUnit($SwapState[1]); ?>', <?php echo $SwapState[1]; ?>],
                    ['Disponible: <?php echo ConvertUnit($SwapState[2]); ?>', <?php echo $SwapState[2]; ?>],
                ]
            }]
        });
    }

    // Espacio en disco
    Highcharts.chart('container_disk', {
        credits: false,
        // colors: ['#1E90FF', '#97C3E6'],
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Uso del disco duro'
        },
        subtitle: {
            text: 'Capacidad total: <?php echo "$DiskUsage[0] GB"; ?>'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45, 
                center: ['30%', '50%'],
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }

        },
        legend: {
            x: 90,
            floating: true,
            verticalAlign: "middle",
            layout: "vertical",
            itemMarginTop: 10
        },
        series: [{
            name: 'Tamaño en GB',
            type: 'pie',
            data: [
                ['En uso: <?php echo "$DiskUsage[1] GB"; ?>', <?php echo $DiskUsage[1]; ?>],
                ['Disponible: <?php echo "$DiskUsage[2] GB"; ?>', <?php echo $DiskUsage[2]; ?>]
            ]
        }]
    });

    // Estado de la CPU
    Highcharts.chart('container_cpu', {
        credits: false,
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Uso de la CPU'
        },
        subtitle: {
            text: '<?php echo "$CpuState[0]"; ?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                depth: 35,
                center: ['30%', '50%'],
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        legend: {
            x: 90,
            floating: true,
            verticalAlign: "middle",
            layout: "vertical",
            itemMarginTop: 10
        },
        series: [{
            type: 'pie',
            name: 'Porcentaje de CPU',
            data: [
                ['En uso: <?php echo OperacionCPU($CpuState[1], $CpuState[2], "uso"); ?> %', <?php echo OperacionCPU($CpuState[1], $CpuState[2], "uso"); ?>],
                {
                    name: 'Disponible: <?php echo OperacionCPU($CpuState[1], $CpuState[2], "disponible"); ?> %',
                    y: <?php echo OperacionCPU($CpuState[1], $CpuState[2], "disponible"); ?>,
                    sliced: true,
                    selected: true
                }
            ]
        }]
    });

    // Estado de la batería
    // ----------------------
    var stDiv = $('#battery')[0];
    var dataPercent = stDiv.getAttribute('data-percent');
    var width = dataPercent - 2;
    stDiv.insertAdjacentHTML('afterend', '<style>#battery::after{width:' + width + '%;}</style>');


    if (dataPercent <= 10) {
      stDiv.setAttribute('red','');
    } else if (dataPercent > 10 && dataPercent <= 30) {
        stDiv.setAttribute('orange','');
    } else if (dataPercent > 30 && dataPercent <= 50) {
        stDiv.setAttribute('yellow','');
    } else if (dataPercent > 50 && dataPercent <= 70) {
        stDiv.setAttribute('yellowgreen','');
    } else if (dataPercent > 70 && dataPercent <= 90) {
        stDiv.setAttribute('green','');
    }

    var dataStatus = "<?php echo $BatteryState[1] ?>";
    
    if (dataStatus == "charging" && dataPercent < 100) {
        $(charging_text).html("Cargando...");   
    } else if (dataStatus == "discharging" && dataPercent < 100) {
        $(charging_text).html('Queda ' + dataPercent + '%');
    } else if (dataStatus == "fully-charged") {
        $(charging_text).html("Carga completa");
    }

    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    /*$(function () {
        $('#myTab a:last').tab('show')
    })*/

    $('#mix-items').mixItUp();

    /*$(document).ready(function() {
        $('#tb_procesos').DataTable( {
            "scrollY":        "200px",
            "scrollCollapse": true,
            "paging":         false
        });
    });*/

</script>