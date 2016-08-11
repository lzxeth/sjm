#!/bin/bash

VIP=(
    192.168.1.188
)

/etc/rc.d/init.d/functions

case "$1" in
start)
        echo "start LVS of REALServer"

        for ((i=0; i<`echo ${#VIP[*]}`; i++))
        do
                interface="lo:`echo ${VIP[$i]}|awk -F . '{print $4}'`"
                /sbin/ifconfig $interface ${VIP[$i]} broadcast ${VIP[$i]} netmask 255.255.255.255 up
        done
        echo "1" >/proc/sys/net/ipv4/conf/lo/arp_ignore
        echo "2" >/proc/sys/net/ipv4/conf/lo/arp_announce
        echo "1" >/proc/sys/net/ipv4/conf/all/arp_ignore
        echo "2" >/proc/sys/net/ipv4/conf/all/arp_announce
        ;;
stop)
        for ((i=0; i<`echo ${#VIP[*]}`; i++))
        do
                interface="lo:`echo ${VIP[$i]}|awk -F . '{print $4}'`"
                /sbin/ifconfig $interface down
        done
        echo "close LVS Directorserver"
        #echo "0" >/proc/sys/net/ipv4/conf/lo/arp_ignore
        #echo "0" >/proc/sys/net/ipv4/conf/lo/arp_announce
        #echo "0" >/proc/sys/net/ipv4/conf/all/arp_ignore
        #echo "0" >/proc/sys/net/ipv4/conf/all/arp_announce
        ;;
*)
        echo "Usage: $0 {start|stop}"
        exit 1
esac
