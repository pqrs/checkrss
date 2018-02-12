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

// Gets the last item published in the rss feed and stores it in $last_item
$last_item = $rss->getLastItem(RSS_FEED);

// $last_item is an object that may have many different elements. You must now choose an element that has
// unique values for every item. Usually [guid] or [pubDate] elements, although they are optional. CheckRSS
// won't work it there isn't a unique element for every item.

// In this case we get our unique element from [guid]
$last_itemId = (string)$last_item->guid;

// Checks if the item is new by comparing the new [guid] with the last stored [guid].
if ($rss->isNewItem($last_itemId)) {

 	echo "There's a new item in " . RSS_FEED . PHP_EOL . PHP_EOL;

 	echo "Title: " 			. $last_item->title 		. PHP_EOL;
 	echo "Description: " 	. $last_item->description 	. PHP_EOL;
 	echo "Link: " 			. $last_item->link 			. PHP_EOL;

 	$rss->WriteLog($last_item->title);

} else {

	echo "There isn't a new item in " . RSS_FEED . PHP_EOL;

 	$rss->WriteLog("No new items found in rss feed");

}