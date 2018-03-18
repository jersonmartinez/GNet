<?php
	#Importar constantes.
	@session_start();
	include (@$_SESSION['getConsts']); 

	include (PF_CONNECT_SERVER);
    include (PD_DESKTOP_ROOT_PHP."/gn.ssh.class.php");
    // include (PD_DESKTOP_ROOT_PHP."/gn.fr.ssh.network.php");

   	$ConnectSSH = new ConnectSSH("127.0.0.1", "root", "123");

    /*foreach ($CpuState as $value) {
        echo $value."";
    }*/

   	$MemoryState    = explode(",", $ConnectSSH->getMemoryState());
    $SwapState      = explode(",", $ConnectSSH->getSwapState());
   	$CpuState       = explode(",", $ConnectSSH->getCpuState());
   	$DiskUsage      = explode(",", $ConnectSSH->getDiskState());
    $Procesos       = explode(",", $ConnectSSH->getProcState());
    $NetAddress     = explode(",", $ConnectSSH->getNetAddress());
    $PortsListen    = explode(",", $ConnectSSH->getPortsListen());
    $BatteryState   = explode(",", $ConnectSSH->getBatteryState());
    $InfoOS         = explode(",", $ConnectSSH->getInfoOS());
    $UsersConnected = explode(",", $ConnectSSH->getUsersConnected());

    foreach ($MemoryState as $value) {
        if ($value >= 1024) {
            $value = ($value / 1024);
        } else {
            $value = $value;
        }
        echo "$value\n";
    }
?>

<div class="row">
	<div class="col-xs-6">
 		<div id="highchart-pie_memory" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 250px;"></div>
 		<div id="container_disk" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 300px; margin-top: 20px;"></div>
	</div>

	<div class="col-xs-6">
		<div id="highchart-pie_swap" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 250px;"></div>
        <div id="container_cpu" style="box-shadow: 0 0 2px 0 #000; width: 100%; height: 300px; margin-top: 20px"></div>
		<!-- <div style="width: 600px; height: 400px; margin: 0 auto">
            <div id="container-speed_cpu" style="width: 300px; height: 200px; float: left"></div>
    		<div id="container-rpm" style="width: 300px; height: 200px; float: left">
				<p>Algo</p>
				<p>Porcentaje en uso: 45</p>
				<p>Velocidad: 33</p>
				<p>Procesos: 34</p>
    		</div>
        </div> -->
	</div>
</div>
<br>
<!-- Required .admin-panels wrapper-->
<div class="admin-panels">
    <!-- Create Row -->
    <div class="row">
        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">
            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p1">
                <div class="panel-heading">
                    <span class="panel-title">Información básica del equipo</span>
                </div>
                <div class="panel-body" style="max-height: 300px;">
                	<table class="table">
						<tr>
							<td>Nombre de equipo:</td>
							<td><?php echo $InfoOS[0]; ?></td>
						</tr>
						<tr>
							<td>Sistema Operativo:</td>
							<td><?php echo $InfoOS[1]; ?></td>
						</tr>
						<tr>
							<td>Versión del sistema:</td>
							<td><?php echo $InfoOS[2]; ?></td>
						</tr>
						<tr>
							<td>Tipo de sistema (Arquitectura):</td>
							<td><?php echo $InfoOS[3]; ?></td>
						</tr>
						<tr>
							<td>Versión de Kernel:</td>
							<td><?php echo $InfoOS[4]; ?></td>
						</tr>
				    </table>
                </div>
            </div>
        </div>
        <!-- End Column -->

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p3">
                <div class="panel-heading">
                    <span class="panel-title">Estado de la batería</span>
                </div>
                <div class="panel-body">
                	<p>Porcentaje de carga: <?php echo $BatteryState[0]; ?></p>
                	<p>Estado: <?php echo $BatteryState[1]; ?></p>
                </div>
            </div>
        </div>
        <!-- End Column -->

    </div>
    <!-- End Row -->

