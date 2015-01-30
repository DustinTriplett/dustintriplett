<?php
add_action( 'admin_enqueue_scripts', 'import_epanel_javascript' );
function import_epanel_javascript( $hook_suffix ) {
	if ( 'admin.php' == $hook_suffix && isset( $_GET['import'] ) && isset( $_GET['step'] ) && 'wordpress' == $_GET['import'] && '1' == $_GET['step'] )
		add_action( 'admin_head', 'admin_headhook' );
}

function admin_headhook(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("p.submit").before("<p><input type='checkbox' id='importepanel' name='importepanel' value='1' style='margin-right: 5px;'><label for='importepanel'>Replace ePanel settings with sample data values</label></p>");
		});
	</script>
<?php }

add_action('import_end','importend');
function importend(){
	global $wpdb, $shortname;

	#make custom fields image paths point to sampledata/sample_images folder
	$sample_images_postmeta = $wpdb->get_results(
		$wpdb->prepare( "SELECT meta_id, meta_value FROM $wpdb->postmeta WHERE meta_value REGEXP %s", 'http://et_sample_images.com' )
	);
	if ( $sample_images_postmeta ) {
		foreach ( $sample_images_postmeta as $postmeta ){
			$template_dir = get_template_directory_uri();
			if ( is_multisite() ){
				switch_to_blog(1);
				$main_siteurl = site_url();
				restore_current_blog();

				$template_dir = $main_siteurl . '/wp-content/themes/' . get_template();
			}
			preg_match( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $postmeta->meta_value, $matches );
			$image_path = $matches[1];

			$local_image = preg_replace( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $template_dir . '/sampledata/sample_images/$1.jpg', $postmeta->meta_value );

			$local_image = preg_replace( '/s:55:/', 's:' . strlen( $template_dir . '/sampledata/sample_images/' . $image_path . '.jpg' ) . ':', $local_image );

			$wpdb->update( $wpdb->postmeta, array( 'meta_value' => esc_url_raw( $local_image ) ), array( 'meta_id' => $postmeta->meta_id ), array( '%s' ) );
		}
	}

	if ( !isset($_POST['importepanel']) )
		return;

	$importOptions = 'YTo4Njp7czowOiIiO047czoxMjoiZGV2aWFudF9sb2dvIjtzOjA6IiI7czoxNToiZGV2aWFudF9mYXZpY29uIjtzOjA6IiI7czoyMDoiZGV2aWFudF9jb2xvcl9zY2hlbWUiO3M6MzoiUmVkIjtzOjE0OiJkZXZpYW50X2Zvcm1hdCI7TjtzOjE4OiJkZXZpYW50X2dyYWJfaW1hZ2UiO047czoxOToiZGV2aWFudF9kYXRlX2Zvcm1hdCI7czo3OiJNIGpTLCBZIjtzOjIwOiJkZXZpYW50X2NhdG51bV9wb3N0cyI7czoxOiI1IjtzOjI0OiJkZXZpYW50X2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyMzoiZGV2aWFudF9zZWFyY2hudW1fcG9zdHMiO3M6MToiNSI7czoyMDoiZGV2aWFudF90YWdudW1fcG9zdHMiO3M6MToiNSI7czoxOToiZGV2aWFudF91c2VfZXhjZXJwdCI7TjtzOjIyOiJkZXZpYW50X2hvbWVwYWdlX3Bvc3RzIjtzOjE6IjYiO3M6MjI6ImRldmlhbnRfZXhsY2F0c19yZWNlbnQiO047czoxNzoiZGV2aWFudF9tZW51cGFnZXMiO047czoyNDoiZGV2aWFudF9lbmFibGVfZHJvcGRvd25zIjtzOjI6Im9uIjtzOjE3OiJkZXZpYW50X2hvbWVfbGluayI7czoyOiJvbiI7czoyNToiZGV2aWFudF90aWVyc19zaG93bl9wYWdlcyI7czoxOiIzIjtzOjE4OiJkZXZpYW50X3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MTg6ImRldmlhbnRfb3JkZXJfcGFnZSI7czozOiJhc2MiO3M6MTY6ImRldmlhbnRfbWVudWNhdHMiO047czozNToiZGV2aWFudF9lbmFibGVfZHJvcGRvd25zX2NhdGVnb3JpZXMiO3M6Mjoib24iO3M6MzA6ImRldmlhbnRfdGllcnNfc2hvd25fY2F0ZWdvcmllcyI7czoxOiIzIjtzOjE2OiJkZXZpYW50X3NvcnRfY2F0IjtzOjQ6Im5hbWUiO3M6MTc6ImRldmlhbnRfb3JkZXJfY2F0IjtzOjM6ImFzYyI7czoxOToiZGV2aWFudF9zd2FwX25hdmJhciI7TjtzOjIzOiJkZXZpYW50X2Rpc2FibGVfdG9wdGllciI7TjtzOjE3OiJkZXZpYW50X3Bvc3RpbmZvMiI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MjU6ImRldmlhbnRfc2hvd19wb3N0Y29tbWVudHMiO3M6Mjoib24iO3M6MTg6ImRldmlhbnRfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyOToiZGV2aWFudF90aHVtYm5haWxfd2lkdGhfcG9zdHMiO3M6MzoiMjAwIjtzOjMwOiJkZXZpYW50X3RodW1ibmFpbF9oZWlnaHRfcG9zdHMiO3M6MzoiMjAwIjtzOjIzOiJkZXZpYW50X3BhZ2VfdGh1bWJuYWlscyI7TjtzOjI2OiJkZXZpYW50X3Nob3dfcGFnZXNjb21tZW50cyI7TjtzOjI5OiJkZXZpYW50X3RodW1ibmFpbF93aWR0aF9wYWdlcyI7czozOiIyMDAiO3M6MzA6ImRldmlhbnRfdGh1bWJuYWlsX2hlaWdodF9wYWdlcyI7czozOiIyMDAiO3M6MjQ6ImRldmlhbnRfaW5kZXhfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyMToiZGV2aWFudF9jdXN0b21fY29sb3JzIjtOO3M6MTc6ImRldmlhbnRfY2hpbGRfY3NzIjtOO3M6MjA6ImRldmlhbnRfY2hpbGRfY3NzdXJsIjtzOjA6IiI7czoyMjoiZGV2aWFudF9jb2xvcl9tYWluZm9udCI7czowOiIiO3M6MjI6ImRldmlhbnRfY29sb3JfbWFpbmxpbmsiO3M6MDoiIjtzOjIyOiJkZXZpYW50X2NvbG9yX3BhZ2VsaW5rIjtzOjA6IiI7czoyODoiZGV2aWFudF9jb2xvcl9wYWdlbGlua19ob3ZlciI7czowOiIiO3M6MjE6ImRldmlhbnRfY29sb3JfaGVhZGluZyI7czowOiIiO3M6MjQ6ImRldmlhbnRfY29sb3JfaGVhZGluZ19iZyI7czowOiIiO3M6MzA6ImRldmlhbnRfY29sb3JfaGVhZGluZ19iZ19ob3ZlciI7czowOiIiO3M6Mjg6ImRldmlhbnRfY29sb3Jfc2lkZWJhcl90aXRsZXMiO3M6MDoiIjtzOjI3OiJkZXZpYW50X2NvbG9yX3NpZGViYXJfbGlua3MiO3M6MDoiIjtzOjMzOiJkZXZpYW50X2NvbG9yX3NpZGViYXJfbGlua3NfaG92ZXIiO3M6MDoiIjtzOjI2OiJkZXZpYW50X2NvbG9yX3NpZGViYXJfdGV4dCI7czowOiIiO3M6Mjc6ImRldmlhbnRfY29sb3JfcG9zdGluZm9fZm9udCI7czowOiIiO3M6MTk6ImRldmlhbnRfY29sb3JfcXVvdGUiO3M6MDoiIjtzOjIyOiJkZXZpYW50X3Nlb19ob21lX3RpdGxlIjtOO3M6Mjg6ImRldmlhbnRfc2VvX2hvbWVfZGVzY3JpcHRpb24iO047czoyNToiZGV2aWFudF9zZW9faG9tZV9rZXl3b3JkcyI7TjtzOjI2OiJkZXZpYW50X3Nlb19ob21lX2Nhbm9uaWNhbCI7TjtzOjI2OiJkZXZpYW50X3Nlb19ob21lX3RpdGxldGV4dCI7czowOiIiO3M6MzI6ImRldmlhbnRfc2VvX2hvbWVfZGVzY3JpcHRpb250ZXh0IjtzOjA6IiI7czoyOToiZGV2aWFudF9zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjIxOiJkZXZpYW50X3Nlb19ob21lX3R5cGUiO3M6Mjc6IkJsb2dOYW1lIHwgQmxvZyBkZXNjcmlwdGlvbiI7czoyNToiZGV2aWFudF9zZW9faG9tZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MjQ6ImRldmlhbnRfc2VvX3NpbmdsZV90aXRsZSI7TjtzOjMwOiJkZXZpYW50X3Nlb19zaW5nbGVfZGVzY3JpcHRpb24iO047czoyNzoiZGV2aWFudF9zZW9fc2luZ2xlX2tleXdvcmRzIjtOO3M6Mjg6ImRldmlhbnRfc2VvX3NpbmdsZV9jYW5vbmljYWwiO047czozMDoiZGV2aWFudF9zZW9fc2luZ2xlX2ZpZWxkX3RpdGxlIjtzOjk6InNlb190aXRsZSI7czozNjoiZGV2aWFudF9zZW9fc2luZ2xlX2ZpZWxkX2Rlc2NyaXB0aW9uIjtzOjE1OiJzZW9fZGVzY3JpcHRpb24iO3M6MzM6ImRldmlhbnRfc2VvX3NpbmdsZV9maWVsZF9rZXl3b3JkcyI7czoxMjoic2VvX2tleXdvcmRzIjtzOjIzOiJkZXZpYW50X3Nlb19zaW5nbGVfdHlwZSI7czoyMToiUG9zdCB0aXRsZSB8IEJsb2dOYW1lIjtzOjI3OiJkZXZpYW50X3Nlb19zaW5nbGVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI3OiJkZXZpYW50X3Nlb19pbmRleF9jYW5vbmljYWwiO047czoyOToiZGV2aWFudF9zZW9faW5kZXhfZGVzY3JpcHRpb24iO047czoyMjoiZGV2aWFudF9zZW9faW5kZXhfdHlwZSI7czoyNDoiQ2F0ZWdvcnkgbmFtZSB8IEJsb2dOYW1lIjtzOjI2OiJkZXZpYW50X3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzE6ImRldmlhbnRfaW50ZWdyYXRlX2hlYWRlcl9lbmFibGUiO3M6Mjoib24iO3M6Mjk6ImRldmlhbnRfaW50ZWdyYXRlX2JvZHlfZW5hYmxlIjtzOjI6Im9uIjtzOjM0OiJkZXZpYW50X2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjM3OiJkZXZpYW50X2ludGVncmF0ZV9zaW5nbGVib3R0b21fZW5hYmxlIjtzOjI6Im9uIjtzOjI0OiJkZXZpYW50X2ludGVncmF0aW9uX2hlYWQiO3M6MDoiIjtzOjI0OiJkZXZpYW50X2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjMwOiJkZXZpYW50X2ludGVncmF0aW9uX3NpbmdsZV90b3AiO3M6MDoiIjtzOjMzOiJkZXZpYW50X2ludGVncmF0aW9uX3NpbmdsZV9ib3R0b20iO3M6MDoiIjtzOjIwOiJkZXZpYW50X2ZvdXJzaXhlaWdodCI7TjtzOjE4OiJkZXZpYW50X2Jhbm5lcl80NjgiO3M6NTc6Imh0dHA6Ly93d3cuZWxlZ2FudHRoZW1lcy5jb20vaW1hZ2VzL1N0dWRpb0JsdWUvNDY4eDYwLmdpZiI7czoyMjoiZGV2aWFudF9iYW5uZXJfNDY4X3VybCI7czoxOiIjIjt9';

	/*global $options;

	foreach ($options as $value) {
		if( isset( $value['id'] ) ) {
			update_option( $value['id'], $value['std'] );
		}
	}*/

	$importedOptions = unserialize(base64_decode($importOptions));

	foreach ($importedOptions as $key=>$value) {
		if ($value != '') update_option( $key, $value );
	}

	update_option( $shortname . '_use_pages', 'false' );
} ?>