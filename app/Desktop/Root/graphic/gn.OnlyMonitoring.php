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
                <?php
                    if (count($ArrayInitiating) > 0){
                        foreach ($ArrayInitiating as $AInit){
                            echo $AInit, "<br/>";
                        }
                    }
                ?>
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
                <?php
                    if (count($ArrayCompleted) > 0){
                        foreach ($ArrayCompleted as $AComp){
                            echo $AComp, "<br/>";
                        }
                    }
                ?>
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
                <?php
                    if (count($ArrayPorts) > 0){
                        foreach ($ArrayPorts as $APort){
                            echo $APort, "<br/>";
                        }
                    }
                ?>
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
                <?php
                    if (count($ArrayCPE) > 0){
                        foreach ($ArrayCPE as $ACPE){
                            echo $ACPE, "<br/>";
                        }
                    }
                ?>
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
                <?php
                   if (count($ArrayIncreasing) > 0){
                        foreach ($ArrayIncreasing as $AIncre){
                            echo $AIncre, "<br/>";
                        }
                    }
                ?>
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
                <?php
                    if (!empty($RawPackets)){
                        $ObtainSent = explode(":", explode("|", $RawPackets)[0])[1];
                        echo "Enviado: ", $ObtainSent, "<br/>";
                        
                        $ObtainRcvd = explode(":", explode("|", $RawPackets)[1])[1];
                        echo "Recibido: ", $ObtainRcvd, "<br/>";
                    }
                ?>
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
                <?php
                    if (!empty($TimeScanned)){
                        echo $TimeScanned, "<br/>";
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- End Column -->
</div>
<!-- End Row -->

<!-- Create Row -->
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
                <?php
                     if (!empty($MacAddress)){
                        echo $MacAddress, "<br/>";
                    }
                ?>
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
                <?php
                    if (!empty($OSLinux)){
                        echo "Linux<br/>";
                    } else if (!empty($OSWindows)){
                        echo "Windows<br/>";
                    } else if (!empty($OSAndroid)){
                        echo "Android<br/>";
                    }
                ?>
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
                <?php
                    if (empty($HostUpOrDown)){
                        echo "Encendido<br/>";
                    } else {
                        echo "Apagado<br/>";
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- End Column -->
</div>
<!-- End Row -->