</div>
<!-- End .admin-panels Wrapper -->

<!-- Required .admin-panels wrapper-->
<div class="admin-panels">
    <!-- Create Row -->
    <div class="row">
        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">
            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p1">
                <div class="panel-heading">
                    <span class="panel-title">Interfaces de red y direcciones IP asignadas</span>
                </div>
                <div class="panel-body" style="max-height: 300px;">
                	<table class="table">
		                <tr>
							<th>Interfaz de red</th>
							<th>Dirección IP</th>	
						</tr>
						<?php
							$i = 0;
							foreach ($NetAddress as $value) {

								?>
									<tr>
										<td><?php echo $NetAddress[$i++]; ?></td>
										<td><?php echo $NetAddress[$i++]; ?></td>
									</tr>
								<?php
							}
						?>
				    </table>
                </div>
            </div>
        </div>
        <!-- End Column -->

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p3">
                <div class="panel-heading">
                    <span class="panel-title">Puertos Abiertos</span>
                </div>
                <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                	<table class="table">
		                <tr>
							<th>Puerto</th>
							<th>Protocolo</th>
							<th>Tipo</th>	
							<th>Proceso</th>
						</tr>
						<?php
							for ($i=0; $i < count($PortsListen); $i++) { 
								$Firts = explode(" ", $PortsListen[$i]);

								for ($j=0; $j < count($Firts); $j++) { 
								?>
									<tr>
										<td><?php echo $Firts[$j]; ?></td>
										<td><?php echo $Firts[$j+1]; $j++; ?></td>
										<td><?php echo $Firts[$j+1]; $j++; ?></td>
										<td><?php echo $Firts[$j+1]; $j++; ?></td>
									</tr>
								<?php
								}
							}
						?>
				    </table>
                </div>
            </div>
        </div>
        <!-- End Column -->

    </div>
    <!-- End Row -->

</div>
<!-- End .admin-panels Wrapper -->


