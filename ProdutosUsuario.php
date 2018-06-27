<html>
<?php
session_start();

if((!isset ($_SESSION['Login']))){
header('location:index.php');
}else{
  header("Content-type: text/html; charset=utf-8");
?>


<head>

<!-- Css do materialize -->
<link rel="stylesheet" href="./Materialize/css/materialize.css">

<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<script>

function TiraMenuCelular(){
  document.getElementById('menu-mobile').style.visibility="hidden";
}

function FechaTudo(){
  document.getElementById('menu-mobile').style.visibility="visible";
}



// CEP usuário
 function fnObtemDados(){
   var
      oPagina = new XMLHttpRequest();
      cep = document.all.CEP.value;

      with(oPagina)
      {
      open('GET','http://cep.republicavirtual.com.br/web_cep.php?cep='+cep+'&formato=json');
      send();
      onload = function()
               {
               var 
                   oResposta = JSON.parse(responseText);
                   document.all.Estado.value = oResposta.uf;
                   document.all.Cidade.value = oResposta.cidade;
                   document.all.Bairro.value = oResposta.bairro;
                   document.all.Logradouro.value = oResposta.logradouro;
               }
      }
   }

   //Essa função valida o campo se está vazio ou não, tira os espaçõs e vai para o segundo field(Estado de uso do produto)
    function Proximo(){
    var NomeProduto = document.all.Nome_Produto.value.match(/^[ \t]+$/);
      if (document.all.Nome_Produto.value == "") {
            document.getElementById('Vazio').style.display="block";
         
       }else{
        if (NomeProduto){
          document.getElementById('Vazio').style.display="block";
            }else{
            document.getElementById('Vazio').style.display="none";
           document.getElementById('PrimeiroField').style.display="none";
           document.getElementById('SegundoField').style.display="block";
           document.getElementById('Vazio').style.display="none";
           document.all.Nome_Produto.value.length.trim();

            }
        }
}


  // Essa função volta para o primiero fieldset
  function AnteriorPrimeiro(){
    document.getElementById('SegundoField').style.display="none";
    document.getElementById('PrimeiroField').style.display="block";
  }


  //Essa função vai para o fieldset de Categoria do produto
  function ProximoTerceiro(){
      if (document.all.Estado_Item.value.length == " "){
        document.getElementById('Vazio_Segundo').style.display="block";
      }else{
    document.getElementById('SegundoField').style.display="none";
    document.getElementById('TerceiroField').style.display="block";
    document.getElementById('Vazio_Segundo').style.display="none";
     }
  }

//Volta para o segundo field
  function AnteriorSegundo(){
    document.getElementById('TerceiroField').style.display="none";
    document.getElementById('SegundoField').style.display="block";
  }

//Vai para o fieldset opcional(Escolha de troca do produto)
  function ProximoQuarto(){
     if (document.all.Categoria_Produto.value.length == " "){
        document.getElementById('Vazio_Terceiro').style.display="block";
      }else{
    document.getElementById('TerceiroField').style.display="none";
    document.getElementById('QuartoField').style.display="block";
    document.getElementById('Vazio_Terceiro').style.display="none";
    }
  }

//Volta para o terceiro field
function AnteriorTerceiro(){
    document.getElementById('TerceiroField').style.display="block";
    document.getElementById('QuartoField').style.display="none";
  }

//Avança para o fieldset de descrição
function ProximoQuinto(){

    document.getElementById('QuartoField').style.display="none";
    document.getElementById('QuintoField').style.display="block";
}

//Volta para o quarto field
function AnteriorQuarto(){
    document.getElementById('QuintoField').style.display="none";
    document.getElementById('QuartoField').style.display="block";
  }

//Essa função também valida o campo descrição e remove todos os espaços duplou ou mais que o usuário digitar
function ProximoSexto(){
    var DescProduto = document.all.Descricao_Produto.value.match(/^[ \t]+$/);

    if (DescProduto) {
       document.getElementById('Vazio_Quinto').style.display="block";
    }else{
       if (document.all.Descricao_Produto.value.length == " "){
            document.getElementById('Vazio_Quinto').style.display="block";
          }else{
      document.getElementById('QuintoField').style.display="none";
      document.getElementById('SextoField').style.display="block";
       document.getElementById('Vazio_Quinto').style.display="none";
        }
    }
}

//Volta para o quinto field
function AnteriorQuinto(){
  document.getElementById('SextoField').style.display="none";
  document.getElementById('QuintoField').style.display="block"; 
}

function Enviar(){
  document.all.NomeProduto.value = document.all.Nome_Produto.value.replace(/\s{2,}/g, ' ');
  document.all.EstadoItem.value = document.all.Estado_Item.value;
  document.all.Categoria.value = document.all.Categoria_Produto.value;
  document.all.CategoriaParaTrocar.value = document.all.Categoria_Para_Trocar.value;
  document.all.Descricao.value = document.all.Descricao_Produto.value.replace(/\s{2,}/g, ' ');
  document.getElementById('EnviarDados').click();
  document.all.Nome_Produto.value = " ";
  document.all.Estado_Item.value = " ";
  document.all.Categoria_Produto.value = " ";
  document.all.Categoria_Para_Trocar.value= " ";
  document.all.Descricao_Produto.value=" ";
}



  function enviaFavorito(valor){
      var Objeto = new XMLHttpRequest();
      
      with(Objeto){
      
      open('GET','./conexoesPhp/Favoritar.php?id_produto='+valor+'');
      
      send();
        onload = function(){

           location.reload();
        }
      }
    
  }

  function TiraFavorito(valor){
      var Objeto = new XMLHttpRequest();
      
      with(Objeto){
      
      open('GET','./conexoesPhp/TiraFavoritos.php?id_produto='+valor+'');
      
      send();

      
        onload = function(){
        
        location.reload();
        
        }
      }
    
  }

    function DeletaAnuncio(valor){
      var Objeto = new XMLHttpRequest();
      
      with(Objeto){
      
      open('GET','./conexoesPhp/DeletaAnuncio.php?id_produto='+valor+'');
      
      send();

      
        onload = function(){
        location.reload();
        
        }
      }
    
  }

  function validaTel(valor){
  var d1 = valor.charAt(0);
  var d2 = valor.charAt(1);
  var d3 = valor.charAt(2);
  var d4 = valor.charAt(4);
  var d5 = valor.charAt(5);
  var d6 = valor.charAt(6);
  var d7 = valor.charAt(7);
  var final = "("+d1.concat(d2,")")+d3+" "+d4+valor.substring(4,5)+d5+valor.substring(6,6)+d6+"-"+d7+valor.substring(8);
  document.getElementById('CampoValue').value =final;
  document.getElementById('TELE').style.display="block";
  document.getElementById('TelPrincipal').style.display="none";
 
}

function ComValida(){
  document.getElementById('TELE').style.display="none";
  document.getElementById('TelPrincipal').style.display="block";
   
}


//function MostraFoto(){
   // let campo = document.getElementById('AdicionaFoto');
 
  //  for(contador = 0; contador < campo.files.length;contador++){
   //   alert(campo.files[contador].name);
  //    let arquivo = new FileReader();
      
    //  arquivo.onloadend = function(){
   //     let campo = document.getElementById('AdicionaFoto');
    //    document.getElementById("visualizacao").src = campo.files[contador].name;
   //     let x = document.createElement("IMG");
    //    x.setAttribute("src",arquivo.result);
   //     document.body.appendChild(x);
     // }


/// }


//}

//function MostraFoto(){
//    let campo = document.getElementById('AdicionaFoto');
 //   for(contador = 0; contador < campo.files.length;contador++){
 //     alert(campo.files[contador].name);
 //     let arquivo = new FileReader();
 //     alert(campo);
 //     arquivo.onloadend = function(){
 //       let campo = document.getElementById('AdicionaFoto');
 //       let x = document.createElement("IMG");
 //       x.setAttribute("src",arquivo.result);
  //      document.body.appendChild(x);
 //     }
//    }
//}

</script>

<style>

nav{
  
  background-color:#1e88e5 !important;
}

blockquote{
  border-left:5px solid #1e88e5 !important
}

  
fieldset:not(:first-child){
  display: none;
}

fieldset{
  border:none;
}

fieldset p{
  font-size: 25px;
    color: #1e88e5;
}
#Vazio{
  color:red;
}

