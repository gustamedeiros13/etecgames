<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>Area Administrativa</title>

  <style>
    body {
      background-color: #f6f6f6;
    }
  </style>


</head>

<body>

  <div class="container">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="">GameEtec</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="<?php echo base_url('./')?>">Home</a>
							</li>

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="nbFun" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Funcionario
								</a>
								<ul class="dropdown-menu" aria-labelledby="nbFun">
								<li><a class="dropdown-item" href="<?php echo base_url('./FuncionarioController/inserirFuncionario')?>">Cadastro</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./FuncionarioController/todosFuncionarios')?>">Lista de Funcionários</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./FuncionarioController/buscaFuncionario')?>">Buscar Funcionário</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="nbCatJogo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Jogos
								</a>
								<ul class="dropdown-menu" aria-labelledby="nbCatJogo">
									<li><a class="dropdown-item" href="<?php echo base_url('./CatJogoController/inserirCatJogo')?>">Cadastrar Categoria</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./CatJogoController/todosCatJogo')?>">Lista de Categorias</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./CatJogoController/buscaCatJogo')?>">Buscar Categorias</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="nbUsu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Usuarios
								</a>
								<ul class="dropdown-menu" aria-labelledby="nbUsu">
									<li><a class="dropdown-item" href="<?php echo base_url('./UsuarioController/inserirUsuario')?>">Cadastro</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./UsuarioController/todosUsuarios')?>">Lista de Usuários</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./UsuarioController/buscaUsuario')?>">Buscar Usuários</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="nbForn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Fornecedor
								</a>
								<ul class="dropdown-menu" aria-labelledby="nbForn">
								<li><a class="dropdown-item" href="<?php echo base_url('./FornecedorController/inserirFornecedor')?>">Cadastro</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./FornecedorController/todosFornecedores')?>">Lista de Fornecedores</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./FornecedorController/buscaFornecedor')?>">Buscar Fornecedores</a></li>
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="nbCli" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Cliente
								</a>
								<ul class="dropdown-menu" aria-labelledby="nbCli">
								<li><a class="dropdown-item" href="<?php echo base_url('./ClienteController/inserirCliente')?>">Cadastro</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./ClienteController/todosClientes')?>">Lista de Clientes</a></li>
									<li><a class="dropdown-item" href="<?php echo base_url('./ClienteController/buscaCliente')?>">Buscar Cliente</a></li>
								</ul>
							</li>

						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class='container mt-4'>
			<?php if(isset($msg) && isset($cor)) : ?>
				<div class='alert <?php echo $cor ?>' role='alert'>
					<?php echo $icon .  $msg ?>
				</div>
			<?php endif;?>