$(document).ready(start);

function start(){

	$(".ConfigNetwork").hide();
	$("#InstallValidation").hide();
	$("#CallModalSuccessful").hide();
	$("#VMCreateUser").hide();
	$("#ValidateModalProblemUser").hide();
	$("#BtnModalLogin").hide();

	$("#Maestro").click(function(){
		$("#btn_session").text("Maestro");
		$("#btn_session").attr("data-content", "Acceder con privilegios de Maestro.");
		$(".LbUsername").text("Número de Carnet");
		$("#username").attr("placeholder", "Escriba sun úmero de carnet: ## - #### - ##");
		$("#privilege").val("master");
	});
	$("#Estudiante").click(function(){
		$("#btn_session").text("Estudiante");
		$("#btn_session").attr("data-content", "Acceder con privilegios de Estudiante.");
		$(".LbUsername").text("Número de Carnet");
		$("#username").attr("placeholder", "Escriba su número de carnet: ## - #### - ##");
		$("#privilege").val("student");
	});
	$("#Tutor").click(function(){
		$("#btn_session").text("Tutor");
		$("#btn_session").attr("data-content", "Acceder con privilegios de Tutor");
		$(".LbUsername").text("Nombre de usuario");
		$("#username").attr("placeholder", "Escriba el nombre de usuario");
		$("#privilege").val("tutor");
	});
	$("#Administrador").click(function(){
		$("#btn_session").text("Administrador");
		$("#btn_session").attr("data-content", "Acceder con privilegios de Administrador");
		$(".LbUsername").text("Nombre de usuario");
		$("#username").attr("placeholder", "Escriba el nombre de usuario");
		$("#privilege").val("admin");
	});

	$("#LockSession").click(function(){
		LoginLockSession();
	});

	$("#FormSessionActive").submit(function( event ) {
	  	LoginLockSession();
	  	event.preventDefault(); 
	});

	if ($("#TimeRestActive").val() == "Yes"){
		
		ExecTimerSession();

		setTimeout(function(){
			window.location.href = "./";
		}, ($("#TimeRestHope").val() * 1000)+1000 );
	}
	
	$("#BtnLogin").click(function(){
		var UN = $("#username").val(), 
			PW = $("#password").val();

		if (UN == "" || PW == ""){
			if (UN == "" && PW != ""){
				$(".VerifyInformation").html("El campo de <b>Usuario</b> se encuentra vacío, por favor, rellene el campo para continuar.");
			} else if (UN != "" && PW == ""){
				$(".VerifyInformation").html("El campo de <b>Contraseña</b> se encuentra vacío, por favor, rellene el campo para continuar.");
			} else if (UN == "" && PW == "") {
				$(".VerifyInformation").html("Los campos se encuentran vacíos, por favor, verifíquelos y vuelva a intentarlo.");
			}
			$("#BtnModalLogin").click();
			return false;
		}

		$.ajax({
			url: "app/controller/php/ic.login.php", 
			type: "post", 
			data: $("#FormGoLogin").serialize(), 
			success: function(data){
				if (data == "OK"){
					window.location.href="./";
				} else if (data == "Error"){
					$(".VerifyInformation").html("El usuario escrito no se encuentra, por favor, verifíquelos y vuelva a intentarlo.");
					$("#BtnModalLogin").click();
				} else if (data == "AD"){
					$(".VerifyInformation").html("Se ha intentado hacer un ataque con esta cuenta. Verificaré el problema lo más rápido posible!.");
					$("#BtnModalLogin").click();

					setTimeout(function(){
						window.location.href="./";
					}, 3000);
				}
			}
		});
		return false;
	});

	$("#ConfigureInstallation").click(function(){
		var Host = $("#InstallHost").val(), 
			Username = $("#InstallUsername").val(), 
			Password = $("#InstallPassword").val(),
			RepeatPassword = $("#InstallRepeatPassword").val(),
			Database = $("#InstallDatabase").val(), 
			Confirm = 0;

		Confirm = Host.length * Username.length * Password.length * RepeatPassword.length * Database.length;

		if (Confirm == 0){

			if (Host.length == 0){
				$(".VerifyInformation").html("El campo <b>Host</b> se encuentra vacío, este debe rellenarse para hacer la conexión con el SGDB MySQL.");
				$("#InstallValidation").click();
				return false;
			}

			if (Username.length == 0){
				$(".VerifyInformation").html("El campo <b>Nombre de usuario</b> se encuentra vacío, este debe rellenarse para que la conexión al SGDB MySQL se haga con un usuario registrado, dicho usuario debe estar registrado en el dominio del Host -> <b>" + Host + "</b>.");
				$("#InstallValidation").click();
				return false;
			}

			if (Password.length == 0){
				$(".VerifyInformation").html("El campo <b>Contraseña</b> se encuentra vacío, este debe rellenarse para que la conexión al SGDB MySQL se haga con éxito con respecto al Usuario -> <b>" + Username + "</b>.");
				$("#InstallValidation").click();
				return false;
			}

			if (RepeatPassword.length == 0 || RepeatPassword != Password){
				$(".VerifyInformation").html("El campo <b>Repetir contraseña</b> no se ha confirmado con respecto a la clave anterior, por favor, repita la clave para que exista conexión al servidor con el Usuario -> <b>" + Usuario + "</b>.");
				$("#InstallValidation").click();
				return false;
			}

			if (Database.length == 0){
				$(".VerifyInformation").html("El campo <b>Base de datos</b> se encuentra vacío, se debe rellenar para que los datos puedan volcarse a la base de datos que usted especifique.");
				$("#InstallValidation").click();
				return false;
			}
		}

		$("#ConfigureInstallation").text("Configurando...");

		$.ajax({
			url: "app/config/install/ic.SaveFileConfig.php",
			type: "post",
			data: $("#InstallationCompleteNow").serialize(),
			success: function(data){

				if (data == "OK"){
					Valor = $("#InstallPrefix").val();

					if (Valor.length == 0){
						Valor += "No tiene";
					}

					$(".InstallationSuccessData").html("<i class='fa fa-check-square fa-lg' aria-hidden='true'><b style='margin-left: 10px;'>Host: </b>" + Host + "</i><br/><i class='fa fa-check-square fa-lg' aria-hidden='true'><b style='margin-left: 10px;'>Nombre de usuario: </b>" + Username + "</i><br/><i class='fa fa-check-square fa-lg' aria-hidden='true'><b style='margin-left: 10px;'>Nombre de la Base de Datos: </b>" + Database + "</i><br/><i class='fa fa-check-square fa-lg' aria-hidden='true'><b style='margin-left: 10px;'>Prefijo de tablas: </b>" + Valor + "</i><br/>");
					$("#CallModalSuccessful").click();
					
					$("#ConfigureInstallation").text("Finalizado");
				} else {
					$(".VerifyInformation").html("No hay conexión con la base de datos, verifique la configuración en MySQL, Host, Nombre de usuario, Contraseña y el nombre de la base de datos.");
					$("#InstallValidation").click();
					return false;
				}
			}
		});
		return false;

	});
}

