=== Fancy Header Slider ===
Contributors: Rashmi K Soni 
Donate link: http://rashmiksoni.com/
Tags:wordpress Slider , Header , Slider , Images , Gallery slider
Requires at least: 2.7
Tested up to: 3.0.1
Stable tag: 2.0

Image gallery with fancy transitions effects. This is a "strip curtain" effect

== Description ==

This is header gallery plugin if you want so fancy look in you header part you can use this one.you can made custom effect with set of options that you can use to set speed, number of strips,direction, type of effect, etc. Bellow is list of all parameters and their values that you can use.

effect: "", // wave, zipper, curtain

width: 500, // width of panel

height: 332, // height of panel

strips: 20, // number of strips

delay: 5000, // delay between images in ms

stripDelay: 50, // delay beetwen strips in ms

titleOpacity: 0.7, // opacity of title

titleSpeed: 1000, // speed of title appereance in ms

position: "alternate", // top, bottom, alternate, curtain

direction: "fountainAlternate", // left, right, alternate, random, fountain, fountainAlternate

navigation: false, // prev and next navigation buttons

links: false // show images as links

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Download FancyHeaerSlider.zip plugin
2. Activate the plugin through the 'Plugins' menu in WordPress
3. after active you will see the "Header slider" in menu bar
4. Upload images any size and you can set option for that plugin.
5. after done this add a function in your page / post shordtcode
`if(function_exists('fhs_display_front'))
{
echo fhs_display_front();
}
`
 
for demo please <a href="http://blog.rashmiksoni.com/header-image-gallery/" target="_blank">click here </a>

== Frequently Asked Questions ==

== Screenshots ==

1. Add new media to be used as a dynamic header.
2. Plugin area.
3. slider setting option.

== Changelog ==

= 1.2 =
* Update Some basic issue


= 1.5 =
* Update Some basic issue. that realy needed

= 1.6 =
* Update Some basic issue. that realy needed

= 1.7 =
* Update Some basic issue. that realy needed

= 2.0 =
* change Fancy header slider code and delete unwanted Js and css so no confliction occur with any theme and default theme
