Ports=($(lsof -i -nP | sed '1d' | egrep -v '(ESTAB|WAIT)' | awk {'print $9 ,$8 ,$5 ,$1'} | cut -d':' -f2 | uniq))
echo "${Ports[*]},"