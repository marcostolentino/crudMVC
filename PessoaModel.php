<?php

class PessoaModel {

    private $pdo;

    //CONSTRUCT
    public function __construct() {
        $this->pdo = new PDO(DBLIB . ':host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //DADOS
    private function dado($dado) {
        return [
            ':NOME' => $dado['NOME'],
            ':UF' => $dado['UF'],
            ':OBSERVACAO' => $dado['OBSERVACAO']
        ];
    }

    //INCLUIR
    public function incluir($dado) {
        $acao = $this->pdo->prepare('
            INSERT INTO PESSOA (NOME,   UF,  OBSERVACAO) 
                        VALUES (:NOME, :UF, :OBSERVACAO)
        ');
        return $acao->execute($this->dado($dado));
    }

    //ALTERAR
    public function alterar($dado, $ID_PESSOA) {
        $acao = $this->pdo->prepare('
            UPDATE PESSOA SET NOME = :NOME, 
                                UF = :UF, 
                        OBSERVACAO = :OBSERVACAO 
                   WHERE ID_PESSOA = :ID_PESSOA
        ');
        $dado = $this->dado($dado);
        $dado[':ID_PESSOA'] = $ID_PESSOA;
        return $acao->execute($dado);
    }

    //EXCLUIR
    public function excluir($ID_PESSOA) {
        $acao = $this->pdo->prepare('
            DELETE FROM PESSOA 
                  WHERE ID_PESSOA = :ID_PESSOA
        ');
        return $acao->execute([
                    ':ID_PESSOA' => $ID_PESSOA
        ]);
    }

    //LISTAR
    public function listar($ID_PESSOA = '') {

        $where = '';
        if ($ID_PESSOA) {
            $where = 'WHERE ID_PESSOA = :ID_PESSOA';
        }

        $acao = $this->pdo->prepare("
            SELECT *
              FROM PESSOA
              $where
          ORDER BY NOME
        ");

        $acao->execute([
            ':ID_PESSOA' => $ID_PESSOA
        ]);

        return $acao;
    }

}
