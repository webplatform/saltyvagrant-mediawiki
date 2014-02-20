include:
  - php

/etc/php5/conf.d/unicode.ini:
  file.managed:
    - source: salt://php/files/unicode.ini
    - mode: 644
    - require:
      - pkg: php5