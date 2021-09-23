<form method="Post">
    <div>
        <label for="codusu" class="forma-label">Digite o código do Usuário</label>
        <input type="number" name="codUsu" id="codusu" class="form-control" placeholder="Exemplo: 123">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

<table class="table">
    <thead>
        <th>Código</th>
        <th>Email</th>
        <th>Alterar</th>
        <th>Deletar</th>
    </thead>
    <tbody>
        <?php
        $codusu = isset($usuario->codusu) ? $usuario->codusu : "";
        $emailusu = isset($usuario->emailUsu) ? $usuario->emailUsu : "";
        ?>
        <tr>
            <td><?php echo ($codusu) ?></td>
            <td><?php echo ($emailusu) ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="codUsuAlterar" value="<?php echo ($codusu) ?>">
                    <button type="submit" class="btn btn-warning">Alterar</button>
                </form>
            </td>
            <td>
                <form method="POST">
                    <input type="hidden" name="codUsuDel" value="<?php echo ($codusu) ?>">
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
        </tr>

    </tbody>
</table>