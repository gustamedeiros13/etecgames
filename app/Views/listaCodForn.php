<form method="Post">
    <div>
        <label for="codforn" class="forma-label">Digite o código do Fornecedor</label>
        <input type="number" name="codForn" id="codforn" class="form-control" placeholder="Exemplo: 123">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

<table class="table">
    <thead>
    <th>Código</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Fone</th>
        <th>Alterar</th>
        <th>Excluir</th>
    </thead>
    <tbody>
        <?php
        $codforn = isset($fornecedor->codForn) ? $fornecedor->codForn : "";
        $nomeforn = isset($fornecedor->nomeForn) ? $fornecedor->nomeForn : "";
        $emailforn = isset($fornecedor->emailForn) ? $fornecedor->emailForn : "";
        $foneforn = isset($fornecedor->foneForn) ? $fornecedor->foneForn : "";
        ?>
        <tr>
            <td><?php echo ($codforn) ?></td>
            <td><?php echo ($nomeforn) ?></td>
            <td><?php echo ($emailforn) ?></td>
            <td><?php echo ($foneforn) ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="codFornAlterar" value="<?php echo ($codforn) ?>">
                    <button type="submit" class="btn btn-warning">Alterar</button>
                </form>
            </td>
            <td>
                <form method="POST">
                    <input type="hidden" name="codFornDel" value="<?php echo ($codforn) ?>">
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
        </tr>

    </tbody>
</table>