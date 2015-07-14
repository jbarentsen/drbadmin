# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
DOCUMENT_ROOT_ZEND="/var/www/drbadmin"
apt-get update
apt-get install -y apache2 git curl php5-cli php5 php5-intl libapache2-mod-php5
a2enmod rewrite
a2dissite 000-default
a2ensite skeleton-zf
service apache2 restart
cd /var/www/drbadmin
curl -Ss https://getcomposer.org/installer | php
php composer.phar install --no-progress
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.box = "chef/debian-7.8"
  config.vm.box_check_update = false
  config.ssh.forward_agent = true

  config.vm.network "private_network", ip: "192.168.33.35", auto_correct: true
  #config.vm.network "forwarded_port", guest: 9160, host: 9160, protocol: 'tcp', auto_correct: true

  config.vm.synced_folder ".", "/vagrant", disabled: true
  config.vm.synced_folder ".", "/var/www/drbadmin", :nfs => { group: "www-data", owner: "www-data" }, :mount_options => ['nolock,vers=3,udp,noatime']

  config.vm.provision "ansible" do |ansible|
    ansible.limit = "vagrant"
    ansible.inventory_path = "deploy/ansible/inventory/vagrant"
    ansible.playbook = "deploy/ansible/provision.yml"
  end
  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    v.memory = 1000
    v.cpus = 1
  end
end

