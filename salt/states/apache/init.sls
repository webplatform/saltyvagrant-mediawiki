apache2:
  service:
    - running
    - enable: True
    - reload: true
    - require:
      - pkg: apache2
    - watch:
      - pkg: apache2
  pkg:
    - installed
    - names:
      - apache2-mpm-prefork
      - apache2

/etc/apache2/sites-enabled/000-default:
  file.absent:
    - watch_in:
      - service: apache2

/etc/apache2/conf.d/performance:
  file.managed:
    - source: salt://apache/files/performance
    - user: root
    - group: root
    - mode: 644

/etc/apache2/conf.d/charset:
  file.managed:
    - source: salt://apache/files/charset
    - user: root
    - group: root
    - mode: 644
