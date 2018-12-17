<!DOCTYPE html>
<html>

<head>

<!-- Incluye jquery -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>

<!-- Incluye el Checkout de Culqi en tu sitio web-->
<script src="https://checkout.culqi.com/v2"></script>

<style>
.mensaje_salida{
	padding:10px;
	padding-top:40px;
	width: 80%;
	margin: auto;
	text-align: center;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 100%;
	line-height: 180%;
}

.titulo{
	font-size: 2em;
}

.imagen{
	padding:10px;
}

.subtitulo{
	font-size: 1.25em;
}

.mensaje{
	font-size: 1.25em;
	color: #858585;
}

.btn {
  -webkit-appearance: none;
  -webkit-border-radius: 0;
  -moz-border-radius: 4;
  border-radius: 4px;
  border-color: none;
  font-family: "Verdana","Geneva","sans-serif";
  color: #ffffff;
  font-size: 12px;
  font-weight: 500;
  font-style: normal;
  text-transform: uppercase;
  background: #bf3b3b;
  padding: 13px 26px;
  letter-spacing: 2.5px;
  text-decoration: none;
  margin:auto;
}

.btn:hover {
  background: #d67e7e;
  text-decoration: none;
}

#loadingDiv{
	position:absolute;
	top:50%;
	left:50%;
	z-index:100;
}

</style>

</head>

<body>

<!-- Mensajes de salida -->
<div class="mensaje_salida" id="mensaje_salida" style="display:none">
	<div class="titulo" id="titulo"></div>
	<img class="imagen" id="imagen">
	<div class="subtitulo" id="subtitulo"></div>
	<div class="mensaje" id="mensaje1"></div>
	<div class="mensaje" id="mensaje2"></div>
	<div class="mensaje" id="mensaje3"></div>
	<div class="mensaje" id="mensaje4"></div>
</div>
<input class="btn" id="btn" style="display:none" type="button" onclick="window.location.reload()" value="Pagar">

<!-- GIF Loader -->
<div id="loadingDiv" style="display:none">
 <img id="loading" src="<?php bloginfo('template_url'); ?>/images/loader.gif"/>
</div>

