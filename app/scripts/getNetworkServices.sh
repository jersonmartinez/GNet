Services=$(lsof -i -n | egrep -v '(ESTAB|WAIT)' | sed '1d' | awk {'print $1'} | uniq)
echo "${Users[*]},"
for i in ${Services[*]}; do
case $i in
"sshd" )
echo "SSH,"
;;
"apache2" )
echo "HTTP,"
;;
"mysqld" )
echo "MySQL,"
;;
"named" )
echo "DNS,"
;;
"vsftpd" )
echo "FTP,"
;;
esac
done