#Vazio_Segundo{
  color:red;
}

#Vazio_Terceiro{
  color:red;
}

#Vazio_Quinto{
  color:red;
}
ul#categorias{
    display: inline-table;
  }

  .card .card-image #ImagensAnunciadas {
      display: block;
      border-radius: 2px 2px 0 0;
      position: relative;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      max-height: 25%;
      width: 100%;
      min-height: 20%;
      height: 25%;
  }

  .card .card-content p {
      margin: 0;
      color: inherit;
      max-width: 68ch;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }

  @media only screen and (max-width: 320px) {
    .card .card-image #ImagensAnunciadas {
      display: block;
      border-radius: 2px 2px 0 0;
      position: relative;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      max-height: 25%;
      width: 100%;
      height: 12%
    }
  }

    ul#categorias{
    display: inline-table;
    padding:9px;
  }
  fieldset p {
    font-size: 36px;
    color: #1e88e5;
}

label {
    font-size: 30px;
    color: #9e9e9e;
}

.card .card-content p {
      margin: 0;
      color: inherit;
      max-width: 68ch;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
</style>

<body onclick="FechaTudo()" style="background-color: whitesmoke;">

<?php

   include './conexoesPhp/Conexao.php';
    
    
    $Usuario = 'select usrEmail,usrApelido,usrFoto,usrTelefone,usrCEP,usrLogradouro,usrUf,usrBairro,usrLocalidade from usuario where UsrCodigo='.$_SESSION['Login'];
    
    $Categoria = 'select ctgCodigo,ctgNome from categoria';

    $CategoriaTroca = 'select ctgCodigo,ctgNome from categoria';

    $DadosCategoria = mysqli_query($oCon,$Categoria);

    $DadosCategoriaEscolhe = mysqli_query($oCon,$Categoria);

    $DadosCategoriaTroca = mysqli_query($oCon,$Categoria);

    $DadosUsuario = mysqli_query($oCon,$Usuario);
    $notificacoes = "select ancTitulo,usrApelido,ancCodigo,ancDesc from anuncio inner join trocas t on anuncioEnvia = ancCodigo inner join usuario on usuarioRecebe = UsrCodigo where usuarioRecebe = ".$_SESSION['Login']."  and t.trocado != 1";
      $resultadoNotificcoes = mysqli_query($oCon,$notificacoes);

      $linhasNotificacoes = mysqli_num_rows($resultadoNotificcoes);

    
    if($RegUsuario = mysqli_fetch_assoc($DadosUsuario)){
    
?>

  <ul id="categorias" class="dropdown-content">
      <?php
        $Categoria = 'select ctgCodigo,ctgNome from categoria where ctgNome != "Nenhum" ';
        $DadosCategoria = mysqli_query($oCon,$Categoria);
        while($RegCategoria = mysqli_fetch_assoc($DadosCategoria)){
      ?>

          <li><a href="ResultadoCategoria.php?categoria=<?php echo $RegCategoria['ctgCodigo']?>"></a><?php echo $RegCategoria['ctgNome'] ?></a></li>
          <?php
         }
          ?>
      </ul>
   <nav>
    <div class="nav-wrapper container">
  
       <a href="Logado.php" class="brand-logo left" style="width: 27%;"><img src="./imagens/logotipo.png" style="width: 46%"></a>


      <a href="#" data-activates="menu-mobile" class="button-collapse"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
    
          <!-- Notificação do usuário -->
          <?php
          if($linhasNotificacoes == 0){
            ?>
            <li style="width: 5%;height:  100%;border-radius: 0%;background-color: #1e87e5;" > <i class="material-icons">notifications_off</i></li>
            <?php

          }else{


          ?>
          <a href="efetuaTroca.php"><li style="width: 5%;height:  100%;border-radius: 0%;background-color: #f58614;" class="btn-floating pulse"> <i class="material-icons" style="left: 10%;position:  absolute;">notifications</i><label style="position:  absolute;top: 20%;font-size:  20px;font-weight:  900;left: 60%;color: white;"><?php echo $linhasNotificacoes?></label></li></a>
    <?php
    }
    ?>


    
    <!--Menu de usuario-->
        <li><a href="#" data-activates="slide-out" class="button"><?php echo $RegUsuario['usrApelido'];?></a></li>
        <li><a href="./conexoesPhp/Deslogar.php">Sair</a></li>

         <li><a href="Logado.php">Página Inicial</a></li>
         <li><a class="dropdown-button" href="#" data-activates="categorias">Categorias
          <i class ="mdi-navigation-arrow-drop-down right"></i></a></li>
       
      </ul>

    <ul id="slide-out" class="side-nav">

    <li><div class="user-view">

      <div class="background" style="background-color: #3d6888;">


      </div>
      <a href="#!user"><img class="circle" src="./Usuarios/<?php echo $RegUsuario['usrFoto'];?>"></a>

      <a href="#!name"><span class="white-text name"><?php echo $RegUsuario['usrApelido'];?></span></a>

      <a href="#!email"><span class="white-text email"><?php echo $RegUsuario['usrEmail'];
    
    }
    ?></span></a>

    </div></li>

      <li><a href="ProdutosUsuario.php#test-swipe-4">Seus Dados</a></li>
        <li><a href="ProdutosUsuario.php#test-swipe-2">Anunciar um Novo Produto</a></li>
         <li><a href="ProdutosUsuario.php#test-swipe-1">Seus Produtos</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader" >Favoritos</a></li>
        <li><a class="waves-effect" href="ProdutosUsuario.php#test-swipe-3">Seus Produtos Favoritados</a></li>
          <li><a class="subheader">Trocas</a></li>
        <li><a class="waves-effect" href="efetuaTroca.php">Pedidos para troca</a></li>
        <li><a class="waves-effect" href="produtosTrocados.php">Produtos trocados</a></li>
  </ul>

  
        <!-- Celular -->
    
      <ul class="side-nav" id="menu-mobile">
    
    
      <nav>

      <div class="nav-wrapper">

        <form>

        <div class="input-field">

          <input id="search" type="search" required>

          <label class="label-icon" for="search"><i class="material-icons">search</i></label>

          <i class="material-icons">close</i>

        </div>


        </form>


      </div>

    </nav>

      <li ><a href="#" data-activates="slide-out" class="button" onclick="TiraMenuCelular()"><i class="material-icons">account_circle</i></a></li>

        <li><a href="Logado.php">Página Inicial</a></li>

        <li><a href="collapsible.html">Javascript</a></li>

        <li><a href="mobile.html">Mobile</a></li>

      </ul>
    
    </div>

  </nav>
          
 

<div class="row">

  <ul id="tabs-swipe-demo" class="tabs" style="background-color: #1e88e5">

          <li class="tab col s3"><a href="#test-swipe-4" style="color: #fff">Seus Dados</a></li>

          <li class="tab col s3"><a href="#test-swipe-1" style="color: #fff">Produtos Anunciados</a></li>

          <li class="tab col s3"><a href="#test-swipe-2" style="color: #fff">Anunciar um novo produto</a></li>

          <li class="tab col s3"><a href="#test-swipe-3" style="color: #fff">Favoritos</a></li>
    </ul>

<div class="container">


    <!-- Dados do usuário -->

     <div id="test-swipe-4" class="col s12">

    <div class="row">
    
      <div class="container">
        

        <div class="card horizontal">

        <div class="card-image col l6 s6 m6">

          <img src="./Usuarios/<?php echo $RegUsuario['usrFoto'];?>" onclick="AlteraFoto()">

           <div class="file-field input-field col s12 m12 l12">
               <div class="btn">
            <form method="POST" enctype="multipart/form-data" action="./conexoesPhp/AlteraFotoUsuario.php">
             

                <input type="file" name="FotoUsuario" id="btnEscolheFotoUsuario" onchange="document.getElementById('EnviarFotoUsuario').click()">
                
                <span>Trocar Foto</span>
              </div>
              <button id="EnviarFotoUsuario" style="visibility: hidden;"></button>
            </form>
          
          </div>
        </div>

        <div class="card-stacked">

          <div class="card-content">

            <h5>Email de contato</h5>

            <p><?php echo $RegUsuario['usrEmail'] ?></p>

          

          <!-- modal para nome do usuário -->

            <div class="card-action">
              <button data-target="modal3" class="btn modal-trigger">Mudar Email</button>
            </div>


             <div id="modal3" class="modal">
              <div class="modal-content">

                <form action="./conexoesPhp/AlteraEmail.php" method="POST">

                  <div class="input-field col s12 m12 l12">
                    <input type="email"  class="validate" name="NovoEmail" value="<?php echo $RegUsuario['usrEmail'] ?>" required>
                    <label for="icon_prefix">Novo Email</label>
                </div>

                <button>Enviar</button>
                </form>

              </div>
            </div>

          <h5>Nome de Usuário</h5>

          
            <p><?php echo $RegUsuario['usrApelido'] ?></p>

            <!-- Modal Para alterar nome do usuário -->


           <div class="card-action">
              <button data-target="modal2" class="btn modal-trigger">Mudar Nome</button>
            </div>
            
            <div id="modal2" class="modal">
              <div class="modal-content">

                <form action="./conexoesPhp/AlteraNome.php" method="POST">

                  <div class="input-field col s12 m12 l12">
                    <input  type="text"  class="validate" name="NovoNome" value="<?php echo $RegUsuario['usrApelido'] ?>" required>
                    <label for="icon_prefix">Novo Nome</label>
                </div>

                <button>Enviar</button>
                </form>

              </div>
            </div>

          <h5>Endereço</h5>

            <form>
              
              <p><strong>CEP: </strong> <?php echo $RegUsuario['usrCEP'] ?></p>
              <p><strong>Rua: </strong> <?php echo $RegUsuario['usrLogradouro'] ?></p>
              <p><strong>Cidade: </strong> <?php echo $RegUsuario['usrUf'] ?></p>
              <p><strong>Bairro: </strong><?php echo $RegUsuario['usrBairro'] ?></p>
              <p><strong>Estado: </strong><?php echo $RegUsuario['usrLocalidade'] ?></p>

            </form>

            <div class="card-action">
              <button data-target="modal1" class="btn modal-trigger">Mudar endereço</button>
            </div>

            <!--ESTRUTURA DO MODAL DE ENDEREÇO -->
            <div id="modal1" class="modal">
              <div class="modal-content">


                <h4>Endereço</h4>

                <form action="./conexoesPhp/AlteraEndereco.php" method="POST">
                  
                          <!-- Estado onde será anunciado -->
                        <div class="input-field col s12 m12 l12">
                    <i class="material-icons prefix">location_on</i>
                    <input type="text"  class="validate" name="CEP" maxlength="9" id="CEP" required value="<?php echo $RegUsuario['usrCEP'] ?>">
                    <label for="icon_prefix">Digite seu cep</label>
                </div>

                 <div class="input-field col s12 m12 l12">
                    <input id="Logradouro" type="text"  class="validate" name="Logradouro" required value="<?php echo $RegUsuario['usrLogradouro'] ?>" onclick="fnObtemDados()">
                    <label for="icon_prefix">Rua</label>
                </div>

                <div class="input-field col s12 m12 l12">
                    <input id="Cidade" type="text"  class="validate" name="Cidade" value="<?php echo $RegUsuario['usrUf'] ?>" required>
                    <label for="icon_prefix">Cidade</label>
                </div>

                <div class="input-field col s12 m12 l12">
                    <input id="Bairro" type="text"  class="validate" name="Bairro" value="<?php echo $RegUsuario['usrBairro'] ?>" required>
                    <label for="icon_prefix">Bairro</label>
                </div>

                <div class="input-field col s12 m12 l12">
                    <input id="Estado" type="text"  class="validate" name="Estado" value="<?php echo $RegUsuario['usrLocalidade']?>" required maxlength="2">
                    <label for="icon_prefix">Estado</label>
                    <button onclick="fnObtemDados()" style="visibility: hidden;">Pesquisar</button>
                </div>           

              </div>
              <div class="modal-footer">
                <button>Alterar</button>
              </div>
            </div>
 </form>
              
              <p><strong>Telefone: </strong> <?php echo $RegUsuario['usrTelefone'] ?></p>

               <div class="card-action">
              <button data-target="modalTel" class="btn modal-trigger">Mudar Telefone</button>

              </div>

               <div id="modalTel" class="modal">

              <div class="modal-content">


                <h4>Telefone</h4>

          <form action="./conexoesPhp/AlteraTelefone.php" method="POST">
                  
                          <!-- Telefone para trocar -->
                    

                <div class="input-field col s12 m12 l12" id="TelPrincipal">
                    <input id="Telefone" type="text"  class="validate" name="AtualizaTel" placeholder="<?php echo $RegUsuario['usrTelefone']?>" required maxlength="15" onblur="validaTel(this.value)">
                    <label for="icon_prefix">Telefone</label>
                    
                </div>   

                <div class="input-field col s12 m12 l12" style="display:none;" id="TELE" onclick="ComValida()">
                  <p>Telefone(opcional)</p>
                  <i class="material-icons prefix">phone</i>
                     <input type="text"  maxlength="15" id="CampoValue">

                </div>
        

              </div>
                <div class="modal-footer">
                  <button>Alterar</button>
                </div>
            </div>
              
          </form>


        </div>

        </div>

      </div>

      </div>

    </div>


    </div>




     <!--  Produtos anunciados -->
        <div id="test-swipe-1" class="col s12">

          <?php
          
            $SelecionaOsProdutosAnunciados = 'select ancCodigo,ancTitulo,ancEstadoItem,ancCod_Criador,ancDesc from anuncio where trocado = 0 and ancCod_Criador = '.$_SESSION['Login'];

            $DadosDoProdutosAnunciados = mysqli_query($oCon,$SelecionaOsProdutosAnunciados);

            while ($RegProdutosAnunciado = mysqli_fetch_assoc($DadosDoProdutosAnunciados)) {
              

                $anunciosDoUsuario = $RegProdutosAnunciado['ancCodigo'];


        
              
            ?>
          

          
              <div class="col l3 m3 s3">
                <div class="card" style=" word-wrap: break-word;">
                  <div class="card-image">
  
  <!--    Deleta anuncio -->

                    <a class="btn-floating btn-small waves-effect waves-light blue darken-2" onclick="DeletaAnuncio(<?php echo $RegProdutosAnunciado['ancCodigo'];?>)"><i class="material-icons">clear</i></a>
                     <?php 

                     $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anunciosDoUsuario.' order by  foto_cod asc limit 1';

                     $DadosDasFotos = mysqli_query($oCon,$Fotos);

                     while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
                      
                      ?>
                    <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>" id="ImagensAnunciadas">
                    

                    <?php 
                   }
                   ?>
                  
                    <button data-target="modal4" class="btn-floating btn-large cyan pulse btn modal-trigger right"><a href="alterarProduto.php?anuncio=<?php echo $anunciosDoUsuario?>"><i class="material-icons">create</i></a></button>

                           

                  </div>

                  <div class="card-content">
                    <span class="card-title"><?php echo $RegProdutosAnunciado['ancTitulo']?></span>
                    <p id="Desc"><?php echo $RegProdutosAnunciado['ancDesc']?></p>
                  </div>

                </div>
              </div>
        
            
          <?php
            
          }
        
          ?>




          <?php
          //Esse loop é para pegar os anuncios que foram trocados
          
            $SelecionaOsProdutosAnunciados = 'select ancCodigo,ancTitulo,ancEstadoItem,ancCod_Criador,ancDesc from anuncio where trocado = 1 and ancCod_Criador = '.$_SESSION['Login'];

            $DadosDoProdutosAnunciados = mysqli_query($oCon,$SelecionaOsProdutosAnunciados);

            while ($RegProdutosAnunciado = mysqli_fetch_assoc($DadosDoProdutosAnunciados)) {
              

                $anunciosDoUsuario = $RegProdutosAnunciado['ancCodigo'];


        
            
          ?>
          

          
              <div class="col l3 m3 s3">
                <div class="card" style=" word-wrap: break-word;">
                  <div class="card-image">
                     <?php 

                     $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where foto_cod_anuncio =".$anunciosDoUsuario.' order by  foto_cod asc limit 1';

                     $DadosDasFotos = mysqli_query($oCon,$Fotos);

                     while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
                      
                      ?>
                    <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>" id="ImagensAnunciadas">
                    

                    <?php 
                   }
                   ?>
                  </div>

                  <div class="card-content">
                    <span class="card-title"><?php echo $RegProdutosAnunciado['ancTitulo']?></span>
                    <p id="Desc"><?php echo $RegProdutosAnunciado['ancDesc']?></p>
                    <button class="btn disabled">Produto Trocado</button>
                  </div>

                </div>
              </div>
        
            
          <?php
            
          }
        
          ?>




          </div>





        </div>



      


          </div>

