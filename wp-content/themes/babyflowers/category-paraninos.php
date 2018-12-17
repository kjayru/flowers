<?php 
$_SESSION['categoria']="paraninos";
get_header();
?>
<hr>
<div class="container paraninos">
	<div class="row">
          <?php 
            $args=array(
              'suppress_filters' => false,
              'post_type'=>'flores_panel',
              'post_status' => 'publish',
              'numberposts'=>'50',
			   'category_name'=>'paraninos',
              'orderby'=>'post_date',
              'post_parent'=>0,
              'order'=>'DESC'
            );
            $posts = get_posts($args);	
          ?>
          <?php foreach ($posts as $post): 
				$thumb_url  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium', true );
                $url = $thumb_url[0];
		  ?>
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item2">
                    <div class="verde">
						<a href="<?php the_permalink(); ?>" class="pimage"> <img src="<?php echo $url; ?>" class="img-responsive block-center"></a>
                        </div>
                        <div class="ccti">
                        <a href="<?php the_permalink(); ?>" class="detalle">
                        	<?php echo get_field('nombre_producto'); ?> - <?php echo get_field('precio') ?> soles
                        </a> 
                        </div> 
                </div>   
           <?php endforeach ?> 	
	</div>
</div>
<?php 
get_footer();
?>