<form method="POST" class='border border-primary rounded p-4'>
<?php 
$codusuario = isset($usuario->codusu) ? $usuario->codusu : null;

if($codusuario && $codusuario!=null) :
?>
	<div class="mb-3">
		<label for="nome" class="form-label">Código Usuário</label>
		<input type="text" class="form-control" id="codigo" readonly name="codusu_FK" value="<?php echo ($codusuario); ?>">
	</div>
	<div class="mb-3">
		<label for="cpf" class="form-label">CPF</label>
		<input type="number" class="form-control" id="cpf" aria-describedby="cpfHelp" name="CpfCli">
		<div id="cpfHelp" class="form-text">CPF do cliente</div>
	</div>
	<div class="mb-3">
		<label for="nome" class="form-label">Nome</label>
		<input type="text" class="form-control" id="nome" aria-describedby="nomeHelp" name="nomeCli">
		<div id="nomeHelp" class="form-text">Nome do cliente</div>
	</div>
	<div class="mb-3">
		<label for="telefone" class="form-label">Telefone</label>
		<input type="text" class="form-control" aria-describedby="telHelp"  id="telefone" name="foneCli">
		<div id="telHelp" class="form-text">xxxx-xxxx</div>
	</div>
	<button type="submit" class="btn btn-primary">Cadastrar</button>
	
<?php else : ?>

	<div>
        <label for='codusu' class='form-label'>Digite o Código do usuário para poder passar para cliente</label>
        <input type='number' name='codUsuBusca' id='codusu' class='form-control' placeholder='Exemplo: 123' required/>
    </div>

    <div class='col-12 mt-4'>
        <button type='submit' class='btn btn-primary'>Buscar</button>
    </div>
<?php endif ?>

</form>