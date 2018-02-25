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
                    
                    <div class="mixings-get-devices">
                        <!-- Mixitup Filters -->
                        <div class="controls mt15">
                          <label class="ml5 mr10">Filter:</label>
                          <button class="filter btn btn-primary btn-sm" data-filter="all">All</button>
                          <button class="filter btn btn-primary btn-sm" data-filter=".category-1">Category 1</button>
                          <button class="filter btn btn-primary btn-sm" data-filter=".category-2">Category 2</button>
                          
                          <label class="ml20 mr10">Sort:</label>
                          <button class="sort btn btn-info btn-sm" data-sort="myorder:asc">Asc</button>
                          <button class="sort btn btn-info btn-sm" data-sort="myorder:desc">Desc</button>
                        </div>

                        <!-- Mixitup Items -->
                        <div id="mix-items-other" class="mix-container">
                          <div class="mix category-1" data-myorder="1"></div>
                          <div class="mix category-1" data-myorder="2"></div>
                          <div class="mix category-1" data-myorder="3"></div>
                          <div class="mix category-2" data-myorder="4"></div>
                          <div class="mix category-1" data-myorder="5"></div>
                          <div class="mix category-1" data-myorder="6"></div>
                          <div class="mix category-2" data-myorder="7"></div>
                          <div class="mix category-2" data-myorder="8"></div>
                          <div class="gap"></div>
                          <div class="gap"></div>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <!-- <div id="datetimepicker_test">
                        <input type="text" class="form-control" style="max-width: 250px;">
                    </div>              
 -->
                </div>
            </div>
        </div>
        <!-- End Column -->

    </div>
    <!-- End Row -->

</div>
<!-- End .admin-panels Wrapper -->

<!-- <script type="text/javascript" src="<?php echo PDS_DESKTOP_ROOT_JS; ?>/gn.TrackingNetwork.js"></script> -->