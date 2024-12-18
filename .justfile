set dotenv-load
docker_php_exec := "docker compose exec -it php"
composer := docker_php_exec + " composer "

up:
    docker compose up --detach --remove-orphans --build

# update source files + docker compose down+up
update: && tests
    git pull
    docker compose down
    docker compose up -d --build
    {{composer}} install

# open a fish shell on the container
fish:
    {{docker_php_exec}} fish

[private]
fish_root:
    docker compose exec -it -u root php fish

# composer require package
req package:
    {{composer}} req {{package}}

# composer require package --dev
req-dev package:
    {{composer}} req {{package}} --dev

tests format='--testdox':
    {{docker_php_exec}} php vendor/bin/phpunit {{format}}

# XDEBUG_MODE=debug XDEBUG_SESSION=1 XDEBUG_CONFIG="client_host=172.25.0.1 client_port=9003" PHP_IDE_CONFIG="serverName=myrepl" phpunit
# XDEBUG_MODE=debug XDEBUG_SESSION=1 XDEBUG_CONFIG="client_host=host.docker.internal client_port=9003" PHP_IDE_CONFIG="serverName=myrepl" phpunit

#tests_xdebug:
tests_xdebug:
    {{docker_php_exec}} env XDEBUG_MODE=debug XDEBUG_SESSION=1 XDEBUG_CONFIG="client_host=host.docker.internal client_port=9003" PHP_IDE_CONFIG="serverName=myrepl" php vendor/bin/phpunit

# interactive php shell
psysh:
    {{docker_php_exec}} psysh

[private]
[confirm("Écraser .git/hooks/pre-commit ?")]
install-pre-commit-hook:
    echo "docker compose exec php symfony composer run-script pre-commit" > .git/hooks/pre-commit
    {{docker_php_exec}} chmod +x .git/hooks/pre-commit

# firt run docker compose up + composer install + open browser
[private]
init:
    docker compose down
    just up
    {{composer}} install
