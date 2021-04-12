# PHP GoogleTranslate free [![Build Status](https://travis-ci.org/statickidz/php-google-translate-free.svg?branch=master)](https://travis-ci.org/statickidz/php-google-translate-free)

Simple PHP library for talking to Google's Translate API for free.

Eliminates IP request limitations

## Installation

Install this package via [Composer](https://getcomposer.org/).

```
composer require statickidz/php-google-translate-free
```

Or edit your project's `composer.json` to require `statickidz/php-google-translate-free` and then run `composer update`.

```json
"require": {
    "statickidz/php-google-translate-free": "^1.2.1"
}
```

## Usage

```php
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

$source = 'es';
$target = 'en';
$text = 'buenos días';

$trans = new GoogleTranslate();
$result = $trans->translate($source, $target, $text);

// Good morning
echo $result;
```
