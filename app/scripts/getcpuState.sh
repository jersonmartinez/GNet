NameModel=($(cat /proc/cpuinfo | grep name | cut -d ':' -f2))
UsoUser=$(top -n1 -b | grep '%Cpu' | awk {'print $2'} | sed 's/,/./g')
UsoSystem=$(top -n1 -b | grep '%Cpu' | awk {'print $4'} | sed 's/,/./g')
TotalProc=$(ps ax | wc -l)
echo "${NameModel[*]},$UsoUser,$UsoSystem,$TotalProc,"