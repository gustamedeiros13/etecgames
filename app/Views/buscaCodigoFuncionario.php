<style type="text/css">
    form {
        font-size: large;
        background: #000000;
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 50px 10px 10px;
    }

    th {
        color: #1E90FF;
    }

    label {
        color: #1E90FF;
    }

    td {
        color: #1E90FF;
    }

    .formcad {
        width: 800px;
        height: 800px;
        margin: auto;
        padding-top: 50px;
        padding-bottom: 30px;
    }
</style>
<h1> Busca por Funcionário</h1>
<div class="formcad">
    <form method="Post" class="border border-dark p-3 rounded">
        <div>
            <div class="col-8 mb-3">
                <label class="mb-3" for="codusu">Digite o Código do Funcionário</label>
                <input type="number" name="codFunAlterar" id="codusu" class="form-control" placeholder="Exemplo:123" required>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Buscar</button>
        </div>
    </form>

    <?php
    //Selecionar todos os arquivos do método POST && GET
    $request = service('request');

    //Ternário
    $codfun = isset($funcionario->codFun) ? $funcionario->codFun : 0;
    $nomeFun = isset($funcionario->nomeFun) ? $funcionario->nomeFun : '';
    $foneFun = isset($funcionario->foneFun) ? $funcionario->foneFun : '';

    if ($codfun) {

    ?>

        <form method="Post">
            <div class="mb-3">
                <label for="codufun" class="form-label">Código Funcionário</label>
                <input type="text" class="form-control" id="codFun" name="codFun" value="<?= $codfun ?>" readonly aria-describedby="Exemplo: 123">
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Funcionário</label>
                <input type="text" class="form-control" id="nome" name="nomeFun" value="<?= $nomeFun ?>" aria-describedby="nomeHelp" required>
            </div>

            <div class="mb-3">
                <label for="fone" class="form-label">Fone do Funcionário</label>
                <input type="text" class="form-control" id="fone" name="foneFun" value="<?= $foneFun ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Alterar</button>
        </form>

        <form method="Post">
            <input type="hidden" name="codFunDeletar" value="<?= $codfun ?>">
            <button type="submit" class="btn btn-primary"> Deletar </button>
        </form>

    <?php
    }
    ?>