<div class="container">
      <!-- Anunciar um novo produto -->
        <div id="test-swipe-2" class="col s12 m12 l12" style="box-shadow: 2px 2px 2px 2px #ddd;margin-top: 3%;background-color: #fff;">

                <div class="row">

                    <fieldset id="PrimeiroField">

                      <blockquote>
                        <p>TITULO <label> USO </label><label> CATEGORIA </label><label> INTERESSE </label><label> DESCRIÇÃO </label><label> FOTOS</label></p>
                      </blockquote>

                          <div class="input-field col s6 m6 l6">

                                      <input id="input_text" type="text" class="validate" name="Nome_Produto" data-length="150" maxlength="150">
                                      <span id="Vazio" style="display: none;">Preencha o campo</span>

                                      <label for="icon_prefix">Nome do produto</label>

                              <button onclick="Proximo()" id="Proximo"  class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Avançar</button>

                          </div>

                    </fieldset>



                    <fieldset id="SegundoField">
                      
                      <blockquote>
                         <p><label>TITULO </label> USO <label> CATEGORIA </label><label> INTERESSE </label><label> DESCRIÇÃO </label><label> FOTOS</label></p>
                      </blockquote>

                       <div class="input-field col s6 m6 l6">
                                    <select name="Estado_Item">
                                      <option value="" disabled selected>Novo ou Usado</option>
                                      <option value="Novo" name="EstadoItem">Novo</option>
                                      <option value="Usado" name="EstadoItem">Usado</option>
                                    </select>
                                    <span id="Vazio_Segundo" style="display: none;">Preencha o campo</span>

                                    <button onclick="AnteriorPrimeiro()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Voltar</button>
                                    <button onclick="ProximoTerceiro()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Avançar</button>
                        </div>            
                    </fieldset>


                    <fieldset  id="TerceiroField">
                      
                      <blockquote>
                       <p><label>TITULO </label> <label>USO </label> CATEGORIA <label> INTERESSE </label><label> DESCRIÇÃO </label><label> FOTOS</label></p>
                      </blockquote>

                       <div class="input-field col s6 m6 l6">
                                    <select name="Categoria_Produto">
                                      <option value="" disabled selected>Categoria do produto</option>

                                      <?php 

                                      while($RegCategoria = mysqli_fetch_assoc($DadosCategoriaEscolhe)){
                                      ?>


                                      <option name="Categoria" value="<?php echo $RegCategoria['ctgCodigo']?>"> <?php echo $RegCategoria['ctgNome']?></option><?php }?>
                                
                                    </select>
                                    <span id="Vazio_Terceiro" style="display: none;">Preencha o campo</span>
                                    

                      <button onclick="AnteriorSegundo()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Voltar</button>

                      <button onclick="ProximoQuarto()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Avançar</button>

                     </div>

                    </fieldset>    

                   <!--  Quarto field -->

                    <fieldset id="QuartoField">

                      <blockquote>
                       <p><label>TITULO </label> <label>USO </label><label> CATEGORIA</label> INTERESSE <label> DESCRIÇÃO </label><label> FOTOS</label></p>
                        <h5>Este item é opcional</h5>
                      </blockquote>
                      

                        <div class="input-field col s6 m6 l6">

                          <select name="Categoria_Para_Trocar">

                            <option value="" disabled selected>Opção de categoria no qual você gostaria de trocar</option>


                            <?php 

                            while($RegCategoriaTroca = mysqli_fetch_assoc($DadosCategoriaTroca)){
                            ?>


                            
                            <option name="Categoria" value="<?php echo $RegCategoriaTroca['ctgCodigo']?>"> <?php echo $RegCategoriaTroca['ctgNome']?></option><?php }?>
                      
                          </select>

                          <label>Escolha uma categoria que você queira trocar(Opcional)</label>

                            <button onclick="AnteriorTerceiro()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Voltar</button>

                            <button onclick="ProximoQuinto()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Avançar</button>

                        </div>
                          

                      </fieldset>
                        

                      <fieldset id="QuintoField">
                          
                          <blockquote>
                              <p><label>TITULO </label> <label>USO </label><label> CATEGORIA</label> <label>INTERESSE</label>  DESCRIÇÃO <label> FOTOS</label></p>
                          </blockquote>
                             <div class="input-field col s12 m12 l12">
                                <textarea id="textarea1" class="materialize-textarea" data-length="250" name="Descricao_Produto" required></textarea>

                                <span id="Vazio_Quinto" style="display: none;">Preencha o campo</span>

                                <label for="textarea1">Descrição do produto</label>
                              </div>

                              <button onclick="AnteriorQuarto()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Voltar</button>

                              <button onclick="ProximoSexto()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Avançar</button>

                      </fieldset>

                      <fieldset id="SextoField">
                        
                        <blockquote>
                              <p><label>TITULO </label> <label>USO </label><label> CATEGORIA</label> <label>INTERESSE</label><label> DESCRIÇÃO </label> FOTOS</p>
                          </blockquote>

                        <div class="file-field input-field col s12 m12 l12">

                            <div class="btn">
                              <form class="col s12 m12 s12" method="POST" enctype="multipart/form-data" action="./conexoesPhp/SalvandoProdutos.php">

                                 <span>Selecione as fotos do seu produto</span>

                                 <input type="file" multiple name="FotoProduto[]" required onchange="MostraFoto()" id="AdicionaFoto">

                                  

                              </div>

                              <div class="file-path-wrapper">

                                  <input class="file-path validate" type="text" placeholder="Fotos do seu produto">

                              </div>

                             
                              <img id="visualizacao">

                              <button onclick="Enviar()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A" style="float: right;">Enviar Dados</button>


                              <!--  Campo invisivel -->
                                  <input type="text" name="NomeProduto" style="display: none;">
                                  <input type="text" name="EstadoItem" style="display: none;">
                                  <textarea name="Descricao" style="display: none;" ></textarea >
                                  <input type="text" name="Categoria" style="display: none;">
                                  <input type="text" name="CategoriaParaTrocar" style="display: none;">

                                  <button  id="EnviarDados" style="display: none;" >Enviar</button>

                              </form>

                               <button onclick="AnteriorQuinto()" class="blue darken-2 waves-effect waves-light btn  N/A-text text-N/A">Voltar</button>

                        </div>

                      </fieldset>


                  </div>

           </div>       

        </div>




