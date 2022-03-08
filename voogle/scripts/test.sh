#This is the script that starts everything for the search engine, it is a "spider"
source /etc/voogle.conf
sh ./build_index.sh
rm -rf ./woot2.txt
echo "use Intranet;" >> woot2.txt
echo "delete from Filenames;" >> woot2.txt
input="./files.txt"
while IFS= read -r var
do
	for file in "$var"/*;
 		do
		rootpath=${file%/*}
		fullpath="$file"
		easylook=${fullpath#${rootpath}/}
		#extension=$file | awk -F . '{print $NF}'
		
		
		  filename="${fullpath##*/}"                      # Strip longest match of */ from start
		  dir="${fullpath:0:${#fullpath} - ${#filename}}" # Substring from 0 thru pos of filename
		  base="${filename%.[^.]*}"                       # Strip shortest match of . plus at least one non-dot char from end
		  ext="${filename:${#base} + 1}"                  # Substring from len of base thru end
		  if [[ -z "$base" && -n "$ext" ]]; then          # If we have an extension and no base, it's really the base
		      base=".$ext"
		      ext=""
		  fi
		  echo $file
		  three=""
		  if [ $ext = "mp3" ] || [ $ext = "wav" ]
		  then
		    types="audio"
		  elif [ $ext = "mkv" ] || [ $ext = "mpg" ] || [ $ext = "avi" ] || [ $ext = "flv" ] || [ $ext = "wmv" ] || [ $ext = "mp4" ]
		  then
		    types="video"
		  elif [ $ext = "txt" ] || [ $ext = "htm" ] || [ $ext = "html" ]
		  then
		    types="text"
		    line=$(<$file)
		    three=$(echo $line | sed 's/[^a-zA-Z0-9<>=/ ]//g' | sed 's/buildindexsh filestxt huhsh hyphenssh testsh woot2txt/''/g')

		  elif [ $ext = "jpg" ] || [ $ext = "jpeg" ] || [ $ext = "bmp" ] || [ $ext = "gif" ] || [ $ext = "png" ]
		  then
		    types="image"
		  elif [ $ext = "exe" ]
		  then
		    types="executable"
		  else
		    types="misc"
		   fi
		   
		#echo $ext
		#echo $fullpath
		#rootpath=unrelated
		FILESIZE=$(stat -c%s "$file")
		suba="Insert into Filenames(filename,location,type,description,sizeinbytes) VALUES ($easylook,http://192.168.1.1:90/all$file,$types,$three,$FILESIZE);"
		#echo $suba
		echo $suba | sed s/"'"/"''"/g | sed s/"VALUES ("/"VALUES ('"/g | sed s/");"/"');/"g | sed s/","/"','"/g | sed s/"Filenames(filename','location','type','description','sizeinbytes)"/"Filenames(filename,location,type,description,sizeinbytes)"/g >> woot2.txt
		#echo $suba | "sed s/'/''/g | sed s/VALUES (/VALUES ('/g | sed s/);/');/g | sed s/,/','/g | sed s/Filenames)filename','location','type)/Filenames(filename,location,type)/g" >> woot2.txt
		#echo $suba >> woot2.txt
	done;
done < $input
echo "update Filenames set Type='tarball' where Filename like '%tar.gz';" >> woot2.txt
echo "update Filenames set type='audio' where location like '%.ogg';" >> woot2.txt
echo "update Filenames set Type='image' where Filename like '%.JPEG';" >> woot2.txt
echo "update Filenames set Type='image' where Filename like '%.JPG';" >> woot2.txt
echo "update Filenames set Type='tarball' where Filename like '%.bz2';" >> woot2.txt
echo "update Filenames set Type='directory' where Filename not like '%.%';" >> woot2.txt
echo "update Filenames set Type='executable' where Filename like '%.EXE';" >> woot2.txt
echo "update Filenames set Type='php' where Filename like '%.php';" >> woot2.txt
echo "update Filenames set Type='pdf' where Filename like '%.pdf';" >> woot2.txt
echo "update Filenames set Type='spreadsheet' where Filename like '%.ods';" >> woot2.txt
echo "update Filenames set Type='spreadsheet' where Filename like '%.xlsx';" >> woot2.txt
echo "update Filenames set Type='image' where Filename like '%.jpe';" >> woot2.txt
echo "update Filenames set Type='image' where Filename like '%.png';" >> woot2.txt
echo "update Filenames set Type='image' where Filename like '%.PNG';" >> woot2.txt
echo "update Filenames set Type='zip' where Filename like '%.zip';" >> woot2.txt
echo "update Filenames set Type='rar' where Filename like '%.rar';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.flc';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.FLC';" >> woot2.txt
echo "update Filenames set Type='subtitle' where Filename like '%.srt';" >> woot2.txt
echo "update Filenames set Type='bookmark' where Filename like '%.json';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.AVI';" >> woot2.txt
echo "update Filenames set Type='iso' where Filename like '%.iso';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.mpeg';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.asf';" >> woot2.txt
echo "update Filenames set Type='spreadsheet' where Filename like '%.xlsm';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.FLV';" >> woot2.txt
echo "update Filenames set Type='executable' where Filename like '%.msi';" >> woot2.txt
echo "update Filenames set Type='spreadsheet' where Filename like '%.xls';" >> woot2.txt
echo "update Filenames set Type='document' where Filename like '%.rtf';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.mov';" >> woot2.txt
echo "update Filenames set Type='subtitle' where Filename like '%.sub';" >> woot2.txt
echo "update Filenames set Type='playlist' where Filename like '%.xspf';" >> woot2.txt
echo "update Filenames set Type='hypertext' where Filename like '%.htm';" >> woot2.txt
echo "update Filenames set Type='hypertext' where Filename like '%.html';" >> woot2.txt
echo "update Filenames set Type='bookmark' where Filename like '%bookmark%';" >> woot2.txt
echo "update Filenames set Type='playlist' where Filename like '%.m3u';" >> woot2.txt
echo "update Filenames set Type='corrupt' where Filename like '%.part';" >> woot2.txt
echo "update Filenames set Type='video' where Filename like '%.webm';" >> woot2.txt

echo "delete from Filenames where location like '%*%';" >> woot2.txt;
echo "Insert into Updates(date) VALUES ('$(date)');" >>  woot2.txt

mysql -u${username} -p${password} -f < ./woot2.txt

echo "Database successfully updated at: $(date)" >> /var/log/my_scripts/voogle_search_index.log
#echo "Database successfully updated at: $(date)" >> /var/log/my_scripts/$(date +%m-%d-%Y)/$(date +%H)/voogle_search_index.log
