<?php

function truncateString($str, $maxChars, $more = '') {
    $str = trim($str);
    if (strlen($str) > $maxChars + 1) {
        preg_match("/^(.{1," . $maxChars . "})[[:punct:][:space:]]/is", $str, $matches);
        return trim($matches[0]) . $more;
    } else {
        return $str;
    }
}

//Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', false, '2.2.2');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'modify_jquery');

// Remove nonce check for CF7 so that studio can submit forms
define ('WPCF7_VERIFY_NONCE', false);


?>
