<?php
/*
	Plugin Name: WP Arabic Virtual Keyboard
	Plugin URI: http://webexplorar.com/wordpress-arabic-virtual-keyboard-plugin/
	Description: Make it very easy to type using this virtual keyboard without any 3rd party Software or Web sites.Really easy to type in Arabic language.You can search something in Google or Youtube by using this keyboard.If your keyboard is not working, or you can type in mobile phone easy using this virtual keyboard.Use <strong>[wp-arabic-virtual-keyboard]</strong> shortcode to display the keyboard any place.
	Author: Sumith Harshan
	Author URI: http://webexplorar.com/
	Version: 2.0
*/	
 
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

function wpavk_admin() {
	require (dirname(__FILE__) . '/admin.php');
}	
		
		
add_action('admin_menu', 'wpavk_plugin_admin_add_page');
function wpavk_plugin_admin_add_page() {
	add_menu_page('WP Arabic Virtual Keyboard', 'Arabic Keyboard', 'manage_options', 'wpavk_admin', 'wpavk_admin',plugins_url('/images/keyboard-icon16.png', __FILE__));
}


function wpavk_admin_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'wpavk_admin_register_head');


function wpavk_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=wpavk_admin">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'wpavk_plugin_settings_link' );


function wpavk_load_jquery_library() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}     
add_action('wp_enqueue_scripts', 'wpavk_load_jquery_library');


function wpavk_keyboard_script() {
	wp_enqueue_script( 'wp-arabic-keyboard', plugin_dir_url( __FILE__ ) . 'js/script.js', array(), '0.1', 'screen' );
	wp_enqueue_script( 'wp-arabic-keyboard-zclip-min', plugin_dir_url( __FILE__ ) . 'js/jquery.zclip.js', array(), '1.1.1', 'screen' );
}    
add_action('wp_enqueue_scripts', 'wpavk_keyboard_script');





function wpavk_prefix_add_stylesheet() {
	wp_enqueue_style( 'wp-arabic-keyboard', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), '0.1', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'wpavk_prefix_add_stylesheet' );
 
 
 
add_action('wp_head', 'wpavk_add_metatags');
function wpavk_add_metatags(){
	echo '<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1"/>';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	
	echo '<script>var wpvrk_site_url = "'.get_site_url().'";</script>';
	
}

 

