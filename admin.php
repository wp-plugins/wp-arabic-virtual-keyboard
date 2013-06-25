<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	global $wpdb;
	$table    = $wpdb->prefix . "arabic_keyboard";

	$record_ID = '';
	$page_ID   = '';
	$pageIDString = '';
	
function wpavk_get_pages() {
	global $wpdb;
	$table    = $wpdb->prefix . "arabic_keyboard"; 
	$result_details = $wpdb->get_results("SELECT * from ".$table);
	foreach($result_details as $result_data){
		$record_ID = $result_data->id;  	
		$page_ID   = $result_data->page_id;
	}
	$page_ID_Arr = explode(',',$page_ID);
	return $page_ID_Arr;
	
}
function wpavk_get_keyID() {
	global $wpdb;
	$table    = $wpdb->prefix . "arabic_keyboard";
	$result_details = $wpdb->get_results("SELECT * from ".$table);
	foreach($result_details as $result_data){
		$record_ID = $result_data->id; 
	}
	$record_ID_Arr = explode(',',$record_ID);
	return $record_ID_Arr;
	
}

$page_ID_Array = wpavk_get_pages();

if( isset($_POST['wpakp_hidden']) && $_POST['wpakp_hidden'] == 'Y' ) {
	
	$keyboard_position = trim($_POST['keyboard_position']);
	$wpakp_keyID = trim($_POST['wpakp_keyID']);
 
	
	
	if( isset($_POST['pageIDs']) && is_array($_POST['pageIDs']) ) {
		foreach($_POST['pageIDs'] as $pageID) {
			 $pageIDString .= $pageID.',';
		}
	}
$record_ID_Array = wpavk_get_keyID();

	if(isset($record_ID_Array[0]) && $record_ID_Array[0] !='') { 
    	$results = $wpdb->update($table,array("page_id" =>$pageIDString, "page_type" => "page",'keyboard_position'=>$keyboard_position),array("id"=>$record_ID_Array[0]));
	} else {  
		$results = $wpdb->insert($table,array('id'=>'','page_type'=>"page",'page_id'=>$pageIDString,'keyboard_position'=>$keyboard_position));
	}
	
	$page_ID_Array = wpavk_get_pages();
  
}
?>
<div class="wpakp-wrapper">
	<div id="icon-keyboard" class="icon"></div>
    <h2>Arabic Virtual Keyboard Settings</h2>
    <?php if(isset($results))  { ?>
    <div class="updated"><p><strong><?php _e('Options saved.' );?></strong></p></div>
    <?php } ?>
    <h3>Select Pages do you want to display the keyboard</h3>    
    <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
        <table width="99%">
          <tr><td><div id="errNotes"></div></td></tr>
          <tr><td>
          <input type="hidden" name="wpakp_hidden" id="wpakp_hidden" value="Y"/>
          <input type="hidden" name="wpakp_keyID" id="wpakp_keyID" value="<?php echo $page->id; ?>"/>	
          </td></tr>
          
          <tr><td>
          
          
          <table class="widefat">
            <thead>
                <tr>
                    <th>Page</th>         
                </tr>
            </thead>
            <tbody>
		  <?php

			$args = array(
				'sort_order' => 'ASC',
				'sort_column' => 'post_title',
				'post_type' => 'page',
				'post_status' => 'publish'
			); 

            $pages = get_pages($args); 

  			foreach ( $pages as $page ) {
				
			?>
            <tr>
           	 <td><input type="checkbox" class="wpakCheckbox" name="pageIDs[]" value="<?php echo $page->ID; ?>" <?php if(in_array($page->ID,$page_ID_Array)) { ?> checked="checked"<?php }?>/>&nbsp;&nbsp;&nbsp;<?php echo $page->post_title; ?></td>
        	</tr>
			<?php	
			} 
          ?>
           </tbody>
           </table>
          </td></tr>
          <tr><td></td></tr>
          <tr><td align="left"><h3>Select a position to display the keyboard</h3>  </td></tr>
          <tr><td align="left">
          <select name="keyboard_position" id="keyboard_position">
          	<option value="Before_page_content">Before page content</option>
            <option value="After_page_content">After page content</option>
          </select>
          </td></tr>
          
          <tr><td align="left"><br/><input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button-primary" /></td></tr>
          <tr><td align="center"></td></tr>
        </table>
    </form>
  
</div>