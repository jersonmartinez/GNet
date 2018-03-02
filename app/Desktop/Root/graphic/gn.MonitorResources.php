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

   	$DiskUsage = explode(",", $ConnectSSH->getDiskState());

   	$NetAddress = explode(",", $ConnectSSH->getNetAddress());

   	$BatteryState = explode(",", $ConnectSSH->getBatteryState());
   	foreach ($BatteryState as $value) {
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
	</div>
	<div id="donut-chart_cpu" style="height: 250px; width: 100%; margin-top: 20px;"></div>
</div>

<table>
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

<div style="width: 600px; height: 400px; margin: 0 auto">
    <div id="container-speed_cpu" style="width: 300px; height: 200px; float: left"></div>
    <div id="container-rpm_cpu" style="width: 300px; height: 200px; float: left"></div>
</div>

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


	var gaugeOptionsCpu = {

    chart: {
        type: 'solidgauge'
    },

    title: null,

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
        enabled: false
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
var chartSpeedOne = Highcharts.chart('container-speed_cpu', Highcharts.merge(gaugeOptionsCpu, {
    yAxis: {
        min: 0,
        max: 200,
        title: {
            text: 'Speed'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [80],
        dataLabels: {
            format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                   '<span style="font-size:12px;color:silver">km/h</span></div>'
        },
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

}));

// The RPM gauge
var chartRpm = Highcharts.chart('container-rpm_cpu', Highcharts.merge(gaugeOptionsCpu, {
    yAxis: {
        min: 0,
        max: 5,
        title: {
            text: 'RPM'
        }
    },

    series: [{
        name: 'RPM',
        data: [1],
        dataLabels: {
            format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
                   '<span style="font-size:12px;color:silver">* 1000 / min</span></div>'
        },
        tooltip: {
            valueSuffix: ' revolutions/min'
        }
    }]

}));

// Bring life to the dials
setInterval(function () {
    // Speed
    var point,
        newVal,
        inc;

    if (chartSpeedOne) {
        point = chartSpeedOne.series[0].points[0];
        inc = Math.round((Math.random() - 0.5) * 100);
        newVal = point.y + inc;

        if (newVal < 0 || newVal > 200) {
            newVal = point.y - inc;
        }

        point.update(newVal);
    }

    // RPM
    if (chartRpm) {
        point = chartRpm.series[0].points[0];
        inc = Math.random() - 0.5;
        newVal = point.y + inc;

        if (newVal < 0 || newVal > 5) {
            newVal = point.y - inc;
        }

        point.update(newVal);
    }
}, 2000);

</script>