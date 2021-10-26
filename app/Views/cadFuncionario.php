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

<div class="formcad">
    <form method="Post" class="border border-dark p-3 rounded">
        <div>
            <div class="col-8 mb-3">
                <label class="mb-3" for="codusu">Digite o Código do Usuário</label>
                <input type="number" name="codUsu" id="codusu" class="form-control" placeholder="Exemplo:123" required>
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
    $codusu = isset($usuario->codusu)?$usuario->codusu:0;
    $email = isset($usuario->emailUsu)?$usuario->emailUsu:'';
    ?>

    <form method="Post">
        <div class="mb-3">
            <label for="codusu" class="form-label">Código Usuário</label>
            <input type="text" class="form-control" id="codusu" name="codUsu" value="<?=$codusu?>" readonly aria-describedby="Exemplo: 123">
        </div>

        <div class="mb-3">
            <label for="emailusu" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="emailusu" name="emailUsu" readonly value="<?=$email?>" aria-describedby="nomeHelp">
        </div>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nomeFun" aria-describedby="nomeHelp" required>
        </div>

        <div class="mb-3">
            <label for="fone" class="form-label">Fone</label>
            <input type="text" class="form-control" id="fone" name="foneFun" required>
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>