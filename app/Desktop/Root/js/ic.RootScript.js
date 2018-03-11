$(".AddRedactDocumentation").hide();
$(".AddDeviceManagement").hide();

$("#ConfigNetwork").click(function(){
	$(".ConfigNetwork").click();
});

$(".savechange").click(function(){
	if ($(".savechange").attr("data-dismiss") == "modal"){
		$(".savechange").text("Guardar cambios");
		$(".savechange").attr("data-dismiss", "");
		$(".savechange").attr("data-toggle", "popover");
	} else {
		AddNetwork();
	}
});

$("#DetailsNetwork").click(function(){
	$.ajax({
		url: "app/Desktop/Root/php/ic.GetNetworkData.php",
		success: function(data){
			$("#FormAppendDataDetails").html(data);
		}
	});
});

$("#HistoryNetwork").click(function(){
	$.ajax({
		url: "app/Desktop/Root/php/ic.GetNetworkHistory.php",
		success: function(data){
			$(".HereBreakHistory").html(data);
		}
	});
});

$("#LogoutRoot").click(function(){
	window.location.href="app/controller/php/ic.logout.php";
});

function AddNetwork(){
	$.ajax({
		url: "app/Desktop/Root/php/ic.AddNet.php",
		type: "post",
		data: $("#FormCreateNetwork").serialize(),
		success: function(data){
			if (data == "OK"){
				$(".savechange").text("¡Ok!...");
				$(".savechange").attr("data-dismiss", "modal");
				$(".savechange").attr("data-toggle", "");
			}
		}
	});
}

$("#dropdown-allServices").click(function(){
	if ($("#SwitchAllServices").val() == "Off"){
		$("#SwitchAllServices").val("On");
		$("#title_sm").val("Corriendo los servicios");
		$("#content_sm").val("Red, Apache y MySQL");
		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-success");
		}, 50);
	} else {
		$("#SwitchAllServices").val("Off");
		$("#title_sm").val("Apagando los servicios");
		$("#content_sm").val("Red, Apache y MySQL");
		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
		}, 50);
	}
});

$("#dropdown-Network").click(function(){
	if ($("#SwitchNetwork").val() == "Off"){
		$("#title_sm").val("Ejecutando red");
		$("#content_sm").val("Red hospedada...");

		$.ajax("app/Desktop/Root/php/ic.Create_Network.php").fail(function() { 
			$("#content_sm").val("Ha ocurrido un problema al intentar iniciar MySQL");
		});

		$("#SwitchNetwork").val("On");

		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-success");
		}, 50);
	} else {
		$("#title_sm").val("Apagando red");
		$("#content_sm").val("Red hospedada...");

		$.ajax("app/Desktop/Root/php/ic.Network_Stop.php").fail(function() { 
			$("#content_sm").val("Ha ocurrido un problema al intentar apagar MySQL");
		});

		$("#SwitchNetwork").val("Off");

		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
		}, 50);
	}
});

/*Aquí la cuestión es que la condición funcione, no se le cambia el valor a un teléfono!.*/

$("#dropdown-Network").click(function(){
	if ($("#SwitchNetwork").val() == "Off"){
		

		// $("#SwitchNetwork").val();
		
		
	} else if ($("#SwitchNetwork").val() == "On"){
	}
});

$("#dropdown-MySQL").click(function(){
	if ($("#SwitchMySQL").val() == "Off"){
		$("#SwitchMySQL").val("On");
		$("#title_sm").val("Ejecutando servicio");
		$("#content_sm").val("Gestor de base de datos MySQL");

		$.ajax("app/core/Services/ExeMySQLStart.php").fail(function() { 
			$("#content_sm").val("Ha ocurrido un problema al intentar iniciar MySQL");
		});
		
		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-success");
		}, 50);
	} else if ($("#SwitchMySQL").val() == "On"){
		$("#SwitchMySQL").val("Off");
		$("#title_sm").val("Apagando servicio");
		$("#content_sm").val("Cerrando gestor de BD MySQL");

		$.ajax("app/core/Services/ExeMySQLStop.php").fail(function() { 
			$("#content_sm").val("Ha ocurrido un problema al intentar apagar MySQL");
		});

		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
		}, 50);
	}
});

