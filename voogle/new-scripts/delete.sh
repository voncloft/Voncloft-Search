source /etc/voogle.conf
mysql_path_pre="http://voncloft.com:90/all"
final_mysql_location=$mysql_path_pre$1

command="delete from Filenames where location ='$final_mysql_location'" 
echo $command
mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
echo "$1 deleted from database"
echo "$command" >> /var/log/old/search_engine_events
