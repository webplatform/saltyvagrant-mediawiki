# WebPlatform Docs MediaWiki workbench

This repository is a workbench to develop [WebPlatform.org](http://webplatform.org)
("WPD") MediaWiki extensions on a VirtualMachine that mimicks the production
environment.

This workspace replicates, with some differences, is a **Subset** of the **Full WPD Salt configuration**, applied to an "`app{n}`" server in which we run MediaWiki.
You can [read about our infrastructure setup in our *blog*](http://blog.webplatform.org/2012/10/building-web-platforms-infrastructure/).

The main difference in the provisioning configuration is that an "`app{n}`" server
only runs *Apache webserver*, uses *Memcached* and *MySQL* from separate VMs. Whereas
this configuration has it all-in-one.

Although it is planned to publish the **Full WPD Salt configuration** publicly, we
need to cleanup all private data first.


# 1. Installation

## 1.1. Development

All the development work is made on your local machine and IDE. But the
web server, database, and other services are running within the VM.


### 1.2. Softwares to install

Make sure you have the latest of those. I've seen issues working with the
Vagrant environment without keeping them updated.

1. [Vagrant 2.x](http://www.vagrantup.com/)
2. [Oracle VM VirtualBox](https://www.virtualbox.org/)
3. "Salty-vagrant", Vagrant plugin (installation covered below)


### 1.3. Procedures

Feel free to contribute your setup under a different Operating System
environment that supports Vagrant.

If you want setup manually your workspace, you can follow the Salt Stack
states definitions stored in the `salt/` folder. Every definitions are space
indendted text (YAML) describing required changes that can be applied on a
blank Linux instance.

Although the provisioner is using Salt Stack, the required configurations are
concise enough to be understood without learning the syntax it uses.


#### 1.3.1. Mac OS X and Linux

This procedure assumes either Linux or Mac OS X.

**NOTE**: All files in workspace are mounted inside the VM at `/vagrant` and
the VM's default user (vagrant) has a symbolic link from
`~/workspace` pointing to it.

1. Prepare local workspace to have code checkouts ready for the VM
  - Get a MediaWiki installation, put the files in the new folder `project/wiki/`, that's where the Apache configuration will serve MediaWiki
  - Get a MediaWiki MySQL dump file in `utilities/snapshot.sql`
  - Put some desired (if needed) files in `project/root/`, as they will be served as `/var/www`

2. Install Vagrant provisioner plugin ("Salt stack")

        vagrant plugin install vagrant-salt

    **NOTE**: If you have issues and you already use vagrant-salt, make sure you have the latest version or remove the plugin and re-install it.

3. Run the VM

        vagrant up

    **NOTE**: The first run seem to always fail. This is because some states are about enabling apache2 modules and salt considers the return message (e.g. "To activate the new configuration, you need to run") as an error.

    Do not worry about those errors for now, just continue at next step and `state.highstate` below will give you colored error messages. That'll be easier to work with, but with last attempts, running `state.highstate` in the VM a second time fixes everything.

4. Connect to the VM, install dependencies

        vagrant ssh

    **NOTE**: If you change a file in `salt/`, you need to apply states again
    Its always good to make sure everything worked correctly, always run `state.highstate`
    to be sure all at their appropriate places.

        salt state.highstate

    *HINT!*: The `salt` command is defined in `/home/vagrant/.bash_aliases` to run
    with Salt Stack in a Masterless fashion.

    *Possible issue*: If the VM says "No command 'salt' found, did you mean...", you might have to run "vagrant provision" from outside the VM again. To fix, do:

        vagrant@wpwiki:~$ exit
        me@local:~/workspace/docs/$ vagrant provision

5. Install database dump

        salt mysql.db_create wpwiki
        mysql -u root wpwiki < workspace/utilities/snapshot.sql

6. Create an entry in your **VM host** machine `hosts` file

        sudo vi /etc/hosts
        33.33.32.5    docs.webplatform.local

    You can always change, or get the IP from the `Vagrantfile` if you want to change it.

        wpwiki.vm.network :private_network, ip: "33.33.32.5"

7. Code within this workspace outside the VM, browse from the VMs web server.

    http://docs.webplatform.local/

    *HINT!* if you look at the title on the browser window, you should see \[LOCAL\] in the title. It helps me make sure I don't mess with [the production](http://docs.webplatform.org/wiki/).

8. Restart local apache web server

        salt service.restart apache2

    *HINT!* you could had run the `sudo service apache2 reload`, but using salt stack to execute things can be a good habit to get.

