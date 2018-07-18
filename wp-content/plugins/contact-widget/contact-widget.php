<?php
/*
Plugin Name:  Ajax Contact Widget
Description:  Simple Ajax powered contact form widget
Version:      1.0
Author:       Vicki Edwards
Author URI:   https://eduonix.com
License:      GPL2
*/

//include js
function add_scripts(){
	wp_enqueue_script('contact-scripts', plugins_url().'/contact-widget/js/script.js', array('jquery'),'1.0.0', false);
}

add_action('wp_enqueue_scripts', 'add_scripts');

//include widget class
include('class.contact-widget.php');

//register widget
function register_contact_widget() {
	register_widget('Contact_Widget');
}

add_action('widgets_init', 'register_contact_widget');