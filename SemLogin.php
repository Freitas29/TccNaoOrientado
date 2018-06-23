<html>
<?php
session_start();

if((!isset ($_SESSION['Login']))){

	include 'Header.php'
?>
<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

	<div class="container">

		<h1>Que triste :(</h1>
		<h2>Faça Login, por favor</h2>

		<a href="PaginaDeLogin.php">Fazer Login</a>

	</div>

</body>

  <!-- jquery -->
<script src="./javascript/jQuery.js"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>

<?php
}else{
	header('location:Logado.php');
}

?>
</html>