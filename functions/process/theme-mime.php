<?php
/*******************************
*
*	Extended supported MIME type
*
*   Please refer to http://filext.com/ for the correct MIME types
*
*******************************/
function custom_upload_mimes ( $existing_mimes=array() ) {
 
	// add your ext => mime to the array. Multiple MIME types should be separated by commas
	// $existing_mimes['ext'] = 'mime';
	
	$existing_mimes['apk'] = 'application/vnd.android.package-archive';
 
	// add as many as you like
 
	// and return the new full result
	return $existing_mimes;
 
}

add_filter('upload_mimes', 'custom_upload_mimes');
?>