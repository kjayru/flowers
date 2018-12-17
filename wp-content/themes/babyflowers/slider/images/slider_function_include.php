<?php 
function create_post_type_slider(){
	  register_post_type('slider_panel',
	  	array(
				'labels' => array(
					'name' => __('Sliders'),
					'query_var' => true,
					'hierarchical' => true,
					'singular_name' => __('Panel')
				),
				'public' => true,
				'has_archive' => false,
				'capability_type' => 'post',
				'menu_icon' => get_template_directory_uri().'/slider/images/icon.png',
				'rewrite' => array('slug'=> 'leermas','with_front'=> false),
				'supports' => array('title','editor','thumbnail'),
				
		)
	  );
	}
	add_action('init','create_post_type_slider');
?>