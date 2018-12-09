// $(".AddRedactDocumentation").hide();
var xhr = null;
var var_item_ResourcesMonitorModal = false;

function Finish_NProgress(){
	NProgress.done();
	NProgress.remove();
}

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
		// 
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
        }, 1800000);
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

// Devices Management
$("#BtnHiddenDeviceManagementInit").click(function(){
	$("#title_sm").val("Verificando conexión");
	$("#content_sm").val(respuesta.data.count + " dispositivos encontrados...");
	
	setTimeout(function(){
		$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
	}, 50);
});

$("#BtnHiddenDeviceManagementFinish").click(function(){
	$("#title_sm").val("Proceso de verificación");
	$("#content_sm").val("Dispositivos verificados con éxito");

	setTimeout(function(){
		$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
		// $(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-success");
	}, 50);
});

// Credentials Local Machine
$("#BtnHiddenNotifyACLMEmpty").click(function(){
	$("#title_sm").val("Credenciales del servidor");
	$("#content_sm").val("Por favor, rellene los campos!");
	
	setTimeout(function(){
		$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
	}, 50);
});

$("#BtnHiddenNotifyACLMOk").click(function(){
	$("#title_sm").val("Credenciales del servidor");
	$("#content_sm").val("¡Estupendo, ha sido actulizado!");
	
	setTimeout(function(){
		$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-success");
	}, 50);
});

$("#BtnHiddenNotifyACLMFail").click(function(){
	$("#title_sm").val("Credenciales del servidor");
	$("#content_sm").val("Lo sentimos, ha ocurrido un error, inténtelo más tarde");
	
	setTimeout(function(){
		$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-error");
	}, 50);
});

$("#BtnHiddenNotifyACLMError").click(function(){
	$("#title_sm").val("Credenciales del servidor");
	$("#content_sm").val("Lo sentimos, nombre de usuario y contraseña inválidos");
	
	setTimeout(function(){
		$(".ui-pnotify-container").attr("class", "alert ui-pnotify-container alert-dark");
	}, 50);
});

function LoadPNotifyDeviceManagement(condition){
	if (condition){
		$("#BtnHiddenDeviceManagementInit").click();
	} else {
		$("#BtnHiddenDeviceManagementFinish").click();
	}
}

$("#sb_subitem_NetworkMap").click(function(){
	$("#sb_item_TrackingNetwork").click();
});

var var_item_TrackingNetwork = false;

//Tracking Network
$("#sb_item_TrackingNetwork").click(function(){
	HideAdminPanels();

	NProgress.configure({parent: 'body'});
	NProgress.start();

	$(".AdminPanel_TrackingNetwork").addClass('animated fadeIn').show();
	
	if (!var_item_TrackingNetwork){
		xhr = $.ajax({
			url: "app/Desktop/Root/graphic/gn.TrackingNetwork.php",
			success: function(data){
				let posicion = data.indexOf("Fail");

				var_item_TrackingNetwork = true;
				if (posicion != -1){
					$(".AdminPanel_TrackingNetwork_PanelBody").addClass('animated fadeIn').html(data);
					$(".here_write").html($("#MessageFailCheckTrackingNetwork").html());
				} else {
					$(".AdminPanel_TrackingNetwork_PanelBody").addClass('animated fadeIn').html(data);
					// $(".AdminPanel_TrackingNetwork_PanelBody").html(data);
					draw();
				}
				Finish_NProgress();
			}
		});
	} else {
		Finish_NProgress();
	}
});

function btn_action_tn(){
	$(".btn_action_tn").click();
}

$("#sb_item_TrackingNetwork").dblclick(function(){
	var_item_TrackingNetwork = false;
	$("#sb_item_TrackingNetwork").click();
});

var var_item_DevicesManagement = false;

