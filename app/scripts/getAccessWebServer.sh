hs=(0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0)
for h in $(cat /var/log/apache2/access.log | cut -d '[' -f2 | cut -d ']' -f1 | cut -d ' ' -f1 | cut -d ':' -f2 | sed 's/^0//'); do
	(( hs[$h]++ ))
done
hora="0"
for h3 in ${hs[@]}; do
	echo "$h3,"
	(( hora++ ))
done