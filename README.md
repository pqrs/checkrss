# CheckRSS

Check RSS feeds for new items

CheckRSS provides some methods to:

* Get all the items in a RSS feed
* Check which of those items is/are new since last check
* Write a log every time a checking for new items is run

It is recommended using CheckRSS with a cron job so you can get new items periodically, although you can run it manually too.


## Installation

```
composer install require pqrs/checkrss=dev-master
```

Alternatively, add the dependency directly to your composer.json file:

```
"require": {
    "pqrs/checkrss": "dev-master"
}
```

Add this to your program:

``` php
require_once __DIR__ . '/vendor/autoload.php';   // Autoload files using Composer autoload

use CheckRSS\RSS;
```


## Usage




## Examples

You can find some uses for these functions in [tests folder](tests).


## Prerequisites

PHP 5.3.0


## Credits

**Copyright © 2018 Alvaro Piqueras** - [pqrs](https://github.com/pqrs)

This is a cleanup of a dirty code I wrote some time ago. Also it's my first try with GitHub, Composer and Packagist so if you find some mistakes or have some tips for me, I would be more than glad to hear you.

I hope this code suites your needs.


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

