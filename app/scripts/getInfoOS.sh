HostName=$(hostname)
NameOs=$(lsb_release -si)
Version=$(lsb_release -sr)
TypeMachine=$(uname -m)
Kernel=$(uname -r)
echo "$HostName,$NameOs,$Version,$TypeMachine,$Kernel,"