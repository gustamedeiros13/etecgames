<?php
$searchModeCk = isset($searchModeRd) ? $searchModeRd : 1;
?>

<form method="post" class='border border-primary rounded p-4'>
	<fieldset class="row mb-3">
		<legend class="col-form-label col-sm-3 pt-0">Escolha a informação desejada:</legend>
		<div class="col-sm-6">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="CPF" <?php if($searchModeCk == 1) echo 'checked';?> value="1" onclick="getChecked();">
				<label class="form-check-label" for="CPF">CPF</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="Nome" <?php if($searchModeCk == 2) echo 'checked';?> value="2" onclick="getChecked();">
				<label class="form-check-label" for="Nome">Nome</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="searchMode" id="Fone" <?php if($searchModeCk == 3) echo 'checked';?> value="3" onclick="getChecked();">
				<label class="form-check-label" for="Fone">Telefone</label>
			</div>
		</div>
	</fieldset>

	<div id='DivCPF' class="visible d-block" >
		<label for='CpfCli' class='form-label'>Digite o cpf do cliente</label>
		<input type='number' name='CpfCli' id='CpfCli' class='form-control' placeholder='Exemplo: 23024788890' />
	</div>

	<div id='DivName' class="invisible d-none">
		<label for='nomeCli' class='form-label'>Digite o nome do cliente</label>
		<input type='text' name='nomeCli' id='nomeCli' class='form-control' placeholder='Exemplo: Maria' />
	</div>

	<div id='DivFone' class="invisible d-none">
		<label for='foneCli' class='form-label'>Digite o telefone do cliente</label>
		<input type='number' name='foneCli' id='foneCli' class='form-control' placeholder='Exemplo: 40028922' />
	</div>

	<div class='col-12 mt-4'>
		<button type='submit' class='btn btn-primary'>Buscar</button>
	</div>

	
</form>

<?php
$CpfCli = isset($clientes->CpfCli) ? $clientes->CpfCli : "";

if ($CpfCli) {
	$nomeCli = isset($clientes->nomeCli) ? $clientes->nomeCli : "";
	$foneCli = isset($clientes->foneCli) ? $clientes->foneCli : "";
?>
	<div class='mt-5 rounded border border-success p-4'>
		<h2>Resultado:</h2>
		<table class='table mt-3'>
			<thead>
				<th>CPF</th>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Alterar</th>
				<th>Excluir</th>
			</thead>
			<tbody>

				<tr>
					<td> <?php echo ($clientes->CpfCli) ?> </td>
					<td> <?php echo ($clientes->nomeCli) ?> </td>
					<td> <?php echo ($clientes->foneCli) ?> </td>
					<td>
						<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarCliModal" cpf="<?php echo ($CpfCli); ?>" nome='<?php echo ($nomeCli); ?>' telefone='<?php echo ($foneCli); ?>'>
							Alterar
						</button>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarCliModal" cpf="<?php echo ($CpfCli); ?>" nome='<?php echo ($nomeCli) ?>'>Deletar</button>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
<?php } else if(isset($clientes) && count($clientes) > 0) {
	?>
	<div class='mt-5 rounded border border-success p-4'>
		<h2>Resultado:</h2>
		<table class='table mt-3'>
			<thead>
				<th>CPF</th>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Alterar</th>
				<th>Excluir</th>
			</thead>
			<tbody>

			<?php foreach ($clientes as $cli) : ?>
				<tr>
					<td> <?php echo ($cli->CpfCli) ?> </td>
					<td> <?php echo ($cli->nomeCli) ?> </td>
					<td> <?php echo ($cli->foneCli) ?> </td>
					<td>
						<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarCliModal" 
						cpf="<?php echo ($cli->CpfCli); ?>" 
						nome='<?php echo ($cli->nomeCli); ?>'
						telefone='<?php echo ($cli->foneCli); ?>'>
							Alterar
						</button>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarCliModal" cpf="<?php echo ($cli->CpfCli); ?>" nome='<?php echo ($cli->nomeCli) ?>'>Deletar</button>
					</td>

				</tr>
			<?php endforeach; ?>

			</tbody>
		</table>
	</div>
<?php } ?>

<div class="modal fade" id="alterarCliModal" tabindex="-1" aria-labelledby="alterarCliModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="alterarCliModal">Alterar cliente</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<input type="hidden" name="CpfCliAlterar" class="cpf form-control" id="CpfCli" readonly>
					<input type="hidden" name="CpfCli" class="cpf2 form-control" id="CpfCli" readonly>
					<div class="mb-3">
						<label for="nome" class="col-form-label">Nome:</label>
						<input type="text" name="nomeCli" class="nome form-control" id="nome">
					</div>
					<div class="mb-3">
						<label for="telefone" class="col-form-label">Telefone:</label>
						<input type="text" name="foneCli" class="telefone form-control" id="telefone">
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

<div class="modal fade" id="deletarCliModal" tabindex="-1" aria-labelledby="deletarCliModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deletarCliModal">Tem certeza que quer deletar o cliente?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-footer">
					<input type="hidden" name='CpfCliDel' class="cpf">
					<button type="submit" class="btn btn-danger">Sim</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	var alterarCliModal = document.getElementById('alterarCliModal')
	alterarCliModal.addEventListener('show.bs.modal', function(event) {

		var button = event.relatedTarget
		var cpf = button.getAttribute('cpf')
		var nome = button.getAttribute('nome')
		var telefone = button.getAttribute('telefone')


		var Cpf = alterarCliModal.querySelector('.modal-body .cpf')
		Cpf.value = cpf

		Cpf = alterarCliModal.querySelector('.modal-body .cpf2')
		Cpf.value = cpf

		var Nome = alterarCliModal.querySelector('.modal-body .nome')
		Nome.value = nome

		var Telefone = alterarCliModal.querySelector('.modal-body .telefone')
		Telefone.value = telefone
	})

	var deletarCliModal = document.getElementById('deletarCliModal')
	deletarCliModal.addEventListener('show.bs.modal', function(event) {
		var button = event.relatedTarget;
		var cpf = button.getAttribute('cpf');
		var nome = button.getAttribute('nome');

		var modalTitle = deletarCliModal.querySelector('.modal-title');
		modalTitle.textContent = 'Tem certeza que deseja excluir o cliente ' + nome + '?';

		var Cpf = deletarCliModal.querySelector('.modal-footer .cpf');
		Cpf.value = cpf;
	})

	function getChecked() {
		var DivId = [ 
			'DivCPF', // 0
			'DivName',  // 1
			'DivFone'	// 2
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