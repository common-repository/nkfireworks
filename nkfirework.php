<?php
/*
Plugin Name: Fireworks
Plugin URI: http://www.nkuttler.de/nkfireworks/
Author: Nicolas Kuttler
Author URI: http://www.nkuttler.de/
Description: Fireworks for your blog, see the <a href="http://www.nkuttler.de/nkfireworks/">live demo</a>.
Version: 0.1.8
*/

// Install hook
register_activation_hook(__FILE__,'nkfireworks_install');
function nkfireworks_install() {
	if (!get_option('nkfireworks_rockets')) {
	    update_option('nkfireworks_rockets', '5');
	    update_option('nkfireworks_timeout', '80');
	    update_option('nkfireworks_maxstepx', '10');
	    update_option('nkfireworks_maxstepy', '10');
	    //update_option('nkfireworks_selected', 'flake2.gif,flake3.gif');
	    update_option('nkfireworks_maxtime', '20');
	    update_option('nkfireworks_uri', '');
	    update_option('nkfireworks_precise', '');
	    update_option('nkfireworks_flakesize', '40');
		update_option('nkfireworks_homelink', 'No');
	}
}

// Hook for adding admin menus
add_action('admin_menu', 'nkfireworks_add_pages');
if (get_option('nkfireworks_uri')) {
	if (
		(
			get_option('nkfireworks_precise') !== 'on' &&
			strpos($_SERVER['REQUEST_URI'], get_option('nkfireworks_uri')) > 0
		) ||
		(
			get_option('nkfireworks_precise') === 'on' &&
			strcmp($_SERVER['REQUEST_URI'], get_option('nkfireworks_uri')) === 0
		)
	) {
		add_action('wp_head', 'nkfireworks_head');
		add_action('wp_footer', 'nkfireworks_footer');
	}
} // default: enable
elseif  (!get_option('nkfireworks_uri')) {
	add_action('wp_head', 'nkfireworks_head');
	add_action('wp_footer', 'nkfireworks_footer');
}
add_action('wp_footer', 'nkfireworks_homelink');


