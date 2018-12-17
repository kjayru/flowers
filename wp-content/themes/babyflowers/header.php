<?php 
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package babyflowers
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<section id="page" class="site">
	<div class="container">
		
		<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://babyflowers.com.pe/"><img src="<?php bloginfo('template_url') ?>/images/logo2.png" class="img-responsive" alt="BabyFlowers" ></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            
            <ul class="nav navbar-nav navbar-right">
               <li  class="<?php if($_SESSION['categoria']=="paraninas"){ echo "active";} ?>"><a href="/paraninas">Catálogo para Niñas <span class="sr-only"></span></a> </li>
               <li class="<?php if($_SESSION['categoria']=="paraninos"){ echo "active";} ?>"><a  href="/paraninos">Catálogo para Niños</a></li>
               <li class="<?php if($_SESSION['categoria']=="comocomprar"){ echo "active";} ?>"><a  href="/comocomprar">¿Cómo comprar?</a></li>
               <li class="<?php if($_SESSION['categoria']=="porque"){ echo "active";} ?>"><a href="/porque">¿Por qué Baby Flowers?</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

     

	
	