/*Gestionar dispositivos en red*/
$("#sb_item_DevicesManagement").click(function(){
	HideAdminPanels();
	
	NProgress.configure({parent: 'body'});
	NProgress.start();

	$(".AdminPanel_DevicesManagement").addClass('animated fadeIn').show();

	if ((typeof respuesta == "undefined") || (!var_item_DevicesManagement)){
		$.ajax({
			url: "app/Desktop/Root/graphic/gn.DevicesManagement.php",
			success: function(data){
				$(".AdminPanel_DevicesManagement_PanelBody").addClass('animated fadeIn').html(data);
				Finish_NProgress();
			}
		});

		$.ajax({
			url: "app/Desktop/Root/php/gn.TestingShowUsers.php", 
			type: "post", 
			dataType: "json",
		})
		.done(function(response) {
			var_item_DevicesManagement = true;
			respuesta = response;
			LoadPNotifyDeviceManagement(true);
		})
		.fail(function( jqXHR, textStatus, errorThrown ) {
		     if ( console && console.log ) {
		         console.log( "La solicitud a fallado: " +  textStatus);
		     }
		})
		.then(function(){
			console.log(respuesta);
			CheckPingAjax();
		});
	} else {
		Finish_NProgress();
	}
});

$("#sb_item_DevicesManagement").dblclick(function(){
	var_item_DevicesManagement = false;
	$("#sb_item_DevicesManagement").click();
});

var var_item_ResourcesMonitor = false;

/*Monitorizar recursos*/
$("#sb_item_ResourcesMonitor").click(function(){

	var params = {
		"name" : "GNet",
		"host" : "127.0.0.1",
		"container_return" :  "AdminPanel_ResourcesMonitor_PanelBody", 
		"NProgress" : "body"
	};

	getResourcesMonitor(params);
});

function getResourcesMonitorNetwork(params){
	xhr = $.ajax({
		url: "app/Desktop/Root/php/gn.CheckCredentialsLocalMachine.php",
		type: "post",
		success: function(data){
			if (data == "Ok"){
				// var_item_ResourcesMonitorModal = true;
				NProgress.configure({parent: params['NProgress']});
				NProgress.start();
				
				xhr = $.ajax({
					data: params,
					url: "app/Desktop/Root/graphic/gn.ResourcesMonitorNetwork.php",
					type: "post",
					success: function(data){
						if (data == "Fail"){
							alert("Fail -> No existen credenciales de usuario y contraseña para este host");
							$("#BtnHiddenNotifyACLMError").click();
						} else {

							// if (var_item_ResourcesMonitor){
							// 	$(".AdminPanel_ResourcesMonitor_PanelBody").html("");
							// }

							$("." + params['container_return']).addClass('animated fadeIn').html(data);
						}
						Finish_NProgress();
					}
				});
				// if (params['name'] == "GNet"){
					// HideAdminPanels();
					// NProgress.configure({parent: params['NProgress']});
				// } else {
				// }
				
			} else if (data == "Fail"){
				if (params['name'] == "GNet"){
					getModalCredentialsLocalMachine();
				} else {
					alert("No existen credenciales de usuario y contraseña para este host");
				}
			}
		}
	});
}

