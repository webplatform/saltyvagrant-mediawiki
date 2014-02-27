#
# Reference:
#  - https://github.com/hypothesis/h/blob/develop/INSTALL.Ubuntu.rst
#

include:
  - nodejs

hypothesis:
  group.present

hypothesis-service:
  service:
    - running
    - name: hypothesis
    - enable: True
    - reload: true
    - require:
      - git: hypothesis-checkout
      - pkg: hypothesis-dependencies
      - file: /etc/init/hypothesis.conf
      - pkg: nodejs

hypothesis-dependencies:
  pkg.installed:
    - names:
      - python-yaml
      - python-dev
      - python-pip
      - python-virtualenv
      - git
      - libpq-dev
      - make
      - rubygems
      - ruby-full
      - build-essential

# pip install pyyaml
# gem install sass
# http://acervulus.info/2012/how-to-install-sass-on-ubuntu-precise-12-04-lts/
# gem install compass

hypothesis-checkout:
  git.latest:
    - name: https://github.com/hypothesis/h.git
    - rev: develop
    - target: /srv/h
    - unless: test -f /srv/h/annotation.ini
    - require:
      - file: /srv/h

#/srv/h/annotation.ini:
#  file.managed:
#    - template: jinja
#    - source: salt://hypothesis/files/annotation.ini.jinja
#    - user: nobody
#    - group: hypothesis
#    - require:
#      - file: /srv/h
#      - git: hypothesis-checkout

/srv/h:
  file.directory:
    - makedirs: True
    - user: nobody
    - group: hypothesis
    - mode: 670
    - require:
      - group: hypothesis

/etc/init/hypothesis.conf:
  file.managed:
    - source: salt://hypothesis/files/hypothesis.init
    - user: root
    - group: root
    - mode: 644
    - requires:
      - file: /srv/h
      - git: hypothesis-checkout
#      - file: /srv/h/annotation.ini

#npm-packages:
#  npm.installed:
#    - names:
#      - uglify-js
#      - clean-css
#      - coffee-script
#    - require:
#      - pkg: npm