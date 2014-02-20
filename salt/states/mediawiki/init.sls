include:
  - memcached
  - php.mediawiki
  - php.mediawiki-apache
  - php.memcached

mediawiki-dependencies:
  pkg.installed:
    - pkgs:
      - curl
      - php5-memcache
      - php-pear

/etc/php5/conf.d/mediawiki.ini:
  file.managed:
    - source: salt://mediawiki/files/mediawiki.ini
    - mode: 644
    - require:
      - pkg: php5