var totalTiempo = Math.floor($("#TimeRestHope").val());

function ExecTimerSession(){
	ValorNum = $("#TimeRestHope").val() / 60;
	$("#ValoresSave").val(ValorNum);

	DecimalValue = ValorNum.toFixed(2);
	DecimalSolo = parseFloat(DecimalValue).toFixed();

	MoreOtherT = Math.floor(((DecimalValue - (Math.floor(DecimalValue) ) ) * 60).toFixed());

	if (MoreOtherT >= 0 && MoreOtherT < 10){
		TimeRegresive = "0" + Math.floor(DecimalValue) + ":0" + MoreOtherT;
	} else {
		TimeRegresive = "0" + Math.floor(DecimalValue) + ":" + MoreOtherT;
	}

	$(".badge").html(TimeRegresive);

    $("#TimeRestHope").val(Math.floor($("#TimeRestHope").val()) - 1);
    setTimeout("ExecTimerSession()", 1000);
    
}

function LoginLockSession(){
	$("#TmpPassword").val($("#mypassword").val());

	if ($("#TmpPassword").val() == ""){
		$(".VerifyInformation").html("No ha escrito una contraseña para el usuario <b>" + $("#TmpUsername").val() + "</b>, por favor, escríbala y vuelva a intentarlo.");
		$("#BtnModalLogin").click();
	} else {
		$.ajax({
			url: "app/controller/php/ic.login.php", 
			type: "post", 
			data: $("#FormSessionActive").serialize(), 
			success: function(data){
				if (data == "OK"){
					window.location.href="./";
				} else if (data == "Error"){
					$(".VerifyInformation").html("¡Up's, algo ha salido mal!. Verifique sus credenciales y vuelva a intentarlo.");
					$("#BtnModalLogin").click();
				} else if (data == "AD"){
					$(".VerifyInformation").html("Disculpe, la cantidad de veces que ha escrito la contraseña incorrecta, se ha excedido. Verifique sus datos y vuelva a intentarlo más tarde.");
					$("#BtnModalLogin").click();

					setTimeout(function(){
						window.location.href="./";
					}, 10000);
				}
			}
		});
		return false;
	}
}

