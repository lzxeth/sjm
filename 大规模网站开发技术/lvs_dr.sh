RIP1=192.168.1.110
RIP2=192.168.1.111
RIP3=192.168.1.112

VIP1=192.168.1.188
	
/etc/rc.d/init.d/functions

case "$1" in

start)
echo " start LVS of DirectorServer"

# set the Virtual IP Address and sysctl parameter
/sbin/ifconfig eth0:0 $VIP1 broadcast $VIP1 netmask 255.255.255.0 up
#/sbin/route add -host $VIP1 dev eth0:0
echo "1" >/proc/sys/net/ipv4/ip_forward

#Clear IPVS table
/sbin/ipvsadm -C

#set LVS
#Web Apache
/sbin/ipvsadm -A -t $VIP1:80 -s rr
/sbin/ipvsadm -a -t $VIP1:80 -r $RIP1:80 -g
/sbin/ipvsadm -a -t $VIP1:80 -r $RIP2:80 -g
/sbin/ipvsadm -a -t $VIP1:80 -r $RIP3:80 -g

#Run LVS
/sbin/ipvsadm -Ln
;;
stop)
echo "close LVS Directorserver"
echo "0" >/proc/sys/net/ipv4/ip_forward
/sbin/ipvsadm -C
/sbin/ifconfig eth0:0 down

;;
*)
echo "Usage: $0 {start|stop}"
exit 1
esac 
