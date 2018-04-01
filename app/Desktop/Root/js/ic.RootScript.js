// $(".AddRedactDocumentation").hide();
var xhr = null;

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
	xhr = $.ajax({
		url: "app/Desktop/Root/php/ic.GetNetworkData.php",
		success: function(data){
			$("#FormAppendDataDetails").html(data);
		}
	});
});

$("#HistoryNetwork").click(function(){
	xhr = $.ajax({
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
	xhr = $.ajax({
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
	xhr = $.ajax({
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
        if (CountNow != 0){
        	// console.log("Reiniciando de: " + CountNow);
        	clearTimeout(CountNow);
        	// console.log("El clearTimeout es de: " + CountNow);
    	    CountNow = 0;
	        // console.log("El contador es de: " + CountNow);
        }
      }
    }, 1000);
});

//Tracking Network
$("#sb_item_TrackingNetwork").click(function(){

	HideAdminPanels();

	NProgress.start();

	$(".AdminPanel_TrackingNetwork").addClass('animated fadeIn').show();
	xhr = $.ajax({
		url: "app/Desktop/Root/graphic/gn.TrackingNetwork.php",
		success: function(data){
			$(".AdminPanel_TrackingNetwork_PanelBody").html(data);
			draw();
				
			NProgress.done();
		}
	});
});

/*Gestionar dispositivos en red*/
$("#sb_item_DevicesManagement").click(function(){

	HideAdminPanels();
	
	NProgress.start();
	$(".AdminPanel_DevicesManagement").addClass('animated fadeIn').show();

	xhr = $.ajax({
		url: "app/Desktop/Root/graphic/gn.DevicesManagement.php",
		success: function(data){
			$(".AdminPanel_DevicesManagement_PanelBody").addClass('animated fadeIn').html(data);
			NProgress.done();
		}
	});
});

/*Monitorizar recursos*/
$("#sb_item_ResourcesMonitor").click(function(){

	HideAdminPanels();
	
	NProgress.start();
	$(".AdminPanel_ResourcesMonitor").addClass('animated fadeIn').show();

	xhr = $.ajax({
		url: "app/Desktop/Root/graphic/gn.ResourcesMonitor.php",
		success: function(data){
			$(".AdminPanel_ResourcesMonitor_PanelBody").addClass('animated fadeIn').html(data);
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

	xhr = $.ajax({
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
	xhr = $.ajax({
	    url: "app/Desktop/Root/php/vis/return.php",
	    success: function(data){
	    	$(".here_write").html(data);
			// $(".btn_tracking span").html("SONDEAR INFRAESTRUCTURA DE RED");			
			// $("#ClickSondeoFinal").click();
			draw();
	    }
	});
}

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

$("#sb_item_AddDeviceManagement").click(function(){
	$(".AddDeviceManagement").click();
});

$("#ddt_SelectTypeDeviceOptionFinalHost").click(function(){
    $(".ddt_SelectTypeDevice").html("Ordenador <span class='caret'></span>");
});

$("#ddt_SelectTypeDeviceOptionServer").click(function(){
    $(".ddt_SelectTypeDevice").html("Servidor <span class='caret'></span>");
});

$("#ddt_SelectTypeDeviceOptionRouter").click(function(){
    $(".ddt_SelectTypeDevice").html("Enrutador <span class='caret'></span>");
});

$(".AddDeviceManagement").hide();

/*Admin Panels*/
function HideAdminPanels(){
	$(".AdminPanel_DevicesManagement").addClass('animated fadeOut').hide();
	$(".AdminPanel_TrackingNetwork").addClass('animated fadeOut').hide();
	$(".AdminPanel_ResourcesMonitor").addClass('animated fadeOut').hide();
}

function HideADM(which){

	// $(".ADM_Host").addClass('animated fadeOut').hide();
	$(".ADM_Server").addClass('animated fadeOut').hide();
	$(".ADM_Router").addClass('animated fadeOut').hide();

	if (which == "ADM_Host"){
		$(".ADM_Host").addClass('animated fadeIn').show();
		$(".ADM_Server").addClass('animated fadeOut').hide();
		$(".ADM_Router").addClass('animated fadeOut').hide();
	} else if (which == "ADM_Server"){
		$(".ADM_Host").addClass('animated fadeOut').hide();
		$(".ADM_Server").addClass('animated fadeIn').show();
		$(".ADM_Router").addClass('animated fadeOut').hide();
	} else if (which == "ADM_Router"){
		$(".ADM_Host").addClass('animated fadeOut').hide();
		$(".ADM_Server").addClass('animated fadeOut').hide();
		$(".ADM_Router").addClass('animated fadeIn').show();
	}

	$(".ddt_SelectTypeDevice").click();
}

HideAdminPanels();
HideADM();

var ADM_Value = "";
$("#ddt_SelectTypeDeviceOptionFinalHost").click(function(){
	ADM_Value = "ADM_Host";
	HideADM("ADM_Host");
});

$("#ddt_SelectTypeDeviceOptionServer").click(function(){
	ADM_Value = "ADM_Server";
	HideADM("ADM_Server");
});

$("#ddt_SelectTypeDeviceOptionRouter").click(function(){
	ADM_Value = "ADM_Router";
	HideADM("ADM_Router");
});

// Tooltip
$(function(){
    $('[data-toggle="tooltip"]').tooltip()
});

function KnowIPClass(first_octec){
	if (first_octec >= 1 && first_octec <= 126)
		return "A";
	else if (first_octec >= 128 && first_octec <= 191)
		return "B";
	else if (first_octec >= 192 && first_octec <= 223)
		return "C";
		
	return "DESCONOCIDA";
}

// Muestra la dirección IP de red seleccionada.
function getDataAndWriteTBNetIP(ip_net){
	let IPOctec = ip_net.split(".");
	let LastOctec = IPOctec[3].split("/");

	$(".ADM_TB_IPNet").val(ip_net);
	$(".ADM_TB_IPNet").attr("disabled", "disabled");

	$(".ADM_TB_IPHost").val(IPOctec.slice(0, 3).join(".") + ".");
	$(".ADM_TB_IPHost").attr("data-content", "La IP es de clase " + KnowIPClass(IPOctec[0]) + " y debe estar comprendida en el rango de red /" + LastOctec[1] + ".");
	$(".ADM_TB_IPHost").click();
	$(".ADM_TB_IPHost").focus();
}

function getDataAndWriteTBHostIP(ip_net){
	let IPOctec = ip_net.split(".");
	let LastOctec = IPOctec[3].split("/");

	$(".ADM_TB_IPNet").val(ip_net);
	$(".ADM_TB_IPNet").attr("disabled", "disabled");

	$(".ADM_TB_IPHost").val(IPOctec.slice(0, 3).join(".") + ".");
	$(".ADM_TB_IPHost").attr("data-content", "La IP es de clase " + KnowIPClass(IPOctec[0]) + " y debe estar comprendida en el rango de red /" + LastOctec[1] + ".");
}

$(".Option_ADM_NewNetwork").click(function(){
	$(".ADM_TB_IPNet").removeAttr("disabled");
	$(".ADM_TB_IPNet").click();
	$(".ADM_TB_IPNet").focus();
});

$(".ADM_TB_IPHost").click(function(){
	let ADM_TB_IPNet_ID = document.getElementById("ADM_TB_IPNet_ID");

	// alert("Resultado: " + ADM_TB_IPNet_ID.value);

	if (ADM_TB_IPNet_ID.value.length > 0)
		getDataAndWriteTBHostIP(ADM_TB_IPNet_ID.value);
});

/*Registrar nuevo dispositivo*/
$("#Btn_ADM_Save").click(function(){	
	NProgress.start();

	if (ADM_Value == "ADM_Host"){

		$("#InputADMOptionHost_WhoIs").val(ADM_Value);
		$("#InputADMOptionHost_AliasHost").val($("#ADM_InsertAliasHost").val());
		$("#InputADMOptionHost_IPNet").val($("#ADM_TB_IPNet_ID").val());
		$("#InputADMOptionHost_IPHost").val($("#ADM_TB_IPHost_ID").val());

		xhr = $.ajax({
			url: "app/Desktop/Root/php/gn.AddDevice.php",
			type: "post",
			data: $("#Form_ADM_Option_Host").serialize(),
			success: function(data){
				$(".AdminPanel_ResourcesMonitor_PanelBody").addClass('animated fadeIn').html(data);
				NProgress.done();
			}
		});
	} else if (ADM_Value == "ADM_Server"){
		alert("Intenta agregar un servidor");
	} else if (ADM_Value == "ADM_Router"){
		alert("Intenta agregar un enrutador");
	}

});

$(".btn_main_logo").click(function(){
	if (xhr != null)
		xhr.abort();
	
	window.location.reload();
});