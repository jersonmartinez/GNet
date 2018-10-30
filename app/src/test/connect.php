<?php

    $cn = new mysqli("10.0.100.102", "root", "root", "gnet");

    if ($cn->connect_error){
        echo "No hay conexión";
    } else {
        echo "Todo bien conectado!";
    }

    phpinfo();