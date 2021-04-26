
sudo apt-get -y update > /dev/null

echo "Instalando Apache"
sudo apt-get -y install apache2 > /dev/null
sudo rm /var/www/html/index.html > /dev/null

echo "Instalando PHP"
sudo apt -y install lsb-release apt-transport-https ca-certificates 
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
sudo apt -y install php7.4
sudo apt-get install php7.4-{bcmath,bz2,intl,gd,mbstring,mysql,zip}

echo "Configurando PHP SSH2"

sudo apt-get install gcc make autoconf libc-dev pkg-config
sudo apt-get install libssh2-1-dev
sudo pecl5.X-sp install ssh2
sudo bash -c "echo extension=ssh2.so > /etc/php5.X-sp/conf.d/ssh2.ini"
sudo service php5.X-fpm-sp restart

echo "Instalando MySQL"
DBPASSWD=abc123
echo "mysql-server mysql-server/root_password password $DBPASSWD" | sudo debconf-set-selections  > /dev/null
echo "mysql-server mysql-server/root_password_again password $DBPASSWD" | sudo debconf-set-selections  > /dev/null
  sudo apt-get -y install mysql-server  > /dev/null
# https://support.plesk.com/hc/en-us/articles/213904365-How-to-enable-remote-access-to-MySQL-database-server
sudo sed -i -r -e 's/127.0.0.1/0.0.0.0/g' /etc/mysql/my.cnf
sudo service mysql restart > /dev/null
mysql -uroot -p"$DBPASSWD" -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '$DBPASSWD' REQUIRE NONE WITH GRANT OPTION; FLUSH PRIVILEGES;"

echo "Vagrant finalizado"
