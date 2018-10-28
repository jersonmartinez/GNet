Proc=($(ps axo pid,pcpu,size,time,cmd --sort -pcpu | sed '1d' | awk {'print $1 ,$2 ,$3 ,$4 ,$5'}))
echo "${Proc[*]},"