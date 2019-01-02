Servidor=$1
FileConf="/etc/rsyslog.d/gnet_syslog.conf"
echo "*.*	@@$Servidor:514" > $FileConf
service rsyslog restart