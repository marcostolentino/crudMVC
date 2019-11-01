<?

//PRINT_R PRE
function pr($dado, $print_r = true) {
    echo '<pre>';
    if ($print_r) {
        print_r($dado);
    } else {
        var_dump($dado);
    }
}

//BANCO DE DADOS
define('DBLIB', 'mysql');
define('HOST', '127.0.0.1');
define('DBNAME', 'CRUD');
define('USER', 'root');
define('PASS', '');

//PESSOA
require_once 'PessoaController.php';
$Pessoa = new PessoaController();
$Pessoa->listar();
