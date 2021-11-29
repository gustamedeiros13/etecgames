<?php
$searchModeCk = isset($searchModeRd) ? $searchModeRd : 1;
?>

<form method="post" class='border border-primary rounded p-4'>
	<fieldset class="row mb-3">
		<legend class="col-form-label col-sm-3 pt-0">Escolha a informação desejada:</legend>
		<div class="col-sm-6">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="Codigo" <?php if($searchModeCk == 1) echo 'checked';?> value="1" onclick="getChecked();">
				<label class="form-check-label" for="Codigo">Código</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="Nome" <?php if($searchModeCk == 2) echo 'checked';?> value="2" onclick="getChecked();">
				<label class="form-check-label" for="Nome">Nome</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="Email" <?php if($searchModeCk == 3) echo 'checked';?> value="3" onclick="getChecked();">
				<label class="form-check-label" for="Email">E-mail</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="Fone" <?php if($searchModeCk == 4) echo 'checked';?> value="4" onclick="getChecked();">
				<label class="form-check-label" for="Fone">Telefone</label>
			</div>
		</div>
	</fieldset>

	<div id='DivCodigo' class="visible d-block" >
		<label for='codForn' class='form-label'>Digite o codigo do fornecedor</label>
		<input type='number' name='codForn' id='codForn' class='form-control' placeholder='Exemplo: 123' />
	</div>

	<div id='DivName' class="invisible d-none">
		<label for='nomeForn' class='form-label'>Digite o nome do fornecedor</label>
		<input type='text' name='nomeForn' id='nomeForn' class='form-control' placeholder='Exemplo: Maria' />
	</div>
	<div id='DivEmail' class="invisible d-none">
		<label for='emailForn' class='form-label'>Digite o E-mail do fornecedor</label>
		<input type='text' name='emailForn' id='emailForn' class='form-control' placeholder='Exemplo: jose_alves@gmail.com' />
	</div>

	<div id='DivFone' class="invisible d-none">
		<label for='foneForn' class='form-label'>Digite o telefone do fornecedor</label>
		<input type='number' name='foneForn' id='foneForn' class='form-control' placeholder='Exemplo: 40028922' />
	</div>

	<div class='col-12 mt-4'>
		<button type='submit' class='btn btn-primary'>Buscar</button>
	</div>

</form>

<?php 
$codForn = isset($fornecedor->codForn) ? $fornecedor->codForn : "";
if($codForn) {
	$nomeForn = isset($fornecedor->nomeForn) ? $fornecedor->nomeForn : "";
	$emailForn = isset($fornecedor->emailForn) ? $fornecedor->emailForn : "";
	$foneForn = isset($fornecedor->foneForn) ? $fornecedor->foneForn : "";
?>
<div class='mt-5 rounded border border-success p-4'>
<h2>Resultado:</h2>
<table class='table mt-3'>
	<thead>
		<th>Código</th>
		<th>Nome</th>
		<th>Email</th>
		<th>Telefone</th>
		<th>Alterar</th>
		<th>Excluir</th>
	</thead>
	<tbody>

		<tr>
			<td> <?php echo ($fornecedor->codForn) ?> </td>
			<td> <?php echo ($fornecedor->nomeForn) ?> </td>
			<td> <?php echo ($fornecedor->emailForn) ?> </td>
			<td> <?php echo ($fornecedor->foneForn) ?> </td>
			<td>
				<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarFornModal" 
				codigo="<?php echo ($codForn); ?>"
				email='<?php echo ($emailForn) ?>'
				nome='<?php echo ($nomeForn); ?>'
				telefone='<?php echo ($foneForn); ?>'>
					Alterar
				</button>
			</td>
			<td>
				<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarFornModal" codigo="<?php echo ($codForn); ?>" nome='<?php echo ($nomeForn) ?>'>Deletar</button>
			</td>
		</tr>

	</tbody>
</table>
</div>
<?php } else if(isset($fornecedor) && count($fornecedor) > 0) { ?>
<div class='mt-5 rounded border border-success p-4'>
	<h2>Resultado:</h2>
	<table class='table'>
		<thead>
			<th>Código</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Telefone</th>
			<th>Alterar</th>
			<th>Excluir</th>
		</thead>
		<tbody>
			<?php foreach ($fornecedor as $forn) : ?>
				<tr>
					<td> <?php echo ($forn->codForn) ?> </td>
					<td> <?php echo ($forn->nomeForn) ?> </td>
					<td> <?php echo ($forn->emailForn) ?> </td>
					<td> <?php echo ($forn->foneForn) ?> </td>
					<td>
						<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarFornModal" 
						codigo="<?php echo ($forn->codForn); ?>" 
						nome='<?php echo ($forn->nomeForn); ?>'
						email='<?php echo ($forn->emailForn); ?>'
						telefone='<?php echo ($forn->foneForn); ?>'>
							Alterar
						</button>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarFornModal" codigo="<?php echo ($forn->codForn); ?>" nome='<?php echo ($forn->nomeForn) ?>'>Deletar</button>
					</td>

				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?php } ?>



