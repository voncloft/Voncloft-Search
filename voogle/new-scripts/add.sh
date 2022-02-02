source /etc/voogle.conf

new_file=$1
filename=$(basename "${new_file}")
location="$new_file"
extension="${filename##*.}"
mysql_path_pre="http://voncloft.com:90/all"
final_mysql_location="$mysql_path_pre$location"
case $extension in
	txt)
		mysql_ext="Text"
		;;
	mp3)
		mysql_ext="Audio"
		;;
	mkv|mp4|avi)
		mysql_ext="Video"
		;;
	*)
		mysql_ext="Misc"
esac
#echo $mysql_ext
#echo $final_mysql_location
command="insert into Filenames(filename,location,type,description) Values ('${filename}','${final_mysql_location}','${mysql_ext}','NEW')"
echo $command
mysql -u${username} -p${password} --database="Intranet" --execute="$command;"
echo "added $final_mysql_location to database"
