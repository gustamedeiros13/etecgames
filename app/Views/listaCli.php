<table class='table'>
	<thead>
		<th>CPF</th>
		<th>Nome</th>
		<th>Telefone</th>
		<th>Alterar</th>
		<th>Excluir</th>
	</thead>
	<tbody>
		<?php foreach ($clientes as $cliente) : ?>
			<tr>
				<td> <?php echo ($cliente->CpfCli) ?> </td>
				<td> <?php echo ($cliente->nomeCli) ?> </td>
				<td> <?php echo ($cliente->foneCli) ?> </td>
				<td>
					<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarCliModal" 
					cpf="<?php echo ($cliente->CpfCli); ?>" 
					nome='<?php echo ($cliente->nomeCli); ?>'
					telefone='<?php echo ($cliente->foneCli); ?>'>
						Alterar
					</button>
				</td>
				<td>
					<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarCliModal" cpf="<?php echo ($cliente->CpfCli); ?>" nome='<?php echo ($cliente->nomeCli) ?>'>Deletar</button>
				</td>

			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<div class="modal fade" id="alterarCliModal" tabindex="-1" aria-labelledby="alterarCliModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="alterarCliModal">Alterar informações do cliente:</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<input type="hidden" name="CpfCliAlterar" class="cpf form-control" id="CpfCliente" readonly>
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
					<input type="hidden" name='CpfCli' class="cpf">
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
</script>