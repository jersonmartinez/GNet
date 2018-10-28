IP=($(netstat -s | grep -w Ip: -A8 | sed '1,2d' | awk {'print $1'}))
echo "${IP[*]} "
echo "="
TCP=($(netstat -s | grep -w Tcp: -A10 | sed '1d' | awk {'print $1'}))
echo "${TCP[*]} "
echo "="
UDP=($(netstat -s | grep -w Udp: -A6 | sed '1d' | awk {'print $1'}))
echo "${UDP[*]} "
echo "="