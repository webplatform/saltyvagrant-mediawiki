# -*- mode: ruby -*-
# vi: set ft=ruby :

pref_interface = ['p2p0','en0: Wi-Fi (AirPort)']
vm_interfaces = %x( VBoxManage list bridgedifs | grep ^Name ).gsub(/Name:\s+/, '').split("\n")
pref_interface = pref_interface.map {|n| n if vm_interfaces.include?(n)}.compact
$network_interface = pref_interface[0]

Vagrant.configure("2") do |config|
  config.vm.network :public_network, :bridge => $network_interface

  # Multiple VM of one
  config.vm.define "wpwiki" do |wpwiki|
    wpwiki.vm.network :private_network, ip: "33.33.32.5"

    wpwiki.vm.network "forwarded_port", guest: 80, host: 8080

    wpwiki.vm.box = "precise64"
    wpwiki.vm.box_url = "http://files.vagrantup.com/precise64.box"
    wpwiki.vm.hostname = "wpwiki"

    wpwiki.vm.synced_folder "salt/states",  "/srv/salt"
    wpwiki.vm.synced_folder "salt/pillars", "/srv/pillars"

    wpwiki.vm.provider "virtualbox" do |v|
      v.name = "wpwiki"
      v.memory = 3524
    end
  end


  config.vm.provision :salt do |c|
    c.minion_config = "salt/minion"
    c.run_highstate = true
    c.verbose = true
  end
end
