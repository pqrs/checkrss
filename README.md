# CheckRSS

Check RSS feeds for new items

CheckRSS provides some methods to:

* Get all the items in a RSS feed
* Check which of those items is/are new since last check
* Write a log every time a checking for new items is run

It is recommended using CheckRSS with a cron job so you can get new items periodically, although you can run it manually too.


## Installation

```
composer require pqrs/checkrss=dev-master
```

Alternatively, add the dependency directly to your composer.json file:

```
"require": {
    "pqrs/checkrss": "dev-master"
}
```

Then add to your php code:

``` php
require_once __DIR__ . '/vendor/autoload.php';   // Autoload files using Composer autoload

use CheckRSS\RSS;
```

## Usage

### method getItems($feed_url)

This method gets **all the items** published in the rss feed and returns an object containing them.

``` php
$rss = new RSS;

$items = $rss->getItems(RSS_FEED);
```

### method getNewItems($items)

This method checks which items in a feed (obtained with getItems) are new since the last a check was made.

Returns an object with just the **new items**.

``` php
$rss = new RSS;

// Gets all the items published in the rss feed and stores them in $items
$items = $rss->getItems(RSS_FEED);

// Checks which items are new since last check
if ($newitems = $rss->getNewItems($items) ) {

    // Prints new items
    echo "New items found:" . PHP_EOL . PHP_EOL;

    foreach ($newitems as $value) {

        echo $value->title          . PHP_EOL;
        echo $value->description    . PHP_EOL;
        echo $value->guid           . PHP_EOL;
        echo $value->link           . PHP_EOL. PHP_EOL;

        $rss->WriteLog($value->title);

    }

} else {

    echo "There'are no new items in RSS feed";

    $rss->WriteLog("No new items found in RSS feed");

}
```

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

