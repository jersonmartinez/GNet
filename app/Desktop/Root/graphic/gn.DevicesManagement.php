<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    include (PF_CONNECT_SERVER);
    include (PD_DESKTOP_ROOT_PHP."/gn.ssh.class.php");

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $R = $CN->getAllHost();
?>

<link rel="stylesheet" type="text/css" href="<?php echo PDS_DESKTOP_ROOT; ?>/css/vis/style.css">

<!-- Required .creating-admin-panels wrapper-->
<div class="creating-admin-panels">

    <!-- Create Row -->
    <div class="row">

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-12 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel" id="p100">
                <div class="panel-heading">
                    <span class="panel-icon"><i class="fa fa-desktop"></i></span>
                    <span class="panel-title">Gestión de dispositivos</span>
                    
                    <div class="container_options_controls" style="position: absolute; top: 0; right: 10px;">
                        <button style="padding: 9px;" class="filter btn btn-primary btn-sm active" data-filter="all">Todo</button>
                        <button style="padding: 9px;" class="filter btn btn-primary btn-sm" data-filter=".category-1">Dispositivos finales</button>
                        <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-2">Enrutadores</button>
                        <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-3">Conmutadores</button>
                        <button style="padding: 9px;" class="filter btn btn-info btn-sm" data-filter=".category-4">Servidores</button>

                        <!-- Orden -->
                        <button class="sort btn btn-default btn-sm btn_Order_Asc" data-sort="myorder:asc" style="display: none;">Asc</button>
                        <button class="sort btn btn-default btn-sm btn_Order_Desc" data-sort="myorder:desc" style="display: none;">Desc</button>

                        <!-- Split button -->
                        <div class="btn-group" style="display: inline-block;">
                            <button type="button" class="btn btn-danger btn_Order_value">Orden</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li class="li_OrderAsc"><a href="#">Ascendente</a></li>
                                <li class="li_OrderDesc"><a href="#">Descendente</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="panel-body">

                    <div class="mixings-get-devices" data-example-id="contextual-panels">
                        

                        <!-- <hr class="alt short"> -->

                        <div id="mix-items" class="mix-container">

                            <?php
                                if (@$R->num_rows > 0){
                                    $R_Count = 1;
                                    while ($Restore = @$R->fetch_array(MYSQLI_ASSOC)) {
                                        if ((bool)$Restore['router']){

                                            if ($Restore['net_next'] != "-"){
                                                /*Switch*/
                                                ?>
                                                    <div class="mix category-3" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                                        <img src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/switchs/switchicon1.png" style="margin-left: 25%; height: 130px;" />
                                                        <p style="margin: -10px 0 0 30%; font-size: 16px;"><?php echo $Restore['ip_host']; ?></p>
                                                    </div>
                                                <?php
                                            } else {
                                                /*Router*/
                                                ?>
                                                    <div class="mix category-2" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                                        <img src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/routers/router4.png" style="margin-left: 25%; height: 130px;" />
                                                        <p style="margin: -10px 0 0 30%; font-size: 16px;"><?php echo $Restore['ip_host']; ?></p>
                                                    </div>
                                                <?php
                                            }
                                        } else {
                                            $getMyIPServer = $CN->getMyIPServer();

                                            if ($getMyIPServer == $Restore['ip_host']){
                                                ?>
                                                    <div class="mix category-4" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                                        <img src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/servers/server1.png" style="margin-left: 16%; height: 130px;" />
                                                        <p style="margin: -10px 0 0 30%; font-size: 16px;"><?php echo $Restore['ip_host']; ?></p>
                                                    </div>
                                                <?php
                                            } else {
                                                ?>
                                                    <div class="mix category-1" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                                        <img src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/computers/laptop1.png" style="margin-left: 25%; height: 130px;" />
                                                        <p style="margin: -10px 0 0 30%; font-size: 16px;"><?php echo $Restore['ip_host']; ?></p>
                                                    </div>
                                                <?php
                                            }
                                        }
                                        $R_Count++;
                                    }
                                }
                            ?>
                            
                            <div class="gap"></div>
                            <div class="gap"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Column -->

    </div>
    <!-- End Row -->

</div>
<!-- End .admin-panels Wrapper -->

<script type="text/javascript">
    $('#mix-items').mixItUp();

    // multiselect - contextual 
    $('#multiselect-contextual').multiselect({
      buttonClass: 'multiselect dropdown-toggle btn btn-primary'
    });

    $(".li_OrderDesc").click(function(){
        $(".btn_Order_Desc").click();
        $(".btn_Order_value").text("Descendente");
    });

    $(".li_OrderAsc").click(function(){
        $(".btn_Order_Asc").click();
        $(".btn_Order_value").text("Ascendente");
    });

</script>