function getResourcesMonitor(params){
	xhr = $.ajax({
		url: "app/Desktop/Root/php/gn.CheckCredentialsLocalMachine.php",
		type: "post",
		success: function(data){
			if (data == "Ok"){
				
				if (params['name'] == "GNet"){
					HideAdminPanels();
					NProgress.configure({parent: params['NProgress']});
				} else {
					var_item_ResourcesMonitorModal = true;
					NProgress.configure({parent: params['NProgress']});
				}

				NProgress.start();

				if (params['name'] == "GNet"){
					$(".AdminPanel_ResourcesMonitor").addClass('animated fadeIn').show();
					
					if (!var_item_ResourcesMonitor){
						xhr = $.ajax({
							data: params,
							url: "app/Desktop/Root/graphic/gn.ResourcesMonitor.php",
							type: "post",
							success: function(data){
								if (data == "Fail"){
									$("." + params['container_return']).addClass('animated fadeIn').html($("#MessageFailCheckCredentialsLocalMachine").html());
									$("#BtnHiddenNotifyACLMError").click();
								} else {
									$("." + params['container_return']).addClass('animated fadeIn').html(data);
									
									setTimeout(function(){
										$(".ShowInfoPercentageCPUPull").text($("#InputHiddenPercentageCPU").val() + "%");
										$(".ShowInfoPercentageCPUProgress").css("width", $("#InputHiddenPercentageCPU").val() + "%");
	
										$(".ShowInfoPercentageRAMPull").text($("#InputHiddenPercentageRAM").val() + "%");
										$(".ShowInfoPercentageRAMProgress").css("width", $("#InputHiddenPercentageRAM").val() + "%");
	
										$(".SB_Medida_CPU").addClass('animated fadeIn').css("visibility", "visible");
										$(".SB_Medida_RAM").addClass('animated fadeIn').css("visibility", "visible");
										$(".SB_Medida_Label").addClass('animated fadeIn').css("visibility", "visible");
									}, 500);
								}
	
								Finish_NProgress();
								var_item_ResourcesMonitor = true;
							}
						});
					} else {
						if (var_item_ResourcesMonitorModal){
							var_item_ResourcesMonitor = false;

							$("#sb_item_ResourcesMonitor").dblclick();
						}
						Finish_NProgress();
					}
				} else {
					xhr = $.ajax({
						data: params,
						url: "app/Desktop/Root/graphic/gn.ResourcesMonitor.php",
						type: "post",
						success: function(data){
							if (data == "Fail"){
								alert("Fail -> No existen credenciales de usuario y contraseña para este host");
								$("#BtnHiddenNotifyACLMError").click();
							} else {

								if (var_item_ResourcesMonitor){
									$(".AdminPanel_ResourcesMonitor_PanelBody").html("");
								}

								$("." + params['container_return']).addClass('animated fadeIn').html(data);
							}
							Finish_NProgress();
						}
					});
				}
				
				
				
			} else if (data == "Fail"){
				if (params['name'] == "GNet"){
					getModalCredentialsLocalMachine();
				} else {
					alert("No existen credenciales de usuario y contraseña para este host");
				}
			}
		}
	});
}

$("#sb_item_ResourcesMonitor").dblclick(function(){
	var_item_ResourcesMonitor = false;

	if (var_item_ResourcesMonitorModal){
		var_item_ResourcesMonitorModal = false;
		$(".AdminPanel_ResourcesMonitor_PanelBodyModal").html("");
	}

	$("#sb_item_ResourcesMonitor").click();
});

$(".tab_btn_process").click(function(){
	$(".sorting").addClass('animated fadeIn').click();
	setTimeout(function(){
		$(".sorting_asc").addClass('animated fadeIn').click();
	}, 100);
});
// ----------------------------------------------
// Configuraciòn de cuenta y perfil del usuario
// ----------------------------------------------

