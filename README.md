# Voncloft-Search
A LAMP search engine for server or desktop.

run mysql_script_update to create database 

mysql -u yourusername -p yourpassword yourdatabase < mysql_script_update

in scripts directory run "test" to build your database and import file locations/attributes. Add to cron job if you like.

In the php files - and some bash scripts the unsername and password, you will need to be mysql username and password specific. 

Prerequisites:

(I am assuming you have experience with Linux, Apache, mysql, and PHP or LAMP servers)

The folder voogle needs to be placed in /media/Websites

Load your httpd.conf apache file - and encorporate the new directory/website.

Load php modules in httpd.conf as well

Start Apache, php, and mysql

Dependencies: Maria-db, PHP, APACHE, LINUX, fortune-mod (if you want the random quotes)

I removed the logo, feel free to put whatever you want in there.

Known issues I may/maynot fix - if you find any or want to contribute you are more than welcome.

1) Unable to play *some* videos in browser

2) Searching .folder names can crash the program or have it go into an infinite loop.

3) []'s in filename will cause entire path in search result link not just filename.

4) apostrophes can break links
