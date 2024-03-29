=== oik-twit ===
Contributors: bobbingwide
Donate link: https://www.oik-plugins.com/oik/oik-donate/
Tags: oik, plugin, unloader
Requires at least: 6.4.3
Tested up to: 6.4.3
Stable tag: 0.2.0

Today's word is this.

== Description ==
Displays the word or phrase for the given date projected from a predefined sequence.

== Installation ==
1. Upload the contents of the oik-twit plugin to the `/wp-content/plugins/oik-twit' directory
1. Activate the oik-twit plugin through the 'Plugins' menu in WordPress
1. Use the [twit] shortcode to display today's word.

== Frequently Asked Questions ==

= What is this plugin for? =
It was written to display the answers to two different Food based Wordles.
The sequences you can chose are:

1. dayoftheweek - used to test the logic
2. food-le.com - the sequence of 5 letter words used by food-le.com
3. foodlewordle.io - the sequence of 5 letter words used by foodlewordle.io

For more information on how I made these sequences see https://herbmiller.me/foodle-answers-my-food-le-com-crib-sheet/

= What are the parameters to the twit shortcode? =

[twit sequence=daysoftheweek | food-le.com | foodlewordle.io date="any date accepted by strtotime()" ]

These are positional; you don't have to specify the attribute name.

By default the plugin will display the value from the dayoftheweek sequence for the current date.


== Screenshots ==
1. days of the week - yesterday, today, tomorrow
2. food-le.com - yesterday, today, tomorrow
3. foodlewordle.io - yesterday, today, tomorrow

== Upgrade Notice ==
= 0.2.0 =
Upgrade for automatic cache clearance when using SiteGround's Speed Optimizer ( sg-cachepress ).

= 0.1.0 = 
Update for ability to style Wordles based sequences

= 0.0.0 =
Prototype version for herbmiller.me.

== Changelog ==
= 0.2.0 = 
* Added: Add logic to clear the cache after midnight #4

= 0.1.0 = 
* Added: Early version to display phases of the moon #3
* Changed: Support styling of wordle based words letter by letter #2

= 0.0.0 =
* Added: Brand new plugin. 
* Tested: With WordPress 6.4.3
* Tested: With PHP 8.3

== Further reading ==

If you want to read more about oik plugins and themes then please visit
[oik-plugins](https://www.oik-plugins.com/)