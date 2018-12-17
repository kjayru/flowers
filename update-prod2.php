<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<?php
  $username = 'josepolack@babyflowers.pe';
  // $username = $_POST['username'];
   //$password = 'josepolack@babyflowers.pe';
  $password = 'Diegoymajo1!';

$id = $_GET['prod_id'];
$estado = $_GET['estado'];
//$precio = $_POST['precio'];
//$descripcion = $_POST['descripcion'];
?>
<div>Token: <label class="token"></label></div>
<div class="respuesta">
    <label></label>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>

var datasend = ({'username':'<?php echo $username ?>', 'password':'<?php echo $password ?>' });

$.ajax({
    url:'http://flowers.test/wp-json/jwt-auth/v1/token',
   
    method: 'POST',
    data:datasend,
    dataType:'json',
    success:function(response){
       
        localStorage.setItem('token', response.token);
    }
});
let itoken = localStorage.getItem("token");
$(".token").html(itoken);

var datasend2 = ({'status': '<?php echo $estado; ?>'});


$.ajax({
    url:'http://flowers.test/wp-json/wp/v2/flores_panel/<?php echo $id; ?>', 
    headers:{
        'Authorization': 'Bearer' +itoken,
    },
    method: 'POST',
    data:datasend2,
    success:function(response){ 
        
        $(".respuesta").html(response);
    }
});



 
</script>
<?php 
echo json_encode(["rpta"=>"Proceso realizado satisfactoriamente"]);
?>
</body>
</html>   
