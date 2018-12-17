<?php 
$_SESSION['categoria']="comocomprar";
get_header();
?>
<hr>
<div class="container pagina">
	<div class="row">
		<div class="col-md-12">
		<?php 
		  while ( have_posts() ) : the_post();
		
			
			the_content();
			
		endwhile;
			?>
		</div>
	</div>
</div>

<?php
get_footer();
?>
