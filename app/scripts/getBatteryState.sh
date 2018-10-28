Porcentaje=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep percentage | awk {'print $2'} | tr -d '%')
StatusBat=$(upower -i /org/freedesktop/UPower/devices/battery_BAT0 | grep state | awk {'print $2'})
echo "$Porcentaje,$StatusBat,"