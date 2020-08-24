<?php

function my_search_form( $form ) {

    $form  = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >';
	$form .= '	<input class="small" type="search" placeholder="Search and press enter" value="' . get_search_query() . '" name="s" id="s" />';
	/* $form .= '	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />'; */
	$form .= '</form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

?>