SWAP=($(free -m | egrep '(Intercambio|Swap)' | cut -d ':' -f2))
echo "${SWAP[0]},${SWAP[1]},${SWAP[2]},"