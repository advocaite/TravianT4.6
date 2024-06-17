#!/bin/sh
# chkconfig: 345 95 5
. /etc/init.d/functions
test -x [SERVER_BASH_LOCATION] || exit 0RETVAL=0
prog=[SERVER_WORLD_ID]Daemon
proc=[SERVER_PID_LOCATION]
bin=[SERVER_BASH_LOCATION]
start() {
	# Check if Daemon is already running
	if [ ! -f $proc ]; then
	    echo -n $"Starting $prog: "
	    daemon $bin
	    RETVAL=$?
	    [ $RETVAL -eq 0 ] && touch $proc
	    echo
	fi
	    return $RETVAL
}

stop() {
	echo -n $"Stopping $prog: "
	killproc $bin
	RETVAL=$?
	[ $RETVAL -eq 0 ] && rm -f $proc
	echo
        return $RETVAL
}

restart() {
	stop
	start
}

reload() {
	restart
}

status_at() {
 	status $bin
}

case "$1" in
start)
	start
	;;
stop)
	stop
	;;
reload|restart)
	restart
	;;
condrestart)
        if [ -f $proc ]; then
            restart
        fi
        ;;
status)
	status_at
	;;
*)

echo $"Usage: $0 {start|stop|restart|condrestart|status}"
	exit 1
esac

exit $?
exit $RETVAL