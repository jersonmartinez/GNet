<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    @$_SESSION['call'] = "off";

    include (PF_CONNECT_SERVER);
    include (PF_SSH);


    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $R = $CN->getAllHost();

    ?>
        <label style="display: none; position: absolute; right: 50px;" id="retardo_temporal">...</label>
        
    <?php

    if (!$R->num_rows > 0){
        ?>
            <div class="here_write"><?php echo "Fail"; ?>
            </div>
        <?php
        
    } else {
        ?>
            <div class="here_write">
                <?php 
                    include (PD_DESKTOP_ROOT_PHP."/vis/images.php"); 
                ?>
            </div>
        <?php
        
    }
?>