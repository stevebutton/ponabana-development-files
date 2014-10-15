=== wpRichFeeds ===
Contributors: WillCast
Plugin URI: http://williamscastillo.com/code/plugins/wprichfeeds/
Author URI: http://www.williamscastillo.com/
Plugin URL: http://williamscastillo.com/code/plugins/wprichfeeds/
Author URL: http://www.williamscastillo.com/
Donate link: http://j.mp/WPRichFeeds
Tags: rss,feeds,atom
Requires at least: 3.0.0
Tested up to: 3.1
Version: 1.04
Stable tag: trunk

Adds a given Custom Field, a Post Thumbnail or the first image of the content, to your feed as an enclosure or a media:content record to your RSS and ATOM entries. Additionally, allows you to add an image to the head of your feeds.

== Description ==

It's a Free WordPress plugin that does only two things:

* Allows you to include a image as the header of your RSS/ATOM feeds. Sounds simple, but it adds a lot to the feed in terms of search results' look and brand exposure. It also allows you to add an icon for the ATOM feeds.
* Allows you include an image for every feed entry as an attachment or "enclosure" for the item.  This enclosure could be used for the feed reader and, basically, visually defines the feed entry. wpRichFeeds has three build-in methods to fetch the image that will be used for this: By default, it fetch the first image of the post content but you can specify if you rather prefer to use the WordPress Post Thumbnail feature (if you theme supports it) or even to use a Custom Field.


== Installation ==

1. Unzip the plugin into your `/wp-content/plugins/` directory. If you're uploading it make sure to upload
the entire directory.
2. Activate the plugin through the 'Plugins > Installed' menu from the  WordPress dashboard.
3. Configure the plugin by entering the paths to the images and the fetching and publishing methods.

== Upgrade Notice ==

Usual WordPress procedure for upgrading plugins.


== Usage ==

After you have correctly installed this plugin and visited its Settings page, you will need to specify where are located the images you wish to use as the feed header and icon.

Also, specify which is the main method that should be used to fetch the image of each post entry.


== Frequently Asked Questions ==

= The most Frequently Asked Question: How do I donate? :) =

Easily! Use the following link: http://j.mp/wpRichFeeds :) Thanks in advance!


== Screenshots ==

1. The wpRichFeeds Settings page.
2. A Preview of a RSS feed


== Changelog ==
= 1.0    *2011-03-12* =
* First public release.

= 1.01    *2011-03-12* =
* Added a new publishing method fr RSS feeds: media:content 

= 1.02    *2011-03-13* =
* Added multilanguage support
* Added spanish translation

= 1.03    *2011-03-13* =
* FIXED: Annoying bug left in index.php in 1.02 (it sent me an email)
* Improve a little bit the filter example shown in the setting screen of the plugin.

= 1.04    *2011-03-14* =
* FIXED: The script insert a PHP error in the feed regarding the filesize function.