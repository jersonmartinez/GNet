<script>
  var tour = new Tour({
      backdrop: false, // can mask content in a modal
      //storage: window.localStorage, // can use localstorage
      onEnd: function(tour) { // On Tour Complete
        $.ajax({
            url: "app/Desktop/Root/php/gn.AddTour.php",
            success: function(data){
                if (data == "Ok"){
                    setTimeout( () => {
                        location.reload();
                    }, 500 );
                }
            }
        });
      },
      steps: [{
        element: ".gnet_heart",
        title: "Bienvenido a <b>GNet</b>",
        content: "<b>GNet</b> es un sistema de control y monitorización de dispositivos en infraestructuras de redes. <br/><br/>Realiza un recorrido por la plataforma y conoce las impresionantes utilidades que te provee. <br/><br/>Presiona <b>Next</b> para continuar, <b>Prev</b> para retornar y <b>End Tour</b> para finalizar.",
        placement: 'bottom',
		   delay: 1000,
        // backdrop: true,
        onNext: function(tour){
          $(".sidebar-menu-toggle").click();
        }
      }, {
        element: ".sidebar-menu-toggle",
        title: "Panel de control",
        content: "Colección de servicios, eventos y configuración de usuario.",
        placement: 'top',
        onPrev: function (tour) {
          $(".sidebar-menu-toggle").click();
        },
        onNext: function(tour){
          //Close
          $(".sidebar-menu-toggle").click();

          //Open
          $(".topbar-menu-toggle").click();
          setTimeout(function(){
            $(".dropdown-toggle-language").click();
          }, 700);
        }
      }, {
        element: ".menu-options-dashboard",
        title: "Panel de control -",
        content: "Navegación entre el panel de control, cambio de idioma y configuración del perfil de usuario.",
        placement: 'up',
        onPrev: function (tour) {
          //Open
          $(".sidebar-menu-toggle").click();

          //Close
          $(".topbar-menu-toggle").click();
          $(".dropdown-toggle-language").click();
        },
        onNext: function(tour){
          //Close
          $(".topbar-menu-toggle").click();
          $(".dropdown-toggle-language").click();
        }
      }, {
        element: ".NAC_SB_First",
        title: "Panel de gestión de red",
        content: "Este es el panel más importante, donde están señaladas las herramientas de trabajo. <br/><br/> <b>1. </b> Monitorización del servidor actual. <br/> <b>2. </b>Tracking Network (Rastreo de red). <br/> <b>3. </b>Gestión de dispositivos.<br/><b>4. </b>Gestión de eventos (Logs). <br/><b>5. </b>Administración de VPS. ",
        placement: 'right',
        onNext: function (tour) {
          //Open
          $(".panel-heading-usability").click();
        }
      }, {
        element: ".panel-heading-usability",
        title: "Apariencia",
        content: "En este panel puedes personalizar la apariencia de GNet. <br/><br/> <b>1. Navbar: </b> Personalización del encabezado. <br/> <b>2. Sidebar: </b>Personalización de la barra lateral izquierda. <br/> <b>3. Misc: </b>Opciones de diseño. <br/><br/> También puede remover los cambios haciendo clic en el botón <b>Restaurar apariencia</b>.",
        placement: 'left',
        onPrev: function (tour) {
          $(".panel-heading-usability").click();
        },
        onNext: function (tour) {
          $(".panel-heading-usability").click();
        },
      }, {
        element: "#MainSearchIPHostFinal",
        title: "Buscador y monitorizador",
        content: "Luego de haber sondeado la infraestructura de red, acá puedes realizar búsquedas sobre las direcciones de hosts y automaticamente aplicar una monitorización detallada.",
        placement: 'bottom',
		onPrev: function (tour) {
          $(".panel-heading-usability").click();
        },
      }, {
        element: "body",
        title: "<b>GNet</b> | Funcionalidades",
        content: "Si estás listo para conocer las utilidades de <b>GNet</b>, presiona <b>Next</b> para continuar.",
        placement: 'top',
		onNext: function (tour) {
          $(".AddCredentialsLocalMachine").click();
        },
      }, {
        element: ".modal-content-NACLM",
        title: "<b>GNet</b> | Credenciales",
        content: "Empezamos con agregar las credenciales globales del entorno controlado. <br/><br/><b>Conexión remota por SSH</b><br/><b>1.</b> Nombre de usuario (preferiblemente root). <br/><b>2.</b> Clave de acceso. <br/><br/>Luego de agregar las credenciales, haga clic en <b>Next</b>.",
		placement: 'right',
		delay: 700,
		onNext: function (tour){
			$("#ModalCloseACLM").click();
		},
      }, {
        element: ".SB_Medida_Label",
        title: "<b>GNet</b> | Mi servidor",
        content: "Monitorizando este servidor.",
		orphan: true,
		placement: 'top',
		// Add that time.
		delay: 15000,
		onNext: function (tour) {
          $("#sb_item_TrackingNetwork").click();
        },
      }, {
        element: ".AdminPanel_TrackingNetwork",
        title: "<b>GNet</b> | Autodescubrimiento",
        content: "Realiza un sondeo de red y haz que tu infraestructura se vea reflejada en un precioso mapa de red. <br/><br/> Administra los dispositivos que encuentres de forma dinámica.",
		placement: 'bottom',
		delay: 500,
      }, {
        element: ".class-sb_item_TrackingNetwork",
        title: "<b>GNet</b> | Autodescubrimiento",
        content: "Administra los dispositivos de forma dinámica.",
		placement: 'bottom',
		onNext: function (tour) {
		  $(".class-sb_item_DevicesManagement").click();
		  setTimeout( () => {
			$("#sb_item_DevicesManagement").click();
		  }, 300);
        },
      }, {
        element: ".parent-class-sb_item_DevicesManagement",
        title: "<b>GNet</b> | Dispositivos",
        content: "Gestiona tus dispositivos.",
		placement: 'bottom',
		onNext: function (tour){
			$(".class-sb_item_MonitorLogs").click();
			setTimeout( () => {
				$("#sb_item_MonitorLogs").click();
			}, 300);
		},
      }, {
        element: ".parent-class-sb_item_MonitorLogs",
        title: "<b>GNet</b> | Gestión de eventos",
        content: "Selecciona dispositivos para controlar sus eventos.",
		placement: 'bottom',
		onNext: function (tour){
			$("#sb_item_ConfigureSyslog").click();
		},
      }, {
        element: ".modal-content-NCS",
        title: "<b>GNet</b> | Gestión de eventos",
        content: "<b>Dirección IP del host: </b> <br/>Correspondiente al host remoto que enviará los eventos que genere. <br/><br/><b>Dirección IP del servidor: </b><br/>Servidor asignado para recibir y almacenar los eventos que los host clientes generen. <br/><br/>Comienza a agregar para ver resultados.",
		placement: 'bottom',
		delay: 700,
		onNext: function (tour){
			$("#ModalCloseADMSave-ConfigSyslog").click();
			$("#sb_item_MonitorLogs").click();
		},
      }, {
        element: ".parent-class-sb_item_MonitorLogs",
        title: "<b>GNet</b> | Gestión de eventos",
        content: "Navega por el visor de eventos.",
		placement: 'bottom',
		onNext: function (tour){
			$("#sb_item_VPS").click();
		},
      }, {
        element: ".modal-content-NAVPS",
        title: "<b>GNet</b> | VPS",
        content: "<b>Servidor Virtual Privado</b> <br/><br/>La filosofía de esta funcionalidad, es la de agregar un host remoto que se encuentre en internet o bien, una intranet. <br/><br/><b>Alias del dispositivo</b><br/>Nombre que identifique fácilmente al dispositivo.<br/><br/><b>Dirección IP</b><br/>Dirección del host remoto. <br/><br/><b>Nombre de usuario</b><br/>Identificación del usuario (preferiblemente con privilegios de root). <br/><br/><b>Contraseña</b><br/>Clave de acceso al host.",
		placement: 'right',
		delay: 700,
		onNext: function (tour){
			$("#ModalCloseACVPS").click();
		},
      }, {
        element: ".SB_devicesVPS",
        title: "<b>GNet</b> | VPS",
        content: "Monitoriza el VPS.",
		placement: 'top',
      }, {
        element: "body",
        title: "Bienvenido a <b>GNet</b>",
        content: "Esperamos que con este breve recorrido haya conseguido instruirse sobre <b>GNet</b>. <br/><br/>¡El recorrido ha finalizado!.",
		placement: 'top',
		delay: 15000,
      }]
    });

    // Init the tour
    tour.init();

    // Start tour on click
    // $('#tour_start').on('click', function() {
      tour.restart();
    // });

</script>