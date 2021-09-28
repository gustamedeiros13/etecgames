<form method="POST">
    <div class="mb-3 col-2">
        <label class="form-label" for="codigofornecedorinput">Código: </label>
        <input class="form-control text-center" readonly type="text" name="codFornAlterar" id="codigofornecedorinput" value="<?php echo ($fornecedor->codForn)?>">
    </div>
    <div class="mb-3 col-4">
        <label class="form-label" for="nomefornecedorinput">Nome: </label>
        <input class="form-control" type="text" name="nomeForn" id="nomefornecedorinput" value="<?php echo ($fornecedor->nomeForn) ?>">
    </div>
    <div class="mb-3 col-4">
        <label class="form-label" for="emailfornecedorinput">Email: </label>
        <input class="form-control" type="text" name="emailForn" id="emailfornecedorinput" value="<?php echo ($fornecedor->emailForn) ?>">
    </div>
    <div class="mb-3 col-4">
        <label class="form-label" for="fonefornecedorinput">Fone: </label>
        <input class="form-control" type="text" name="foneForn" id="fonefornecedorinput" value="<?php echo ($fornecedor->foneForn) ?>">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-warning">Alterar</button>
    </div>
</form>