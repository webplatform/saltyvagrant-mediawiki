# WebPlatform Docs MediaWiki workbench

This repository is a workbench to develop [WebPlatform.org](http://webplatform.org)
("WPD") MediaWiki extensions on a VirtualMachine that mimicks the production
environment.

This workspace replicates, with some differences, is a a **Subset** of the **Full WPD Salt configuration**, applied to an "`app{n}`" server in which we run MediaWiki.
You can [read about our infrastructure setup in our *blog*](http://blog.webplatform.org/2012/10/building-web-platforms-infrastructure/).

The main difference in the provisioning configuration is that an "`app{n}`" server
only runs *Apache webserver*, uses *Memcached* and *MySQL* from separate VMs. Whereas
this configuration has it all-in-one.

Although it is planned to publish the **Full WPD Salt configuration** publicly, we
need to cleanup all private data first.


# 1. Installation

## Development

All the development work is made on your local machine and IDE. But the
web server, database, and other services are running within the VM.


### Softwares to install

Make sure you have the latest of those. I've seen issues working with the
Vagrant environment without keeping them updated.

1. [Vagrant 2.x](http://www.vagrantup.com/)
2. [Oracle VM VirtualBox](https://www.virtualbox.org/)
3. Salty Vagrant Vagrant plugin (installation covered below)


### Procedures

Feel free to contribute your setup under a different Operating System
environment that supports Vagrant.

If you want setup manually your workspace, you can follow the Salt Stack
states definitions stored in the `salt/` folder. Every definitions are space
indendted text (YAML) describing required changes that can be applied on a
blank Linux instance.

Although the provisioner is using Salt Stack, the required configurations are
concise enough to be understood without learning the syntax it uses.


#### Mac OS X and Linux

This procedure assumes either Linux or Mac OS X. If you used this workspace
under Windows with Vagrant.

**NOTE**: All files in workspace are mounted inside the VM at `/vagrant` and
the VM's default user (vagrant) has a symbolic link from
`~/workspace`pointing to it.

1. Get a MediaWiki installation and a MySQL dump to work with
  - Keep the MySQL dump file in `utilities/snapshot.sql`
  - Install your full MediaWiki installation in `project/wiki/`, it will be the docroot
  - Put some desired (if needed) files in `project/root/`, as they will be served as `/var/www`

2. Install Vagrant provisioner plugin ("Salt stack")

    ```bash
    vagrant plugin install vagrant-salt
    ```
    *NOTE*: If you have issues and you already use vagrant-salt, make sure you have the latest version or remove the plugin and re-install it.

3. Run the VM

    ```bash
    vagrant up
    vagrant provision
    ```
    *NOTE*: Sometimes `vagrant provision` is not needed at all. In any case, in the next step `state.highstate` would do the same thing as `vagrant provision`.

4. Connect to the VM, install dependencies

    ```bash
    vagrant ssh
    ```
    *NOTE*: If you change a file in `salt/`, you need to apply states again
    Its always good to make sure everything worked correctly, always run `state.highstate`
    to be sure all at their appropriate places.

    ```bash
    salt state.highstate
    ```

    *HINT*: The `salt` command is defined in `/home/vagrant/.bash_aliases` to run
    with Salt Stack in a Masterless fashion.

5. Have a MySQL dump of a MediaWiki installation in `~/workspace/utilities/wptestwiki.sql`

6. Install database dump

    ```bash
    cd /vagrant

    salt mysql.db_create wpwiki
    mysql -u root wpwiki < utilities/snapshot.sql
    ```

7. Create an entry in your **local host machine** `hosts` file

    ```bash
    sudo vi /etc/hosts
    33.33.32.5    docs.webplatform.local
    ```
    You can always change, or get the IP from the `Vagrantfile` if you want to change it.

        wpwiki.vm.network :private_network, ip: "33.33.32.5"

8. Code within this workspace outside the VM, browse [from the VMs web server.

    http://docs.webplatform.local/

