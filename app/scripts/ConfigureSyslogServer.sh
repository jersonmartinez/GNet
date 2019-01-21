Servidor=$1 DB=$2 User=$3 Pass=$4 Severidad=$5 FileConf="/etc/rsyslog.d/mysql.conf"

echo "$"ModLoad imtcp > $FileConf
echo "$"InputTCPServerRun 514 >> $FileConf
echo "$"ModLoad ommysql >> $FileConf
case $5 in
	"emergencia")
		echo "*.emerg ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"alerta")
		echo "*.alert ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"critico")
		echo "*.crit ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"error")
		echo "*.err ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"advertencia")
		echo "*.warn ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"notificacion")
		echo "*.notice ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"informacion")
		echo "*.info ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"depuracion")
		echo "*.debug ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
	"todo")
		echo "*.* ommysql:$Servidor,$DB,$User,$Pass" >> $FileConf
	;;
esac

service rsyslog restart