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

    $host = isset($_POST['host']) ? $_POST['host'] : "127.0.0.1";

    $ConnectSSH = new ConnectSSH($host, $CLMUser, $CLMPass);

    if (!$ConnectSSH->CN){
        echo "Fail";
        exit();
    }

    $NetAddress = explode(",", $ConnectSSH->getNetAddress());
    $TableRoute = explode(",", $ConnectSSH->getTableRoute());
    $PortsListen    = explode(",", $ConnectSSH->getPortsListen());
    $StatisticsIP   = explode(" ", explode("=", $ConnectSSH->getStatisticsNetwork())[0]);
    $StatisticsTCP  = explode(" ", explode("=", $ConnectSSH->getStatisticsNetwork())[1]);
    $StatisticsUDP  = explode(" ", explode("=", $ConnectSSH->getStatisticsNetwork())[2]);
?>

<div role="tabpanel" class="tab-pane" id="network_modal">
    <!-- Required .admin-panels wrapper-->
    <div class="admin-panels">
        <!-- Create Row -->
        <div class="row">
            <!-- Create Column with required .admin-grid class -->
            <div class="col-md-6 admin-grid">
                <!-- Create Panel with required unique ID -->
                <div class="panel panel-dark" id="p1">
                    <div class="panel-heading">
                        <span class="fa fa-sitemap"></span>
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
                        <span class="fa fa-th"></span>
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
                        <span class="fa fa-unlink"></span>
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
                        <span class="fa fa-bar-chart-o"></span>
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
                        <span class="fa fa-bar-chart-o"></span>
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
                        <span class="fa fa-bar-chart-o"></span>
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