$("#ConfigureProfile").click(function(){
	$.ajax({
		url: "app/Desktop/Root/graphic/gn.ProfileSettings.php",
		type: "post",
		success: function(data){
			HideAdminPanels();	
			$(".AdminPanel_ProffileSettings").addClass('animated fadeIn').show();
			$(".AdminPanel_ProfileSetting_PanelBody").addClass('animated fadeIn').html(data);

			$("#btnUpdateUserInfo").click(function(){
				UpdateUserInformation();
			});
			
			$("#btnChangeUserName").click(function(){
				$(".ChangeUserName").click();
			});

			$("#btnSaveNewUser").click(function(){
				ChangeUserName();
			});

			$("#btnChangePassword").click(function(){
				ChangePassword();
			});

			$("#UpdateUserName,#PasswordUserName").keypress(enterChangeUserName);
			$("#name1,#name2,#email").keypress(enterUpdateUserInfo);
			$("#password1,#password2,#password3").keypress(enterChangePassword);

			function UpdateUserInformation() {
				var FirstName = $("#name1").val(),
					LastName = $("#name2").val(),
					Email = $("#email").val();

				$("#G_InputUserName").val();
				$("#G_InputPrefixTable").val();
				$("#G_InputPrivilegeUser").val();
				$("#G_InputFirstName").val(FirstName);
				$("#G_InputLastName").val(LastName);
				$("#G_InputMailAddress").val(Email);
				
				$.ajax({
					url: "app/Desktop/Root/php/gn.UpdateUserInfo.php",
					type: "post",
					data: $("#FormUpdateUserInfo").serialize(),
					success: function(data){
						if (data == "Ok") {
							alert("Se ha modificado la información del usuario");
						} else if (data == "Fail") {
							alert("Ha ocurrido un error");
						}
					}
				});
			}

			function enterUpdateUserInfo(event){
				var e = event || window.event;
				if (e.keyCode == 13) {
					UpdateUserInformation();
				}
			}

			function ChangeUserName() {
				var UserName = $("#UpdateUserName").val(),
					Password = $("#PasswordUserName").val();

				$("#U_InputUserName").val();
				$("#U_InputPrefixTable").val();
				$("#U_InputPrivilegeUser").val();
				$("#U_InputNewUserName").val(UserName);
				$("#U_InputPasswordUserName").val(Password);
				
				if (UserName != "" && Password != ""){
					$.ajax({
						url: "app/Desktop/Root/php/gn.ModifyUserAccount.php",
						type: "post",
						data: $("#FormChangeUserName").serialize(),
						success: function(data){
							if (data == "Ok") {
								alert("Se ha modificado el usuario");
							} else if (data == "Fail") {
								alert("Ha ocurrido un error");
							}
						}
					});
				} else {
					alert("Rellene los campos");
				}
			}

			function enterChangeUserName(event){
				var e = event || window.event;
				if (e.keyCode == 13) {
					ChangeUserName();
				}
			}

			function ChangePassword() {
				var password1 = $("#password1").val(),
					password2 = $("#password2").val()
					password3 = $("#password3").val();

				if (password2 == password3) {
					$("#P_InputUserName").val();
					$("#P_InputPrefixTable").val();
					$("#P_InputPrivilegeUser").val();
					$("#P_InputCurrentPassword").val(password1);
					$("#P_InputNewPassword").val(password3);
					
					if (password1 != "" && password2 != "" && password3 != ""){
						if (password2 == password3) {
							$.ajax({
								url: "app/Desktop/Root/php/gn.ChangePassword.php",
								type: "post",
								data: $("#FormChangePassword").serialize(),
								success: function(data){
									if (data == "Ok") {
										alert("Se ha modificado la contraseña" + data);
									} else if (data == "Fail") {
										alert("Ha ocurrido un error");
									}
								}
							});
						} else {
							alert("Las contraseñas no coinciden");
						}						
					} else {
						alert("Rellene los campos");
					}
				} else {
					alert("Las contraseñas no coinciden");
				}		
			}

			function enterChangePassword(event){
				var e = event || window.event;
				if (e.keyCode == 13) {
					ChangePassword();
				}
			}
		}
	});
});


function getModalCredentialsLocalMachine(){
	$(".AddCredentialsLocalMachine").click();
}

function getModalMonitor(){
	$(".ModalMonitor").click();
}

function getModalMonitorNetwork(){
	$(".ModalMonitorNetwork").click();
}

function getModalMonitorProcess(){
	$(".ModalMonitorProcess").click();
}

function getModalMonitorProperties(){
	$(".ModalMonitorProperties").click();
}

/*Registrar las credenciales del host actual que monitoriza*/
$("#Btn_ACLM_Save").click(function(){
	let user = $("#CredentialLocalMachineUsername").val(), 
		pass = $("#CredentialLocalMachinePassword").val();

	if (user != "" && pass != ""){
		NProgress.configure({parent: 'body'});
		NProgress.start();

		xhr = $.ajax({
			url: "app/Desktop/Root/php/gn.AddCredentialsLocalMachine.php",
			type: "post",
			data: $("#Form_ACLM").serialize(),
			success: function(data){
				if (data == "Ok")
					$("#BtnHiddenNotifyACLMOk").click();
				else if (data == "Fail")
					$("#BtnHiddenNotifyACLMFail").click();

				setTimeout(function(){
					Finish_NProgress();
					$("#ModalCloseACLM").click();
					$("#sb_item_ResourcesMonitor").dblclick();
				}, 200);
			}
		});
	} else {
		$("#BtnHiddenNotifyACLMEmpty").click();
	}
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
	$("#ADM_InsertAliasHost").focus();
});

