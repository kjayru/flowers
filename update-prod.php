
<?php



   // $username = 'josepolack@babyflowers.pe';
    $username = $_POST['username'];

   // $password = 'josepolack@babyflowers.pe';
    $password = $_POST['password'];


$id = $_POST['prod_id'];
$estado = $_POST['estado'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];



$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://flowers.test/wp-json/jwt-auth/v1/token',
    CURLOPT_USERAGENT => 'request token',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'username' => $username,
        'password' => $password
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
$result = json_decode($resp, true);
curl_close ($curl);
$token = $result['token'];

///sendata update



// Set some options - we are passing in a useragent too here
$headers = array(     
    "Authorization" => "Bearer$token", 
);

$url = "http://flowers.test/wp-json/wp/v2/flores_panel/$id";

   $post = array(
    'status' => $estado,
    'precio' => $precio,
   );
    
    $post = http_build_query($post);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_POST, 1);


    $result2 = curl_exec($ch);
    $res = json_decode($result2, true);

    if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);

   

    print_r($res);
    print_r($headers);
    print_r($post);

// Send the request & save response to $resp