<div class="modal fade" id="alterarFornModal" tabindex="-1" aria-labelledby="alterarFornModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="alterarFornModal">Alterar Fornecedor</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<input type="hidden" name="codFornAlterar" class="codigo form-control" id="codForn" readonly>
					<input type="hidden" name="codForn" class="codigo2 form-control" id="codForn" readonly>
					<div class="mb-3">
						<label for="nome" class="col-form-label">Nome:</label>
						<input type="text" name="nomeForn" class="nome form-control" id="nome">
					</div>
					<div class="mb-3">
						<label for="email" class="col-form-label">Email:</label>
						<input type="text" name="emailForn" class="email form-control" id="email">
					</div>
					<div class="mb-3">
						<label for="telefone" class="col-form-label">Telefone:</label>
						<input type="text" name="foneForn" class="telefone form-control" id="telefone">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Alterar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="deletarFornModal" tabindex="-1" aria-labelledby="deletarFornModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deletarFornModal">Tem certeza que quer deletar o fornecedor?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-footer">
					<input type="hidden" name='codFornDel' class="codigo">
					<button type="submit" class="btn btn-danger">Sim</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	var alterarFornModal = document.getElementById('alterarFornModal')
	alterarFornModal.addEventListener('show.bs.modal', function(event) {

		var button = event.relatedTarget
		var codigo = button.getAttribute('codigo')
		var nome = button.getAttribute('nome')
		var email = button.getAttribute('email')
		var telefone = button.getAttribute('telefone')


		var Codigo = alterarFornModal.querySelector('.modal-body .codigo')
		Codigo.value = codigo

		Codigo = alterarFornModal.querySelector('.modal-body .codigo2')
		Codigo.value = codigo

		var Nome = alterarFornModal.querySelector('.modal-body .nome')
		Nome.value = nome

		var Email = alterarFornModal.querySelector('.modal-body .email')
		Email.value = email

		var Telefone = alterarFornModal.querySelector('.modal-body .telefone')
		Telefone.value = telefone
	})

	var deletarFornModal = document.getElementById('deletarFornModal')
	deletarFornModal.addEventListener('show.bs.modal', function(event) {
		var button = event.relatedTarget;
		var codigo = button.getAttribute('codigo');
		var nome = button.getAttribute('nome');

		var modalTitle = deletarFornModal.querySelector('.modal-title');
		modalTitle.textContent = 'Tem certeza que deseja excluir o fornecedor ' + nome + '?';
	
		var Codigo = deletarFornModal.querySelector('.modal-footer .codigo');
		Codigo.value = codigo;
	})

	function getChecked() {
		var DivId = [ 
			'DivCodigo', // 0
			'DivName',  // 1
			'DivEmail',  // 2
			'DivFone'	// 3
		] 

		var docuID
		var selectedID = document.querySelector('input[name = "searchMode"]:checked');
		for(var i = 0; i < DivId.length; i++) {
			docuID = document.getElementById(DivId[i])
			if(selectedID.value == (i+1))  {
				docuID.style.display = "block";
				docuID.className = "visible d-block";
			}
			else {
				docuID.style.display = "none";
				docuID.className = "invisible d-none";
			}
		}
	}

	getChecked();
</script>