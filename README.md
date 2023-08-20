# Axels Repository

# BTH MVC Repository

[![Build Status](https://scrutinizer-ci.com/g/justtoaxel/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/justtoaxel/mvc/build-status/main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/justtoaxel/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/justtoaxel/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/justtoaxel/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/justtoaxel/mvc/?branch=main)

Links for documentation and metrics.

-   [docs](https://www.student.bth.se/~axli22/dbwebb-kurser/mvc/me/report/docs/api/)
-   [metrics](https://www.student.bth.se/~axli22/dbwebb-kurser/mvc/me/report/docs/metrics/)

This repo was used for various tasks during the MVC-Course at Blekinges Tekniska Högskola. It utilized Symfony,Javascript, Doctrine, Composer, NPM and Other various testing tools.

The repo is part of course material for the. You can find the link here:[dbwebb mvc-course](https://github.com/dbwebb-se/mvc). The repository is made with a Symfony app.

# My Repository

This repository contains my project files for all the KMOM and the Project KMOM.

## Cloning the Repository

To clone and download the repository, follow these steps:

1. Open a terminal or command prompt on your local machine.
2. Navigate to the directory where you want to clone the repository.
3. Run the following command to clone:

```

git clone https://github.com/justtoaxel/mvc.git

```

## Requirements

You will need to install the dependencies to the application and install the modules needed for the unit tests. Using Composer and PHP will solve most of that for you.

```
composer install
```

You will need to install NPM:

```
npm install
```

We need to run the NPM and the dependencies:

```
npm run build
```

You also need to enable doctrine

```

composer require symfony/orm-pack
composer require --dev symfony/maker-bundle

```

Enabling the schema for the tables

```
php bin/console doctrine:schema:update --force

```

Making sure PHP 8.2.4 is installed and then start the server

```
php --version
 php -S localhost:8888 -t public

```

### php-cs-fixer

```

composer require friendsofphp/php-cs-fixer --dev

```

### phpmd

```

composer require phpmd/phpmd --dev

```

### phpstan

```

composer require phpstan/phpstan --dev

```

### phpunit

```

composer require phpunit/phpunit --dev

```

### phpdoc

```

composer require phpdocumentor/phpdocumentor --dev

```

### phpmetrics

```

composer require phpmetrics/phpmetrics --dev

```

### Make sure that the following are added to the composer.json

```
"scripts": {
        "auto-scripts": {
            "cache:clear": "symfony-cmd",
            "assets:install %PUBLIC_DIR%": "symfony-cmd"
        },
        "post-install-cmd": [
            "@auto-scripts"
        ],
        "post-update-cmd": [
            "@auto-scripts"
        ],
        "csfix": "tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src",
        "csfix:dry": "tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src --dry-run -v",
        "phpmd": "tools/phpmd/vendor/bin/phpmd . text phpmd.xml || true",
        "phpstan": "tools/phpstan/vendor/bin/phpstan || true",
        "phpunit": "XDEBUG_MODE=coverage vendor/bin/phpunit",
        "phpdoc": "tools/phpdoc/phpDocumentor.phar",
        "lint": [
            "@csfix",
            "@phpmd",
            "@phpstan"
        ],
        "clean": "rm -rf build .phpunit.result.cache",
        "clean-all": [
            "@clean",
            "rm -rf vendor composer.lock"
        ],
        "phpmetrics": "tools/phpmetrics/vendor/bin/phpmetrics --config=phpmetrics.json"
    }

```

## Add to scrutinizer.yml

```
imports:
    - php

filter:
    excluded_paths: [vendor/*, test/*]

build:
    image: default-bionic

    nodes:
        my-tests:
            environment:
                php:
                    version: 8.1.13
                    # version: 8.1.17
                    # version: 8.2.4
        analysis:
            tests:
                override:
                    - php-scrutinizer-run
    tests:
        override:
            -   command: "composer phpunit"
                # command: "XDEBUG_MODE=coverage vendor/bin/phpunit"
                coverage:
                    file: "docs/coverage.clover"
                    format: "php-clover"
```