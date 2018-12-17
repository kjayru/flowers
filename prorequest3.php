<?php
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
				'Cq_Er_Tipo'      => $_POST['Cq_Er_Tipo'],
				'Cq_Er_Codigo'   => $_POST['Cq_Er_Codigo'],
				'Cq_Er_Mensaje' => $_POST['Cq_Er_mensaje'],
				'Cq_Er_MensajeUsuario'   => $_POST['Cq_Er_MensajeUsuario'],
				'Cq_Er_Param'    => $_POST['Cq_Er_Param'],
				'Pagado1'        => "No - Error",

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



