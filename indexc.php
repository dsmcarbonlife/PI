<?php
	//starta a sessao
    session_start();
	ob_start();
	//resgata os valores das session em variaveis
	$email_users = isset($_SESSION['EMAIL']) ? $_SESSION['EMAIL']: "";	
	$km_user = isset($_SESSION['KM']) ? $_SESSION['KM']: "";	
	$RESULTADO_users = isset($_SESSION['RESULTADO']) ? $_SESSION['RESULTADO']: "";	
    $pass_users = isset($_SESSION['SENHA']) ? $_SESSION['SENHA']: "";
	$logado = isset($_SESSION['logado']) ? $_SESSION['logado']: "N";	
	//varificamos e a var logado contem o valos (S) OU (N), se conter N quer dizer que a pessoa nao fez o login corretamente
	//que no caso de nao realizar nossa condicao no if e a pessoa sera redirecionada para a tela de login novamente
	if ($logado == "N" && $id_users == ""){	    
		echo  "<script type='text/javascript'>
					location.href='index.php'
				</script>";	
		exit();
	}
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>Formulário de Registro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
  <div class="container" >
    <a class="links" id="paracadastro"></a>
    <a class="links" id="paralogin"></a>
     
    <div class="content">      
      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="post" action=""> 
          <h1>Cadastro</h1> 
           
                     
          <p> 
            <label for="email_cad">Seu e-mail</label>
            <input id="email_cad" name="email" required="required" type="email" placeholder="contato@htmlecsspro.com"/> 
          </p>
           
          <p> 
            <label for="senha_cad">Sua senha</label>
            <input id="senha_cad" name="pass" required="required" type="password" placeholder="ex. 1234"/>
          </p>
           
          <p> 
	    <button type="submit" name="acao" value="logar">Cadastrarr</button>
          </p>
           
          <p class="link">  
            Já tem conta?
            <a href="index.php"> Ir para Login </a>
          </p>
        </form>
      </div>
    </div>
  </div>  
</body>
</html>

<?php
$action = isset($_POST['acao']) ? trim($_POST['acao']) : '';
	if(isset($action) && $action != ""){ 
		
		switch($action){
			case 'logar':
				//requerimos nossa classe de autenticação passando os valores dos inputs como parametros
				require_once('class/Autentica.class.php');
				//instancio a classse para podermos usar o metodo nela contida
				$Autentica = new Autentica();
				//setamos 
				$Autentica->email	= $_POST['email'];
				$Autentica->pass	= $_POST['pass'];
				//chamamos nosso metodo						
				if($Autentica->Validar_Usuario()){
				   echo  "<script type='text/javascript'>
							location.href='rcalculadora.php'
						</script>";
				  }else{
				   echo  "<script type='text/javascript'>
							alert('ATEN\u00c7\u00c4O, Login ou Senha inv\u00e1lidos...');location.href='index.php'
						</script>";
				  }
			break;
		}	
	}
?>