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
    $query = $Conexao->query("SELECT EMAIL, SENHA, VEICULO, MOTOR, KM, RESULTADO
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
<html>
<head>
	<title>Relatório do Veiculo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<!--===============================================================================================-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!--===============================================================================================-->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!--===============================================================================================-->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!--===============================================================================================-->

</head>
<body>
    <div class="container-fluid">
        
    </div>
    <header>

</header>
    <table id="example" class="table table-bordered table-hover" style="width:108%">
        <thead>
            <tr>
                <th>VEICULO</th>
                <th>MOTOR</th>     
                <th>KM</th>
                <th>RESULTADO</th>
            </tr>
        </thead>
        <?php
               foreach($veiculos as $veiculo) {
            ?>
            <tr>
                <td><?php echo $veiculo['VEICULO']; ?></td> 
                <td><?php echo $veiculo['MOTOR']; ?></td>
                <td><?php echo $veiculo['KM']; ?></td>
                <td><?php echo $veiculo['RESULTADO']; ?></td>
            </tr>
            <?php
               }
            ?>
    </table>
    </div>
<!--===============================================================================================-->   
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--===============================================================================================-->
</body>
</html>