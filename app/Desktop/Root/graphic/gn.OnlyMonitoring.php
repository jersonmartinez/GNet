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

    $host = "127.0.0.1";

    $ConnectSSH = new ConnectSSH($host, $CLMUser, $CLMPass);

    if (!$ConnectSSH->CN){
        echo "Fail";
        exit();
    }

    $Data = $ConnectSSH->OnlyMonitoring($_POST['host']);
                    
    $count = 0;
    $ArrayInitiating    = array();
    $ArrayPorts         = array();
    $ArrayCompleted     = array();
    $ArrayCPE           = array();
    $ArrayIncreasing    = array();
    $RawPackets         = "";
    $MacAddress         = "";
    $TimeScanned        = "";
    $HostUpOrDown       = "";
    $OSLinux            = "";
    $OSWindows          = "";
    $OSAndroid          = "";

    foreach ($Data as $value){                        
        // echo "Line #", ++$count, ": ", $value, "<br/>"; 
        
        if (preg_match("/\bInitiating\b/i", $value))
            array_push($ArrayInitiating, $value);
        
        if (preg_match("/\bCompleted\b/i", $value))
            array_push($ArrayCompleted, $value);

        if (preg_match("/\bIncreasing\b/i", $value))
            array_push($ArrayIncreasing, $value);

        if (preg_match("/\bMAC\b/i", $value))
            $MacAddress = $value;
        
        if (preg_match("/\bCPE\b/i", $value))
            array_push($ArrayCPE, $value);
        
        if (preg_match("/[0-9]{1,5}\//", $value))
            array_push($ArrayPorts, $value);

        if (preg_match("/\bRaw packets\b/i", $value))
            $RawPackets = $value;

        if (preg_match("/\bdone\b/i", $value))
            $TimeScanned = $value;

        if (preg_match("/\bdown\b/i", $value))
            $HostUpOrDown = $value;

        if (preg_match("/\blinux\b/i", $value))
            $OSLinux = $value;

        if (preg_match("/\bwindows\b/i", $value))
            $OSWindows = $value;

        if (preg_match("/\bandroid\b/i", $value))
            $OSAndroid = $value;
    }
?>

<div class="row">
    <!-- Create Column with required .admin-grid class -->
    <div class="col-md-4 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Dirección MAC</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (!empty($MacAddress)){
                            ?>
                                <tr><td><?php echo $MacAddress; ?></td></tr>
                            <?php
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Sistema Operativo</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (!empty($OSLinux)){
                            ?>
                                <tr><td>Linux</td></tr>
                            <?php
                        } else if (!empty($OSWindows)){
                            ?>
                                <tr><td>Windows</td></tr>
                            <?php
                        } else if (!empty($OSAndroid)){
                            ?>
                                <tr><td>Android</td></tr>
                            <?php
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Estado del dispositivo</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php

                        if (empty($HostUpOrDown)){
                            ?>
                                <tr><td>Encendido</td></tr>
                            <?php
                        } else {
                            ?>
                                <tr><td>Apagado</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- End Column -->
</div>

<!-- Create Row -->
<div class="row">
    <!-- Create Column with required .admin-grid class -->
    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Inicialización</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (count($ArrayInitiating) > 0){
                            foreach ($ArrayInitiating as $AInit){
                                ?>
                                    <tr><td><?php echo $AInit; ?></td></tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Completado</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (count($ArrayCompleted) > 0){
                            foreach ($ArrayCompleted as $AComp){
                                ?>
                                    <tr><td><?php echo $AComp; ?></td></tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- End Column -->
</div>
<!-- End Row -->

<!-- Create Row -->
<div class="row">
    <!-- Create Column with required .admin-grid class -->
    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Puertos abiertos</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (count($ArrayPorts) > 0){
                            foreach ($ArrayPorts as $APort){
                                ?>
                                    <tr><td><?php echo $APort; ?></td></tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Enumeración de Plataforma Común (CPE)</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (count($ArrayCPE) > 0){
                            foreach ($ArrayCPE as $ACPE){
                                ?>
                                    <tr><td><?php echo $ACPE; ?></td></tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- End Column -->
</div>
<!-- End Row -->

<!-- Create Row -->
<div class="row">
    <!-- Create Column with required .admin-grid class -->
    <div class="col-md-12 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Aumento del retraso de envío</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (count($ArrayIncreasing) > 0){
                            foreach ($ArrayIncreasing as $AIncre){
                                ?>
                                    <tr><td><?php echo $AIncre; ?></td></tr>
                                <?php
                            }
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->

<!-- Create Row -->
<div class="row">
    <!-- Create Column with required .admin-grid class -->
    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Paquetes transitados</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>Paquetes enviados</th>
                        <th>Paquetes recibidos</th>
                    </tr>
                    <?php
                        if (!empty($RawPackets)){
                            $ObtainSent = explode(":", explode("|", $RawPackets)[0])[1];
                            $ObtainRcvd = explode(":", explode("|", $RawPackets)[1])[1];

                            ?>
                                <tr>
                                    <td><?php echo $ObtainSent; ?></td>
                                    <td><?php echo $ObtainRcvd; ?></td>
                                </tr>
                            <?php
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }    
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark">
            <div class="panel-heading">
                <span class="fa fa-users"></span>
                <span class="panel-title">Saltos y tiempo de escaneo</span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php
                        if (!empty($TimeScanned)){
                            ?>
                                <tr><td><?php echo $TimeScanned; ?></td></tr>
                            <?php
                        } else {
                            ?>
                                <tr><td style="text-align: center;">Información no disponible</td></tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <!-- End Column -->
</div>
<!-- End Row -->
