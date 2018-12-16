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

    $InfoOS         = explode(",", $ConnectSSH->getInfoOS());
    $BatteryState   = explode(",", $ConnectSSH->getBatteryState());
    $UsersConnected = explode(",", $ConnectSSH->getUsersConnected());
?>

 <!-- Create Row -->
 <div class="row">
    <!-- Create Column with required .admin-grid class -->
    <div class="col-md-6 admin-grid">
        <!-- Create Panel with required unique ID -->
        <div class="panel panel-dark" id="p_table_basic_info">
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
        <div class="panel panel-dark" id="p_battery">
            <div class="panel-heading">
                <i class="fa fa-fw fa-battery-full" aria-hidden="true"></i>
                <span class="panel-title">Estado de la batería</span>
            </div>
            <div class="panel-body">
                <div id="battery" data-percent="<?php echo $BatteryState[0]; ?>"></div>
                <br>
            </div>
            <div class="panel-heading">
                <div class="charging_txt glow" id="modal_charging_text"></div>
                <!-- <span class="panel-title">Estado de la batería</span> -->
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
        <div class="panel panel-dark" id="p_modal_session_users">
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

<script>
    // Estado de la batería
    // ----------------------
    var stDiv = $('#battery')[0];
    var dataPercent = stDiv.getAttribute('data-percent');
    var width = dataPercent - 2;
    stDiv.insertAdjacentHTML('afterend', '<style>#battery::after{width:' + width + '%;}</style>');

    var dataStatus = "<?php echo $BatteryState[1]; ?>";
    
    if (dataStatus == "charging" && dataPercent < 100) {
        $(modal_charging_text).html("Cargando...");   
    } else if (dataStatus == "discharging" && dataPercent < 100) {
        $(modal_charging_text).html('Queda ' + dataPercent + '%');
    } else if (dataStatus == "fully-charged") {
        $(modal_charging_text).html("Carga completa");
    }
</script>