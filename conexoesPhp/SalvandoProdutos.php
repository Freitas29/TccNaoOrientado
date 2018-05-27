<?php
session_start();


include 'Conexao.php';

$diretorio = '../Produtos/';

$Titulo = $_POST['NomeProduto'];

if (empty($Titulo)) {
	$_SESSION['VazioNomeProduto'] = "Por Favor, preecha o campo Nome do Produto";

	
}


$EstadoItem = $_POST['EstadoItem'];

if (empty($EstadoItem)) {
	$_SESSION['VazioEstadoItem'] = "Por Favor, selecione uma opção(Novo ou velho)";

	
}

$Descricao = $_POST['Descricao'];

if (empty($Descricao)) {
	$_SESSION['VazioDescricao'] = "Por Favor, escreva sobre o seu produto";

	
}

$Categoria = $_POST['Categoria'];


if (empty($Descricao)) {
	$_SESSION['VazioCategoria'] = "Por Favor, selecione uma Categoria";

	
}


$CategoriaTroca = $_POST['CategoriaParaTrocar'];

//Verifica se o campo opcional foi escolhido, se foi ele passa 0
if (empty($_POST['CategoriaParaTrocar'])){
	
	$CategoriaTroca = 0;
}

$Logado = $_SESSION['Login'];


//Insere os anuncios
$DadosAnuncio = "insert into anuncio (ancCod_Criador,ancTitulo,ancData,ancEstadoItem,ancDesc,ancCod_Categoria,ancCategoria_interesse)values ('$Logado','$Titulo',now(),'$EstadoItem','$Descricao',$Categoria,$CategoriaTroca)";

	
			if(mysqli_query($oCon,$DadosAnuncio)){
				echo "okay";
				print_r($DadosAnuncio);
				
			}else{
				
				echo "erro ao cadastrar";
				
				echo mysqli_error($oCon);
			}

			//Pegando o ultimo anuncio do banco
			$ultimoid = "select ancCodigo from anuncio order by ancCodigo desc limit 1";
			$DadosUltimoAnuncio = mysqli_query($oCon,$ultimoid);
			if($registro = mysqli_fetch_assoc($DadosUltimoAnuncio)){
						$DadoDoUltimoRegistro = $registro['ancCodigo'];
			}		

			//Verificando se o diretorio existe

				if(!is_dir($diretorio)){ 
					echo "Pasta $diretorio nao existe";
				}else{
					$arquivo = isset($_FILES['FotoProduto']) ? $_FILES['FotoProduto'] : FALSE;

					//Contadno as fotos
					for ($controle = 0; $controle < count($arquivo['name']); $controle++){
						$destino = $arquivo['name'][$controle];
						if(move_uploaded_file($arquivo['tmp_name'][$controle], $destino)){
							echo "Upload realizado com sucesso<br>";
							$DadosImagens = "insert into fotosprodutos(fotoDescricao,foto_cod_usuario,foto_cod_anuncio)values('$destino','$Logado','$DadoDoUltimoRegistro')";
							echo "Imagem cadastrada";
						}else{
								echo "Erro ao cadsatrar imagem";
								echo mysqli_error($oCon);
						}
							if(mysqli_query($oCon,$DadosImagens)){ 
								echo "sucesso";
						}else{
							echo "Erro ao realizar upload";
						}
						
					}
				}

mysqli_free_result($DadosUltimoAnuncio);
mysqli_close($oCon);
?>
