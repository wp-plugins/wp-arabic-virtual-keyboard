<?php

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

function wpavk_install() {
			global $wpdb;
			
			$wpdb->show_errors();
			
			$sql = "";
			$charset_collate = "";
			
			
			if ( ! empty($wpdb->charset) ) $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( ! empty($wpdb->collate) ) $charset_collate .= " COLLATE $wpdb->collate";
			$table = $wpdb->prefix . "arabic_keyboard";
			
			if ( $wpdb->get_var("SHOW TABLES LIKE '$table'") != $table ) { 
				$sql = "CREATE TABLE " . $table . " (
													`id` int(5) NOT NULL AUTO_INCREMENT,
													`page_type` varchar(255) NOT NULL,
													`page_id` varchar(255) NOT NULL,
													`keyboard_position` varchar(255) NOT NULL,
													UNIQUE KEY (`id`));";
			} 
			
			dbDelta($sql);
}