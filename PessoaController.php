<?php

require_once 'PessoaModel.php';

class PessoaController {

    private $Model;
    private $ok;
    private $msgOk;
    private $msgException;
    private $qry;
    private $dado;
    private $acaoDescricaoPost;
    private $acaoDescricao = 'Incluir';

    private function acao() {
        $this->Model = new PessoaModel();
        try {

            //INCLUIR
            if ($_POST['ACAO'] == 'Incluir') {
                $this->msgOk = 'Incluído';
                $this->ok = $this->Model->incluir($_POST);
            }
            //ALTERAR
            elseif ($_POST['ACAO'] == 'Alterar') {
                $this->msgOk = 'Alterado';
                $this->ok = $this->Model->alterar($_POST, $_POST['ID_PESSOA']);
                $this->acaoDescricao = 'Incluir';
            }
            //EXCLUIR
            elseif ($_POST['ACAO'] == 'Excluir') {
                $this->msgOk = 'Excluído';
                $this->ok = $this->Model->excluir($_POST['ID_PESSOA']);
            }
            //EDITAR
            elseif ($_POST['ACAO'] == 'Editar') {
                $this->dado = $this->Model->listar($_POST['ID_PESSOA']);
                $this->dado = $this->dado->fetchAll(PDO::FETCH_ASSOC)[0];
                $this->acaoDescricao = 'Alterar';
            }
        } catch (Exception $ex) {
            $this->msgException = $ex->getMessage();
        }
    }

    public function listar() {
        $this->acaoDescricaoPost = $_POST['ACAO'];
        $this->acao();
        $this->qry = $this->Model->listar();
        require_once 'PessoaView.php';
    }

}
