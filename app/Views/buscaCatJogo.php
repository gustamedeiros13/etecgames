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
        </div>
    </fieldset>
    <div id='DivCodigo' class="visible d-block">
        <label for='codcatjogo' class='form-label'>Digite o Código da categoria</label>
        <input type='number' name='codcatjogo' id='codcatjogo' class='form-control' placeholder='Exemplo: 123' />
    </div>

    <div id='DivNome' class="invisible d-none">
        <label for='nomeCatjogo' class='form-label'>Digite o nome da categoria</label>
        <input type='text' name='nomeCatjogo' id='nomeCatjogo' class='form-control' placeholder='Exemplo: Ação' />
    </div>

    <div class='col-12 mt-4'>
        <button type='submit' class='btn btn-primary'>Buscar</button>
    </div>

</form>

<?php

$codcatjogo = isset($categoria->codcatjogo) ? $categoria->codcatjogo : "";
if ($codcatjogo) {
    $nomeCatjogo = isset($categoria->nomeCatjogo) ? $categoria->nomeCatjogo : "";
?>
    <div class='mt-5 rounded border border-success p-4'>
        <h2>Resultado:</h2>
        <table class='table mt-3'>
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </thead>
            <tbody>

                <tr>
                    <td> <?php echo ($codcatjogo) ?> </td>
                    <td> <?php echo ($nomeCatjogo) ?> </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarCatModal" codigo="<?php echo ($codcatjogo); ?>" nome='<?php echo ($nomeCatjogo) ?>'>Alterar</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarCatModal" codigo="<?php echo ($codcatjogo); ?>" nome='<?php echo ($nomeCatjogo) ?>'>Deletar</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
<?php } else if (isset($categoria) && count($categoria) > 0) { ?>
    <div class='mt-5 rounded border border-success p-4'>
        <h2>Resultado:</h2>
        <table class='table'>
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </thead>
            <tbody>
                <?php foreach ($categoria as $cat) : ?>
                    <tr>
                        <td> <?php echo ($cat->codcatjogo) ?> </td>
                        <td> <?php echo ($cat->nomeCatjogo) ?> </td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarCatModal" codigo="<?php echo ($cat->codcatjogo); ?>" nome='<?php echo ($cat->nomeCatjogo) ?>'>Alterar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarCatModal" codigo="<?php echo ($cat->codcatjogo); ?>" nome='<?php echo ($cat->nomeCatjogo) ?>'>Deletar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php } ?>


<div class="modal fade" id="alterarCatModal" tabindex="-1" aria-labelledby="alterarCatModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="alterarCatModal">Alterar categoria</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="codCatAlterar" class="codigo form-control" id="codcatjogo" readonly>
                    <input type="hidden" name="codcatjogo" class="codigo2 form-control" id="codcatjogo" readonly>
                    <div class="mb-3">
                        <label for="nome" class="col-form-label">Nome:</label>
                        <input type="text" name="nomeCatjogo" class="nome form-control" id="nome">
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

<div class="modal fade" id="deletarCatModal" tabindex="-1" aria-labelledby="deletarCatModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletarCatModal">Tem certeza que quer deletar a categoria?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-footer">
                    <input type="hidden" name='codCatDel' class="codigo">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var alterarCatModal = document.getElementById('alterarCatModal')
    alterarCatModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var codigo = button.getAttribute('codigo')

        var nome = button.getAttribute('nome')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.

        var Codigo = alterarCatModal.querySelector('.modal-body .codigo')
        Codigo.value = codigo

        var Codigo2 = alterarCatModal.querySelector('.modal-body .codigo2')
        Codigo2.value = codigo

        var nome = alterarCatModal.querySelector('.modal-body .nome')
        nome.value = nome
    })

    var deletarCatModal = document.getElementById('deletarCatModal')
    deletarCatModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        var codigo = button.getAttribute('codigo');
        var nome = button.getAttribute('nome');
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.

        var modalTitle = deletarCatModal.querySelector('.modal-title');
        modalTitle.textContent = 'Tem certeza que deseja excluir a categoria ' + nome + '?';

        var Codigo = deletarCatModal.querySelector('.modal-footer .codigo');
        Codigo.value = codigo;

        //var Nome = alterarCatModal.querySelector('.modal-header .nome');
        //Nome.value = nome;
    })

    function getChecked() {
        var DivId = [
            'DivCodigo', // 0
            'DivNome' // 1
        ]

        var docuID
        var selectedID = document.querySelector('input[name = "searchMode"]:checked');
        for (var i = 0; i < DivId.length; i++) {
            docuID = document.getElementById(DivId[i])
            if (selectedID.value == (i + 1)) {
                docuID.style.display = "block";
                docuID.className = "visible d-block";
            } else {
                docuID.style.display = "none";
                docuID.className = "invisible d-none";
            }
        }
    }
    getChecked();

</script>