$("#sb_item_ConfigureSyslog").click(function(){
	$(".ConfigureSyslog").click();
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
$(".ConfigureSyslog").hide();
$(".AddCredentialsLocalMachine").hide();
$(".ModalMonitor").hide();
$(".ModalMonitorNetwork").hide();
$(".ModalMonitorProcess").hide();
$(".ModalMonitorProperties").hide();
$(".ChangeUserName").hide();

/*Admin Panels*/
function HideAdminPanels(){
	$(".AdminPanel_DevicesManagement").addClass('animated fadeOut').hide();
	$(".AdminPanel_TrackingNetwork").addClass('animated fadeOut').hide();
	$(".AdminPanel_ResourcesMonitor").addClass('animated fadeOut').hide();
	$(".AdminPanel_ProffileSettings").addClass('animated fadeOut').hide();
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
	NProgress.configure({parent: 'body'});
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
				$(".ddt_SelectTypeDevice").html("* Dispositivo <span class='caret'></span>");
				$("#ADM_InsertAliasHost").val("");
				$("#ADM_TB_IPNet_ID").val(" ");
				$("#ADM_TB_IPHost_ID").val("");
				Finish_NProgress();
				$("#ModalCloseADMSave").click();
			}
		});
	} else if (ADM_Value == "ADM_Server"){
		alert("Intenta agregar un servidor");
	} else if (ADM_Value == "ADM_Router"){
		alert("Intenta agregar un enrutador");
	}
});

$(".btn_main_logo").click(function(){
	CleanXHR();
	
	window.location.reload();
});

function FunctionOnChange(ip_addr, value){
	
	var parametros = {
        "ip_addr" : ip_addr,
        "alias" : value.newValue
    }

	xhr = $.ajax({
		url: "app/Desktop/Root/php/gn.UpdateAliasNetHost.php",
		type: "post",
		data: parametros,
		success: function(data){
			if (data != ""){
				console.log('IP Address: ' + ip_addr + ', Valor guardado: ' + value.newValue);
			} else {
				console.log("Ha fallado...");
			}
		}
	});
	
}

function CleanXHR(){
	if (xhr != null)
		xhr.abort();
}

function CheckPingLoopAjax(value, callback) {
    console.log('START execution with value =', value);
    var ip_host = respuesta.data.hosts[value].ip_host;
    var parametros = {"ip_addr" : ip_host}
    
    NProgress.start();

	$.ajax({
		url: "app/Desktop/Root/php/gn.CheckPing.php",
		type: "post",
		data: parametros,
		success: function(data){
        	Finish_NProgress();
        	callback(value, {ip_host: ip_host, data: data});
		}
	});
}

function CheckPingAjax(){
	var max_host = respuesta.data.count;
	var i_host = 0;
	var request = null;

	NProgress.configure({parent: '.host' + respuesta.data.hosts[i_host].ip_host.split(".").slice(0,4).join("")});
	CheckPingLoopAjax(i_host, function callback(value, result) {

	    console.log('END execution with value =', value, 'and result =', result.ip_host, ' and status: ', result.data);
	    
	    request = ".host" + respuesta.data.hosts[i_host].ip_host.split(".").slice(0,4).join("");
	    if (result.data == "1"){
	    	$(request).css("border-top", "3px solid #89de64");
	    } else {
	    	$(request).css("border-top", "3px solid #e15d5d");
	    }

	    if (i_host === max_host-1) {
	        console.log('COMPLETED Principal');
	        i_host = 0;
	    	Finish_NProgress();
	    	LoadPNotifyDeviceManagement(false);
	    } else {
			// NProgress.start();
			if (i_host < max_host-1){
	    		NProgress.configure({parent: '.host' + respuesta.data.hosts[++i_host].ip_host.split(".").slice(0,4).join("")});
	        	CheckPingLoopAjax(i_host, callback);
			}
	    }
	});
}

