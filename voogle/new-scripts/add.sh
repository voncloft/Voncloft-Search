source /etc/voogle.conf
#echo "${1}" >> /var/log/search_engine_events
new_file=$1
filename=$(basename "${new_file}")
location="$new_file"
extension="${filename##*.}"
final_mysql_location="$mysql_path_pre$location"
#echo "Size" $sizeinbytes >> /var/log/search_engine_events
case $extension in
	txt)
		mysql_ext="text"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	mp3)
		mysql_ext="audio"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	mkv|mp4|avi)
		mysql_ext="video"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	html)
		mysql_ext="hypertext"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	sh)
		mysql_ext="shell"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	php)
		mysql_ext="php"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	log)
		mysql_ext="log"
		sizeinbytes=$(du -b "$1" | cut -f1)
		;;
	*)
		mysql_ext="misc"
		sizeinbytes="0"
esac
#echo $mysql_ext
#echo $final_mysql_location
command="insert into Filenames(filename,location,type,description,sizeinbytes) Values ('${filename}','${final_mysql_location}','${mysql_ext}','NEW','${sizeinbytes}')"
echo $command
mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
echo "added $final_mysql_location to database" >> /var/log/search_engine_events
echo "$command" >> /var/log/search_engine_events