function RootPrivileges(){
	$("#btn_session").text("Root");
	$("#btn_session").attr("data-content", "Llegó mi creador, el usuario Root.");
	$(".LbUsername").text("Usuario Root");
	$("#username").attr("placeholder", "Escriba el nombre de usuario");
	$("#privilege").val("root");
}

if (window.addEventListener) {
	window.addEventListener("keydown", compruebaTecla, false);
} else if (document.attachEvent) {
    document.attachEvent("onkeydown", compruebaTecla);
}

var CountKey = 0;

function compruebaTecla(evt){
    var tecla = evt.which || evt.keyCode;
    if (tecla == 17){
    	CountKey++;
    	if (CountKey == 2){
       		$("#NewOption").append("<li class='divider' id='DividerRoot'></li><li onclick='RootPrivileges()' id='Root'><a href='#'>Root</a></li>");
       	} else if (CountKey > 5){
       		$("#DividerRoot").remove();
       		$("#Root").remove();
       		$("#btn_session").text("Iniciar como");
       		$("#btn_session").attr("data-content", "Seleccione el tipo de usuario con que desea iniciar sesión.");
       		$(".LbUsername").text("Nombre de usuario");
			$("#username").attr("placeholder", "Escriba el nombre de usuario");
			$("#privilege").val("Administrador");
       		CountKey = 0;
       	}
    }
}

function GoHome(){
	window.location.reload();
}

function BackInstallation(){
	$.ajax({
		url: "app/core/ic.DFConfig.php",
		success: function(data){
			if (data == "OK"){
				window.location.href="./";
			}
		}
	});
	return false;
}

function CleanFields(){
	$("#admin_username").val("");
	$("#admin_password").val("");
	$("#admin_repeat_password").val("");

	$("#admin_password").attr("type", "password");
	$("#admin_repeat_password").attr("type", "password");
}

function InsertUsernameAdmin(){
	var Username = $("#admin_username").val(), 
		Password = $("#admin_password").val(), 
		RepeatPassword = $("#admin_repeat_password").val(), 
		Confirm = 0;

	Confirm = Username.length * Password.length * RepeatPassword.length;

	if (Confirm == 0){
		if (Username.length == 0){
			$(".VerifyInformation").html("El campo <b>Nombre de usuario</b> se encuentra vacío, debe rellenar este campo para que se agregue el usuario con privilegios de administrador.");
			$("#ValidateModalProblemUser").click();
			return false;
		}

		if (Password.length == 0 || Password != RepeatPassword){
			$(".VerifyInformation").html("Confirme los campos de <b>Contraseña y Repetir contraseña</b> para continuar con la instalación.");
			$("#ValidateModalProblemUser").click();
			return false;
		}
	}

	$("#tmp_username").val(Username);
	$("#tmp_password").val(Password);

	$.ajax({
		url: "app/controller/php/ic.InstallUser.php",
		type: "post",
		data: $("#ConfigurationUsernameAdmin").serialize(),
		success: function(data){
			if (data == "OK"){
				$(".InstallationSuccessData").html("<i class='fa fa-check-square fa-lg' aria-hidden='true'><b style='margin-left: 10px;'>Nombre de usuario: </b>" + $("#tmp_username").val() + "</i><br/><i class='fa fa-check-square fa-lg' aria-hidden='true'><b style='margin-left: 10px;'>Contraseña: </b>" + $("#tmp_password").val() + "</i><br/><br/><b>Bien, ahora haz click en Iniciar sesión.</b>");
				$("#VMCreateUser").click();
			} else {
				$(".VerifyInformation").html("Confirme los campos de <b>Contraseña y Repetir contraseña</b> para continuar con la instalación.");
				$("#ValidateModalProblemUser").click();
			}
		}
	});
	return false;
}

function StartSession(){
	window.location.href="./";
}

function ShowFieldsKeys(){
	$("#admin_password").attr("type", "text");
	$("#admin_repeat_password").attr("type", "text");

	var Key = GenerateKey(7);

	$("#admin_password").val(Key);
	$("#admin_repeat_password").val(Key);
}

function GenerateKey(lng) {
  	long = parseInt(lng);

  	var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  	var password = "";

  	for (i=0; i<long; i++) 
  		password += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  	
  	return password;
}

function ChangeUser(){
	$.ajax({
		url: "app/controller/php/ic.RememberDelete.php",
		success: function(data){
			if (data == "OK"){
				setTimeout(function(){
					window.location.href="./";
				}, 200);
			}
		}
	});
	return false;
}