<?php 
function create_post_type_flores(){
	  register_post_type('flores_panel',
	  	array(
				'labels' => array(
					'name' => __('Productos'),
					'query_var' => true,
					'hierarchical' => true,
					'singular_name' => __('Panel')
				),
				'public' => true,
				'has_archive' => false,
				'capability_type' => 'post',
				'menu_icon' => get_template_directory_uri().'/flores/images/icon.png',
				'rewrite' => array('slug'=> 'producto','with_front'=> false),
				'supports' => array('title','editor','thumbnail'),
		  		'taxonomies' => array('category')
				
		)
	  );
	}
	add_action('init','create_post_type_flores');
?>