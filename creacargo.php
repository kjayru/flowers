<?php

// Carga dependencias vía Composer
require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';


//Recibe información de proceso.php
if(!$_REQUEST['tokentext'])
{ 
	echo "No se pudieron enviar<br>las variables al servidor.<br>Le agradeceremos contactarnos a yoquiero@babyflowers.pe<br>para coordinar el pago de pedido.";
	exit;
}else{
	$tokentext = $_REQUEST['tokentext'];
	$codigo = $_REQUEST['codigo'];
	$precio += $_REQUEST['cost'];
	$producto = $_REQUEST['producto'];
	$distrito = $_REQUEST['distrito'];
	$codigopedido = $_REQUEST['codigopedido'];
	
	$token = json_decode($tokentext,true);

	try {
		// Configura la API Key y autenticación
		$SECRET_KEY = "sk_live_iaS16MPqWc05Ygie";
		$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
		// Crea el cargo a una tarjeta
		$charge = $culqi->Charges->create(
			array(
				"amount" => $precio,
				"capture" => true,
				"currency_code" => "PEN",
				"description" => "Arreglo $producto con delivery a $distrito",
				"installments" => 0,
				"email" => $token['email'],
				"metadata" => array("Codigo_pedido"=> "$codigopedido"),
				"source_id" => $token['id']
			)
		);
		
		// Pasa las variables a Zoho
		$criteria = 'Codigo_de_pedido="'.$codigopedido.'"';
		$url = 'https://creator.zoho.com/api/babyflowers/json/bfao/form/Nuevo_pedido/record/update/';
		
		$data = array(
			'authtoken' => '03be3c71cb6b7a8724f4306b86b29550',
			'scope' => 'creatorapi',
			'criteria' => $criteria,
			'Pagado1' => 'Sí',
			'Cq_Tk_ID' => $token['id'],
			'Cq_Tk_Correo' => $token['email'],
			'Cq_Cargo_ID' => $charge->id,
			'Cq_Er_type' => "",
			'Cq_Er_code' => "",
			'Cq_Er_merchant_message' => "",
			'Cq_Er_user_message' => ""
		);
	
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { /* PENDIENTE IMPLEMENTAR EEROR, SI ZOHO NO RESPONDE */ }
		echo "success";
		

	} catch (Exception $e) {
		$ini = stripos($e, "{");
		$fin = stripos($e, "}");
		$f = substr($e, $ini, $fin - $ini + 1);
		$err = json_decode($f,true);
		// Pasa las variables a Zoho
		$url = 'https://creator.zoho.com/api/babyflowers/json/bfao/form/Nuevo_pedidos/record/update/';
		
		$data = array(
			'authtoken' => '03be3c71cb6b7a8724f4306b86b29550',
			'scope' => 'creatorapi',
			'criteria' => 'Codigo_de_pedido="11039BA101"',
			'Pagado1' => 'No - Error',
			'Cq_Tk_ID' => $token['id'],
			'Cq_Tk_Correo' => $token['email'],
			'Cq_Cargo_ID' => $err['charge_id'],
			'Cq_Er_type' => $err['type'],
			'Cq_Er_code' => $err['code'],
			'Cq_Er_merchant_message' => $err['merchant_message'],
			'Cq_Er_user_message' => $err['user_message']
		);
	
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { /* PENDIENTE IMPLEMENTAR EEROR, SI ZOHO NO RESPONDE */ }
		echo $err['user_message'];
		
		/* PENDIENTE IMPLEMENTAR VERIFICACIÓN DE SI EL PEDIDO YA ESTA PAGADO */
	}
}
?>