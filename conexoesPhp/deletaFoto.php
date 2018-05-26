<?php

include 'Conexao.php';

$codigo = $_GET['codigo'];


$sql = "delete from fotosprodutos where foto_cod = ".$codigo;


if(mysqli_query($oCon,$sql)){
 echo "jfdksl";
}else{
	echo mysqli_error($oCon);
}

?>