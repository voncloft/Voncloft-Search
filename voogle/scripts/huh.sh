#grabs all the files listed from the build_directory.sh file
source /etc/voogle.conf
rm -rf ./files.txt
read -ra myvariable <<< $(mysql -DIntranet -u${username} -p${password} -se "SELECT path FROM Default_Locations")
for i in "${myvariable[@]}";
do
echo $i
find $i -type d >> files.txt
done
