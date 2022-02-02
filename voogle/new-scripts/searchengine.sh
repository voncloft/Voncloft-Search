#!/bin/sh
IFS=$','
source /etc/voogle.conf
MONITORDIR="$paths"
for p in $paths
do
	echo "Adding watch path for $p"
	inotifywait -m -r -e create --format '%w%f' "${p}" | while read NEWFILE
	do
		sh /media/Websites/voogle/new-scripts/add.sh ${NEWFILE}
	done &
	inotifywait -m -r -e delete --format '%w%f' "${p}" | while read NEWFILE
	do
		sh /media/Websites/voogle/new-scripts/delete.sh ${NEWFILE}
	done &
done
