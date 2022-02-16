#script that documents when this was ran
source /etc/voogle.conf
echo "use Intranet;" >> woot2.txt
echo "delete from Filenames;" >> woot2.txt
echo "Insert into Updates(date) VALUES ('$(date)')" >>  woot2.txt
mysql -u${username} -p${password} < ./woot2.txt

echo "Database successfully updated at: $(date)" >>logs.txt
