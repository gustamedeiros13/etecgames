<table class='table'>
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Alterar</th>
        <th>Excluir</th>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td> <?php echo ($categoria->codcatjogo) ?> </td>
                <td> <?php echo ($categoria->nomeCatjogo) ?> </td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterarCatModal" codigo="<?php echo ($categoria->codcatjogo); ?>" nome='<?php echo ($categoria->nomeCatjogo) ?>'>Alterar</button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletarCatModal" codigo="<?php echo ($categoria->codcatjogo); ?>" nome='<?php echo ($categoria->nomeCatjogo) ?>'>Deletar</button>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div class="modal fade" id="alterarCatModal" tabindex="-1" aria-labelledby="alterarCatModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="alterarCatModal">Alterar Categoria</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="codCatAlterar" class="codigo form-control" id="codcatjogo" readonly>
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
                <h5 class="modal-title" id="deletarCatModal">Tem certeza que quer deletar o categoria?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-footer">
                    <input type="hidden" name='codcatjogo' class="codigo">
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

        var Nome = alterarCatModal.querySelector('.modal-body .nome')
        Nome.value = nome
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
        modalTitle.textContent = 'Tem certeza que deseja excluir o categoria ' + nome + '?';
    
        var Codigo = deletarCatModal.querySelector('.modal-footer .codigo');
        Codigo.value = codigo;

        //var Nome = alterarCatModal.querySelector('.modal-header .nome');
        //Nome.value = nome;
    })
</script>