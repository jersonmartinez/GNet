## GNet (Monitorización y control de infraestructuras de redes)
Proyecto Web OpenSource, para la Gestión de Red y dispositivos informáticos (Servers, Firewalls, [...]) bajo GNU/Linux.
- - -

### **Instalación**
**Desde Vagrant**

Realizar un clón del proyecto Vagrant de Git y cambiarse al directorio [Vagrant-GNet](https://github.com/SideMasterGM/Vagrant/tree/master/Vagrant-GNet).
```
git clone https://github.com/SideMasterGM/Vagrant.git
cd Vagrant-GNet/
```

Realizar un clone GNet: 
```
git clone https://github.com/SideMasterGM/GNet.git
```

Correr el proyecto
```
vagrant up
```

Ficheros de vital importancia
|Nº | Nombre   | Descripción       |
|----- | ------- | -------------------- |
|`1` | [Vagrantfile](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/Vagrantfile)  | Configuración del entorno sobre la infraestructura de red |
|`2` | [db](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/db.sh) | Prepara el servidor de base de datos   |
|`3` | [web](https://github.com/SideMasterGM/Vagrant/blob/master/Vagrant-GNet/ProvisionScripts/web.sh) | Prepara el servidor de monitorización |

- - -

**Instalación manual**

Siga todos los pasos correspondientes que se muestran en el siguiente enlace sobre [cómo realizar la instalación manual](https://github.com/SideMasterGM/GNet/wiki/Principal---Instalaci%C3%B3n-manual).

- - -
### Authors

* **Jerson A. Martínez M.** - *Ing. Telemática* - [LinkedIn - Jerson Martinez](https://www.linkedin.com/in/jersonmartinezsm/)

* **Frankier Y. Flores Z.** - *Ing. Telemática* - [LinkedIn - Frankier Flores](https://www.linkedin.com/in/frankier-flores-4b9b94108/)

#### YouTube Channels
* [**Side Master**](https://www.youtube.com/user/sidemastersupremo/) & [**Core Stack**](https://www.youtube.com/user/gvideosmtutorialesgm)