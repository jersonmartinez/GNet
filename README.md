# GNet (Monitorización y control de red)
Web System of Network Management, Servers and Firewalls under GNU/Linux. 

## Desarrollar nuevo espacio

Las formas básicas para desarrollar un nuevo espacio de trabajo en el software, a nivel de programación, es de la siguiente manera: 

### Script de Selección de Privilegios
En el fichero core/ic.desktop.php: Este hace referencia al escritorio, invocando al fichero PD_DESKTOP_ROOT."/main.php".

### Script de constantes de rutas
Esta es la instrucción PHP que se necesita para invocar al script que maneja las rutas absolutas de cada uno de los directorios de importancia. Este fichero es necesario la utilización de las rutas. 

```
#Importar constantes.
@session_start();
include (@$_SESSION['getConsts']);
```

### Agregar un nuevo elemento en el menú
Apuntar al directorio de Root: PD_DESKTOP_ROOT."/main.php".
Este fichero apunta al fichero: PD_DESKTOP_ROOT_PHP."/ic.sidebar_menu.php".

Agregar un sólo elemento. 
```
<li>
    <a href="#" id="sb_item_TrackingNetwork">
        <span class="fa fa-calendar"></span>
        <span class="sidebar-title">Autodescubrimiento</span>
    </a>
</li>
```

Agregar elementos con sub elementos.
```
<li>
    <a class="accordion-toggle" href="#">
        <span class="glyphicon glyphicon-book"></span>
        <span class="sidebar-title">Documentación</span>
      
        <span class="caret"></span>
    </a>

    <ul class="nav sub-nav">
        <li>
            <a href="#" id="sidebar_show_documentation">
                <span class="glyphicon glyphicon-eye-open"></span>
                Mostrar
            </a>
        </li>
        
        <li>
            <a href="#" id="sidebar_redactDocumentation">
                <span class="glyphicon glyphicon-text-height"></span>
                Redactar
            </a>
        </li>
      
    </ul>
</li>
```

### Capturando evento de clic del elemento | JS (JQuery)
Por omisión, la librería de JQuery está agregada.

Se le agrega un identificador al elemento, así específicamente.
```
<li>
    <a href="#" id="sb_item_MiIdentificador">
        <span class="fa fa-calendar"></span>
        <span class="sidebar-title">Nuevo elemento</span>
    </a>
</li>
```
Le describo un poco, sb_item = elemento del sidebar.

Se dirige al fichero Script JS llamado: PD_DESKTOP_ROOT_JS."/ic.RootScript.js". 

Agregar la siguiente instrucción:
```
$("#sb_item_MiIdentificador").click(function(){
	NProgress.start();
	$.ajax({
		url: "app/Desktop/Root/graphic/gn.MiIdentificador.php",
		success: function(data){
			$("div.container_platform").html(data);
			NProgress.done();
		}
	});
});
```

Se escucha el evento click del elemento con el identificador. Luego se aplica la barra de carga superior, mientras está en ejecución una petición Ajax al fichero de diseño que debe estar elojado sí o sí en el directorio: PD_DESKTOP_ROOT_GP. Luego de obtener la información solicitada, se envía el diseño al contenedor tipo DIV con la clase "container_platform", este se encuentra en el fichero: PD_DESKTOP_ROOT_PHP."/ic.content_main.php". Cuando el servidor devuelva la información, he ahí donde la barra de carga llega a 100%.

Hasta ahí, no hay más que hacer, sólo queda diseñar en el fichero donde se le hace la petición.