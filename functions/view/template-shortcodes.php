<?php

class Fliplet_Shortcodes  {

	function band_func( $atts , $content = "") {

		extract( shortcode_atts( array(
			'color'       => '',
			'class'       => '',
			'image'       => '',
			'size'        => '',
			'id'          => '',
			'mobile_only' => NULL,
			'screen_only' => NULL
		), $atts ) );

		$output = '<div class="band';

		if ($color !== '') {
			$output .= ' ' . $color;
		}

		if ($image !== '') {
			$output .= ' has-image';
		}

		if ($size !== '') {
			$output .= ' ' . $size;
		}

		if ($mobile_only) {
			$output .= ' mobile-only';
		}

		if ($screen_only) {
			$output .= ' screen-only';
		}

		if ($class !== '') {
			$output .= ' ' . $class;
		}

		$output .= '"';

		if ($id !== '') {
			$output .= ' id="' . $id . '"';
		}

		if ($image !== '') {
			$output .= ' style="background-image:url(' . $image . ');"';
		}

		$output .= '><div class="container group"><div class="row">';
		$output .= apply_filters('the_content', $content);
		$output .= '</div></div></div>';

		return $output;

	}

	function column_func ( $atts , $content = "" ) {

		extract( shortcode_atts( array(
			'count'        => '1',
			'class'        => '',
			'push'         => '0',
			'pull'         => '0',
			'mobile_count' => '0',
			'last'         => NULL,
			'centered'     => NULL,
			'mobile_only'  => NULL,
			'screen_only'  => NULL
		) , $atts ) );

		$opt_classes = '';

		if (intval($push) > 0) {
			$opt_classes .= ' col-md-push-' . $push . ' col-sm-push-' . $push;
		}

		if (intval($pull) > 0) {
			$opt_classes .= ' col-md-pull-' . $pull . ' col-sm-pull-' . $pull;
		}

		if (intval($mobile_count) > 0) {
			$opt_classes .= ' mobile-' . $mobile_count;
		}

		if ($last) {
			$opt_classes .= ' last';
		}

		if ($centered) {
			$opt_classes .= ' centered';
		}

		if ($mobile_only) {
			$opt_classes .= ' mobile-only';
		}

		if ($screen_only) {
			$opt_classes .= ' screen-only';
		}

		if ($class !== '') {
			$opt_classes .= ' ' . $class;
		}

		return '<div class="column col-md-' . $count .' col-sm-' . $count . $opt_classes . '">' . do_shortcode($content) . '</div>';

	}

	function new_row_func ( $atts ) {

		return '<br class="clear"/>';

	}

}

add_shortcode('band', array( 'Fliplet_Shortcodes', 'band_func' ) );
add_shortcode('column', array( 'Fliplet_Shortcodes', 'column_func' ) );
add_shortcode('new_row', array( 'Fliplet_Shortcodes', 'new_row_func' ) );

?>
