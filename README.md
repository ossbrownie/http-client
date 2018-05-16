HttpClient
==========

[![Latest Stable Version](https://poser.pugx.org/ossbrownie/http-client/v/stable)](https://packagist.org/packages/ossbrownie/http-client)
[![Total Downloads](https://poser.pugx.org/ossbrownie/http-client/downloads)](https://packagist.org/packages/ossbrownie/http-client)
[![Latest Unstable Version](https://poser.pugx.org/ossbrownie/http-client/v/unstable)](https://packagist.org/packages/ossbrownie/http-client)
[![License](https://poser.pugx.org/ossbrownie/http-client/license)](https://packagist.org/packages/ossbrownie/http-client)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ossbrownie/http-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ossbrownie/http-client/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ossbrownie/http-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ossbrownie/http-client/?branch=master)
[![Build Status](https://travis-ci.org/ossbrownie/http-client.svg?branch=master)](https://travis-ci.org/ossbrownie/http-client)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/ossbrownie/http-client/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

A simple HTTP client for sending HTTP requests and receiving responses.

## curl
A basic CURL wrapper for PHP (see [http://php.net/curl](http://php.net/curl) for more information about the libcurl extension for PHP)


## Requirements
- **PHP** >= 5.3
- **EXT-CURL** = *
- **"ossbrownie/util"** = ~0.0.5


## Installation
Add a line to your "require" section in your composer configuration:

```json
{
    "require": {
        "ossbrownie/http-client": "0.0.4"
    }
}
```

## Documentation
- [Usage](https://github.com/ossbrownie/http-client/wiki/Usage) - Example of using the HttpClient


## Tests
To run the test suite, you need install the dependencies via composer, then run PHPUnit.
```bash
$> composer.phar install
$> ./vendor/bin/phpunit --colors=always --bootstrap ./tests/bootstrap.php ./tests
```


## License
HttpClient is licensed under the [GNU General Public License v3.0](http://www.gnu.org/copyleft/lesser.html)


## Contact
Problems, comments, and suggestions all welcome: [oss.brownie@gmail.com](mailto:oss.brownie@gmail.com)
