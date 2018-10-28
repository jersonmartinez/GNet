Sites=($(ls /etc/apache2/sites-available/))
for i in ${Sites[*]}; do
	ServerName=$(cat /etc/apache2/sites-available/$i | grep "ServerName" | cut -d " " -f2 | tail -n1)
	SitesEnable=$(ls /etc/apache2/sites-enabled/ | grep "$i")
	if [[ $SitesEnable == "" && $ServerName == "" ]]; then
		echo "$i|No identificado|No habilitado,"
	else
		echo "$i|$ServerName|Habilitado,"
	fi
done
echo "="
NumAccesos=$(cat /var/log/apache2/access.log | wc -l)
ConHttp=$(lsof -i -nP | egrep '(CONNECTED|ESTAB)' | grep '80' | wc -l)
ConHttps=$(lsof -i -nP | egrep '(CONNECTED|ESTAB)' | grep '443' | wc -l)
TimeWaitHttp=$(lsof -i -nP | grep TIME_WAIT | grep '80' | wc -l)
TimeWaitHttps=$(lsof -i -nP | grep TIME_WAIT | grep '443' | wc -l)
APID=$(ps axo pid,cmd,user | grep apache2 | grep root | grep -v $0 | grep -v g | cut -d' ' -f2)
DateInit=$(ls -od --time-style=+%d-%m-%y,%H-%M /proc/ | cut -d' ' -f5)
CantRestart=$(cat /var/log/apache2/*.log | grep 'resuming normal operations' | wc -l)
echo "$NumAccesos,$ConHttp,$ConHttps,$TimeWaitHttp,$TimeWaitHttps,$DateInit,$CantRestart,"