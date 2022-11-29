<?php
	//starta a sessao
    session_start();
	ob_start();
	//resgata os valores das session em variaveis
	$email_users = isset($_SESSION['EMAIL']) ? $_SESSION['EMAIL']: "";	
	$pass_user = isset($_SESSION['SENHA']) ? $_SESSION['SENHA']: "";	
	$motor_users = isset($_SESSION['MOTOR']) ? $_SESSION['MOTOR']: "";	
	$km_users = isset($_SESSION['KM']) ? $_SESSION['KM']: "";	
	$resultado_users = isset($_SESSION['RESULTADO']) ? $_SESSION['RESULTADO']: "";
	$logado = isset($_SESSION['logado']) ? $_SESSION['logado']: "N";	
	//varificamos e a var logado contem o valos (S) OU (N), se conter N quer dizer que a pessoa nao fez o login corretamente
	//que no caso satisfazer nossa condição no if e a pessoa sera redirecionada para a tela de login novamente
	if ($logado == "N" && $id_users == ""){	    
		echo  "<script type='text/javascript'>
					location.href='index.php'
				</script>";	
		exit();
	}

define('DB_HOST'        , "localhost");
define('DB_USER'        , "sa");
define('DB_PASSWORD'    , "a");
define('DB_NAME'        , "CARBONLIFE");
define('DB_DRIVER'      , "sqlsrv");

require_once "Conexao.php";

    try{

    $Conexao = Conexao::getConnection();
    $query = $Conexao->query("SELECT EMAIL, SENHA, VEICULO, MOTOR, KM, RESULTADO, PLACA
                            FROM VEICULOS
                            WHERE SENHA = '$pass_users'
                            ORDER BY EMAIL");
    $faturamentos   = $query->fetchAll();

    }catch(Exception $e){
    echo $e->getMessage();
    exit;

}
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <title>Formulário de Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
  <div class="container" >
    <a class="links" id="paracadastro"></a>
    <a class="links" id="paralogin"></a>
     
    <div class="content">      
      <!--FORMULÁRIO DE VEICULO-->
      <div id="login">
        <form method="post" action=""> 
          <h1>Veiculo</h1> 
           <p> 
            <label for="nome_login">Modelo</label>
            <input id="email_users" name="email" required="required" type="text" placeholder=""/>
          </p><br>
          <p> 
            <label for="motor">Motor</label>
            <input id="motor_users" name="motor" required="required" type="text" placeholder=""/>
          </p>
           <p> 
            <label for="KM">KM</label>
            <input id="km_users" name="km" required="required" type="text" placeholder=""/>
          </p>
	  <p> 
            <label for="combustivel">Combustivel</label>
            <input id="comb_users" name="comb" required="required" type="text" placeholder=""/>
          </p>
	 <p> 
            <label for="placa">Placa</label>
            <input id="placa_users" name="placa" required="required" type="text" placeholder=""/>
          </p>
         <p> 
            <input type="button" class="btn btn-light" value ="Incluir" onclick="location.href='veiculo.php';" />
          </p>
         <p> 
            <input type="button" class="btn btn-light" value ="Relatorio" onclick="location.href='rcalculadora.php';" />
          </p>
        </form>
      </div>
 
        </form>
      </div>
    </div>
  </div>  
</body>
</html>