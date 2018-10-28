Interfaces=($(ip addr show | egrep "[1-9]: " | cut -d ":" -f2 | tr -d " "))
for i in ${Interfaces[*]}; do
	DirIP=$(ip addr show "$i" | grep -w inet | cut -d " " -f6 | cut -d "/" -f1)
	Ether=$(ip addr show "$i" | grep -w ether | cut -d " " -f6)
	if [[ $DirIP != "" ]]; then
		echo "$i|$DirIP|$Ether,"
	else
		echo "$i|No tiene IP asignada|$Ether,"
	fi
done