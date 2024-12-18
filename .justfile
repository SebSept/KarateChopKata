set dotenv-load
docker_php_exec := "docker compose exec -it php"
composer := docker_php_exec + " composer "

up:
    docker compose up -d

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

test filter:
    {{docker_php_exec}} php vendor/bin/phpunit --filter {{filter}}

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