<?php 

	// Obtiene código de pedido de la URL
	if(!$_GET['ID']){ // Si no se ha especificado el código de pedido --> avisa y sale
		$imagen = get_bloginfo('template_url')."/images/Cancel.png";
		echo "<script>"; 
		echo "document.getElementById('titulo').style.color='#F44336',";
		echo "document.getElementById('titulo').innerHTML = '¡Uppps!';";
		echo "document.getElementById('imagen').src = '".$imagen."';";	
		echo "document.getElementById('subtitulo').innerHTML = 'No hemos encontrado el código de pedido a procesar.';";
		echo "document.getElementById('mensaje1').innerHTML = 'Algo salió mal y no podemos procesar tu pedido.';";
		echo "document.getElementById('mensaje2').innerHTML = 'Vaya a la pagina principal, seleccione su arreglo y haga click en el botón COMPRAR.';";
		echo "document.getElementById('mensaje3').innerHTML = 'Si el problema persiste comuníquese con nosotros a yoquiero@babyflowers.pe .';";
		echo "document.getElementById('mensaje4').innerHTML = '';";
		echo "document.getElementById('mensaje_salida').style.display = 'block';";
		echo "</script>";
		exit;
	}else{
		$id = $_GET['ID'];
		// verifica si ID = "deposito" --> imprime mensaje y sale
		if ($id=="deposito"){
			$imagen = get_bloginfo('template_url')."/images/Ok.png";
			echo "<script>";
			echo "document.getElementById('titulo').style.color='#4CAF50',";
			echo "document.getElementById('titulo').innerHTML = '¡Felicitaciones!';"; 
			echo "document.getElementById('imagen').src = '".$imagen."';";
			echo "document.getElementById('subtitulo').innerHTML = 'Tu pedido fue ingresado con éxito.';";
			echo "document.getElementById('mensaje1').innerHTML = 'Pronto recibirás un correo con toda la información de tu pedido.';";
			echo "document.getElementById('mensaje2').innerHTML = '¡Muchas gracias por elegir Baby Flowers!';";
			echo "document.getElementById('mensaje3').innerHTML = '';";
			echo "document.getElementById('mensaje4').innerHTML = '';";
			echo "document.getElementById('mensaje_salida').style.display = 'block';";
			echo "</script>";
			exit;
		}
	}

	// Comprueba si hay soporte para cURL
	if (function_exists('curl_init')){
		// Si hay cURL, obtiene archivo de Zoho con información del pedido
		$cha = curl_init();
		curl_setopt($cha, CURLOPT_URL,
			"https://creator.zoho.com/api/json/bfao/view/Reporte_para_servidor?scope=creatorapi&authtoken=03be3c71cb6b7a8724f4306b86b29550&zc_ownername=babyflowers&Codigo_de_pedido=".$id);
		curl_setopt($cha, CURLOPT_TIMEOUT, 30);
		curl_setopt($cha, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cha, CURLOPT_FOLLOWLOCATION, true);
		
		$resultad = curl_exec ($cha);
		$cadena = explode("=",$resultad);
		$arreglo = $cadena[1];
		$json = explode(";",$arreglo);
		$productodato = json_decode($json[0],true);
		
		foreach($productodato["Nuevo_pedido"] as $row){
			 
			$precio    = $row["Precio_total"];	
			$formapago = $row["Forma_de_pago"];	
			$producto  = $row["Producto_solicitado"];	
			$prod_id   = $row["ID"];	
			$distrito  = $row["Distrito"];	
			$pagado    = $row["Pagado1"];	
			$codigopedido  = $row["Codigo_de_pedido"];
			$telefono = $row["TelefonoCliente"];
			$direccion = $row["DireccionCliente"];
		}

		$cost = explode(" ",$precio);
			
		if ($pagado == "Sí"){ // Si el pedido ya está pagado --> Avisa y sale
			$imagen = get_bloginfo('template_url')."/images/Cancel.png";
			echo "<script>";
			echo "document.getElementById('titulo').style.color='#F44336',";
			echo "document.getElementById('titulo').innerHTML = '¡Uppps!';"; 
			echo "document.getElementById('imagen').src = '".$imagen."';";
			echo "document.getElementById('subtitulo').innerHTML = 'Encontramos que este pedido ya ha sido pagado';";
			echo "document.getElementById('mensaje1').innerHTML = 'Si cree que hay un error, comuníquese con nosotros a yoquiero@babyflowers.pe .';";
			echo "document.getElementById('mensaje2').innerHTML = '';";
			echo "document.getElementById('mensaje3').innerHTML = '';";
			echo "document.getElementById('mensaje4').innerHTML = '';";
			echo "document.getElementById('mensaje_salida').style.display = 'block';";
			echo "</script>";
			exit;
		}
	}else{
		// Si no hay soporte cURL avisa, y termina?
		$imagen = get_bloginfo('template_url')."/images/Attention.png";
		echo "<script>";
		echo "document.getElementById('titulo').style.color='#FFCA28',";
		echo "document.getElementById('titulo').innerHTML = '¡Atención!';"; 
		echo "document.getElementById('imagen').src = '".$imagen."';";
		echo "document.getElementById('subtitulo').innerHTML = 'No hay soporte cURL.';";
		echo "document.getElementById('mensaje1').innerHTML = 'Algo salió mal y no podemos procesar el pago.';";
		echo "document.getElementById('mensaje2').innerHTML = 'Aunque el pago no pudo realizarse, tu pedido sí fue ingresado con éxito.';";
		echo "document.getElementById('mensaje3').innerHTML = 'Por favor, comunicate con nosotros a yoquiero@babyflowers.pe .';";
		echo "document.getElementById('mensaje4').innerHTML = '';";
		echo "document.getElementById('mensaje_salida').style.display = 'block';";
		echo "</script>";
		exit;
	}

?>

<!-- Configura el formulario Culqi -->
<script>
    Culqi.publicKey = 'pk_live_12saEkBHVqpksL7H';
    Culqi.settings({
        title: 'Baby Flowers',
        currency: 'PEN',
        description: <?php echo "'Arreglo ".$producto." con envío a ".$distrito."<br>Código pedido #".$codigopedido."'"?>,
        amount: <?php echo $cost[1]*100; ?>,
    });
</script>

