# versions Stack
- Linux Ubuntu 18.04
- Apache 2.4
- Mysql 5.7
- Php 7.2
- PhpStorm 2018.3.3
- Mysql Workbench  
 
# 00 - install apache/php/mysql
Dans le terminal (phpstorm ou xterm)

    > sudo apt-get install apache2 mysql-server php libapache2-mod-php php-mysql php-mbstring php-cgi

# 03 - setup mysql
les dernières versions de mysql utilisent le user root du systeme, sans mot de passe.
Il n'est pas possible de se connecter hormis via la commande

    > sudo mysql

Nous allons créer un user pour permettre d'y acceder en local (localhost) avec un l:p

    > sudo mysql
    GRANT ALL PRIVILEGES ON *.* TO 'mysqluser'@'localhost' IDENTIFIED BY 'mysqlpassword';
    quit;

Ce user a maintenant tous les droits, c'est perrave mais pour l'instant ou s'en bat.    


