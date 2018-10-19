Net=$(ip route show | awk {'print $1'})
for i in ${Net[*]}; do
	Comp=$(ip route show | grep -w "$i" | grep -w via)
	if [[ $Comp != "" ]]; then
		Int=$(ip route show | grep -w "$i" | cut -d " " -f5)
		Salt=$(ip route show | grep -w "$i" | cut -d " " -f3)
		echo "$i|$Int|$Salt,"
	else
		Int=$(ip route show | grep -w "$i" | cut -d " " -f3)
		echo "$i|$Int|-,"
	fi
done