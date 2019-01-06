<?php
    #Importar constantes.
    @session_start();
    include (@$_SESSION['getConsts']); 

    include (PF_CONNECT_SERVER);
    include (PF_SSH);
    include (PD_DESKTOP_ROOT_PHP_CLASS."/gn.class.ping.php");
    
    $CD = new CheckDevice();

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

    // $R = $CN->getAllHost();
    $R = $CN->getHostWithOutInterfaces();
    $IPNet = $CN->getIPNet();
?>

<!-- Ordenar espacios (dispositivos en la filosofia del proyecto) -->
<script src="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/mixitup/jquery.mixitup.min.js"></script>

<style>
    /* ============================================= */
    /* Managament devices secundary                  */
    /* ============================================= */

    div.mixings-get-devices-secundary .mix-container-secundary {
        min-height: 300px;
        padding: 2% 2% 0;
        text-align: justify;
        -webkit-backface-visibility: hidden;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5 {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-6 {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-7 {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-8 {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:hover, .mix.category-6:hover {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:active, .mix.category-6:active > p {
        font-weight: bold;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:hover, .mix.category-5:hover {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:active, .mix.category-5:active > p {
        font-weight: bold;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:hover, .mix.category-7:hover {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:active, .mix.category-7:active > p {
        font-weight: bold;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:hover, .mix.category-8:hover {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5:active, .mix.category-8:active > p {
        font-weight: bold;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix.category-5, .mix.category-6, .mix.category-7, .mix.category-8 {
        height: 150px;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix, .mix-container-secundary .gap-secundary {
        display: inline-block;
        width: 49%;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix {
        background: #f4f4f4;
        border: 1px solid #DDD;
        border-top-width: 1px;
        border-top-style: solid;
        border-top-color: rgb(221, 221, 221);
        margin-bottom: 2%;
        display: none;
    }

    div.mixings-get-devices-secundary .mix-container-secundary .mix, .mix-container-secundary .gap-secundary {
        width: 23.5%;
    }
</style>

<div class="mixings-get-devices-secundary" data-example-id="contextual-panels-secundary">
    <!-- <hr class="alt short"> -->
    <div id="mix-items-secundary" class="mix-container-secundary box-wrap boxes blue">

        <section class="box-wrap boxes blue">
        <?php
            if (@$R->num_rows > 0){
                $R_Count = 1;

                while ($SwitchIPNet = @$IPNet->fetch_array(MYSQLI_ASSOC)){
                    /*Switch*/

                    ?>
                        <div class="mix category-7" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block; margin-top: 3px solid #7a7ade;">
                            <img onselectstart="return false" ondragstart="return false" src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/switchs/switchicon1.png" style="margin-left: 25%; height: 130px;" />
                            
                            <?php
                                if (!empty($SwitchIPNet['alias'])){
                                    ?>
                                        <p title="<?php echo $SwitchIPNet['ip_net']; ?>" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $SwitchIPNet['ip_net']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;">
                                            <?php 
                                                echo $CN->getStringFormatSize($SwitchIPNet['alias']);
                                            ?>
                                        </p>
                                    <?php
                                } else {
                                    ?>
                                        <p title="Cambiar nombre" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $SwitchIPNet['ip_net']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;"><?php echo $SwitchIPNet['ip_net']; ?></p>
                                    <?php
                                }
                            ?>
                        </div>
                    <?php

                    ?>
                        <script type="text/javascript">
                            $('#getIdDeviceManagementSecundary<?php echo $R_Count; ?>').editable({
                                type: 'text',
                                pk: <?php echo $R_Count; ?>,
                                name: 'getIdDeviceManagementSecundary<?php echo $R_Count; ?>',
                                title: 'Editar dispositivo'
                            });

                            $('#getIdDeviceManagementSecundary<?php echo $R_Count; ?>').on('save', function(e, params) {
                                ip_addr = $('#getIdDeviceManagementSecundary<?php echo $R_Count; ?>').attr("ip_addr");
                                FunctionOnChange(ip_addr, params);
                                
                            });
                        </script>
                    <?php

                    $R_Count++;
                }

                while ($Restore = @$R->fetch_array(MYSQLI_ASSOC)) {
                    if ((bool)$Restore['router']){
                        /*Router*/
                        $IDOrderHost = implode("", explode(".", $Restore['ip_host']));
                        ?>
                            <div class="mix category-6 host-secundary<?php echo $IDOrderHost; ?>" oncontextmenu="javascript: PruebaPingConnect(this);" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                <img onselectstart="return false" ondragstart="return false" src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/routers/router4.png" style="margin-left: 25%; height: 130px;" />
                                
                                <?php
                                    if (!empty($Restore['alias'])){
                                        ?>
                                            <p title="<?php echo $Restore['ip_host']; ?>" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $Restore['ip_host']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;">
                                                <?php 
                                                    echo $CN->getStringFormatSize($Restore['alias']);
                                                ?>
                                            </p>
                                        <?php
                                    } else {
                                        ?>
                                            <p title="Cambiar nombre" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $Restore['ip_host']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;"><?php echo $Restore['ip_host']; ?></p>
                                        <?php
                                    }
                                ?>
                            </div>
                        <?php
                    } else {
                        $getMyIPServer = $CN->getMyIPServer();
                        $IDOrderHost = implode("", explode(".", $Restore['ip_host']));

                        if ($getMyIPServer == $Restore['ip_host']){
                            ?>
                                <div class="mix category-8 host_secundary<?php echo $IDOrderHost; ?>" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                    <img src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/servers/server1.png" style="margin-left: 16%; height: 130px;" />
                                    
                                    <?php
                                        if (!empty($Restore['alias'])){
                                            ?>
                                                <p title="<?php echo $Restore['ip_host']; ?>" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $Restore['ip_host']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;">
                                                    
                                                    <?php 
                                                        echo $CN->getStringFormatSize($Restore['alias']);
                                                    ?>

                                                </p>
                                            <?php
                                        } else {
                                            ?>
                                                <p title="Cambiar nombre" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $Restore['ip_host']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;"><?php echo $Restore['ip_host']; ?></p>
                                            <?php
                                        }
                                    ?>
                                </div>
                            <?php
                        } else {
                            ?>
                                <div class="mix category-5 host_secundary<?php echo $IDOrderHost; ?>" data-myorder="<?php echo $R_Count; ?>" style="display: inline-block;">
                                   <img onselectstart="return false" ondragstart="return false" src="<?php echo PDS_DESKTOP_ROOT ?>/src/vis/img/refresh-cl/news/computers/laptop1.png" style="margin-left: 25%; height: 130px;" />
                                    
                                    <?php
                                        if (!empty($Restore['alias'])){
                                            ?>
                                                <p title="<?php echo $Restore['ip_host']; ?>" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $Restore['ip_host']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;" class="xedit-virtual_machine">
                                                
                                                <?php 
                                                    echo $CN->getStringFormatSize($Restore['alias']); 
                                                ?>
                                                
                                                </p>
                                            <?php
                                        } else {
                                            ?>
                                                <p title="Cambiar nombre" id="getIdDeviceManagementSecundary<?php echo $R_Count; ?>" ip_addr="<?php echo $Restore['ip_host']; ?>" style="margin-top: -10px; text-align: center; font-size: 16px;" class="xedit-virtual_machine"><?php echo $Restore['ip_host']; ?></p>
                                            <?php
                                        }
                                    ?>
                                </div>
                            <?php
                        }
                    }

                    ?>
                        <script type="text/javascript">
                            $('#getIdDeviceManagementSecundary<?php echo $R_Count; ?>').editable({
                                type: 'text',
                                pk: <?php echo $R_Count; ?>,
                                name: 'getIdDeviceManagementSecundary<?php echo $R_Count; ?>',
                                title: 'Editar dispositivo'
                            });

                            $('#getIdDeviceManagementSecundary<?php echo $R_Count; ?>').on('save', function(e, params) {
                                ip_addr = $('#getIdDeviceManagementSecundary<?php echo $R_Count; ?>').attr("ip_addr");
                                FunctionOnChange(ip_addr, params);
                                
                            });
                        </script>
                    <?php

                    $R_Count++;
                }
            }
        ?>
        </section>

        <div class="gap-secundary"></div>
        <div class="gap-secundary"></div>
    </div>
</div>

<script type="text/javascript">
    $('#mix-items-secundary').mixItUp();

    // multiselect - contextual 
    // $('#multiselect-contextual').multiselect({
    //   buttonClass: 'multiselect dropdown-toggle btn btn-primary'
    // });

    $(".li_OrderDesc-secundary").click(function(){
        $(".btn_Order_Desc-secundary").click();
        $(".btn_Order_value").text("Descendente");
    });

    $(".li_OrderAsc-secundary").click(function(){
        $(".btn_Order_Asc-secundary").click();
        $(".btn_Order_value-secundary").text("Ascendente");
    });
</script>