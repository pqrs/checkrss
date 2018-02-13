<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define( "TIMEZONE",     "Europe/Madrid" 							);	// Your timezone
define( "RSS_FEED",     "http://feeds.nbcnews.com/feeds/topstories" );	// The RSS feed URL you want to examine

date_default_timezone_set(TIMEZONE);

require_once __DIR__ . '/../vendor/autoload.php'; 					// Autoload files using Composer autoload

use CheckRSS\RSS;

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
        echo $value->link           . PHP_EOL . PHP_EOL;

        $rss->WriteLog($value->title);

    }

} else {

    echo "There're no new items in RSS feed" . PHP_EOL;

    $rss->WriteLog("No new items found in RSS feed");

}