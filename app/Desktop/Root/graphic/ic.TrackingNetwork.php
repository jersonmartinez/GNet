<?php
	#Importar constantes.
	include ($_SERVER['DOCUMENT_ROOT']."/".explode("/", $_SERVER['REQUEST_URI'])[1]."/app/core/ic.const.php");

    @session_start();
    @$_SESSION['call'] = "off";

    include (PD_DESKTOP_ROOT_PHP."/ssh.class.php");
    $CN = new ConnectSSH();

    if ($CN){
    	echo "Conectado...";
    } else {
    	echo "No hay conexion";
    }

    $R = $CN->getAllHost();
?>


<h1>Tracking Network</h1>
<input type="button" onclick="draw();" value="Dibujar" />

<section class="content">
        <div class="container-fluid">

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <button type="button" onclick="javascript: StartTracking();" class="btn_tracking btn btn-warning waves-effect">
                                    <i class="material-icons">perm_scan_wifi</i>
                                    <span>SONDEAR INFRAESTRUCTURA DE RED</span>
                            </button>

                            <label style="display: none; position: absolute; right: 50px;" id="retardo_temporal">Retardo de tiempo: 12.45 seg.</label>

                            <div class="preloader pl-size-xs network_map_loader" style="top: 8px; left: 10px; display: none;">
                                <div class="spinner-layer pl-red-grey">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>

                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="./index.php">Dispositivos</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body" style="padding: 0;">
                            
                            
                            <div class="here_write">
                                <?php
                                    if (@$R->num_rows > 0){
                                        include (PD_DESKTOP_ROOT_PHP."/images.php");
                                    }
                                ?>
                            </div>

                            <br>

                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </section>