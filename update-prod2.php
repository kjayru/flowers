
<?php


$username = $_POST['username'];
$password = $_POST['password'];

$id = $_POST['prod_id'];
$estado = $_POST['estado'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://babyflowers.pe/wp-json/jwt-auth/v1/token',
    CURLOPT_USERAGENT => 'request token',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'username' => $username,
        'password' => $password
    )
));

$resp = curl_exec($curl);
$result = json_decode($resp, true);
curl_close ($curl);
//retorna TOKEN 
$token = $result['token'];

///sendata update
$headers =array(
    'Content-Type: application/json',
    'Authorization: Bearer ' .$token
    );


$url = "https://babyflowers.pe/wp-json/wp/v2/flores_panel/$id";

   $post = json_encode(array(
    'status' => $estado,
    'precio' => $precio,
    'content' => $descripcion
   ));
    

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_POST, 1);


    $result2 = curl_exec($ch);
    $res = json_decode($result2, true);
    $info = curl_getinfo($ch);

    print_r($res); 
    curl_close($ch);


