<?php

function wpavk_uninstall() {
	global $wpdb;

	$table_name = $wpdb->prefix . "arabic_keyboard";
	$wpdb->query("DROP TABLE IF EXISTS $table_name");

}    
?>