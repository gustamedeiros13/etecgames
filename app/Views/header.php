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
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Funcionário
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="<?php echo base_url('../../FuncionarioController/listaCodFuncionario')?>">Cadastro</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('../../FuncionarioController/listaCodFuncionario')?>">Pesquisar por Código</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('../../FuncionarioController/listaCodFuncionario')?>">Pesquisar por Nome</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Jogos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">Cadastro</a></li>
                  <li><a class="dropdown-item" href="#">Pesquisar</a></li>
                  <li><a class="dropdown-item" href="#">Alterar/Deletar</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Usuários
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="<?php echo base_url('../../../UsuarioController/inserirUsuario') ?>">Cadastro</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('../../UsuarioController/listaCodUsuario') ?>">Pesquisar</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('../../UsuarioController/todosUsuarios') ?>">Alterar/Deletar</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Fornecedor
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="<?php echo base_url('../../FornecedorController/inserirFornecedor') ?>">Cadastro</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('../../FornecedorController/listaCodForn') ?>">Pesquisar</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('../../FornecedorController/todosFornecedores') ?>">Alterar/Deletar</a></li>
                </ul>
              </li>
            </ul>
            <ul>
            </ul>
          </div>
        </div>
      </nav>
    </header>