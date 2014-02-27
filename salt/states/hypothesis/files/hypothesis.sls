description "Hypothesis server"

start on (net-device-up
          and local-filesystems
          and runlevel [2345])
stop on runlevel [!2345]

script
   cd /srv/h
   /srv/h/bin/hypothesis start /srv/h/annotation.ini
end script