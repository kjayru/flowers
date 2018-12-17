<?php
if(!$_REQUEST['token'])
{ 
	echo "hubo error de proceso";
}else{
	$token = $_REQUEST['token'];
	$codigo = $_REQUEST['codigo'];
}


	$cha = curl_init();
	curl_setopt($cha, CURLOPT_URL,
		"https://creator.zoho.com/api/json/bfao/view/Reporte_para_servidor?scope=creatorapi&authtoken=03be3c71cb6b7a8724f4306b86b29550&zc_ownername=babyflowers&Codigo_de_pedido=".$codigo);
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
		$pagado    = $row["Pagado"];	
		$codigopedido  = $row["Codigo_de_pedido"];
		$telefono = $row["TelefonoCliente"];
	}
	
	$cost = explode(" ",$precio);

  print_r($cost);


	
