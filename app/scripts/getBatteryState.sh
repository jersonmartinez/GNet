Porcentaje=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep percentage | awk {'print $2'} | tr -d '%')
StatusBat=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep state | awk {'print $2'})
if [[ $Porcentaje == "" ]]; then
	echo "0,$StatusBat,"
else
	echo "$Porcentaje,$StatusBat,"
fi