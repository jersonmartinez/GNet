<?php
    #Importar constantes.
    @session_start();
    include (@$_SESSION['getConsts']); 

    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $Otro = $CN->ConnectDB($H, $U, $P, $D, $X);

    // Credentials Local Machine
    $CLMUser = $CN->getCredentialsLocalMachine()['username'];
    $CLMPass = $CN->getCredentialsLocalMachine()['password'];

    $host = isset($_POST['host']) ? $_POST['host'] : "127.0.0.1";

    $ConnectSSH = new ConnectSSH($host, $CLMUser, $CLMPass);

    if (!$ConnectSSH->CN){
        echo "Fail";
        exit();
    }

    $Procesos = explode(",", $ConnectSSH->getProcState());

?>

        <div class="col-md-12 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p3">
                <div class="panel-heading">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="panel-title">Procesos iniciados</span>
                </div>
                <div class="panel-body">
                    <table class="display" id="tb_process">
                    <style type="text/css">
                        #tb_proc {
                            width: 100% !important;
                        }
                        .display: {
                            width: 100% !important;
                        }
                    </style>
                        <thead>
                            <tr>
                                <th>PID</th>
                                <th>Nombre</th>
                                <th>CPU</th>
                                <th>Memoria</th>
                                <th>Tiempo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for ($i=0; $i < count($Procesos); $i++) { 
                                    $Firts = explode(" ", $Procesos[$i]);

                                    for ($j=0; $j < count($Firts); $j++) { 
                                        ?>
                                            <tr>
                                                <td><?php echo $Firts[$j]; ?></td>
                                                <td><?php echo $Firts[$j+4]; $j++; ?></td>
                                                <td><?php echo "$Firts[$j]%"; $j++; ?></td>
                                                <td><?php echo $ConnectSSH->ConvertMemoryProc($Firts[$j]); $j++;#echo "$Firts[$j] kb"; $j++; ?></td>
                                                <td><?php echo $Firts[$j]; $j++; ?></td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
        <!-- End Column -->

<script>
    $('#tb_process').DataTable( {
        scrollY:        '200px',
        scrollCollapse: true,
        paging:         false
    });
</script>