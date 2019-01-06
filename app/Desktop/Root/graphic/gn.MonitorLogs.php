<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);
?>

<div class="panel" id="spy3">
    <style>
        .head_logs {
            background-color: rgb(59, 63, 79);
            color: rgb(255, 255, 255);
        }

        #Emergencia {
            /* background-color: rgb(244, 67, 54); */
            background-color: rgb(233, 30, 99); 
            color: rgb(255, 255, 255);
        }

        #Alerta {
            background-color: rgb(150, 122, 220);
            color: rgb(255, 255, 255);
        }
        
        #Critico {
            background-color: rgb(244, 67, 54);
            /* background-color: rgb(255, 152, 0); */
            color: rgb(255, 255, 255);
        } 

        #Error {
            background-color: rgb(223, 86, 64);
            color: rgb(255, 255, 255);
        }

        #Advertencia {
            background-color: rgb(255, 152, 0);
            /* background-color: rgb(112, 202, 99); */
            /* background-color: rgb(246, 187, 66); */
            color: rgb(255, 255, 255);
        }   

        #Notificacion {
            background-color: rgb(112, 202, 99);
            /* background-color: rgb(55, 188, 155); */
            /* background-color: rgb(246, 187, 66); */
            color: rgb(255, 255, 255);
        }             

        #Informacion {
            background-color: rgb(52, 152, 219);
            color: rgb(255, 255, 255);
        }

        #Depuracion {
            background-color: rgb(59, 175, 218);
            color: rgb(255, 255, 255);
        }
    </style>
    <div class="panel-body pn">
        <table class="table footable" data-page-navigation=".pagination" data-page-size="8">
        <table class="table" data-paging="true"></table> 
            <thead class="head_logs">
            <tr>
                <th><span class="fa fa-desktop"></span> Host</th>
                <th><span class="fa fa-envelope"></span> Mensaje</th>
                <th><span class="fa fa-foursquare"></span> Recurso</th>
                <th><span class="fa fa-bell"></span> Prioridad</th>
                <th><span class="fa fa-clock-o"></span> Hora reporte</th>
                <th><span class="fa fa-tags"></span> Etiqueta</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $Logs = $CN->getLogs();
                    while ($A = $Logs->fetch_array(MYSQLI_ASSOC)) {
                
                            if ($A['Priority'] == 0) {
                                $Priority = "Emergencia";
                            } elseif ($A['Priority'] == 1) {
                                $Priority = "Alerta";
                            } elseif ($A['Priority'] == 2) {
                                $Priority = "Critico";
                            } elseif ($A['Priority'] == 3) {
                                $Priority = "Error";
                            } elseif ($A['Priority'] == 4) {
                                $Priority = "Advertencia";
                            } elseif ($A['Priority'] == 5) {
                                $Priority = "Notificacion";
                            } elseif ($A['Priority'] == 6) {
                                $Priority = "Informacion";
                            } elseif ($A['Priority'] == 7) {
                                $Priority = "Depuracion";
                            }
                        ?>
                    <tr id="<?php echo $Priority ;?>">
                        <th><?php echo $A['FromHost'] ;?></th>
                        <th><?php echo $A['Message'] ;?></th>
                        <th><?php echo $A['Facility'] ;?></th>
                        <th><?php echo $Priority ;?></th>
                        <th><?php echo $A['ReceivedAt'] ;?></th>
                        <th><?php echo $A['SysLogTag'] ;?></th>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
            <tfoot class="footer-menu">
            <tr>
                <td colspan="5">
                <nav class="text-right">
                    <ul class="pagination hide-if-no-paging"></ul>
                </nav>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
</div>

<script>
    jQuery(document).ready(function() {
        "use strict";
        // Init Theme Core    
        Core.init();
        // Init Demo JS  
        Demo.init();
        // Init FooTable Examples
        $('.footable').footable();
    });
</script>