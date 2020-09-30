#script that documents when this was ran
echo "use Intranet;" >> woot2.txt
echo "delete from Filenames;" >> woot2.txt
echo "Insert into Updates(date) VALUES ('$(date)')" >>  woot2.txt
mysql -uyour_username -ppassword < ./woot2.txt

echo "Database successfully updated at: $(date)" >>logs.txt
