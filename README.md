# Voncloft-Search

This was hard programmed to reside in /media/Websites/voogle

A LAMP search engine for server or desktop.

run mysql_script_update to create database 

mysql -uyourusername -pyourpassword Intranet < mysql_script_update

(for simplicity sakes you can have a username of your_username and a password of password to get this going)

change username and passwrods in the voogle/include/dbconnect.php to your mysql criteria on your rig
put voogle/new-scripts/voogle.conf to /etc/voogle.conf - change the information you need

Add locations in your mysql table provided after the script was ran.

in scripts directory run "test" to build your database and import file locations/attributes. Add to cron job if you like.

In the php files - and some bash scripts the unsername and password, you will need to be mysql username and password specific. 

___________________________


Prerequisites:

(I am assuming you have experience with Linux, Apache, mysql, and PHP or LAMP servers)

The folder voogle needs to be placed in /media/Websites

Load your httpd.conf apache file - and encorporate the new directory/website.

Load php modules in httpd.conf as well

For httpd.conf put your folders that you plan on searching and keeping tabs on in the alias section.

Also I have hard coded the IP 192.168.1.1 in the search return results - since it is my own router so you may need to tweak that yourself.

Start Apache, php, and mysql

__________________________________________________


Dependencies: Maria-db, PHP, APACHE, LINUX, fortune-mod (if you want the random quotes)

I removed the logo, feel free to put whatever you want in there.

For continuous monitoring - you will need inotify-tools
_________________________________________________




Known issues I may/maynot fix - if you find any or want to contribute you are more than welcome to do so.




1) Unable to play *some* videos in browser

2) Searching .folder names can crash the program or have it go into an infinite loop.

3) []'s in filename will cause entire path in search result link not just filename.

4) apostrophes can break links
