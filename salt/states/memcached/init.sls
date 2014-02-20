memcached:
  pkg:
    - latest
  service:
    - running
    - enable: True
    - watch:
      - file: /etc/memcached.conf
    - requires:
      - pkg: memcached

memcached-dependencies:
  pkg.installed:
    - pkgs:
      - libmemcached-tools

/etc/memcached.conf:
  file:
    - managed
    - template: jinja
    - source: salt://memcached/files/memcached.conf.jinja
    - user: root
    - group: root
    - mode: 444
