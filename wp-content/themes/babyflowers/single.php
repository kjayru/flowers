<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package babyflowers
 */

get_header();

    while ( have_posts() ) : the_post();
?>
<hr>
	<div class="container producto">
		<div class="row">
			<div class="col-md-5">	
				<h2><?php echo get_field('titulo') ?> -  <?php echo get_field('precio') ?> soles </h2>
		 	    
				<h2 class="sub">Código <span style="text-transform:uppercase;"><?php echo get_field('codigo_producto') ?></span></h2>
		 	 
		 	 <a href="/proceso-compra?c=<?php echo get_field('codigo_producto') ?>" class="pcompra">Comprar</a>
		 	 
		 	 <div class="contenido">
		 	   <?php the_content(); ?>
		 	 </div>
			</div>
			<div class="col-md-7">
				<?php
				
                  $iurl = get_field('imagen_principal');
                 ?>
                 <img src="<?php echo $iurl['url']; ?>" class="img-responsive center-block maximg" />
			</div>
	
  </div>
</div>
<?php
  endwhile; 


/*

$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 5, 'post__not_in' => array($post->ID) ) );
if( $related ) foreach( $related as $post ) {
setup_postdata($post); ?>
 <ul> 
        <li>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            <?php the_content('Read the rest of this entry &raquo;'); ?>
        </li>
    </ul>   
<?php }
wp_reset_postdata();
*/
?>
<!--<div class="relatedposts">
    <h3>Productos relacionados</h3>
    <?php
	/*echo do_shortcode( '[related_post themes="flat" id="'.get_the_ID().'"]' ); */
?>
 </div>-->
<?php
get_footer();
