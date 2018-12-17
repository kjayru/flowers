<?php 
/*
+ Template Name: inicio
*/
get_header('home');

the_post();

$args=array(
              'suppress_filters' => false,
              'post_type'=>'slider_panel',
              'post_status' => 'publish',
              'numberposts'=>'-1',
              'orderby'=>'post_date',
              'post_parent'=>0,
              'order'=>'ASC'
            );
           
$sliders = get_posts($args);
?>

    								
  <section class="page">				
	<div class="container icontenedor">
		<div class="row">
			
				<div class="col-md-12 principal">
					<div class="row">
					
						<div class="col-sm-12 col-md-6 col-lg-6 contenido1">
							<div class="row">
								<div class="col-md-12 col-xs-12">
								<img src="<?php bloginfo('template_url'); ?>/images/Logo.gif" style="max-height:150px; margin-bottom: 57px;" class="pull-left">
								</div>
								<div class="col-md-12 col-xs-12 text-left">
								<p>Diseñamos exclusivos bouquets para que celebres los nacimientos.</p>

								<p>Nuestros arreglos están elaborados con ropa para bebés y no contienen flores naturales, lo cual les permite permanecer al interior de las habitaciones de las clínicas.</p>

								<p>Con Baby Flowers tu presente acompañará a la mamá y al bebé en todo momento, desde su estadía en la clínica hasta su retorno a casa... y por mucho tiempo más.</p>

								<p>Regala un Baby Flowers ahora... y marca la diferencia!</p>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-lg-12 botones-home col-xs-12">

							<a href="/paraninas" class="btn btnhome btn-catalogo">CATALOGO PARA NIÑA</a>
							<a href="/paraninos" class="btn btnhome btn-catalogo">CATALOGO PARA NIÑO</a>
						</div>
					</div>

				</div>

		</div>
	</div>
 </section>
 <div class="capa-slider"></div>
<?php
get_footer('home');
?>
<script>
	jQuery(function($) { 
		$(function() {
			$('body').chocolate({
				images		: [
				<?php
				 foreach ($sliders as  $slider):
				    $imagens = get_field('imagen',$slider->ID);
					 foreach($imagens as  $imgs):
							echo "'".$imgs['imagen_slider']."',";
					  endforeach; 
			      endforeach;
				?>	
				],
				interval	: 4000,
				speed		: 2000,
			});
		  });
		});
	</script>      
