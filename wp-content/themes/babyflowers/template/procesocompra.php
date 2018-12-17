<?php 
/*
+ Template Name: proceso-compra
*/
$prod = $_GET['c'];
get_header('proceso'); ?>
	<div class="container" style="background: white;">
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
			<br><br><br>
		<?php
		while ( have_posts() ) : the_post();

			//get_template_part( 'template-parts/content', get_post_format() );

			//the_post_navigation();

			?>
				<iframe target="_parent" style="overflow:hidden; height:2500px; width:300" width='300px' class='center-block' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/babyflowers/bfao/form-embed/Form_Cliente/Jg8gbzOZXd7nv0z4ZWUeBuk06W18UyTvNVQpQj50Rz4E19A9qe2zkK6077DTkGzMJ4tXJfhBEbmMpStDfdDG2q8dS16FtKBzpQKv/Arreglo_elegido=<?php echo $prod; ?>' id="iproducto">
				
				</iframe>
			<?php

		endwhile; // End of the loop.
		?>
	</div>
  </div>
</div>
	

<?php

get_footer();
