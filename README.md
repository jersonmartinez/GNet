# GNet (Monitorización y control de red)
Proyecto Web OpenSource, para la Gestión de Red y dispositivos informáticos (Servers, Firewalls, [...]) bajo GNU/Linux.

### Prerrequisitos
Para utilizar este proyecto deberá tener instalado los siguientes servicios y herramientas.

```
1- Apache 2		| NGinx
2- PHP 4.3.0 		| >  superiores
3- libssh2		| https://libssh2.org/ 
4- MySQL		| MariaDB 
5- Git			| Descargar el paquete del proyecto.
```
Para no complicarse pueden instalar algún gestor de paquetes como WAMP(Windows), LAMPP (Linux) o XAMPP (Todas las plataformas).

## Instalación de Paquetes
Es necesario instalar lo siguientes paquetes, para eso dejaré las instrucciones.

### Repositorio
```
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
```

### Instalación en Debian

[Instalación de PHP7.2 con sus extensiones de Apache en Debian](https://github.com/SideMasterGM/GNet/wiki/Instalaci%C3%B3n-de-PHP7.2-con-sus-extensiones-de-Apache-en-Debian)

### Apache 2 (Web Server)
```
apt-get -y install apache2
```

### PHP 7 | Módulo Apache PHP
```
apt-get -y install php7.0 libapache2-mod-php7.0
```

### MySQL 5.7
```
apt-get -y install mysql-server mysql-client
mysql_secure_installation
```

Instrucción para crear un usuario: 
```
mysql -h 127.0.0.1 -u root -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'Side Master'@'127.0.0.1' IDENTIFIED BY 'MiClave' WITH GRANT OPTION";
```

### MariaDB 10
```
apt-get -y install mariadb-server mariadb-client
mysql_secure_installation
```

### MySQL | MariaDB para soportar PHP
```
apt-cache search php7.0
apt-get install -y php7.0-{mysql,curl,gd,intl,pear,imagick,imap,mcrypt,memcache,pspell,recode,sqlite3,tidy,xmlrpc,xsl,mbstring,gettext}
```

### phpMyAdmin
```
apt-get -y install phpmyadmin
```
Luego de haber instalado todos estos paquetes, tendrá un sistema flexible.

## Instalación del Proyecto
En caso de GNU / Linux. 
```
git clone https://github.com/SideMasterGM/GNet.git /var/www/html/GNet
```
Este proyecto en su forma funcional, es exclusivamente para ejecutarse en GNU/Linux.

Suponiendo que no tiene un host virtual asociado al proyecto, en primera instancia tendrá que acceder con la dirección IP local, ya sea localhost | 127.0.0.1, o bien, con la dirección IP que fue asignada por algún enrutador por medio de DHCP.

### Ejecución
Ejecutar el navegador y arrancar el software: 

```
https://127.0.0.1/GNet
```

### Creación de Base de Datos
Inicialmente, aparecerá la interfaz gráfica donde aparece un formulario de instalación. Este pide tener una base de datos creada.

Abrir una consola y escribir la siguiente instrucción. 
```
mysql -h 127.0.0.1 -u root -proot -e "CREATE DATABASE gnet;"
```
Luego sólo falta rellenar con los datos host: 127.0.0.1, usuario: root, contraseña: root, base de datos: gnet.

Verificar las credenciales en el fichero.
```
app/config/Config.tcb
Line 1: Host
Line 2: Username
Line 3: Password
Line 4: Database
Line 5: Prefix Database
```

### Usuario Administrador
El siguiente formulario es sobre rellenar las credenciales del usuario con privilegio administrador. Este aún no está finalizado, por lo que se deberá acceder por medio de Root.

Pasando de este punto, apareceré el login, ahí es donde te debes loguear. Sólo aquellos usuarios de confianza son permitidos, aunque claro, la pista está en el código.

### Habilitar la conexión SSH con el usuario Root
Para proceder a habilitar el usuario Root para la conexión SSH, por favor, [acceda a este documento](https://github.com/SideMasterGM/GNet/wiki/Habilitar-el-usuario-Root-con-SSH).

## Documentación de Aplicaciones
### Las prácticas en desarrollo son las siguientes: 
```
1. Tracking Network
2. Agregar dispositivos de telecomunicaciones manualmente
3. Control de usuarios | Seguridad de Login
4. Obtención de información de los equipos
5. Recolección de Logs
6. Backups y Restores (Base de datos y configuración de servicios)
```
Fuente: [Acceder a los desarrollos](https://github.com/SideMasterGM/GNet/wiki/Desarrollos)

Tracking Network (Autodescubrimiento de dispositivos interconectados en Red): [acceda a este documento](https://github.com/SideMasterGM/GNet/wiki/Tracking-Network-(Autodescubrimiento-de-dispositivos-interconectados-en-Red))

### Incrustar nuevo código
Desarrollar nuevo espacio de trabajo (Dashboard): [acceda a este documento](https://github.com/SideMasterGM/GNet/wiki/Desarrollar-nuevo-espacio-de-trabajo-(Dashboard)).

## Authors

* **Jerson A. Martínez M.** - *Ing. Telemática (Redes, Telecomunicaciones y Desarrollo de Software)* - [LinkedIn - Jerson Martinez](https://www.linkedin.com/in/jersonmartinezsm/)

* **Frankier Y. Flores Z.** - *Ing. Telemática (Redes, Telecomunicaciones y Desarrollo de Software)* - [LinkedIn - Frankier Flores](https://www.linkedin.com/in/frankier-flores-4b9b94108/)

### YouTube Channels

* **Side Master** - *Formador en YouTube | Canal de contenido variado sobre Informática (Shell Script, Programación, Hacking, Networking, etc.)* - [Channel - Side Master](https://www.youtube.com/user/sidemastersupremo/)

* **Core Stack** - *Formador en YouTube | Canal de contenido variado sobre Informática (Shell Script, Programación, Hacking, Networking, etc.)* - [Channel - Core Stack](https://www.youtube.com/user/gvideosmtutorialesgm)