function PruebaPingConnect(value){
	// var offsetX;
	// var offsetY;
	value.addEventListener('contextmenu', function (e) {
		var info = getCoordsPosition(e);

		console.log("Posicion: x = " + info.x + "px, y = " + info.y + "px");

		popupMenux = document.getElementById("ContextMenuTest");

    	popupMenux.style.top = e.clientY - info.y + 'px';
		popupMenux.style.left = e.clientX - info.x + 'px';
		
        popupMenux.style.visibility = "visible";
		console.log("Los atributos son: " + $(value).attr("class").split(" ")[2] + " Valor X: " + offsetX + ", Y: " + offsetY);

	    e.preventDefault();
	}, false);

	// 	console.log("Valor ClIENT (" + "x: " + e.clientX + "px | y: " + e.clientY + "px)");
    	
	// 	popupMenux = document.getElementById("ContextMenuTest");

 //    	popupMenux.style.top = e.clientY + 'px';
	// 	popupMenux.style.left = e.clientY + 'px';
		
 //        popupMenux.style.visibility = "visible";


	//     e.preventDefault();
	// }, false);
}

$(".AdminPanel_DevicesManagement").click(function(){
	document.getElementById("ContextMenuTest").style.visibility = "hidden";
    document.getElementById("ContextMenuTest_White").style.visibility = "hidden";
});


$(".AdminPanel_DevicesManagement").on('contextmenu', function(e){
	var info = getCoordsPosition(e);

	console.log("Posicion: getPosition(x: " + info.x + "px, y: " + info.y + "px" + "| Client(x: " + e.clientX + "px, y: "+ e.clientY +"px) | offset(x: " + e.offsetX + "px, y: " + e.offsetY + "px)");

	var popupMenux = document.getElementById("ContextMenuTest");

	var offsetX = e.offsetX;
    var offsetY = e.offsetY;

    if( e.target != this ){ // 'this' is our HTMLElement
        offsetX = e.target.offsetLeft + e.offsetX;
        offsetY = e.target.offsetTop + e.offsetY;
    }

	popupMenux.style.top = info.y + 'px';
	popupMenux.style.left = offsetX + 'px';
	
    popupMenux.style.visibility = "visible";
	// console.log("Los atributos son: " + $(value).attr("class").split(" ")[2] + " Valor X: " + offsetX + ", Y: " + offsetY);

    e.preventDefault();
});

// $("#content_wrapper").contextmenu(function(){
// 	console.log("Funcionando");
// });

function getDataSelection(value){
	let final_value = $(value).attr("class");

	if (final_value == "monitor"){
		getModalMonitor();

		var params = {
			"name" : "Unknown",
			"host" : $("#Topology_host_selected_ip_host").html(),
			"container_return" : "AdminPanel_ResourcesMonitor_PanelBodyModal", 
			"NProgress" : ".AdminPanel_ResourcesMonitor_PanelBodyModal"
		};
	
		getResourcesMonitor(params);

		console.log("Action: " + final_value + " | " + "Host selected: " + $("#Topology_host_selected_ip_host").html());
	} else if (final_value == "network"){
		
		getModalMonitorNetwork();

		var params = {
			"name" : "Unknown",
			"host" : $("#Topology_host_selected_ip_host").html(),
			"container_return" : "AdminPanel_ResourcesMonitorNetwork_PanelBodyModal", 
			"NProgress" : ".AdminPanel_ResourcesMonitorNetwork_PanelBodyModal"
		};

		getResourcesMonitorNetwork(params);

		console.log("Action: " + final_value + " | " + "Host selected: " + $("#Topology_host_selected_ip_host").html());
	} else if (final_value == "processes"){
		getModalMonitorProcess();
		console.log("Action: " + final_value + " | " + "Host selected: " + $("#Topology_host_selected_ip_host").html());
	} else if (final_value == "properties"){
		getModalMonitorProperties();
		console.log("Action: " + final_value + " | " + "Host selected: " + $("#Topology_host_selected_ip_host").html());
	}

}

$("#DivACLMKeyPress").keypress(function(event){
	if (event.which == 13){
		$("#Btn_ACLM_Save").click();
		event.preventDefault();
	}
});