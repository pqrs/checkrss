# CheckRSS

Check RSS feeds for new items

**NOTE: If you happen to arrive to this repo, please have in mind that CheckRSS is in early development stages**

## What CheckRSS does

CheckRSS loads an RSS file and checks if there are new items since the last time it was checked. It is intended to be used with cron jobs.

It only checks the last (newest) item. If there are two or more new items between program runs you'll only get the last one, losing the others. The publication frequency depends of the source so it's up to you running the program as often as necessary.


## How CheckRSS works

CheckRSS provides two functions: getLastItem(), isNewItem() and WriteLog().

With these three functions you can:

1. Obtain the last item in an rss feed.
1. Check if that last item is the same that the last time it was checked or a new one.
1. Write a log everytime the program is run.

#### object getLastitem( string $feed_url )

Given a feed URL as its only parameter, this functions loads the feed and returns its last (newest) item.

An example of the item returned would be:

```
SimpleXMLElement Object
(
    [guid] => https://www.nbcnews.com/storyline/hurricane-irma/...
    [title] => One-two punch of disease and Irma has left Florida citrus reeling
    [pubDate] => Sat, 10 Feb 2018 15:17:00 GMT
    [link] => https://www.nbcnews.com/storyline/hurricane-irma/...
    [description] => Hurricane Irma served as a knockout punch for many of Florida's...
)
```

#### boolean isNewItem( string $itemId )

Finds wether an item's Id is new (returns true) or not (false).

You must pass an element that is unique. [guid] or [pubDate] use to be unique.

It stores the last item Id in a file (lastrss.txt) to compare with in new checks. Working directory must have write permissions (666) if you call it through your web browser.


#### WriteLog( string $logline )

Writes the text line passed as an argument to a log file called cron.log. Working directory must have write permissions (666) if you call it through your web browser.

## Samples

[...]

## Installation

[...]

## Prerequisites

PHP 7.0.12

But it will probably run without problems in PHP 5.x versions.

## Author notes

This is a cleanup of a dirty code I wrote some time ago. Also it's my first try with GitHub, Composer and Packagist so if you find some mistakes or have some tips for me, I would be more than glad to hear you.

I hope this code suites your needs.

Thanks.