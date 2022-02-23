source /etc/voogle.conf
new_file="$1"
filename=$(basename "${new_file}")
location="$new_file"
final_mysql_location="$mysql_path_pre$location"
sizeinbytes=$(du -b "$1" | cut -f1)
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
	*.log|*.log.*)
		mysql_ext="log"
		;;
	SPKGBUILD)
		mysql_ext="spkgbuild"
		;;
	CHANGELOG)
		mysql_ext="CHANGELOG"
		;;
	*)
		mysql_ext="directory"
		sizeinbytes="0"
		;;
esac
if [ -z $sizeinbytes ];then
	echo "Byte size was null" >> /var/log/search_engine_events.log
	sizeinbytes="0"
fi
	
command="insert into Filenames(filename,location,type,description,sizeinbytes) Values ('${filename}','${final_mysql_location}','${mysql_ext}','NEW','${sizeinbytes}')"
echo $command
mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
echo "added $final_mysql_location to database" >> /var/log/search_engine_events.log
echo "$command" >> /var/log/search_engine_events.log