$("#dropdown-Apache").click(function(){
	$("#title_sm").val("Ejecutando servicio");

	if ($("#SwitchApache").val() == "Off"){
		$("#SwitchApache").val("On");
		$("#content_sm").val("Iniciando servidor Apache");

		$.ajax("app/core/Services/ExeApacheStart.php").fail(function() { 
			alert("Ha ocurrido un problema, verifique las rutas de los servicios!."); 
		});

		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-success");
		}, 50);
	} else if ($("#SwitchApache").val() == "On"){
		$("#SwitchApache").val("Off");
		$("#content_sm").val("Apagando servidor Apache");

		$.ajax("app/core/Services/ExeApacheStop.php").fail(function() { 
			alert("Ha ocurrido un problema, verifique las rutas de los servicios!."); 
		});

		setTimeout(function(){
			$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
		}, 50);
	}
});

/*This event will show to the documentation area.*/
$("#sidebar_show_documentation").click(function(){
	$.ajax({
		url: "app/Desktop/Root/graphic/ic.showDocumentation.php",
		success: function(data){
			$("div.container_platform").html(data);
		}
	});
});

$("#sidebar_redactDocumentation").click(function(){
	$(".AddRedactDocumentation").click();
});

var GlobalX = 0, GlobalY = 0;
var CountNow = 0;
$(document).mousemove(function(event){	
    GlobalX = event.clientX;
    GlobalY = event.clientY;

    setTimeout(function(){
      if (GlobalX == event.clientX && GlobalY == event.clientY){
        CountNow = setTimeout(function(){
        	window.location.href="app/controller/php/ic.logout.php";
        }, 299000);
      } else if (GlobalX != event.clientX || GlobalY != event.clientY) {
        clearTimeout(CountNow);
      }
    }, 1000);
});

//Tracking Network

$("#sb_item_TrackingNetworkTest").click(function(){
	$(".AdminPanel_TrackingNetwork").addClass('animated fadeOut').hide();
	
	NProgress.start();
	$(".AdminPanel_TrackingNetwork").addClass('animated fadeIn').show();

	$.ajax({
		url: "app/Desktop/Root/graphic/gn.TrackingNetworkTest.php",
		success: function(data){
			$(".AdminPanel_TrackingNetwork_PanelBody").html(data);
			draw();
			NProgress.done();
		}
	});
});

/*This event will show the Tracking Network Design*/
$("#sb_item_TrackingNetwork").click(function(){
	NProgress.start();
	$.ajax({
		url: "app/Desktop/Root/graphic/gn.TrackingNetwork.php",
		success: function(data){
			$("div.container_platform").html(data);
			draw();
			NProgress.done();
		}
	});
});

var myVar = 0;

function StartTracking(){
	myVar = setInterval(function(){ LoadNetworkMap() }, 2000);

	$(".btn_tracking span").html("SONDEANDO...");
	$(".network_map_loader").fadeIn(500).show();

	$("#retardo_temporal").html("...");

	$.ajax({
	    url: "app/Desktop/Root/php/vis/Tracking.php",
	    success: function(data){
	    	$(".here_write").html(data);
			
			$("#ClickSondeoFinal").click();
			clearInterval(myVar);

			$("#retardo_temporal").show(500).html($("#input_retardo").val());
	    }
	});
}

function LoadNetworkMap(){
	$.ajax({
	    url: "app/Desktop/Root/php/vis/return.php",
	    success: function(data){
	    	$(".here_write").html(data);
			// $(".btn_tracking span").html("SONDEAR INFRAESTRUCTURA DE RED");			
			// $("#ClickSondeoFinal").click();
			draw();
	    }
	});
}

// function coordenadas(event) {     
//     $(".eje_test").val("X: " + event.clientX + "px | Y: " + event.clientY);

//     clickCoords = getPosition(event);

//     $(".eje_bueno").val("X: " + clickCoords.x + "px | Y: " + clickCoords.y);
// }

function getCoordsPosition(e) {
    var posx = 0;
    var posy = 0;

    if (!e) var e = window.event;
    
    if (e.pageX || e.pageY) {
      	posx = e.pageX;
      	posy = e.pageY;
    } else if (e.clientX || e.clientY) {
      	posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
      	posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
    }

    return {
      	x: posx,
      	y: posy
    }
}

/*Gestionar dispositivos en red*/
$("#sb_item_DevicesShow").click(function(){
	NProgress.start();
	$.ajax({
		url: "app/Desktop/Root/graphic/gn.DevicesManagement.php",
		success: function(data){
			$("div.container_platform").html(data);
			// draw();
			NProgress.done();
		}
	});
});

$("#sb_item_AddDeviceManagement").click(function(){
	$(".AddDeviceManagement").click();
});