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

## Running test suite
```
docker-compose run anagram phpunit --testdox
```

## Big O Analysis

The complexity is O(n) for the anagram algorithm. It only goes over the list of words once.
It does this by assigning a key for each word that we can use to anagrams in one go.

Keys are created by sorting the characters of a string alphabetically

```
abc -> abc
cab -> abc
bca -> abc
```

Groups are then created like so:

```
 abc => [abc, cab, bca]
 xyz => [xyz, zyx, zxy]
```

## Data structures

I've chosen to supply words as input using the Iterator pattern. The way it's implemented is by reading the input file line by line.
This is mainly to avoid loading a lot of words into memory as files could be potentially very big.
In order to get the output I've used the generator pattern which passes the result back to `STDOUT` as
soon we are finished dealing with all the words that have the same length,
since I can assume that all the words of the same length can fit into memory.

## Further improvement

**File Iterator**
I've written a custom class to read the file line by line. When going to the next line there
is a quirk where the File Iterator reads the same line twice to skip it if it's blank. I had to implement that last minute 
since a lot of editors make new lines at the of the file.

I would refactor that class slightly to only ever read a line once and let the Anagram finder code handle empty words

**Anagram Finder**
There is as duplicate line in the function for finding the anagrams from the current input buffer.
Since the loop ends when the file read is completed there will always be a buffer left over.
So I made another call at the end of function. I would refactor this function by separating the creation of the
buffer from the anagram finding function.

```php
yield $this->groupWords($buffer);
```
