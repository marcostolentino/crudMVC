<style>
    label {
        font-weight: bold;
        display: block;
    }
    select, textarea {
        width: 173px;        
    }
</style>

<center>
    <?
    if ($this->ok == 1) {
        echo "<h3 style='color: green'>$this->msgOk com sucesso!</h3>";
    } elseif ($this->msgException) {
        echo "<h3 style='color: red'>Não foi possível $this->acaoDescricaoPost! <br><small>$this->msgException</small></h3>";
    }
    ?>
    <table border="1" style="min-width: 500px">
        <tr style=" vertical-align: top">
            <td style="text-align: right; padding-right: 10px">
                <h2 style="text-align: center">Listar Pessoas</h2> 
                <?
                if ($this->qry->rowCount() == 0) {
                    echo '<h5 style="text-align: center; color: blue">Não existem pessoas para listar!</h5>';
                }
                while ($dado = $this->qry->fetch(PDO::FETCH_ASSOC)) {
                    echo $dado['NOME'];
                    ?>
                    <form method="POST" style="display: inline">
                        <input name="ID_PESSOA" value="<?= $dado['ID_PESSOA'] ?>" hidden>
                        <input name="ACAO" value="Editar" type="submit">
                        <input name="ACAO" value="Excluir" type="submit">
                    </form>
                    <hr>
                <? } ?>
            </td>
            <td style="padding-left: 10px">
                <h2 style="text-align: center;"><?= $this->acaoDescricao ?> Pessoa</h2> 
                <form method="POST">
                    <input type="text" name="ID_PESSOA" value="<?= @$this->dado['ID_PESSOA'] ?>" hidden>
                    <label>Nome:</label>
                    <input type="text" name="NOME" value="<?= @$this->dado['NOME'] ?>" minlength="3" maxlength="100" required><br>
                    <label>UF:</label>
                    <select name="UF" required>
                        <option></option>
                        <option value="SC" <?= (@$this->dado['UF'] == 'SC' ? 'selected' : '') ?>>SC</option>
                        <option value="OU" <?= (@$this->dado['UF'] == 'OU' ? 'selected' : '') ?>>Outro</option>
                    </select><br>
                    <label style="font-weight: normal">Observação:</label>
                    <textarea maxlength="1000" style="height: 100px" name="OBSERVACAO"><?= @$this->dado['OBSERVACAO'] ?></textarea>
                    <hr>
                    <div style="border: 0px solid; text-align: center">
                        <input name="ACAO" value="<?= $this->acaoDescricao ?>" type="submit">
                    </div>
                </form>
            </td>
        </tr>
    </table>
</center>