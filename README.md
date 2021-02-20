# Anagrams
The challenge is built using [PHP 8.0](https://www.php.net/releases/8.0/en.php)

## Requirements
- git
- [Docker Desktop](https://www.docker.com/products/docker-desktop) (Docker engine version 19.03.0+)

## Installing application

To run simply execute from the project root

This will build the container
```
docker-compose up -d
```

## Install composer packages

```
docker-compose run anagram composer install
```

## Run anagrams

argument `{file}` needs to be a file from the `data` folder in the root of the project

```
docker-compose run anagram php anagram.php {file}
```

## Example

```
docker-compose run anagram php anagram.php example1.txt
```

Sample output
```
✓ abc, bac, cba
✓ fun, fun, unf
✓ hello
```
