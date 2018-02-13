<?php

namespace CheckRSS;

class RSS
{
    public $title;
    public $description;
    public $link;


    public static function getItems($feed_url)
    {
        $rss = simplexml_load_file($feed_url);          // Loads the rss feed into $rss

        $items = $rss->channel->item;                   // Assigns the items to $items

        return $items;                                  // Returns the last item of the rss feed
    }


    public static function getNewItems($items)
    {
        $i = 0;

        $newitems[0] = null;

        foreach ($items as $key => $value) {

            $item_id = (string)$value->guid;

            if (RSS::isNewItem($item_id)) {

                $newitems[$i] = new RSS;

                $newitems[$i]->title        = $value->title;
                $newitems[$i]->description  = $value->description;
                $newitems[$i]->link         = $value->link;
                $newitems[$i]->guid         = $value->guid;

                $i++;

            } else break;

        }

        if ( $newitems[0] ) {

            RSS::storeLastItemID($newitems[0]->guid);

            return $newitems;

        } else {

            return false;

        }


    }


    public static function storeLastItemID($item_id)
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']);

        // $_SERVER['DOCUMENT_ROOT'] has a trailing slash when used with Apache so we remove it if it is present
        $dir = str_replace ("//", "/", $dir);

        if (file_exists($dir."/lastrss.txt")) {

            file_put_contents($dir."/lastrss.txt", $item_id);

        } else {

            file_put_contents($dir."/lastrss.txt", $item_id);
            chmod($dir."/lastrss.txt", 0666);

        }

    }


    public static function isNewItem($item_id)
    {
    	$dir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']);

    	// $_SERVER['DOCUMENT_ROOT'] has a trailing slash when used with Apache so we remove it if it is present
    	$dir = str_replace ("//", "/", $dir);

    	if (file_exists($dir."/lastrss.txt")) {

    		$last_storedId = file_get_contents($dir."/lastrss.txt");

    		if($last_storedId == $item_id) {

    			return false;		// There isn't a new element in the feed

    		} else {

    			return true;		// There's a new element in the feed
    		}

    	}

    	else {

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

