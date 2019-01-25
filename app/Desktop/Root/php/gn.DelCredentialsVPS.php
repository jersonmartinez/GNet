<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $ip_host = $_POST['ip_host'];
    
    if ($CN->deleteCredentialsVPS($ip_host)){
        ?>
            <table class="table" id="tb_listVPS">
                <tr>
                    <td><b>Alias</b></td>
                    <td><b>Dirección IP</b></td>
                    <td><b>Nombre de usuario</b></td>
                    <td><b>Acción</b></td>
                </tr>

                <?php
                    $listVPS = $CN->getCredentialsVPS();
                    if ($listVPS->num_rows > 0){
                        while ($row_listVPS = $listVPS->fetch_array(MYSQLI_ASSOC)){
                            ?>
                                <tr>
                                    <td><?php echo $row_listVPS['alias']; ?></td>
                                    <td><?php echo $row_listVPS['ip_host']; ?></td>
                                    <td><?php echo $row_listVPS['username']; ?></td>
                                    <td> <button type="button" ip_host="<?php echo $row_listVPS['ip_host']; ?>" onclick="javascript: delete_listVPS(this);" class="btn btn-default btn-danger">Eliminar</button> </td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        <?php
    } else {
        echo "Fail";
    }
?>