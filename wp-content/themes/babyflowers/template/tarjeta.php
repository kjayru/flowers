<?php 
/*
+ Template Name: tarejta
*/

if(!$_REQUEST['token'])
{ 
	echo "hubo error de proceso";
}else{
	$id = $_REQUEST['token'];
	$codigo = $_REQUEST['codigo'];
}

//Llamamos a las librerias del culqi
?>
<?php
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
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
	
	//print_r($productodato["Nuevo_pedido"]);
	foreach($productodato["Nuevo_pedido"] as $row){
		/*echo "Precio total: ".$row["Precio_total"]."<br>";	
		echo "Forma_de_pago: ".$row["Forma_de_pago"]."<br>";	
		echo "Producto_solicitado: ".$row["Producto_solicitado"]."<br>";	
		echo "ID: ".$row["ID"]."<br>";	
		echo "Distrito: ".$row["Distrito"]."<br>";	
		echo "Pagado: ".$row["Pagado"]."<br>";	
		echo "Codigo_de_pedido :".$row["Codigo_de_pedido"];*/
		
		
		 
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
}
else{
	echo "No hay soporte para cURL";

}


//test_HMzTgHP7qTwV
//api///oH5XUI5k9SxE1UZUWVxaxcaSnrden9l4FKdvHYEsz74

// Creamos Cargo a una tarjeta
require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

	
//$SECRET_API_KEY = "kim1eRN1GMLG02Uni0YDa50feBi+DC6aMx2WR5s7Oss=";
$SECRET_API_KEY = "DaqAUtsjofUI66gs0uw22vhof1/NYXJ4u61+ETlIX3A=";
$culqi = new Culqi\Culqi(array('api_key' => $SECRET_API_KEY));

// Entorno: Integración (pruebas)
$culqi->setEnv("PRODUC");
	
	$pedidoId = time()."babyflowers";

	
try {  
    $cargo = $culqi->Cargos->create(array(
            "moneda"=> "PEN",
             "monto"=> $cost[1], 
            "usuario"=> "71701956",
            "descripcion"=> $producto." con envia  a ".$distrito,
            "pedido"=> $pedidoId,
            "codigo_pais"=> "PE",
            "direccion"=> "Avenida Lima 1232",
            "ciudad"=> "Lima",
            "telefono"=> $telefono,
            "nombres"=> "Brayan",
            "apellidos"=> "Cruces",
            "correo_electronico"=> "demo@emo.com",
            "token"=> $id
            ));
} catch(Exception $e) {
    // ERROR: El cargo tuvo algún error o fue rechazado
    echo "ERRRRRORRRE: ".$e->getMessage();

}
	


?>