<div class="container">
  <div class="row">
        <!-- Favoritos -->
    <div id="test-swipe-3" class="col s12">

      <?php
          
           

            $DadosFavoritos = ' select favoritos_cod,ancTitulo,ancCodigo,ancDesc,favoritos_cod_anuncio,favoritos_cod_usuario,ancCodigo from favoritos inner join anuncio on favoritos_cod_anuncio = ancCodigo where ancCodigo = favoritos_cod_anuncio and  favoritos_cod_usuario ='.$_SESSION['Login'];

            $FavoritosMostra = mysqli_query($oCon,$DadosFavoritos);

              while($RegFav = mysqli_fetch_assoc($FavoritosMostra)) {

          ?>
          

          
              <div class="col l3 m3 s3">
                <div class="card" style=" word-wrap: break-word;">
                  <div class="card-image">
  
                     <?php 

                      $FotoFavorito = $RegFav['favoritos_cod_anuncio'];


                     $Fotos = "select ancCodigo,fotoDescricao,foto_cod_usuario,foto_cod_anuncio from anuncio inner join fotosprodutos on ancCodigo = fotosprodutos.foto_cod_anuncio where 
                     foto_cod_anuncio =".$FotoFavorito." order by foto_cod asc limit 1";

                     $DadosDasFotos = mysqli_query($oCon,$Fotos);

                     while ($FotosEnd = mysqli_fetch_assoc($DadosDasFotos)) {
                      
                      ?>
                    <img src="./Produtos/<?php echo $FotosEnd['fotoDescricao'] ?>" id="ImagensAnunciadas">
                    

                    <?php 
                   }


                    $linhas = mysqli_num_rows($FavoritosMostra);
                    if($linhas == 0){
                      ?>
                      <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2"  onclick="enviaFavorito(<?php echo $RegFav['ancCodigo'];?>)" id="btnFavoritado"><i class="material-icons">favorite_border</i></a>
                  
                      <?php
                      }elseif($linhas > 0){

                    

                      ?> 

                      <a class="btn-floating halfway-fab waves-effect waves-light blue darken-2" id="btnNaoFavoritado" onclick="TiraFavorito(<?php echo $RegFav['ancCodigo'];?>)"><i class="material-icons">favorite</i></a>
          
                      <?php     

                    }

                
              
                    ?>
                           

                  </div>

                  <div class="card-content">
                    <span class="card-title"><?php echo $RegFav['ancTitulo']?></span>
                    <p id="Desc"><?php echo $RegFav['ancDesc']?></p>
                  </div>

                </div>
              </div>
        <?php


          }
        ?>
            

          </div>

        </div>
</div>
  

  </div>

    </div>
      </div>
        </div>
</body>

<!-- jquery -->
<script src="./javascript/jQuery.js"></script>

<!-- Materialize JavaScript -->
<script src="./Materialize/js/materialize.js"></script>


<!-- Menu dropdown -->
<script> 
$(".button-collapse").sideNav();
</script>


<!-- MENU DO USUARIO -->
<script>

$(".button").sideNav();

</script>


<!-- SELECTS -->
<script>
  $(document).ready(function() {
    $('select').material_select();
  });
</script>


<!-- TextArea -->
<script>
  
  $(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });


</script>


<!-- Pra mudar informaçoes do usuario(MODALS) -->
<script type="text/javascript">
   $(document).ready(function(){
    $('.modal').modal();
  });


          
</script>



</body>



<script type="text/javascript">
  $(document).ready(function(){
    $('.modal2').modal();
  });



</script>


<?php

}


mysqli_free_result($DadosCategoria);
mysqli_free_result($DadosUsuario);
mysqli_close($oCon);
?>