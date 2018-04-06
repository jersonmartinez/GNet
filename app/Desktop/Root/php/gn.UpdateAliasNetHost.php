<?php
    @session_start();

    #Importar constantes.
    include (@$_SESSION['getConsts']);

    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    #Recibir datos
    $ip_addr = $_POST['ip_addr'];
    $alias   = $_POST['alias'];
    
    #Traer todos las coincidencias del supuesto enrutador
    $getHosts = $CN->getAllHost();

    if ($getHosts->num_rows > 0){
        while ($listHosts = $getHosts->fetch_array(MYSQLI_ASSOC)){
            if ($listHosts['ip_host'] == $ip_addr){
                if ((bool)$listHosts['router']){

                    #Cambiar todos los que son enrutadores
                    if ($CN->updateHostRouterAlias($listHosts['ip_net'], $alias))
                        echo "Ok";
                    
                    // echo $listHosts['ip_net']." | ".$listHosts['ip_host']." | ".$listHosts['router'];
                } else {
                    if ($CN->updateHostAlias($ip_addr, $alias))
                        echo "Ok";
                }

            } else if ($listHosts['net_next'] == $ip_test){
                if ($CN->updateNetworkAlias($ip_addr, $alias))
                    echo "Ok";
            }
        }
    }
?>