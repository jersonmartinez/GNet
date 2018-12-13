## GNet (Monitorización y control de infraestructuras de redes)
Proyecto Web OpenSource, para la Gestión de Red y dispositivos informáticos (Servers, Firewalls, [...]) bajo GNU/Linux.
- - -

### **Instalación**
**Desde Vagrant**

Realizar un clón del proyecto Vagrant de Git y cambiarse al directorio [Vagrant-GNet](https://github.com/SideMasterGM/Vagrant/tree/master/Vagrant-GNet).
```bash
git clone https://github.com/SideMasterGM/Vagrant.git
cd Vagrant-GNet/
```

Realizar un clone GNet: 
```bash
git clone https://github.com/SideMasterGM/GNet.git
```

Correr el proyecto
```bash
vagrant up
```

Plugin que puede llegar a necesitar por si requiere realizar una sincronización bidireccional, utilizando `vagrant rsync-auto` o bien, `vagrant rsync-back` instalando el plugin [rsync-back](https://github.com/SideMasterGM/Vagrant/wiki/Plugins).

**Scripts de vital importancia**

|Nº | Nombre   | Descripción       | Dirección IP |
|----- | ------- | -------------------- | ------ |
|`1` | [Vagrantfile](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/Vagrantfile) | Configuración del entorno sobre la infraestructura de red | 192.168.0.0/24 |
|`2` | [db](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/db.sh) | Prepara el servidor de base de datos   | 192.168.0.10 |
|`3` | [web](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/web.sh) | Prepara el servidor de monitorización | 192.168.0.20 |
|`4` | [dns](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/dns.sh) | Prepara el servidor DNS (gnet.local - db.gnet.local) | 192.168.0.30 |

**Configurar DNS en la máquina anfitriona** 

Asignar la dirección IP DNS al adaptador de red que creó el proveedor de virtualización.

**``Desde la consola de Windows: ``**
```bash
netsh interface ipv4 set dns "VirtualBox Host-Only Network #2" static 192.168.0.30 > nul
```

**``Desde Linux (Ejmp: Debian)``**

Modificar como root el fichero `/etc/network/interfaces` y agregar la directiva:
```
dns-nameservers 192.168.0.30
```

Modificar el fichero `/etc/resolv.conf` agregando la directiva: `nameserver 192.168.0.30`

Para ambos OS, hacer el test: `nslookup gnet.local && nslookup db.gnet.local`

- - -

**Instalación manual**

Para este caso, la mejor opción es tomar los scripts [db](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/db.sh), [web](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/web.sh), [dns](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/dns.sh) e instalarlos, ya sea en una infraestructura con sistema distribuido o general.

Si desea entender y correr paso a paso, siga los pasos correspondientes que se muestran en el siguiente enlace sobre [cómo realizar la instalación manual](https://github.com/SideMasterGM/GNet/wiki/Principal---Instalaci%C3%B3n-manual).

- - -

### **GNet** `Interfaz gráfica`
Monitorización sobre los recursos del servidor web actual. 

**`Breve descripción`**
* Sobre el uso de recursos
    * Obtiene gráficos que representan: `Estado de la memoria `, `Área de intercambio (Swap) `, `Uso de disco `, `Uso de la CPU`.
* Obtiene información básica
    * `Información básica del sistema `, `sesiones iniciadas `, `Estado de batería `.
* Procesos
    * Todo los procesos inciados, expulsando información tal como: `PID `, `Nombre `, `CPU `, `Memoria `, `Tiempo `. 

![My Server 1](https://github.com/SideMasterGM/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/MyServer1.JPG)

Información sobre las conexiones de red

**`Breve descripción`**
* Conexión de red
    * Interfaz de redes y direcciones asignadas: `Interfaz de red `, `Dirección IP `, `Dirección MAC `.
    * Tabla de enrutamiento: `Red destino `, `Interfaz `, `Pasarela `.
    * Puertos abiertos: `Puerto `, `Protocolo `, `Tipo `, `Proceso `.
    * Estadísticas de red sobre los protocolos: `IP `, `TCP `, `UDP `.

![My Server 2](https://github.com/SideMasterGM/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/MyServer2.JPG)

Información sobre las conexiones de red

**`Breve descripción`**
* Servicio Web
    * Gráfico sobre número de accesos al servicio.
    * Servidor web y sitios virtuales: `Sitio Virtual `, `Nombre del dominio `, `Estado `.
    * Monitorización del servicio web: `Número de accesos `, `Conexiones establecidas `, `Conexiones en espera `, etc. 

![My Server 3](https://github.com/SideMasterGM/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/MyServer3.JPG)

![Topology](https://github.com/SideMasterGM/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/Topology.JPG)

![Machines](https://github.com/SideMasterGM/Vagrant/blob/SideMaster/Vagrant-GNet/Resources/Machines.JPG)

- - -
### Authors

* **Jerson A. Martínez M.** - *Ing. Telemática* - [LinkedIn - Jerson Martinez](https://www.linkedin.com/in/jersonmartinezsm/)

* **Frankier Y. Flores Z.** - *Ing. Telemática* - [LinkedIn - Frankier Flores](https://www.linkedin.com/in/frankier-flores-4b9b94108/)

#### YouTube Channels
* [**Side Master**](https://www.youtube.com/user/sidemastersupremo/) & [**Core Stack**](https://www.youtube.com/user/gvideosmtutorialesgm)