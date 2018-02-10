<?php

namespace CheckRSS;

class Check
{
    public static function helloworld()
    {
        return 'Hello World!';
    }

    public static function getLastItem($feed_url)
    {
        $rss = simplexml_load_file($feed_url);		// Loads the rss feed into $rss

        $items = $rss->channel->item;				// Assigns the items to $items

        return $items[0];							// Returns the last item of the rss feed
    }

    public static function isNewItem($itemId)
    {
    	$dir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']);

    	// $_SERVER['DOCUMENT_ROOT'] has a trailing slash when used with Apache so we remove it if it is present
    	$dir = str_replace ("//", "/", $dir);

    	if (file_exists($dir."/lastrss.txt")) {

    		$last_storedId = file_get_contents($dir."/lastrss.txt");

    		if($last_storedId == $itemId) {

    			return false;		// There isn't a new element in the feed

    		} else {

    			file_put_contents($dir."/lastrss.txt", $itemId);

    			return true;		// There's a new element in the feed
    		}

    	}

    	else {

    		file_put_contents($dir."/lastrss.txt", $itemId);

    		chmod($dir."/lastrss.txt", 0666);

    		return true;			// There's a new element in the feed

    	}

    }


    public static function WriteLog($logline) {

    	$logfile = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . "/cron.log";

    	// $_SERVER['DOCUMENT_ROOT'] has a trailing slash when used with Apache so we remove it if it is present
    	$logfile = str_replace ("//", "/", $logfile);

    	if (file_exists($logfile)) {

    		file_put_contents($logfile, date("d/m/Y H:i") . " $logline" . PHP_EOL, FILE_APPEND );

    	} else {

    		file_put_contents($logfile, date("d/m/Y H:i") . " $logline" . PHP_EOL );

    		chmod($logfile, 0666);

    	}


    }

}

