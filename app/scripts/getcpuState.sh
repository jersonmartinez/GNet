NCPU=($(cat /proc/cpuinfo | grep -w processor | cut -d ':' -f2))
UsoUser=$(top -n1 -b | grep '%Cpu' | awk {'print $2'} | sed 's/,/./g')
UsoSystem=$(top -n1 -b | grep '%Cpu' | awk {'print $4'} | sed 's/,/./g')
if [[ ${#NCPU[*]} -gt 1 ]]; then
	NameModelOne=($(sed -n 1,10p /proc/cpuinfo | grep -w name | cut -d ':' -f2))
	echo "${NameModelOne[*]},$UsoUser,$UsoSystem,${#NCPU[*]},"
else
	NameModelTwo=($(cat /proc/cpuinfo | grep -w name | cut -d ':' -f2))
	echo "${NameModelTwo[*]},$UsoUser,$UsoSystem,${#NCPU[*]},"
fi