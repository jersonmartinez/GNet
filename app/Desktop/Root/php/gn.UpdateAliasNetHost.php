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
            $ip_net_now = $CN->getIPNetFromIPHost($ip_addr)->fetch_array(MYSQLI_ASSOC)['ip_net'];
            
            if ($CN->updateNetworkNextRouterAlias($ip_net_now, $alias))
                echo "Ok";

            if ($listHosts['ip_host'] == $ip_addr){
                if ($CN->updateHostAlias($ip_addr, $alias))
                    echo "Ok";
            } else {
                if ($CN->updateNetworkAlias($ip_addr, $alias))
                    echo "Ok";
            }
        }
    }
?>