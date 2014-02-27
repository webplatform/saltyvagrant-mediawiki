include:
  - nodejs

grunt-cli:
  npm.installed:
    - require:
      - pkg: npm
      - cmd: npm-config-ssl-hack

run-compat-importer-deps:
  cmd.run:
    - cwd: /srv/webplatform/mdn-compat-importer
    - name: npm install
    - require:
      - pkg: npm
      - cmd: npm-config-ssl-hack