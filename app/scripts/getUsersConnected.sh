Users=($(w | sed '1,2d' | awk {'print $1 ,$4'}))
echo "${Users[*]},"