function nkfireworks_add_pages() {
	add_options_page('Fireworks', 'Fireworks', 10, 'nkfireworks', 'nkfireworks_options_page');
	function nkfireworks_options_page() { ?>
		<div class="wrap" style="margin: 0 5mm; max-width: 100ex;">
		<?php
			if ( strlen($_POST['nkfireworks_rockets']) > 0 ) {
				echo '<div id="message" class="updated fade">Form submitted.<br />';
				echo "Settings changed";
				update_option('nkfireworks_rockets', $_POST['nkfireworks_rockets']);
				update_option('nkfireworks_uri', $_POST['nkfireworks_uri']);
				update_option('nkfireworks_precise', $_POST['nkfireworks_precise']);
				update_option('nkfireworks_timeout', $_POST['nkfireworks_timeout']);
				update_option('nkfireworks_maxstepx', $_POST['nkfireworks_maxstepx']);
				update_option('nkfireworks_homelink', $_POST['nkfireworks_homelink']);
				update_option('nkfireworks_maxstepy', $_POST['nkfireworks_maxstepy']);
				update_option('nkfireworks_maxtime', $_POST['nkfireworks_maxtime']);
				//if ($_POST['nkfireworks_selected']) {
				//	update_option('nkfireworks_selected', implode(',', $_POST['nkfireworks_selected']));
				//}
				//else {
    			//	update_option('nkfireworks_selected', 'flake2.gif,flake3.gif');
				//}
				update_option('nkfireworks_flakesize', $_POST['nkfireworks_flakesize']);
				echo '</div>';
			}
		?>
		<h2>Fireworks</h2>
		<p>
		If you have any problems using this plugin, please read the <a href="http://wordpress.org/extend/plugins/nkfireworks/faq/">FAQ</a> first.
		</p>
<h3>Contact</h3>
<p>
Feel free to send me feedback, patches, feature requests etc. to <a href="mailto:wp@nicolaskuttler.de">my mail address</a> or to blog about this plugin. Visit my blog at <a href="http://www.nkuttler.de/">nkuttler.de</a> or this plugin's page at <a href="http://www.nkuttler.de/nkfireworks/">nkfireworks</a>.
<br />
Please remember to <a href="http://www.wordpress.org/extend/plugins/nkfireworks/">rate this widget</a>, especially if you like it.
</p>

<h3>My other plugins</h3>
<p>
<a href="http://www.nkuttler.de/nksnow/">Snow and more</a>:
This one lets you see snowflakes (or other, custom images) fall down your blog.
<br/>
<a href="http://www.nkuttler.de/nktagcloud/">Better tag cloud</a>:
I was pretty unhappy with the default WordPress tag cloud widget. This one is more powerful and offers a list HTML markup that is consistent with most other widgets.
<br/>
<a href="http://www.nkuttler.de/nkmovecomments/">Move WordPress comments</a>:
This plugin adds a small form to every comment on your blog. The form is only added for admins and allows you to move comments to a different post/page and to fix comment threading.
<br />
<a href="http://www.nkuttler.de/nkthemeswitch/">Theme switch</a>:
I like to tweak my main theme that I use on a varity of blogs. If you have ever done this you know how annoying it can be to break things for visitors of your blog. This plugin allows you to use a different theme than the one used for your visitors when you are logged in.
<br/>
<a href="http://www.rhymebox.de/blog/rhymebox-widget/">Rhyming widget</a>:
I wrote a little online rhyming dictionary. This is a widget to search it directly from one of your sidebars.
<br/>
</p>
		<h2>Settings</h2>
		<form action="" method="post">
			Show how many rockets?
			<select name="nkfireworks_rockets" >
			<?php
				$select = get_option('nkfireworks_rockets'); 
				for ($i = 10 ; $i >= 0; $i--) {
					if ( $i == $select ) {
						echo "<option selected>$i</option>\n";
					}
					else {
						echo "<option>$i</option>\n";
					}
				}
			?>
			</select>
			<br />
<!--
			Which of these flakes, drops and leaves do you want? 
			<br />
			<?php
				$dirArray = nkfireworks_dirArray();
				$selected_array = split(',', get_option('nkfireworks_selected'));
				echo "<table style=\"border: 1px solid #ddd; margin: 1mm 0; \" ><tr>";
				for ($i = 0 ; $i < count($dirArray); $i++) {
					echo "<td style=\"vertical-align: top; text-align: center; padding: 2px; \">";
					if ( is_integer(array_search($dirArray[$i], $selected_array)) ) {
						echo "<input type=\"checkbox\" name=\"nkfireworks_selected[]\" value=\"$dirArray[$i]\" checked />";
					}
					else {
						echo "<input type=\"checkbox\" name=\"nkfireworks_selected[]\" value=\"$dirArray[$i]\" />";
					}
					echo "</td>";
				}
				echo "</tr><tr>";
				for ($i = 0 ; $i < count($dirArray); $i++) {
					echo "<td style=\"vertical-align: center; background: #aaf; text-align: center; padding: 2px; \">";
					echo '<img src="' . get_bloginfo('wpurl') .'/' . PLUGINDIR . "/nkfireworks/pics/" . $dirArray[$i] . "\" style=\"margin: 5px 2px;\" />";
					echo "</td>";
				}
				echo "</tr>";
				echo "</table>";
			?>
			By the way if you have nice rockets, drops, leaves etc. feel free to submit them to me if they are properly licensed.
			<br/>
			<input type="submit" value="Update settings" />
			<h2>Custom images</h2>
			<p>If you add your own images to the <tt>pics</tt> directory they will appear in the table above. To have them disappear properly when they are leaving the visible part of the browser window you may have to change the <tt>flakesize</tt> value. 
			<br />
			Make sure the value is bigger than your highest image's height and broadest image's width.
			</p>
			Flakesize?
			<select name="nkfireworks_flakesize" >
			<?php
				$select = get_option('nkfireworks_flakesize'); 
				for ($i = 20 ; $i <= 500; $i = $i + 10) {
					if ( $i == $select ) {
						echo "<option selected>$i</option>\n";
					}
					else {
						echo "<option>$i</option>\n";
					}
				}
			?>
			</select>
			<br/>
			<input type="submit" value="Update settings" />
-->
			<h3>Pro settings</h3>
			Stop fireworks after how many seconds?
			<input type="text" name="nkfireworks_maxtime" value="<?php echo get_option('nkfireworks_maxtime'); ?>" size="3">
			<br />
			Overall speed (timeout in milliseconds between moves)? 
			<select name="nkfireworks_timeout" >
			<?php
				$select = get_option('nkfireworks_timeout'); 
				for ($i = 40 ; $i <= 500; $i = $i + 40) {
					if ( $i == $select ) {
						echo "<option selected>$i</option>\n";
					}
					else {
						echo "<option>$i</option>\n";
					}
				}
			?>
			</select>
			<br />
			Show rockets only on pages whose URI contains
			<input type="text" value="<?php echo get_option('nkfireworks_uri'); ?>" name="nkfireworks_uri" />
			<br />
			Show rockets only if the URI given above and the URI are equal
			($_SERVER['REQUEST_URI'] == URI string)?
		   	<input type="checkbox" name="nkfireworks_precise" <?php
				if (get_option('nkfireworks_precise') === 'on') {
					echo "checked";
				}?>>
			<br />
			Hide the &quot;Powered by&quot; message in the footer?
			<select name="nkfireworks_homelink">
			<option <?php
				if (get_option('nkfireworks_homelink') === 'Yes') {
					echo "selected";
				}?>>Yes</option>
			<option <?php
				if (get_option('nkfireworks_homelink') !== 'Yes') {
					echo "selected";
				}?>>No</option>
			</select>
			<br />
			<input type="submit" value="Update settings" />
		</form>
		</div>
		<?php
	}
}

