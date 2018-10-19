Disk=($(df -H /dev/sda1 | sed "1d" | sed "s/,/./g" | tr -d "G"))
echo "${Disk[1]},${Disk[2]},${Disk[3]},"