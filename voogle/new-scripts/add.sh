source /etc/voogle.conf
echo "path: ${1}" >> /var/log/search_engine_events
new_file="$1"
filename=$(basename "${new_file}")
location="$new_file"
final_mysql_location="$mysql_path_pre$location"
sizeinbytes=$(du -b "$1" | cut -f1)
echo "Extension"$extension >>  /var/log/search_engine_events
	case $filename in
	*.txt)
		mysql_ext="text"
		;;
	*.mp3)
		mysql_ext="audio"
		;;
	*.mkv|*.mp4|*.avi)
		mysql_ext="video"
		;;
	*.html)
		mysql_ext="hypertext"
		;;
	*.sh)
		mysql_ext="shell"
		;;
	*.php)
		mysql_ext="php"
		;;
	*.log)
		mysql_ext="log"
		;;
	*)
		mysql_ext="misc"
		sizeinbytes="0"
		;;

	esac
#echo $mysql_ext
#echo $final_mysql_location
command="insert into Filenames(filename,location,type,description,sizeinbytes) Values ('${filename}','${final_mysql_location}','${mysql_ext}','NEW','${sizeinbytes}')"
echo $command
mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
echo "added $final_mysql_location to database" >> /var/log/search_engine_events
echo "$command" >> /var/log/search_engine_events
