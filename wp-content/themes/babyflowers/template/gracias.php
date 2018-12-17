<!DOCTYPE html>
<html>
<head>
<title>Baby Flowers</title>
<style>

*{
  box-sizing: border-box;
}
body{
  margin:0;
  height:auto;
  background:#fff}
#wrapper{
  min-height:100%;
  overflow:auto}
.blk-row::after{
  content:"";
  clear:both;
  display:block;
}
.blk-row{
  padding-top:10px;
  padding-right:10px;
  padding-bottom:10px;
  padding-left:10px;
}
.blk37l{
  float:left;
  width:10%;
  padding-top:10px;
  padding-right:10px;
  padding-bottom:10px;
  padding-left:10px;
  min-height:75px;
}
.blk37r{
  float:left;
  width:90%;
  padding-top:10px;
  padding-right:10px;
  padding-bottom:10px;
  padding-left:10px;
  min-height:75px;
}
.c6049{
  color:black;
}
.c6242{
  padding:10px;
  color:#bf3b3b;
  font-weight:900;
  font-family:Arial, Helvetica, sans-serif;
  font-size:2.5em;
}
.c6306{
  padding:10px;
  color:#575757;
  font-size:1.25em;
  font-family:Arial, Helvetica, sans-serif;
}
.c6376{
  padding:10px;
  font-family:Arial, Helvetica, sans-serif;
  font-size:1.25em;
  color:#575757;
}
@media (max-width: 480px){
  .c6242{
    font-size:1.8rem;
    text-align:center;
  }
  .c6306{
    text-align:center;
  }
}
@media (max-width: 992px){
  .c6049{
    text-align:center;
  }
}


</style>
</head>
<body>

<div class="blk-row">
  <div class="blk37l">
    <img class="c6049" id="imagen" />
  </div>
  <div class="blk37r">
    <div class="c6242" id="titulo"></div>
    <div class="c6306" id="subtitulo"></div>
  </div>
</div>
<div class="c6376" id="mensaje"></div>

<script>
//if estado = "success" {
	document.getElementById('imagen').src = "<?php bloginfo('template_url'); ?>/images/check.jpg";
	document.getElementById("titulo").innerHTML = "!FELICITACIONES!";
	document.getElementById("subtitulo").innerHTML = "Tu pedido fue ingresado y pagado con éxito.";
	document.getElementById("mensaje").innerHTML = "Pronto recibirás un correo con toda la información de tu pedido.";
//}
</script>

</body>
</html>

