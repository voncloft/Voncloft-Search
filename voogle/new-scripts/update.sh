source /etc/voogle.conf
mysql_path_pre="http://voncloft.com:90/all"
final_mysql_location=$mysql_path_pre$1
new_file=$(echo $2 | sed "s/ISDIR\,//g")
old_file=$(echo $1 | sed "s/ISDIR\,//g")
echo $folder_check >> /var/log/search_engine_events
filename=$(basename "${new_file}")
location="$new_file"
extension="${filename##*.}"
if [[ ! -z $1 ]];then
	sizeinbytes=$(du -b "$new_file" | cut -f1)
	command="update Filenames set location='${mysql_path_pre}${new_file}',filename='${filename}',sizeinbytes='$sizeinbytes'  where location = '${mysql_path_pre}${old_file}'" 
		
	echo $command
	mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
	echo "$1 updated final location" >>  /var/log/search_engine_events.log
	echo "$command" >> /var/log/search_engine_events.log
fi
