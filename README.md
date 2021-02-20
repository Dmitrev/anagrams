# Anagrams
The challenge is built using [PHP 8.0](https://www.php.net/releases/8.0/en.php)

## Requirements
- git
- [Docker Desktop](https://www.docker.com/products/docker-desktop) (Docker engine version 19.03.0+)

## Install

```
git clone git@github.com:Dmitrev/anagrams.git
```

## Installing application

To run simply execute from the project root

This will build the container
```
docker-compose up -d
```

Enter the PHP container
```
docker-compose run php bash
```

Install composer packages

```
composer install
```

Run anagrams
```
php anagrams.php
```



