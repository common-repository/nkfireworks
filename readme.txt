=== Fireworks ===
Contributors: nkuttler
Author URI: http://www.nkuttler.de/
Plugin URI: http://www.nkuttler.de/nkfireworks/
Donate link: http://www.amazon.de/gp/registry/24F64AHKD51LY
Tags: admin, plugin, new year, fireworks, toy, toys, fun, funny
Requires at least: 2.1
Tested up to: 2.8.4
Stable tag: 0.1.8

Fireworks for you blog. 

== Description ==
<p>
Fireworks for you blog. Have a look at the <a href="http://www.nkuttler.de/nkfireworks/">live demo</a>.
</p>
<p>
If you like this you might like my <a href="http://www.nkuttler.de/nksnow/">WordPress snowfall plugin</a> as well.
</p>

<h3>My other plugins</h3>
<p>
<a href="http://www.nkuttler.de/nktagcloud/">Better tag cloud</a>:
I was pretty unhappy with the default WordPress tag cloud widget. This one is more powerful and offers a list HTML markup that is consistent with most other widgets.
<br/>
<a href="http://www.nkuttler.de/nkmovecomments/">Move WordPress comments</a>:
This plugin adds a small form to every comment on your blog. The form is only added for admins and allows you to move comments to a different post/page and to fix comment threading.
<br/>
<a href="http://www.nkuttler.de/nkthemeswitch/">Theme switch</a>:
I like to tweak my main theme that I use on a varity of blogs. If you have ever done this you know how annoying it can be to break things for visitors of your blog. This plugin allows you to use a different theme than the one used for your visitors when you are logged in.
<br/>
<a href="http://www.rhymebox.de/blog/rhymebox-widget/">Rhyming widget</a>:
I wrote a little online rhyming dictionary. This is a widget to search it directly from one of your sidebars.
<br/>
<a href="http://www.nkuttler.de/nksnow/">Snow and more</a>:
This one lets you see snowflakes (or other, custom images) fall down your blog.
</p>

== Installation ==
<ol>
<li>Unzip nkfireworks.zip</li>
<li>Upload nkfireworks to your `/wp-content/plugins/` directory</li>
<li>Activate the plugin through the 'Plugins' menu in WordPress</li>
<li>Configure as you like. See <tt>Settings</tt>, then <tt>Fireworks</tt>.</li>
<li>Enjoy! Read the <a href="http://wordpress.org/extend/plugins/nkfireworks/faq/">FAQ</a> if there's no snow.</li>
</ol>


== Screenshots ==
1. Fireworks. See the <a href="http://www.nkuttler.de/nkfireworks/">live demo</a>

== Frequently Asked Questions ==
Q: I see no fireworks.<br />
A: Please make sure that your template uses the wp_footer() and wp_head() template tags. They should be in your header.php and footer.php, see <a href="http://codex.wordpress.org/Theme_Development">the theme development page</a>.<br />

Q: I still see no fireworks.<br />
A: Please send me a link to your blog. It's quite possible that some doctype combinations or browsers will not work. If somebody complains I might try to fix it.<br />

Q: The fireworks look odd, there's a border around them, they have a background etc.<br />
A: Add <tt>img.nkfireworks { border: 0 }</tt> at the end of your style.css (or change the CSS property you need to change).

Q: Why don't you have nicer explosions/rockets?<br />
A: Sorry, I'm not a designer. Feel free to send me more properly licensed pictures that I can include.<br />

== Changelog ==
= 0.1.8 =
 * Fix bad upgrade bug that deletes the plugin configuration
= 0.1.7.1 =
 * Doc updates
= 0.1.7 =
 * Doc updates
 * New Changelog format
= 0.1.6 =
 * Doc updates
= 0.1.5 =
 * Remove unnecessary file
= 0.1.4 =
 * Minor updates
= 0.1.3 =
 * Doc updates
 * Add class to images to generate valid markup, thanks to <a href="http://mintys.lt/">Gudas</a> for suggesting this for my <a href="http://www.nkuttler.de/nkfireworks/">WordPress snowstorm</a> plugin.
= 0.1.2 =
 * Undo last 'update'
= 0.1.1 =
 * Let IE5 ignore this script
= 0.1.0 =
 * Remove preloading
 * Make images invisble while changing the img src
 * IE6 compatibiliy hack added
= 0.0.5 =
 * Try to preload all explosions
 * Separate gif for every explosion to avoid an animation restart when a gif appears a second time on the page.
= 0.0.4 =
 * Release 0.0.3 went wrong
= 0.0.3 =
 * Fix stupid bug, the images were hardcoded to my server. Doc updates
= 0.0.2 =
 * Docs updates
= 0.0.1 =
 * Initial release

