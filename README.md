# Voncloft-Search
A LAMP search engine for server or desktop.

run mysql_script_update to create database 

mysql -u yourusername -p yourpassword yourdatabase < mysql_script_update

in scripts directory run "test" to build your database and import file locations/attributes. Add to cron job if you like.

In the php files - and some bash scripts the unsername and password, you will need to be mysql username and password specific. 

Prerequisites:

(I am assuming you have experience with Linux, Apache, mysql, and PHP)

The folder voogle needs to be placed in /media/Websites

Load your httpd.conf apache file - and encorporate the new directory/website.

Load php modules in httpd.conf as well

Start Apache, php, and mysql

Dependencies:
Maria-db
PHP
APACHE
LINUX
fortune-mod (if you want the random quotes)