<!-- Muestra el Checkout de Culqi -->
<script>
    // Abre el formulario con las opciones de Culqi.settings
    Culqi.open();
	
	function culqi() {
		if(Culqi.token) { // ¡Token creado exitosamente!
			document.getElementById('loadingDiv').style.display = 'block'; // muestra el loader
			var tokentext = JSON.stringify(Culqi.token);
			
			$.ajax({ // envía el token y otros datos al backend
				type: "POST",
				url: "/creacargo.php",
				data:
				{
					tokentext: tokentext,
					codigo:'<?php echo $id; ?>',
					cost:'<?php echo $cost[1]*100; ?>',
					producto:'<?php echo $producto; ?>',
					distrito:'<?php echo $distrito; ?>',
					codigopedido:'<?php echo $codigopedido; ?>'
				},
				success: function(response)
				{
					document.getElementById('loadingDiv').style.display = 'none'; // apaga el loader
					console.log (response);
					if (response == "success") {
					
						document.getElementById('imagen').src = "<?php bloginfo('template_url'); ?>/images/Ok.png";
						document.getElementById('titulo').style.color='#4CAF50';
						document.getElementById("titulo").innerHTML = "!Felicitaciones!";
						document.getElementById("subtitulo").innerHTML = "Tu pedido fue ingresado y pagado con éxito.";
						document.getElementById("mensaje1").innerHTML = "Pronto recibirás un correo con toda la información de tu pedido.";
						document.getElementById("mensaje2").innerHTML = "";
						document.getElementById("mensaje3").innerHTML = "";
						document.getElementById("mensaje4").innerHTML = "";
						document.getElementById("mensaje_salida").style.display = 'block';
					}
					else {
						document.getElementById('imagen').src = "<?php bloginfo('template_url'); ?>/images/Attention.png";
						document.getElementById('titulo').style.color='#FFCA28';
						document.getElementById("titulo").innerHTML = "!Atención!";
						document.getElementById("subtitulo").innerHTML = response;
						document.getElementById("mensaje1").innerHTML = "Aunque el pago no pudo realizarse, tu pedido sí fue ingresado con éxito.";
						document.getElementById("mensaje2").innerHTML = "Pronto recibirás un correo con toda la información de tu pedido.";
						document.getElementById("mensaje3").innerHTML = "Puedes intentar pagar nuevamente haciendo click en el siguiente botón, o puedes comunicarte con nosotros a <a href='mailto:yoquiero@babyflowers.pe'>yoquiero@babyflowers.pe</a> o al 9851-67838";
						document.getElementById("mensaje_salida").style.display = 'block';
						document.getElementById("btn").style.display = 'block';
						
					}

				},
			})	
			
			.fail( function( jqXHR, textStatus, errorThrown ) {

				document.getElementById('loadingDiv').style.display = 'none'; // apaga el loader
				if (jqXHR.status === 0) {
				er ='Not connect: Verify Network.';
				} else if (jqXHR.status == 404) {
				er = 'Requested page not found [404]';
				} else if (jqXHR.status == 500) {
				er = 'Internal Server Error [500].';
				} else if (textStatus === 'parsererror') {
				er = 'Requested JSON parse failed.';
				} else if (textStatus === 'timeout') {
				er = 'Time out error.';
				} else if (textStatus === 'abort') {
				er = 'Ajax request aborted.';
				} else {
				er = 'Uncaught Error: ' + jqXHR.responseText;
				}
				// Si se produce error de comunicación, muestra el mensaje al usuario y termina
				document.getElementById('imagen').src = "<?php bloginfo('template_url'); ?>/images/Attention.png";
				document.getElementById('titulo').style.color='#FFCA28';
				document.getElementById("titulo").innerHTML = "!Atención!";
				document.getElementById("subtitulo").innerHTML = er;
				document.getElementById("mensaje1").innerHTML = "Aunque el pago no pudo realizarse, tu pedido sí fue ingresado con éxito.";
				document.getElementById("mensaje2").innerHTML = "Pronto recibirás un correo con toda la información de tu pedido.";
				document.getElementById("mensaje3").innerHTML = "Puedes intentar pagar nuevamente haciendo click en el siguiente botón, o puedes comunicarte con nosotros a <a href='mailto:yoquiero@babyflowers.pe'>yoquiero@babyflowers.pe</a> o al 9851-67838";
				document.getElementById("mensaje_salida").style.display = 'block';
				document.getElementById("btn").style.display = 'block';
			});
			
		}else{ // ¡Hubo algún problema!
			// Mostramos JSON de objeto error en consola
			document.getElementById('loadingDiv').style.display = 'none'; // apaga el loader
			console.log(Culqi.error);
			// Si no se crea el token, muestra el mensaje al usuario y termina
			document.getElementById('imagen').src = "<?php bloginfo('template_url'); ?>/images/Attention.png";
			document.getElementById('titulo').style.color='#FFCA28';
			document.getElementById("titulo").innerHTML = "!Atención!";
			document.getElementById("subtitulo").innerHTML = Culqi.error.user_message;
			document.getElementById("mensaje1").innerHTML = "Aunque el pago no pudo realizarse, tu pedido sí fue ingresado con éxito.";
			document.getElementById("mensaje2").innerHTML = "Pronto recibirás un correo con toda la información de tu pedido.";
			document.getElementById("mensaje3").innerHTML = "Puedes intentar pagar nuevamente haciendo click en el siguiente botón, o puedes comunicarte con nosotros a <a href='mailto:yoquiero@babyflowers.pe'>yoquiero@babyflowers.pe</a> o al 9851-67838";
			document.getElementById("mensaje_salida").style.display = 'block';
			document.getElementById("btn").style.display = 'block';
			
		}
	};
</script>



</body>
</html>