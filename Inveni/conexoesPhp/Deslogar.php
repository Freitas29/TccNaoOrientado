<?php

session_start();

if(isset ($_SESSION['Login'])){
	unset ($_SESSION['Login']);
	echo "Deslogando";
	header('location:Index.php');
}


?>