function wpavk_keyboard_shortcode($atts) { 
	ob_start();
	
	// define attributes and their defaults
    extract( shortcode_atts( array ('id' => '1'), $atts ) );
 	 
	$keyboard_content = '<div id=\'wpvrk_keyboard_main_wrapper\'><div id=\'areawrapper\'><textarea tabindex=\'1\' class=\'resizable processed\' name=\'area\' dir=\'rtl\' id=\'area\'></textarea></div><div id=\'keyboard\'> <ul class=\'cf\' id=\'numbers\'>
	<li><a class=\'key c192\' onclick=\'wpavk_wr("ذ")\'><span>~</span>&#1584;</a></li>
	<li><a class=\'key c49\' onclick=\'wpavk_wr("&#1633;")\'><span>1</span>&#1633;</a></li>
	<li><a class=\'key c50\' onclick=\'wpavk_wr("&#1634;")\'><span>2</span>&#1634;</a></li>
	<li><a class=\'key c51\' onclick=\'wpavk_wr("&#1635;")\'><span>3</span>&#1635;</a></li>
	<li><a class=\'key c52\' onclick=\'wpavk_wr("&#1636;")\'><span>4</span>&#1636;</a></li>
	<li><a class=\'key c53\' onclick=\'wpavk_wr("&#1637;")\'><span>5</span>&#1637;</a></li>
	<li><a class=\'key c54\' onclick=\'wpavk_wr("&#1638;")\'><span>6</span>&#1638;</a></li>
	<li><a class=\'key c55\' onclick=\'wpavk_wr("&#1639;")\'><span>7</span>&#1639;</a></li>
	<li><a class=\'key c56\' onclick=\'wpavk_wr("&#1640;")\'><span>8</span>&#1640;</a></li>
	<li><a class=\'key c57\' onclick=\'wpavk_wr("&#1641;")\'><span>9</span>&#1641;</a></li>
	<li><a class=\'key c48\' onclick=\'wpavk_wr("&#1632;")\'><span>0</span>&#1632;</a></li>
	<li><a class=\'key c189  alt\' onclick=\'wpavk_wr("~")\'><span>&nbsp;</span>~</a></li>
	<li><a class=\'key c187\' onclick=\'wpavk_wr("!")\'><span>&nbsp;</span>!</a></li>
	<li><a class=\'key c46\' id=\'delete\' onclick=\'wpavk_op("back")\'><span>Delete</span></a></li>
				</ul>
				<ul class=\'cf\' id=\'qwerty\'>
	<li><a class=\'key c9\' id=\'tab\' onclick=\'wpavk_wr("\t")\'><span>Tab</span></a></li>
	<li><a class=\'key c81\' onclick=\'wpavk_wr("ض")\'><span>q</span>&#1590;</a></li>
	<li><a class=\'key c87\' onclick=\'wpavk_wr("ص")\'><span>w</span>&#1589;</a></li>
	<li><a class=\'key c69\' onclick=\'wpavk_wr("ث")\'><span>e</span>&#1579;</a></li>
	<li><a class=\'key c82\' onclick=\'wpavk_wr("ق")\'><span>r</span>&#1602;</a></li>
	<li><a class=\'key c84\' onclick=\'wpavk_wr("ف")\'><span>t</span>&#1601;</a></li>
	<li><a class=\'key c89\' onclick=\'wpavk_wr("غ")\'><span>y</span>&#1594;</a></li>
	<li><a class=\'key c85\' onclick=\'wpavk_wr("ع")\'><span>u</span>&#1593;</a></li>
	<li><a class=\'key c73\' onclick=\'wpavk_wr("ه")\'><span>i</span>&#1607;</a></li>
	<li><a class=\'key c79\' onclick=\'wpavk_wr("خ")\'><span>o</span>&#1582;</a></li>
	<li><a class=\'key c80\' onclick=\'wpavk_wr("ح")\'><span>p</span>&#1581;</a></li>
	<li><a class=\'key c219 alt\' onclick=\'wpavk_wr("ج")\'><span>{[</span>&#1580;</a></li>
	<li><a class=\'key c221 alt\' onclick=\'wpavk_wr("د")\'><span>}]</span>&#1583;</a></li>
	<li><a class=\'key c220 alt\' onclick=\'wpavk_wr("_")\'><span>- _</span></a></li>
				</ul>
				<ul class=\'cf\' id=\'asdfg\'>
	<li><a class=\'key c20 alt\' id=\'caps\'><span>Copy</span></a></li>
	<li><a class=\'key c65\' onClick=\'wpavk_wr("ش")\'><span>a</span>&#1588;</a></li>
	<li><a class=\'key c83\' onclick=\'wpavk_wr("س")\'><span>s</span>&#1587;</a></li>
	<li><a class=\'key c68\' onclick=\'wpavk_wr("ي")\'><span>d</span>&#1610;</a></li>
	<li><a class=\'key c70\' onclick=\'wpavk_wr("ب")\'><span>f</span>&#1576;</a></li>
	<li><a class=\'key c71\' onclick=\'wpavk_wr("ل")\'><span>g</span>&#1604;</a></li>
	<li><a class=\'key c72\' onclick=\'wpavk_wr("ا")\'><span>h</span>&#1575;</a></li>
	<li><a class=\'key c74\' onclick=\'wpavk_wr("ت")\'><span>j</span>&#1578;</a></li>
	<li><a class=\'key c75\' onclick=\'wpavk_wr("ن")\'><span>k</span>&#1606;</a></li>
	<li><a class=\'key c76\' onclick=\'wpavk_wr("م")\'><span>l</span>&#1605;</a></li>
	<li><a class=\'key c186 alt\' onclick=\'wpavk_wr("ك")\'><span>"</span>&#1603;</a></li>
	<li><a class=\'key c222 alt\' onClick=\'wpavk_wr("ط")\'><span>"</span>&#1591;</a></li>
	<li><a class=\'key c13 alt\'id=\'enter\' onClick=\'wpavk_wr("\n")\'><span>Enter</span></a></li>
				</ul>
				<ul class=\'cf\' id=\'zxcvb\'>
	<li><a class=\'key c16 shiftleft\'onClick=\'wpavk_op("google");\'><span>Search in Google</span></a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("ئ")\'><span>z</span>&#1574;</a></li>
	<li><a class=\'key c88\' onclick=\'wpavk_wr("ء")\'><span>x</span>&#1569;</a></li>
	<li><a class=\'key c67\' onclick=\'wpavk_wr("ؤ")\'><span>c</span>&#1572;</a></li>
	<li><a class=\'key c86\' onclick=\'wpavk_wr("ر")\'><span>v</span>&#1585;</a></li>
	<li><a class=\'key c66\' onclick=\'wpavk_wr("لا")\'><span>b</span>&#1604;&#1575;</a></li>
	<li><a class=\'key c78\' onclick=\'wpavk_wr("ى")\'><span>n</span>&#1609;</a></li>
	<li><a class=\'key c77\' onclick=\'wpavk_wr("ة")\'><span>m</span>&#1577;</a></li>
	<li><a class=\'key c188 alt\' onclick=\'wpavk_wr("و")\'><span>&lt;,</span>&#1608;</a></li>
	<li><a class=\'key c190 alt\' onclick=\'wpavk_wr("ز")\'><span>&gt;.</span>&#1586;</a></li>
	<li><a class=\'key c191 alt\' onClick=\'wpavk_wr("ظ")\'><span>?/</span>&#1592;</a></li>
	<li><a class=\'key c16 shiftright\' onclick=\'wpavk_sl("area").select()\'><span>Select</span></a></li>
				</ul>
				<ul class=\'cf\' id=\'bottomrow\'>
	<li id=\'vow-1\'><a class=\'key c90\' onClick=\'wpavk_wr("&#1611;")\'>&#1611;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1612;")\'>&#1612;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1613;")\'>&#1613;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1614;")\'>&#1614;</a></li>
	<li><a class=\'key c32\' id=\'spacebar\' onClick=\'wpavk_wr(" ")\'> </a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1615;")\'>&#1615;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1616;")\'>&#1616;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1617;")\'>&#1617;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr("&#1618;")\'>&#1618;</a></li>
				</ul>
				
				<ul class=\'cf additional\' id=\'qwerty\'>
	<li><a class=\'key c81\'onclick=\'wpavk_wr("لآ")\'>&#1604;&#1570;</a></li>
	<li><a class=\'key c87\'onclick=\'wpavk_wr("آ")\'>&#1570;</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr(",")\'>,</a></li>
	<li><a class=\'key c90\' onClick=\'wpavk_wr(".")\'>.</a></li> 
	<li><a class=\'key c90\' onClick=\'wpavk_wr("؟")\'>&#1567;</a></li> 
	<li><a class=\'key c90\' onClick=\'wpavk_wr("لأ")\'>&#1604;&#1571;</a></li> 
	<li><a class=\'key c82\' onclick=\'wpavk_wr("أ")\'>&#1571;</a></li>
	<li><a class=\'key c84\' onclick=\'wpavk_wr("-")\'>-</a></li>
	<li><a class=\'key c89\' onclick=\'wpavk_wr("،")\'>&#1548;</a></li>
	<li><a class=\'key c85\' onclick=\'wpavk_wr("إ")\'>&#1573;</a></li>
	<li><a class=\'key c73\' onclick=\'wpavk_wr(";")\'>;</a></li>
				</ul>
			</div>
	</div>'; 
	 
	 
	echo $keyboard_content; 
 	  
	return ob_get_clean();
}
add_shortcode('wp-arabic-virtual-keyboard', 'wpavk_keyboard_shortcode');
?>