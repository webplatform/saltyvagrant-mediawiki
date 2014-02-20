# WebPlatform Docs MediaWiki workbench

This repository is a workbench to extend current WebPlatform.org MediaWiki installation.

It replicates to some extents the current WebPlatform Docs (WPD) Salt Stack configuration. 
Please note that the current Salt states (in `salt/states/`) are currently a subset of the 
full WPD salt configuration.


# 1. Installation

## Development

### Softwares to install

1. [Vagrant 2.x](http://www.vagrantup.com/)
2. [Oracle VM VirtualBox](https://www.virtualbox.org/)

### Procedure

All the work is happening within the VM.

This procedure assumes either Linux or Mac OS X, should work on Windows.

0. Get a MediaWiki installation and a MySQL dump to work with

  - Keep the MySQL dump file in `utilities/snapshot.sql`
  - Install your full MediaWiki installation in `project/wiki/`, it will be the docroot
  - Put some desired (if needed) files in `project/root/`, as they will be served as `/var/www`

I said opinionated, didn't I?  As described earlier, it replicates a subset of WPD app node installation.

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

4. Create an entry in your hostfile
```
    sudo vi /etc/hosts
    33.33.32.5    docs.webplatform.local
```

You can always change, or get the IP from the `Vagrantfile` if you want to change it.

4. Code within this workspace outside the VM, browse [from the VMs web server](http://docs.webplatform.local/)


