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
	inotifywait -m -r -e move --format "%e,%w%f" ${p} |  while read evt file;
	do
    	echo "Event: $evt, Dir: $dir File: $file"

    	if [[ $evt == "MOVED_FROM" ]];then
        	original_file="$file"
    	else
        	new_file="$file"
        	sh /media/Websites/voogle/new-scripts/update.sh "$original_file" "$new_file"
		echo "update Filenames set location='$new_file' where location = '$original_file'"
    	fi
	done &
done
