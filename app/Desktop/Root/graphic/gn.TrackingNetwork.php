<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    @$_SESSION['call'] = "off";

    include (PF_CONNECT_SERVER);
    include (PD_DESKTOP_ROOT_PHP."/gn.ssh.class.php");

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $R = $CN->getAllHost();
?>

<!-- <hr>
<div id="datetimepicker_test">
    <input type="text" class="form-control" style="max-width: 250px;">
</div> -->

<!-- <hr/> -->
<!-- Required .creating-admin-panels wrapper-->
<div class="creating-admin-panels">

    <!-- Create Row -->
    <div class="row">

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-12 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel" id="p1">
                <div class="panel-heading">
                    <span class="panel-icon"><i class="fa fa-desktop"></i></span>
                    <span class="panel-title">Mapa de Red (Autodescubrir dispositivos)</span>
                    

                    <div class="container_options_controls" style="position: absolute; top: 0; right: 100px;">
                        <button type="button" id="btn_tracking_b1" class="btn btn-dark btn_tracking_device" disabled="disabled">Configurar</button>
                        <button type="button" id="btn_tracking_b2" class="btn btn-dark btn_tracking_device" disabled="disabled">Consola</button>
                        <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Procesos</button>
                        <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Servicios</button>
                        <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Historial</button>
                        <button type="button" id="btn_tracking_b3" class="btn btn-dark btn_tracking_device" disabled="disabled">Propiedades</button>

                        <button type="button" class="btn btn-primary ladda-button progress-button" data-style="expand-right">
                            <span class="ladda-label">Tracking Network</span>
                        </button>
                    </div>

                    <!-- <input type="button" onclick="javascript: StartTracking();" class="btn_tracking btn btn-warning waves-effect" value="Sondear" /> -->
                </div>
                <div class="panel-body">
                

                    <label style="display: none; position: absolute; right: 50px;" id="retardo_temporal">...</label>

                    <div class="here_write">
                        <?php
                            if (@$R->num_rows > 0){
                                include (PD_DESKTOP_ROOT_PHP."/vis/images.php");
                            }
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Column -->

    </div>
    <!-- End Row -->

</div>
<!-- End .admin-panels Wrapper -->

<script type="text/javascript" src="<?php echo PDS_DESKTOP_ROOT_JS; ?>/gn.TrackingNetwork.js"></script>