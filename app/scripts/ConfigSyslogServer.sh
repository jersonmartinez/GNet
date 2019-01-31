Servidor=$1 DB=$2 User=$3 Pass=$4 Severity=$5 FileConf="/etc/rsyslog.d/mysql.conf"
echo "$"ModLoad imtcp > $FileConf
echo "$"InputTCPServerRun 514 >> $FileConf
echo "$"ModLoad ommysql >> $FileConf
case $5 in
	"emergencia")
		echo "*.emerg :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"alerta")
		echo "*.alert :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"critico")
		echo "*.crit :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"error")
		echo "*.err :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"advertencia")
		echo "*.warn :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"notificacion")
		echo "*.notice :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"informacion")
		echo "*.info :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"depuracion")
		echo "*.debug :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
	"todo")
		echo "*.emerg :ommysql:localhost,$DB,$User,$Pass" >> $FileConf
	;;
esac
service rsyslog restart