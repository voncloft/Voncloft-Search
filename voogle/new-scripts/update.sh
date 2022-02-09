source /etc/voogle.conf
mysql_path_pre="http://voncloft.com:90/all"
final_mysql_location=$mysql_path_pre$1

command="update Filenames set location='${mysql_path_pre}$2' where location = '${mysql_path_pre}$1'" 
echo $command
mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
echo "$1 updated final location"
echo "$command" >> /var/log/old/search_engine_events
