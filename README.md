## GNet
Sistema Web de Gestión de Red de Dispositivos Informáticos GNU/Linux.
- - -

### **Instalación**
**Desde Vagrant**

Realizar un clón del proyecto Vagrant de Git y cambiarse al directorio [Vagrant-GNet](https://github.com/jersonmartinez/Vagrant/tree/master/Vagrant-GNet).
```bash
git clone https://github.com/jersonmartinez/Vagrant.git
cd Vagrant/Vagrant-GNet/
```

Realizar un clone GNet: 
```bash
git clone https://github.com/jersonmartinez/GNet.git
```

¿Listo?, ¡estupendo!, empieza por hacer el `vagrant up` de Vagrant.

Plugin que puede llegar a necesitar por si requiere realizar una sincronización bidireccional, utilizando `vagrant rsync-auto` o bien, `vagrant rsync-back` instalando el plugin [rsync-back](https://github.com/SideMasterGM/Vagrant/wiki/Plugins).

**Scripts de vital importancia**

|Nº | Nombre   | Descripción       | Dirección IP |
|----- | ------- | -------------------- | ------ |
|`1` | [Vagrantfile](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/Vagrantfile) | Configuración del entorno sobre la infraestructura de red | 192.168.2.0/24 |
|`2` | [db](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/db.sh) | Prepara el servidor de base de datos   | 192.168.2.10 |
|`3` | [web](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/web.sh) | Prepara el servidor de monitorización | 192.168.2.20 |
|`4` | [dns](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/dns.sh) | Prepara el servidor DNS (gnet.local - db.gnet.local) | 192.168.2.30 |

**Configurar DNS en la máquina anfitriona** 

Asignar la dirección IP DNS al adaptador de red que creó el proveedor de virtualización.

**``Desde la consola de Windows: ``**
```bash
netsh interface ipv4 set dns "VirtualBox Host-Only Network #2" static 192.168.2.30 > nul
```

**``Desde Linux (Ejmp: Debian)``**

Modificar como root el fichero `/etc/network/interfaces` y agregar la directiva:
```
dns-nameservers 192.168.2.30
```

Modificar el fichero `/etc/resolv.conf` agregando la directiva: `nameserver 192.168.2.30`

Para ambos OS, hacer el test: `nslookup gnet.local && nslookup db.gnet.local`

**Instalación de soporte de Rsyslog para MySQL**

**`En el servidor de bases de datos ejecuta:`**
```
sudo apt install rsyslog-mysql
```

El asistente de instalación preguntará si deseas configurar la base de datos para `rsyslog-mysql` con dbconfig-common. Debes indicarle que **NO**.

- - -
**Demostración**

[![GNet](https://i.ibb.co/H2bxMbk/GNet-Min.png)](https://www.youtube.com/watch?v=d1Zt3-J0bpI "GNet")

**Instalación manual**

Para este caso, la mejor opción es tomar los scripts [db](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/db.sh), [web](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/web.sh), [dns](https://github.com/jersonmartinez/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/dns.sh) e instalarlos, ya sea en una infraestructura con sistema distribuido o general.

Si desea entender y correr paso a paso, siga los pasos correspondientes que se muestran en el siguiente enlace sobre [cómo realizar la instalación manual](https://github.com/jersonmartinez/GNet/wiki/Principal---Instalaci%C3%B3n-manual).

- - -

### **GNet** `Interfaz gráfica`
Monitorización sobre los recursos del servidor web actual. 

**`Breve descripción`**
* Sobre el uso de recursos
    * Obtiene gráficos que representan: `Estado de la memoria`, `Área de intercambio (Swap)`, `Uso de disco`, `Uso de la CPU`.
* Obtiene información básica
    * `Información básica del sistema`, `sesiones iniciadas`, `Estado de batería`.
* Procesos
    * Todo los procesos inciados, expulsando información tal como: `PID`, `Nombre`, `CPU`, `Memoria`, `Tiempo`. 

![Monitoring](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/Monitoring/1.PNG)

Información sobre las conexiones de red

**`Breve descripción`**
* Conexión de red
    * Interfaz de redes y direcciones asignadas: `Interfaz de red`, `Dirección IP`, `Dirección MAC`.
    * Tabla de enrutamiento: `Red destino`, `Interfaz`, `Pasarela`.
    * Puertos abiertos: `Puerto`, `Protocolo`, `Tipo`, `Proceso`.
    * Estadísticas de red sobre los protocolos: `IP`, `TCP`, `UDP`.

![Monitoring](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/Monitoring/2.PNG)

Información sobre las conexiones de red

**`Breve descripción`**
* Servicio Web
    * Gráfico sobre número de accesos al servicio.
    * Servidor web y sitios virtuales: `Sitio Virtual`, `Nombre del dominio`, `Estado`.
    * Monitorización del servicio web: `Número de accesos`, `Conexiones establecidas`, `Conexiones en espera`, etc. 

Monitorización y sondeo de los dispositivos interconectados en la infraestructura de red.

**`Breve descripción`**
* Mapa de Red: 
    * Tracking Network (Aplica un sondeo en la red para encontrar dispositivos), sondeando en: `Redes privadas`, `Redes públicas`; refiriéndose así, a autodescubrir dentro de las posibilidades de los adaptadores que tenga instalado el sistema. 
    * Topología: `Autogenerada`, `Configurable`, `Usabilidad con clusters de red`, etc. 
    * Capacidad de monitorización: `Información completa` (similar a la información que se obtiene de la monitorización del servidor web), `Red`, `Procesos`, `Propiedades del equipo`, etc. 
    * Capacidad de realizar un sondeo normal y un sondeo profundo, capaz de encontrar host con distintos tipos de OS, igualmente si se tiene un Firewall. Obtiene datos cómo: `Dirección MAC`, `Sistema Operativo`, `Estado del dispositivo`, `Puertos abiertos`, `Enumeración CPE`, `Paquetes transitados` y `Saltos y tiempos de escaneo`.

![TrackingNetwork](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/TrackingNetwork/7.PNG)

Gestión de dispositivos que han sido almacenados en el banco de datos.

**`Breve descripción`**
* Gestión de dispositivos: 
    * Vista gráfica y selección: `Menú contextual`
    * Clasificación de dispositivos: `Enrutadores `, `Conmutadores  `, `Dispositivoss finales`, etc. 
    * Capacidad de monitorización: `Información completa` (similar a la información que se obtiene de la monitorización del servidor web), `Red`, `Procesos`, `Propiedades del equipo`, etc. 
    * Verificación de actividad: `ICMP`, `TCP`, `UDP`, `SSH`.
    * Configurar alias en los dispositivos.

![ManagementDevices](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/ManagementDevices/GNet%20-%20Gesti%C3%B3n%20de%20dispositivos.PNG)

Gestión de eventos en los dispositivos asignados a escuchar.

**`Breve descripción`**
* Gestión de eventos: 
    * Vista gráfica: `Menú de selección de severidad`
    * Filtrado por severidad: `Información `, `Aviso`, `Advertencia`, `Error`, `Crítico`, `Alerta`, `Emergencia`.
    * Obtienes gráficos de eventos.
    * Cantidad de eventos recibidos por cada dispositivo.

![ManagementDevices](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/ManagementEvents/2.PNG)

Adjunto un screenshot sobre el gráfico de eventos gestionados: 

![ManagementDevices](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/ManagementEvents/3.PNG)

Preparación de una tarea programada para la gestión de eventos con Syslog: 

![ManagementDevices](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/ManagementEvents/4.PNG)

Finalmente, tenemos una utilidad interesante; y es precisamente la de gestionar VPS (Virtual Private Server). Siguiendo la misma idea de monitorización y control del primer apartado a los dispositivos.

**`Breve descripción`**
* Gestión de eventos: 
    * Sobre el uso de recursos
    * Obtiene gráficos que representan: `Estado de la memoria`, `Área de intercambio (Swap)`, `Uso de disco`, `Uso de la CPU`.
    * Obtiene información básica
    * `Información básica del sistema`, `sesiones iniciadas`, `Estado de batería`.
    * Procesos
    * Todo los procesos inciados, expulsando información tal como: `PID`, `Nombre`, `CPU`, `Memoria`, `Tiempo`. 

![VPS](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/VPS/1.PNG)

Obteniendo el resultado final: 

![VPS](https://github.com/jersonmartinez/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/VPS/2.PNG)

Estas han sido algunas represenaciones gráficas que se muestran ante el SysAdmin o DevOps o el respectivo responsable de estar al tanto de la infraestructura a cargo de GNet.

Es un proyecto en desarrollo (Open Source) y si deseas colaborar, te invitamos a que empieces por hacer fork.

**Encuéntranos en nuestro sitio oficial**

Si deseas conocer más información acerca de GNet, revisa [FullDevOps / GNet](https://www.fulldevops.es/gnet) e infórmate un poco más.

- - -
### Serie de GNet en FullDevOps

* [GNet #1: Descripción y resumen de funcionalidades](https://www.youtube.com/watch?v=E2viVr901EQ)

* [GNet #2: Instalación y configuración inicial](https://www.youtube.com/watch?v=4CwW6t14Sf0)

* [GNet #3: Autodescubrimiento](https://youtu.be/h1upInacUfE)

* [FullDevOps / GNet / Videos](https://www.fulldevops.es/gnet/videos/)

- - -
### Autores

✔ Ing. Jerson Martínez ( 💌 jersonmartinezsm@gmail.com )

<a href="https://www.fulldevops.es/?suscribirse" target="_blank"><img alt="FullDevOps" src="https://img.shields.io/twitter/url?color=9cf&label=%40FullDevOps&logo=FullDevOps&logoColor=informational&style=for-the-badge&url=https%3A%2F%2Ftwitter.com%2Fantoniomorenosm"></a>
<a href="https://www.youtube.com/user/gvideosmtutorialesgm/videos" target="_blank"><img alt="YouTube Channel - Core Stack" src="https://img.shields.io/twitter/url?color=red&label=%40Core%20Stack&logo=Side%20Master&logoColor=yellow&style=for-the-badge&url=https%3A%2F%2Ftwitter.com%2Fantoniomorenosm"></a>
<a href="https://www.youtube.com/user/sidemastersupremo/videos" target="_blank"><img alt="YouTube Channel - Side Master" src="https://img.shields.io/twitter/url?color=red&label=%40Side%20Master&logo=Side%20Master&logoColor=yellow&style=for-the-badge&url=https%3A%2F%2Ftwitter.com%2Fantoniomorenosm"></a>

<a href="https://twitter.com/antoniomorenosm" target="_blank"><img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/antoniomorenosm?label=S%C3%ADgueme%20en%20%40frankierflores&style=social"></a>

[(LinkedIn)](https://www.linkedin.com/in/jersonmartinezsm/)

<a href="https://twitter.com/frankierflores" target="_blank"><img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/frankierflores?label=S%C3%ADgueme%20en%20%40frankierflores&style=social"></a>

✔ Ing. Frankier Flores  [(LinkedIn)](https://www.linkedin.com/in/frankier-flores-4b9b94108/)
