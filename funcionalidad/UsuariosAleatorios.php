<?php 
$usuariogenerado="";
$contraseñagenrada="";
$formatousuario ="";
$longituddatos=0;
$u="";
$p=0;

//Elegir el tipo de formato del usuario y cantidad de digitos

if ($formatousuario == "1") {
    $u = randNLC($longituddatos);
  } elseif ($formatousuario == "2") {
    $u = randNLC($longituddatos);
  } elseif ($formatousuario == "3") {
    $u = randNLC($longituddatos);
  } elseif ($formatousuario == "4") {
    $u = randNLC($longituddatos);
  } 

  if ($longituddatos == 2) {
    $p = randN(2);
  } elseif ($longituddatos == 3) {
    $p = randN(3);
  } elseif ($longituddatos == 4) {
    $p = randN(4);
  } elseif ($longituddatos == 5) {
    $p = randN(5);
  } elseif ($longituddatos == 6) {
    $p = randN(6);
  } 

  if($u != "" && $p !=0){
    $usuariogenerado=0;
  }

function randNLC($length) { //nombre aleatorio entre numeros y letras minusculas
	$chars = "23456789abcdefghijkmnprstuvwxyz";
	$charArray = str_split($chars);
	$charCount = strlen($chars);
	$result = "";
	for($i=1;$i<=$length;$i++)
	{
		$randChar = rand(0,$charCount-1);
		$result .= $charArray[$randChar];
	}
	return $result;
}
function randN($length) {//numeros aleatorios entre 0 y 9
	$chars = "0123456789";
	$charArray = str_split($chars);
	$charCount = strlen($chars);
	$result = "";
	for($i=1;$i<=$length;$i++)
	{
		$randChar = rand(0,$charCount-1);
		$result .= $charArray[$randChar];
	}
	return $result;
}
?>