<!-- Required .admin-panels wrapper-->
<div class="admin-panels">
    <!-- Create Row -->
    <div class="row">
        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">
            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p1">
                <div class="panel-heading">
                    <span class="panel-title">Usuarios con sesión iniciada</span>
                </div>
                <div class="panel-body" style="max-height: 300px;">
                	<table class="table">
                        <tr>
                            <th>Nombre de usuario</th>
                            <th>Login</th>
                        </tr>
                        <?php
                            for ($i=0; $i < count($UsersConnected); $i++) { 
                                $Firts = explode(" ", $UsersConnected[$i]);

                                for ($j=0; $j < count($Firts); $j++) { 
                                    ?>
                                        <tr>
                                            <td><?php echo $Firts[$j]; ?></td>
                                            <td><?php echo $Firts[$j+1]; $j++; ?></td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Column -->

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel panel-dark" id="p3">
                <div class="panel-heading">
                    <span class="panel-title">Procesos iniciados</span>
                </div>
                <div class="panel-body" style="max-height: 300px; overflow: scroll;">
                	<table id="tb_procesos" class="display" cellspacing="0" width="100%">
			    		<thead>
				            <tr>
				                <th>PID</th>
				                <th>Nombre del proceso</th>
				            </tr>
				        </thead>
						<?php
							for ($i=0; $i < count($Procesos); $i++) { 
								$Firts = explode(" ", $Procesos[$i]);

								for ($j=0; $j < count($Firts); $j++) { 
									?>
										<tbody>
											<tr>
												<td><?php echo $Firts[$j]; ?></td>
												<td><?php echo $Firts[$j+1]; $j++; ?></td>
											</tr>
										</tbody>
									<?php
								}
							}
						?>
			    	</table>
                </div>
            </div>
        </div>
        <!-- End Column -->

    </div>
    <!-- End Row -->

</div>
<!-- End .admin-panels Wrapper -->

<script type="text/javascript">

	// Memoria Ram
 	// Pie Chart
	var HighChartPie = $('#highchart-pie_memory');
	if (HighChartPie.length) {

	    HighChartPie.highcharts({
	        credits: false, // Disable HighCharts logo
	        colors: ['#f6bb42', '#3bafda'], // Set Colors
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false
	        },
	        title: {
	            text: "Estado de la memoria"
	        },
            subtitle: {
                text: 'Memoria Total: <?php echo "$MemoryState[0] MB"; ?>'
            },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                center: ['30%', '50%'],
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: false
	                },
	                showInLegend: true
	            }
	        },
	        legend: {
	            x: 90,
	            floating: true,
	            verticalAlign: "middle",
	            layout: "vertical",
	            itemMarginTop: 10
	        },
	        series: [{
	            type: 'pie',
	            name: 'Porcentaje de memoria',
	            data: [
	                ['En uso: <?php echo "$MemoryState[1] MB"; ?>', <?php echo $MemoryState[1]; ?>],
	                ['Disponible: <?php echo "$MemoryState[2] MB"; ?>', <?php echo $MemoryState[2]; ?>],
	            ]
	        }]
	    });
	}

	// Memoria Swap
	// Pie Chart
	var HighChartPie_MemoriaDos = $('#highchart-pie_swap');
	if (HighChartPie_MemoriaDos.length) {

	    HighChartPie_MemoriaDos.highcharts({
	        credits: false, // Disable HighCharts logo
	        colors: ['#f6bb42', '#4a89dc'], // Set Colors
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false

	        },
	        title: {
	            text: "Área de intercambio | Swap"
	        },
            subtitle: {
                text: 'Espacio total: <?php echo "$SwapState[0] MB"; ?>'
            },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                center: ['30%', '50%'],
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: false
	                },
	                showInLegend: true
	            }
	        },
	        legend: {
	            x: 90,
	            floating: true,
	            verticalAlign: "middle",
	            layout: "vertical",
	            itemMarginTop: 10
	        },
	        series: [{
	            type: 'pie',
	            name: 'Memoria Swap',
	            data: [

	                ['En uso: <?php echo "$SwapState[1] MB"; ?>', <?php echo $SwapState[1]; ?>],
	                ['Disponible: <?php echo "$SwapState[2] MB"; ?>', <?php echo $SwapState[2]; ?>],
	            ]
	        }]
	    });
	}
	
	// Espacio en disco
	Highcharts.chart('container_disk', {
	credits: false,
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Uso del disco duro'
    },
    subtitle: {
        text: 'Capacidad total: <?php echo "$DiskUsage[0] GB"; ?>'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45, 
            center: ['30%', '50%'],
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }

    },
    legend: {
        x: 90,
        floating: true,
        verticalAlign: "middle",
        layout: "vertical",
        itemMarginTop: 10
    },
    series: [{
        name: 'Tamaño en GB',
        type: 'pie',
        data: [
            ['Espacio usado <?php echo "$DiskUsage[1] GB"; ?>', <?php echo $DiskUsage[1]; ?>],
            ['Espacio disponible: <?php echo "$DiskUsage[2] GB"; ?>', <?php echo $DiskUsage[2]; ?>]
        ]
    }]
});



Highcharts.chart('container_cpu', {
    credits: false,
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Uso de la CPU'
    },
    subtitle: {
        text: '<?php echo "$CpuState[0]"; ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
    legend: {
        x: 90,
        floating: true,
        verticalAlign: "middle",
        layout: "vertical",
        itemMarginTop: 10
    },
    series: [{
        type: 'pie',
        name: 'Porcentaje de CPU',
        data: [
            ['En uso: <?php echo "$CpuState[4]%"; ?>', <?php echo $CpuState[4];; ?>],
            {
                name: 'Disponible: <?php echo "$CpuState[5]%"; ?>',
                y: <?php echo $CpuState[5]; ?>,
                sliced: true,
                selected: true
            }
        ]
    }]
});

$(document).ready(function() {
    $('#tb_procesos').DataTable( {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    });
});

</script>