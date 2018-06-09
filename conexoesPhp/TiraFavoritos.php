<?php

include 'Conexao.php';

   session_start();

if((!isset ($_SESSION['Login']))){
header('location:Index.php');
}else{

$FavoritoCod = $_GET['id_produto'];


   $Dado = $_GET['id_produto'];

   $Deleta = 'delete from favoritos where favoritos_cod_anuncio ='.$FavoritoCod;


 if(mysqli_query($oCon,$Deleta)){
   	echo "sucesso";
   }else{
   	echo "fjdkls";
   	echo mysqli_error($oCon);
   }
}

 ?>
