<?php


require_once('wp-load.php');
$cadena = $_POST['criteria'];
$cc = explode("=",$cadena);

$ccc=  explode('"',$cc[1]);

$cccc  = stripslashes($ccc[1]);
$criterios = 'Codigo_de_pedido="'.$cccc.'"';
$pagof  = $_POST['Forma_de_pago'];

	$fields = array(
				'authtoken'      => $_POST['authtoken'],
				'scope'          => $_POST['scope'],
				'criteria'       => $criterios,
				'Cq_Tk_Bin'      => $_POST['Cq_Tk_Bin'],
				'Cq_Tk_nombre'   => $_POST['Cq_Tk_nombre'],
				'Cq_Tk_Apellido' => $_POST['Cq_Tk_Apellido'],
				'Cq_Tk_Correo'   => $_POST['Cq_Tk_Correo'],
				'Cq_Cargo_ID'    => $_POST['cargoid'],
				'Forma_de_pago'  => "Tarjeta de crédito o débito",
				'Pagado1'        => $_POST['Pagado1'],

			);

	$cha = curl_init();

	curl_setopt($cha, CURLOPT_URL,"https://creator.zoho.com/api/babyflowers/json/bfao/form/Nuevo_pedido/record/update/");

	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
							rtrim($fields_string, '&');

	curl_setopt($cha, CURLOPT_TIMEOUT, 30);
	curl_setopt($cha, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cha, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($cha, CURLOPT_POST, true);
	curl_setopt($cha,CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($cha, CURLOPT_SSL_VERIFYPEER, false);
	$resultad = curl_exec ($cha);


	$datos = json_decode($resultad);
    foreach($datos->formname[1] as $row){

	  $criteria = $row[1]->criteria;
	  $status   = $row[1]->status;

         foreach($row[1]->newvalues as $col)
         {
             $nombre   = $col->Cq_Tk_nombre;
             $apellido = $col->Cq_Tk_Apellido;
             $cargo  =   $col->Cq_Cargo_ID;
             $bin    =   $col->Cq_Tk_Bin;
             $correo =   $col->Cq_Tk_Correo;
         }
    }

print_r($datos);

    //guardamos en la base de datos los registros

	$data = array(
		"criteria" => $criteria,
		"status"   => $status,
		"nombre"   => $nombre,
		"apellido" => $apellido,
		"cargo_id"    => $cargo,
		"bin"      => $bin,
		"correo"   => $correo
	);

	global $wpdb;
	$wpdb->insert("wp_procesozoho",$data);
	$wpdb->show_errors();

