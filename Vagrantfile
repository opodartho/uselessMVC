# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/xenial64"

  config.vm.hostname = "useless"
  config.vm.box_check_update = false

  config.vm.network "forwarded_port", guest: 80, host: 8080

  config.vm.synced_folder "./", "/home/vagrant/sync", disabled: true
  config.vm.synced_folder "./", "/var/www/html"

  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    vb.gui = false

    # Customize the amount of memory on the VM:
    vb.memory = "1024"
  end

  config.vm.provision "shell", inline: <<-SHELL
    sudo -i
    apt update
    apt-get -y upgrade
    apt-get -y install apache2
    sed -i "s|/var/www/html|/var/www/html/public|g" /etc/apache2/sites-available/000-default.conf

    debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
    debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

    apt-get -y install mariadb-server
    apt-get -y install php libapache2-mod-php php-mcrypt php-mysql
    systemctl restart apache2.service
    apt-get autoremove
  SHELL
end
