# This will build a spider "backbone" of directories to search. It will only scan subfolders
IFS=$'\n'
source /etc/voogle.conf
rm -rf ./files.txt


myvariable="$(mysql  -DIntranet -u${username} -p${password} -se 'SELECT path FROM Default_Locations')"

for i in "${myvariable[@]}";
do
#echo "test"
echo $i
find $i -type d >> /media/Websites/voogle/scripts/files.txt
done
