<?php	

require_once('Conexao.class.php');

class Autentica extends Conexao{
	private $data = array();

	public function __construct(){
		$this->erro = '';
	}
	
	public function __set($name, $value){
		$this->data[$name] = $value;
	}

	public function __get($name){
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}

		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get(): ' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE);
		return null;
	}
		
		public function Validar_Usuario(){
			//instancio minha classe conexao que foi herdada
			$pdo = new Conexao(); 
			//chamamos nosso metodo select da classe conexao que nos retorna um conjunto de dados
			$resultado = $pdo->select("SELECT Email, SENHA FROM VEICULOS WHERE Email = '".$this->email."' AND SENHA = '".$this->pass."'");
			//desconectamos
			$pdo->desconectar();
			//agora vamos resgatar os valores obtidos pelo nosso metodo atraves do foreach
			//verificamos se houve registros dentro de nossa var se sim entra no if
			if(count($resultado)){
				foreach ($resultado as $res) {
					//estartamos nossa sessao para podermos usar os dados do usuario em nossa aplicação atraves de
					//session, na qual podemos usar para controle de verificar se o user esta logado ou nao, mostrar o nome do user na tela e etc.
					session_start();
					ob_start();
					//setamos as session com os valores obtido da tabela
					$_SESSION['EMAIL'] = $res['EMAIL'];
					$_SESSION['SENHA'] = $res['SENHA'];
					$_SESSION['MOTOR'] = $res['MOTOR'];
					$_SESSION['KM'] = $res['KM'];
					$_SESSION['RESULTADO'] = $res['RESULTADO'];					
					$_SESSION['logado'] = 'S';
			}
				//se tudo ocorrer bem retornamos true, ou seja verdade
				return true;
			}else{
				//se algo deu errado retornamos false
				return false;
			}
		}
}

		
?>