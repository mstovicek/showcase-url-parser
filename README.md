## Objection

Prepare an URL parser in PHP.

Your solution should meet the following criteria:
- Please provide a CLI command that would accept one string argument (the URL) and output the parsed URL or report an error.
- Based on the command’s arguments, the output should be either a human-readable print or a JSON (see examples below).
- Prepare unit tests for your code.
- Use PHP7.
- try to implement the best code practices.

### Examples

```sh
$ php parser.php “https://www.google.com/?q=Czechia&lang=de”
scheme: https
host: www.google.com
path: /
arguments:
	q = Czechia
	lang = de
$ echo $?
0
```

```sh
$ php parser.php --json “https://www.google.com/?q=Czechia&lang=de”
{“scheme”:“https”,“host”:”www.google.com”,”path”:”/”,”arguments”:{“q”:”Czechia”,”lang”:”de”}}
$ echo $?
0
```

```sh
$ php parser.php --json “/www.google.com/?q=Czechia&lang=de”
{“path”:”/www.google.com/”,”arguments”:{“q”:”Czechia”,”lang”:”de”}}
$ echo $?
0
```

```sh
$ php parser.php --json “http://?”
Incorrect URL.
$ echo $?
1
```

## Usage

### Install dependencies
```sh
$ composer install
```

### Run parser
```sh
$ php application.php parse [options] <url>

Arguments:
    url     URL to be parsed.

Options:
    --json  Whether to output json
```

```
$ php application.php parse "https://www.google.com/?q=Czechia&lang=de"
$ php application.php parse --json "https://www.google.com/?q=Czechia&lang=de"
```

### Run tests
```
$ composer test
```

## Used online resources 

- http://php.net/manual/en/function.parse-url.php
- http://symfony.com/doc/current/components/console.html
- https://phpunit.de/manual/6.0/en/installation.html
- https://symfony.com/doc/current/components/dependency_injection.html
- http://php.net/manual/en/function.json-encode.php
- http://php.net/manual/en/function.parse-str.php
- http://stackoverflow.com/questions/25513361/how-can-i-use-array-map-with-keys-and-values-but-return-an-array-with-the-same
- https://gist.github.com/MattKetmo/3665488
- https://phpunit.de/manual/current/en/appendixes.annotations.html
- https://regex101.com/
- https://github.com/sebastianbergmann/phpunit/issues/1785
- http://apigen.juzna.cz/doc/sebastianbergmann/phpunit/function-assertJson.html
