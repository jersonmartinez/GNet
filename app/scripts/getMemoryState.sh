MEMORIA=($(free -m | grep 'Mem' | cut -d ':' -f2))
echo "${MEMORIA[0]},${MEMORIA[1]},${MEMORIA[2]},"