include:
  - php
  - memcached

php5-memcached:
  pkg:
    - installed

/etc/php5/conf.d/memcached.ini:
  file.append:
    - text: |
        ;
        ; Managed by Salt Stack
        ;
        [memcached]
        session.save_handler = memcached
        session.save_path = "localhost:11211"
    - require:
      - pkg: php5
      - pkg: php5-memcached