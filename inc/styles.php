<?php

add_action( 'wp_enqueue_scripts', 'true_enqueue_js_and_css' );
 
function true_enqueue_js_and_css() {
 
	// CSS
	wp_enqueue_style( 
		'main', // идентификатор стиля
		get_stylesheet_directory_uri() . '/style.css'
	);
 
	// JavaScript

   wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url('/js/jquery/jquery.js'), array(), null, true );
	wp_enqueue_script( 'jquery' );


	wp_enqueue_script( 
		'main', // идентификатор скрипта
		get_stylesheet_directory_uri() . '/assets/scipts.js', // URL скрипта
		array( 'jquery' ), // зависимости от других скриптов
		time(), // версия каждую секунду разная, чтоб не кэшировать во время разработки 
		true // true - в футере, false – в хедере
	);
 
}
