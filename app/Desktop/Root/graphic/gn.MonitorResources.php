<?php
	#Importar constantes.
	@session_start();
	include (@$_SESSION['getConsts']); 

	include (PF_CONNECT_SERVER);
    include (PD_DESKTOP_ROOT_PHP."/gn.ssh.class.php");
    // include (PD_DESKTOP_ROOT_PHP."/gn.fr.ssh.network.php");

   	$ConnectSSH = new ConnectSSH("127.0.0.1", "network", "123");

   	// echo "Uso del disco: ".$ConnectSSH->getDiskUsage()."<br/>";
   	// echo "Uso de la memoria".$ConnectSSH->getMemoryState();

   	$Variable = explode(",", $ConnectSSH->getMemoryState());

   	
   	$SwapState = explode(",", $ConnectSSH->getSwapState());

   	$CpuState = explode(",", $ConnectSSH->getCpuState());
   	foreach ($CpuState as $value) {
   		echo $value."";
   	}

   	$DiskUsage = explode(",", $ConnectSSH->getDiskState());

   	$Procesos = explode(",", $ConnectSSH->getProcState());

   	$NetAddress = explode(",", $ConnectSSH->getNetAddress());

   	$PortsListen = explode(",", $ConnectSSH->getPortsListen());
   	foreach ($PortsListen as $value) {
   		echo $value."";
   	}

   	$BatteryState = explode(",", $ConnectSSH->getBatteryState());

   	$InfoOS = explode(",", $ConnectSSH->getInfoOS());

   	$UsersConnected = explode(",", $ConnectSSH->getUsersConnected());
   	foreach ($UsersConnected as $value) {
   		echo $value."";
   	}
?>

<div class="row">
	<div class="col-xs-6">
 		<div id="highchart-pie_memory" style="width: 100%; height: 250px;"></div>
 		<div id="container_disk" style="height: 400px; margin-top: 20px;"></div>
	</div>

	<div class="col-xs-6">
		<div id="highchart-pie_swap" style="width: 100%; height: 250px;"></div>
		<div style="width: 600px; height: 400px; margin: 0 auto;">
		<div id="container-speed" style="width: 300px; height: 200px; float: left;"></div>
		<div id="container-rpm" style="width: 300px; height: 200px; float: left">
			<div class="panel panel-dark">
				<label><?php echo $CpuState[0]; ?></label><br>
				<label>Porcentaje en uso: <?php echo $CpuState[4]; ?></label><br>
				<label>Velocidad: <?php echo $CpuState[1]; ?></label><br>
				<label>Procesos: <?php echo $CpuState[5]; ?></label>
			</div>
		</div>
		</div>
	</div>
</div>

<!-- Required .admin-panels wrapper-->
<div class="admin-panels">
    <!-- Create Row -->
    <div class="row">
        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">
            <!-- Create Panel with required unique ID -->
            <div class="panel" id="p1">
                <div class="panel-heading">
                    <span class="panel-title">Interfaces de red y direcciones IP asignadas</span>
                </div>
                <div class="panel-body">
                	<table class="table">
		                <tr>
							<td>Interfaz de red</td>
							<td>Dirección IP</td>	
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
            <div class="panel" id="p3">
                <div class="panel-heading">
                    <span class="panel-title">Puertos Abiertos</span>
                </div>
                <div class="panel-body">
                	<table class="table">
		                <tr>
							<td>Puerto</td>
							<td>Protocolo</td>
							<td>Tipo</td>	
							<td>Proceso</td>
						</tr>
						<?php
							for ($i=0; $i < count($PortsListen); $i++) { 
								$Firts = explode(" ", $PortsListen[$i]);

								for ($j=0; $j < count($Firts); $j++) { 
								?>
									<tr>
										<td><?php echo $Firts[$j]; ?></td>
										<td><?php echo $Firts[$j+1]; $j++; ?></td>
										<td><?php echo $Firts[$j+2]; $j++; ?></td>
										<td><?php echo $Firts[$j+3]; $j++; ?></td>
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
            <div class="panel" id="p1">
                <div class="panel-heading">
                    <span class="panel-title">Detalles del Sistema Operativo</span>
                </div>
                <div class="panel-body">
                	<p>Nombre: <?php echo $InfoOS[0]; ?></p>
                	<p>Versión: <?php echo $InfoOS[1]; ?></p>
                	<p>Código: <?php echo $InfoOS[2]; ?></p>
                	<p>Arquitéctura: <?php echo $InfoOS[3]; ?></p>
                	<p>Kernel: <?php echo $InfoOS[4]; ?></p>
                </div>
            </div>
        </div>
        <!-- End Column -->

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel" id="p3">
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
            <div class="panel" id="p1">
                <div class="panel-heading">
                    <span class="panel-title">Usuarios con sesión iniciada</span>
                </div>
                <div class="panel-body">
                	<table class="table">
		                <tr>
							<td>Número de usuarios</td>
							<td>Nombre de usuario</td>
						</tr>
						<tr>
							<td><?php echo $UsersConnected[0]; ?></td>
						<?php
							for ($i=1; $i < count($UsersConnected); $i++) { 
								?>
									<td><?php echo $UsersConnected[$i]; ?></td>
								<?php
							}
						?>
							
						</tr>
				    </table>
                </div>
            </div>
        </div>
        <!-- End Column -->

        <!-- Create Column with required .admin-grid class -->
        <div class="col-md-6 admin-grid">

            <!-- Create Panel with required unique ID -->
            <div class="panel" id="p3">
                <div class="panel-heading">
                    <span class="panel-title">Procesos iniciados</span>
                </div>
                <div class="panel-body">
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
	                ['Espacio usado', <?php echo $Variable[0]; ?>],
	                ['Espacio libre', <?php echo $Variable[1]; ?>],
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
	                ['Espacio usado', <?php echo $SwapState[1]; ?>],
	                ['Espacio libre', <?php echo $SwapState[2]; ?>],
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
        text: 'Estado del disco'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Tamaño en GB',
        data: [
            ['Espacio usado', <?php echo $DiskUsage[0]; ?>],
            ['Espacio disponible', <?php echo $DiskUsage[1]; ?>]
        ]
    }]
});


// Uso de la CPU
var gaugeOptions = {

    chart: {
        type: 'solidgauge'
    },

    title: 'Uso de la CPU',

    pane: {
        center: ['50%', '85%'],
        size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    tooltip: {
        enabled: true
    },

    // the value axis
    yAxis: {
        stops: [
            [0.1, '#55BF3B'], // green
            [0.5, '#DDDF0D'], // yellow
            [0.9, '#DF5353'] // red
        ],
        lineWidth: 0,
        minorTickInterval: null,
        tickAmount: 2,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

// The speed gauge
var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: 'Uso'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [<?php echo $CpuState[4]; ?>],
        dataLabels: {
            format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                   '<span style="font-size:12px;color:silver">%</span></div>'
        },
        tooltip: {
            valueSuffix: ' %'
        }
    }]

}));


// Init AdminPanels on columns inside the ".admin-panels" container
$('.admin-panels').adminpanel({
    grid: '.admin-grid',
    draggable: true,
    // On AdminPanel Init complete we fade in the content. Optional
    onFinish: function() {
        $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');
    },
    // We trigger a window resize after a panel has been modified. This helps catch
    // any plugins which may need to update after the panel was changed. Optional
    onSave: function() {
        $(window).trigger('resize');
    }
});

$(document).ready(function() {
    $('#tb_procesos').DataTable( {
        "scrollY":        "200px",
        "scrollCollapse": true,
        "paging":         false
    } );
} );

</script>