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
                                    <p style="margin: -10px 0 0 27%; font-size: 16px;"><?php echo $Restore['net_next']; ?></p>
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