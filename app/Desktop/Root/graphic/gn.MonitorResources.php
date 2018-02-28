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

   	foreach ($Variable as $value) {
   		echo $value." ";
   	}

   	$SwapState = explode(",", $ConnectSSH->getSwapState());
   	foreach ($SwapState as $value) {
   		echo $value." ";
   	}

   	$CpuState = explode(",", $ConnectSSH->getCpuState());
   	foreach ($CpuState as $value) {
   		echo $value."";
   	}

   	$DiskUsage = explode(",", $ConnectSSH->getDiskState());
   	foreach ($DiskUsage as $value) {
   		echo $value."";
   	}

 ?>

<div class="row">
	<div class="col-xs-6">
 		<div id="highchart-pie_memory" style="width: 100%; height: 250px; "></div>
 		<div id="container_disk" style="height: 400px; margin-top: 20px;"></div>
	</div>

	<div class="col-xs-6">
		<div id="highchart-pie_swap" style="width: 100%; height: 250px;"></div>
	</div>
	<div id="donut-chart_cpu" style="height: 250px; width: 100%; margin-top: 20px;"></div>
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


/*// Donut Chart
var donutChartCpu = c3.generate({
    bindto: '#donut-chart_cpu',
    color: {
      pattern: Colors,
    },
    data: {
        columns: [
            ['data1', 30],
            ['data2', 120],
        ],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "Iris Petal Width"
    }
});*/

</script>