include:
  - apache
  - apache.headers

{% from "apache/vhost.sls" import vhost %}
{{ vhost('workspace', True) }}

a2enmod rewrite:
  cmd.run:
    - require:
      - pkg: apache2

/var/cache/mediawiki:
  file.directory:
    - mode: 755
    - makedirs: True
    - user: www-data
    - group: www-data
    - recurse:
      - user
      - group

move-varwww:
  file.symlink:
    - name: /var/www
    - target: /vagrant/project/root
    - force: True
    - user: vagrant
    - group: vagrant

/srv/webplatform/wiki/cache:
  file.symlink:
    - target: /var/cache/mediawiki
    - force: True
    - user: vagrant
    - group: vagrant
    - require:
      - file: /var/cache/mediawiki

/home/vagrant/.bash_aliases:
  file.managed:
    - user: vagrant
    - group: vagrant
    - source: salt://dev-environment/files/bash_aliases.txt

/home/vagrant/workspace:
  file.symlink:
    - target: /vagrant

/srv/webplatform:
  file.symlink:
    - target: /vagrant/project

disable-default:
  cmd:
    - wait
    - name: a2dissite 000-default
    - require:
      - pkg: apache2

/etc/apache2/sites-available/workspace.conf:
  file.managed:
    - user: root
    - group: root
    - source: salt://dev-environment/files/vhost.workspace.conf
    - require:
      - cmd: disable-default
    - require_in:
      - cmd: vhost-exist

a2ensite workspace.conf:
  cmd:
    - run
    - unless: test -L /etc/apache2/sites-enabled/workspace.conf
    - require:
      - pkg: apache2
      - file: /etc/apache2/sites-available/workspace.conf
