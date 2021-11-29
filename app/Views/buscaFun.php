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
				<input class="form-check-input" type="radio" name="searchMode" id="Fone" <?php if($searchModeCk == 3) echo 'checked';?> value="3" onclick="getChecked();">
				<label class="form-check-label" for="Fone">Telefone</label>
			</div>
		</div>
	</fieldset>

	<div id='DivCodigo' class="visible d-block" >
		<label for='codFun' class='form-label'>Digite o codigo do funcionário</label>
		<input type='number' name='codFun' id='codFun' class='form-control' placeholder='Exemplo: 123' />
	</div>

	<div id='DivName' class="invisible d-none">
		<label for='nomeFun' class='form-label'>Digite o nome do funcionário</label>
		<input type='text' name='nomeFun' id='nomeFun' class='form-control' placeholder='Exemplo: Maria' />
	</div>

	<div id='DivFone' class="invisible d-none">
		<label for='foneFun' class='form-label'>Digite o telefone do funcionário</label>
		<input type='number' name='foneFun' id='foneFun' class='form-control' placeholder='Exemplo: 40028922' />
	</div>

	<div class='col-12 mt-4'>
		<button type='submit' class='btn btn-primary'>Buscar</button>
	</div>

	
</form>

<?php
$codFun = isset($funcionarios->codFun) ? $funcionarios->codFun : "";

if ($codFun) {
	$nomeFun = isset($funcionarios->nomeFun) ? $funcionarios->nomeFun : "";
	$foneFun = isset($funcionarios->foneFun) ? $funcionarios->foneFun : "";
?>
	<div class='mt-5 rounded border border-success p-4'>
		<h2>Resultado:</h2>
		<table class='table mt-3'>
			<thead>
				<th>Código</th>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Alterar</th>
				<th>Excluir</th>
			</thead>
			<tbody>

				<tr>
					<td> <?php echo ($funcionarios->codFun) ?> </td>
					<td> <?php echo ($funcionarios->nomeFun) ?> </td>
					<td> <?php echo ($funcionarios->foneFun) ?> </td>
					<td>
						<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarFunModal" codigo="<?php echo ($codFun); ?>" nome='<?php echo ($nomeFun); ?>' telefone='<?php echo ($foneFun); ?>'>
							Alterar
						</button>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarFunModal" codigo="<?php echo ($codFun); ?>" nome='<?php echo ($nomeFun) ?>'>Deletar</button>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
<?php } else if(isset($funcionarios) && count($funcionarios) > 0) {
	?>
	<div class='mt-5 rounded border border-success p-4'>
		<h2>Resultado:</h2>
		<table class='table mt-3'>
			<thead>
				<th>Código</th>
				<th>Nome</th>
				<th>Telefone</th>
				<th>Alterar</th>
				<th>Excluir</th>
			</thead>
			<tbody>

			<?php foreach ($funcionarios as $func) : ?>
				<tr>
					<td> <?php echo ($func->codFun) ?> </td>
					<td> <?php echo ($func->nomeFun) ?> </td>
					<td> <?php echo ($func->foneFun) ?> </td>
					<td>
						<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarFunModal" 
						codigo="<?php echo ($func->codFun); ?>" 
						nome='<?php echo ($func->nomeFun); ?>'
						telefone='<?php echo ($func->foneFun); ?>'>
							Alterar
						</button>
					</td>
					<td>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarFunModal" codigo="<?php echo ($func->codFun); ?>" nome='<?php echo ($func->nomeFun) ?>'>Deletar</button>
					</td>

				</tr>
			<?php endforeach; ?>

			</tbody>
		</table>
	</div>
<?php } ?>

<div class="modal fade" id="alterarFunModal" tabindex="-1" aria-labelledby="alterarFunModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="alterarFunModal">Alterar Funcionario</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-body">
					<input type="hidden" name="codFunAlterar" class="codigo form-control" id="codFun" readonly>
					<input type="hidden" name="codFun" class="codigo2 form-control" id="codFun" readonly>
					<div class="mb-3">
						<label for="nome" class="col-form-label">Nome:</label>
						<input type="text" name="nomeFun" class="nome form-control" id="nome">
					</div>
					<div class="mb-3">
						<label for="telefone" class="col-form-label">Telefone:</label>
						<input type="text" name="foneFun" class="telefone form-control" id="telefone">
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

<div class="modal fade" id="deletarFunModal" tabindex="-1" aria-labelledby="deletarFunModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deletarFunModal">Tem certeza que quer deletar o funcionario?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST">
				<div class="modal-footer">
					<input type="hidden" name='codFunDel' class="codigo">
					<button type="submit" class="btn btn-danger">Sim</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	var alterarFunModal = document.getElementById('alterarFunModal')
	alterarFunModal.addEventListener('show.bs.modal', function(event) {

		var button = event.relatedTarget
		var codigo = button.getAttribute('codigo')
		var nome = button.getAttribute('nome')
		var telefone = button.getAttribute('telefone')


		var Codigo = alterarFunModal.querySelector('.modal-body .codigo')
		Codigo.value = codigo

		Codigo = alterarFunModal.querySelector('.modal-body .codigo2')
		Codigo.value = codigo

		var Nome = alterarFunModal.querySelector('.modal-body .nome')
		Nome.value = nome

		var Telefone = alterarFunModal.querySelector('.modal-body .telefone')
		Telefone.value = telefone
	})

	var deletarFunModal = document.getElementById('deletarFunModal')
	deletarFunModal.addEventListener('show.bs.modal', function(event) {
		var button = event.relatedTarget;
		var codigo = button.getAttribute('codigo');
		var nome = button.getAttribute('nome');

		var modalTitle = deletarFunModal.querySelector('.modal-title');
		modalTitle.textContent = 'Tem certeza que deseja excluir o funcionario ' + nome + '?';

		var Codigo = deletarFunModal.querySelector('.modal-footer .codigo');
		Codigo.value = codigo;
	})

	function getChecked() {
		var DivId = [ 
			'DivCodigo', // 0
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