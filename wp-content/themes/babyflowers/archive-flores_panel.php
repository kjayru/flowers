<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package babyflowers
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
		psot tpe
		<?php
		while ( have_posts() ) : the_post();

			//get_template_part( 'template-parts/content', get_post_format() );

			//the_post_navigation();

			?>
				<iframe src="https://creator.zohopublic.com/babyflowers/bfao/form-embed/Formulario_de_Prueba/Cu1eFbkQMj8Rwm6HgegEagXGw0MjRt6FCfNSVzUT0evrkP29HgtunyOGXbsxE9gb5dZpQAK38g3xnCr8bTRaQhrqmkJk6JrAkMBF/Arreglo_elegido=<?php echo get_field('codigo_producto') ?>" id="iproducto" frameborder="0" style="overflow:hidden; height:700px; width:100%"  width="100%">
						
					
				</iframe>
			<?php

		endwhile; // End of the loop.
		?>
	</div>
  </div>
</div>
	

<?php

get_footer();
