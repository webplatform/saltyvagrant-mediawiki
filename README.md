# WebPlatform Docs MediaWiki workbench

This repository is a workbench to extend current [WebPlatform.org](http://webplatform.org) 
("WPD") MediaWiki extensions.

This workspace replicates, with some differences, the current *WPD* app server configured
with Salt Stack.

The main difference of the configuration is mostly due to the fact that this workspace creates
a single VM with Memcached, Apache, and MySQL on the same machine.

Please note that the current Salt states (in `salt/states/`) are currently a subset of the 
full WPD salt configuration but they are not yet ready to be publicly visible.


# 1. Installation

## Development

### Softwares to install

1. [Vagrant 2.x](http://www.vagrantup.com/)
2. [Oracle VM VirtualBox](https://www.virtualbox.org/)

### Procedure

All the work is happening within the VM.

This procedure assumes either Linux or Mac OS X. If you used this workspace under Windows with
Vagrant, feel free to contribute to the README to setup under that environment.

0. Get a MediaWiki installation and a MySQL dump to work with

  - Keep the MySQL dump file in `utilities/snapshot.sql`
  - Install your full MediaWiki installation in `project/wiki/`, it will be the docroot
  - Put some desired (if needed) files in `project/root/`, as they will be served as `/var/www`


1. Install Vagrant provisioner plugin ("Salt stack")

```bash
    vagrant plugin install vagrant-salt
```

2. Run the VM

```bash
    vagrant up
    vagrant provision
```

Note that sometimes `vagrant provision` is not needed at all.


3. Install dependencies from within the VM

```bash
    vagrant ssh
```


4. If you change a file in `salt/`, you need to apply states again

Its always good to make sure everything worked correctly, always run `state.highstate` to be sure all
at their appropriate places.

```bash
    salt state.highstate
```

Note that the salt command is defined in `/home/vagrant/.bash_aliases` to run with Salt Stack in a Masterless fashion.


6. Install database dump

```bash
    cd /vagrant

    mysql -u root

    mysql> create database wpwiki;
    mysql quit;

    mysql -u root wpwiki < utilities/snapshot.sql
```


5. Create an entry in your hostfile

```bash
    sudo vi /etc/hosts
    33.33.32.5    docs.webplatform.local
```

You can always change, or get the IP from the `Vagrantfile` if you want to change it.

6. Code within this workspace outside the VM, browse [from the VMs web server](http://docs.webplatform.local/)


