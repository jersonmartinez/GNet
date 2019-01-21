<?php
    @session_start();

    include ($_SESSION['getConsts']);
    include (PF_CONNECT_SERVER);
    include (PF_SSH);

    $CN = new ConnectSSH();
    $CN->ConnectDB($H, $U, $P, $D, $X);

    $Logs   = $CN->getLogs();
    $All    = $CN->getNumLogs();
    $Debug  = $CN->getTotalDebug();
    $Info   = $CN->getTotalInfo();
    $Notice = $CN->getTotalNotice();
    $Warn   = $CN->getTotalWarning();
    $Err    = $CN->getTotalError();
    $Crit   = $CN->getTotalCritical();
    $Alert  = $CN->getTotalAlert();
    $Emer   = $CN->getTotalEmer();

    $Hosts  = $CN->getTotalHosts();
?>

<div class="panel" id="spy3">
    <div class="panel-body pn">
        <!-- <table class="table footable" data-page-navigation=".pagination" data-page-size="8"> -->
        <table class="table" data-paging="true">
            <thead class="headLogs">
                <tr>
                    <th><span class="fa fa-desktop"></span> Host</th>
                    <th><span class="fa fa-envelope"></span> Mensaje</th>
                    <th><span class="fa fa-foursquare"></span> Recurso</th>
                    <th><span class="fa fa-bell"></span> Tipo</th>
                    <th><span class="fa fa-clock-o"></span> Fecha/Hora</th>
                    <th><span class="fa fa-tags"></span> Etiqueta</th>
                </tr>
            </thead>
            <tbody class="tbodyLogs">
                <?php
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
                                $Priority = "Aviso";
                            } elseif ($A['Priority'] == 6) {
                                $Priority = "Informacion";
                            } elseif ($A['Priority'] == 7) {
                                $Priority = "Depuracion";
                            }

                            if ($A['Facility'] == 0) {
                                $Facility = "Kernel";
                            } elseif ($A['Facility'] == 1) {
                                $Facility = "Usuario";
                            } elseif ($A['Facility'] == 2) {
                                $Facility = "Correo";
                            } elseif ($A['Facility'] == 3) {
                                $Facility = "Sistema";
                            } elseif ($A['Facility'] == 4) {
                                $Facility = "Seguridad";
                            } elseif ($A['Facility'] == 5) {
                                $Facility = "Syslogd";
                            } elseif ($A['Facility'] == 6) {
                                $Facility = "Impresion";
                            } elseif ($A['Facility'] == 7) {
                                $Facility = "Red";
                            } elseif ($A['Facility'] == 8) {
                                $Facility = "UUCP";
                            } elseif ($A['Facility'] == 9) {
                                $Facility = "Reloj";
                            } elseif ($A['Facility'] == 10) {
                                $Facility = "Seguridad";
                            } elseif ($A['Facility'] == 11) {
                                $Facility = "FTP";
                            } elseif ($A['Facility'] == 12) {
                                $Facility = "NTP";
                            } elseif ($A['Facility'] == 13) {
                                $Facility = "Registro";
                            } elseif ($A['Facility'] == 14) {
                                $Facility = "Registro";
                            } elseif ($A['Facility'] == 15) {
                                $Facility = "Reloj";
                            } elseif ($A['Facility'] == 16) {
                                $Facility = "Local 1";
                            } elseif ($A['Facility'] == 17) {
                                $Facility = "Local 2";
                            } elseif ($A['Facility'] == 18) {
                                $Facility = "Local 3";
                            } elseif ($A['Facility'] == 19) {
                                $Facility = "Local 4";
                            } elseif ($A['Facility'] == 20) {
                                $Facility = "Local 5";
                            } elseif ($A['Facility'] == 21) {
                                $Facility = "Local 6";
                            } elseif ($A['Facility'] == 22) {
                                $Facility = "Local 7";
                            } elseif ($A['Facility'] == 23) {
                                $Facility = "Local 8";
                            }
                        ?>
                    <tr id="<?php echo $Priority ;?>">
                        <th><?php echo $A['FromHost'] ;?></th>
                        <th><span class="tdMessage" title="<?php echo $A['Message'] ;?>"><?php echo substr($A['Message'], 0, 60) ;?></span></th>
                        <th><?php echo $Facility ;?></th>
                        <th>
                            <?php 
                                if ($Priority == "Informacion") {
                                    echo "Información";
                                } elseif ($Priority == "Depuracion") {
                                    echo "Depuración";
                                } elseif ($Priority == "Critico") {
                                    echo "Crítico";
                                }                             
                            ?>     
                        </th>
                        <th><?php echo $A['ReceivedAt'] ;?></th>
                        <th><?php echo $A['SysLogTag'] ;?></th>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
            <!-- <tfoot class="footer-menu">
            <tr>
                <td colspan="5">
                <nav class="text-right">
                    <ul class="pagination hide-if-no-paging"></ul>
                </nav>
                </td>
            </tr>
            </tfoot> -->
            <tfoot>
                <tr class="footable-paging">
                    <td colspan="7">
                        <div class="footable-pagination-wrapper">
                            <ul class="pagination"></ul>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="col-xs-6">
            <div id="container_char_logs" style="height: 400px"></div>
        </div>
        <div class="col-xs-6">
            <?php 
                while ($H = $Hosts->fetch_array(MYSQLI_ASSOC)) {
                    $nhost = $H['Hosts'];                    
            ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="panel panel-tile text-center br-a br-grey">
                        <div class="panel-body">
                            <h1 class="fs30 mt5 mbn"><?php echo $CN->LogsByHost($nhost); ?></h1>
                            <h4 class="text-system">EVENTOS</h4>
                        </div>
                        <div class="panel-footer br-t p12">
                            <span class="fs11">
                                <i class="fa fa-desktop pr5"></i> 
                                <b style="font-size: 2em;"><?php echo $nhost; ?></b>
                            </span>
                        </div>
                    </div>
                </div>
                <div></div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.table').footable();
        $('.tdMessage').tooltip();
    });

    Highcharts.chart('container_char_logs', {
        credits: false,
        colors: ['rgb(59, 175, 218)', 'rgb(52, 152, 219)', 'rgb(112, 202, 99)', 'rgb(255, 152, 0)', 'rgb(223, 86, 64)', 'rgb(244, 67, 54)', 'rgb(150, 122, 220)', 'rgb(233, 30, 99)'],
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Gráfico de eventos (Logs)'
        },
        subtitle: {
            text: 'Eventos registrados: <?php echo $All; ?>'
        },
        tooltip: {
            pointFormat: '{} <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                depth: 35,
                center: ['30%', '50%'],
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        /*legend: {
            x: 90,
            floating: true,
            verticalAlign: "middle",
            layout: "horizontal",
            itemMarginTop: 10
        },*/
        series: [{
            type: 'pie',
            name: 'Logs',
            data: [
                ['Debug', <?php echo $Debug ;?>],
                ['Info', <?php echo $Info ;?>],
                {
                    name: 'Aviso',
                    y: <?php echo $Notice ;?>,
                    sliced: true,
                    selected: true
                },
                ['Warning', <?php echo $Warn ;?>],
                ['Error', <?php echo $Err ;?>],
                ['Crítico', <?php echo $Crit ;?>],
                ['Alerta', <?php echo $Alert ;?>],
                ['Emerg', <?php echo $Emer ;?>],
            ]
        }]
    });
</script>