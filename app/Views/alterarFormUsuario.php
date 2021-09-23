<form method="POST">
    <div class="mb-3 col-2">
        <label class="form-label" for="codigousuarioinput">Código: </label>
        <input class="form-control text-center" readonly type="text" name="codUsuAlterar" id="codigousuarioinput" value="<?php echo ($usuario->codusu)?>">
    </div>
    <div class="mb-3 col-4">
        <label class="form-label" for="emailusuarioinput">Email: </label>
        <input class="form-control" type="text" name="emailUsu" id="emailusuarioinput" value="<?php echo ($usuario->emailUsu) ?>">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-warning">Alterar</button>
    </div>
</form>