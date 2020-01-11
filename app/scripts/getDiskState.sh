FS=$(df -H | awk {'print $1'} | grep -w dev)
Disk=($(df -H "$FS" | sed "1d" | sed "s/,/./g" | tr -d "G"))
echo "${Disk[1]},${Disk[2]},${Disk[3]},"