// set necessary JS variables and include the script
function nkfireworks_head() { ?>
<!-- nkfireworks -->
<script type="text/javascript">
nkf = new Object;
nkf.rockets = <?php
	echo get_option('nkfireworks_rockets');
?>;
nkf.timeout = <?php
	echo get_option('nkfireworks_timeout');
?>;
//nkfireworks_maxstepx = 10;
nkf.maxstepy = 10;
//nkf.flakesize = <?php
	echo get_option('nkfireworks_flakesize');
?>;
nkf.flakesize = 20;
nkf.maxtime = <?php
	echo get_option('nkfireworks_maxtime') * 1000;
?>;
nkf.picsurl = '<?php echo get_bloginfo('wpurl') . '/' . PLUGINDIR . '/nkfireworks/pics/';
?>';
</script>
<script src="<?php echo get_bloginfo('wpurl') . '/' . PLUGINDIR . '/nkfireworks/fireworks.js'; ?>" type="text/javascript"></script>
<!-- /nkfireworks -->
<?php
}

// Put the images into the HTML code
function nkfireworks_footer() {
	$rockets = get_option('nkfireworks_rockets');
	//$selected_array = split(',', get_option('nkfireworks_selected'));
	//$dirArray = nkfireworks_dirArray();
	//$arraymax = count($selected_array) - 1;
	// Check if selected images really exists, revert to defaults if not
	/*
	foreach($selected_array as $selected) {
		if (!file_exists( ABSPATH . '/' . PLUGINDIR . '/nkfireworks/pics/' . $selected )) {
    		$selected_array = array('flake2.gif', 'flake3.gif');
		}
	}
	*/
	/* put gifs in here so that they are in the browser cache when needed */
	/* TODO browser tend to keep the animations of differnt instances of
	 * the same image in sync... put symlinks or something like that in the
	 * pics directory... */

	for ($i = 0; $i < $rockets; $i++) {
				echo "\n<img id=\"nkf" . $i . "\" src=\"" . get_bloginfo('wpurl') . '/' . PLUGINDIR . '/nkfireworks/pics/rocket.gif" style="position: fixed; top: -1000px; border: 0; z-index:1000; visibility: hidden; " class="nkfireworks" alt="fireworks" />';
	}
}

function nkfireworks_homelink() {
	if (
			!(get_option('nkfireworks_homelink') === 'Yes')
	) { ?>
		<a href="http://www.nkuttler.de/nkfireworks/">Wordpress fireworks</a>
		powered by
		<a href="http://www.nkuttler.de/nkfireworks/">nkfireworks</a>
		<br />
<?php
	}
}

function nkfireworks_dirArray() {
	$picpath = ABSPATH . '/' . PLUGINDIR . '/nkfireworks/pics/';
	if ( $picdir = opendir($picpath) ) {
		while($entryName = readdir($picdir)) {

			if ( $entryName == '.' || $entryName == '..' || $entryName == '.svn' ) {
				continue;
			}
			$dirArray[] = $entryName;
		}
	}
	sort($dirArray);
	closedir($picdir);
	return $dirArray;
}
?>
