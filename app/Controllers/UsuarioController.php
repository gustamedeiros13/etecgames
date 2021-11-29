<?php

namespace App\Controllers;

class UsuarioController extends BaseController {
	public function index()
	{
		echo view('header');
		echo view('cadUsuario');
		echo view('footer');
	}

	public function inserirUsuario()
	{
		$request = service('request');

		if($request -> getMethod() === 'post') {
			$UsuarioModelo = new \App\Models\UsuarioModel();
			$UsuarioModelo->set('emailUsu', $request->getPost('emailusu'));
			$opcao = ['cost' => 8];
			$senhacrip = password_hash($request->getPost('senhausu'), PASSWORD_BCRYPT, $opcao);

			$UsuarioModelo->set('SenhaUsu', $senhacrip);

			if($UsuarioModelo->insert()) {
				$data['msg'] = 'Informações cadastradas com sucesso';
				$data['cor'] = 'alert-success';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
					<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
				</svg>";
				
			}
			else {
				$data['msg'] = 'Falha ao cadastrar as Informações';
				$data['cor'] = 'alert-danger';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
				
			}
		}
		if(isset($data))
			echo view('header', $data);
		else 
			echo view('header');
			
		echo view('cadUsuario');
		echo view('footer');
	}
	public function todosUsuarios() {
		$request = service('request');
		$codusuario = $request->getPost('codUsu');
		$codUsuAlterar = $request->getPost('codUsuAlterar');
		
		//$codUsuBusca = $request->getPost('codUsuBusca');
		//$codusu_FK = $request->getPost('codusu_FK');

		//$alterando = $request->getGet('alterar');
		//$excluindo = $request->getGet('delete');

		if($codusuario) {
			$this->deletarUsuario($codusuario, 0);
			//return redirect()->to(base_url('UsuarioController/todosUsuarios'));
		}
		else if($codUsuAlterar) {
			$this->alterarUsuario($codUsuAlterar, 0);
			//return redirect()->to(base_url('UsuarioController/todosUsuarios'));
		}
		/*else if($codUsuBusca || $codusu_FK) {
			$FuncControler = new \App\Controllers\FuncionarioController();
			
			//url_title('FuncionarioController/inserirFuncionario');
			//url_to('FuncionarioController/inserirFuncionario');
			return $FuncControler->inserirFuncionario();
			//return redirect()->to(base_url('FuncionarioController/inserirFuncionario'));
		}*/

		/*else if($alterando) {
			if($alterando == 1) {
				$data['msg'] = "Usuario alterado com sucesso";
				$data['cor'] = 'alert-success';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
					<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
				</svg>";
			}
			else {
				$data['msg'] = "Houve uma falha ao alterar o usuario";
				$data['cor'] = 'alert-danger';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
			}
		}
		else if($excluindo) 
		{
			if($excluindo == 1) {
				$data['msg'] = "Usuario excluido com sucesso";
				$data['cor'] = 'alert-success';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
					<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
				</svg>";
			}
			else {
				$data['msg'] = "Houve uma falha ao excluir o usuario";
				$data['cor'] = 'alert-danger';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
			}
		}*/

		$UsuarioModel = new \App\Models\UsuarioModel();
		$registros = $UsuarioModel -> find();
		$data['usuarios'] = $registros;

		echo view('header');
		echo view('listaUsuario', $data);
		echo view('footer');
	}
	public function buscaUsuario() {
		$request = service('request');
		$codusuario = $request->getPost('codUsu');
		$codUsuDel = $request->getPost('codUsuDel');
		$codUsuAlterar = $request->getPost('codUsuAlterar');
		$searchMode = $request->getPost('searchMode');
		$emailUsu = $request->getPost('emailUsu');

		//$alterando = $request->getPost('alterar');
		//$excluindo = $request->getPost('delete');

		if($codUsuDel) {
			$this->deletarUsuario($codUsuDel, 1);
			//return redirect()->to(base_url('UsuarioController/listaCodUsuario'));
		}
		else if($codUsuAlterar) {
			$this->alterarUsuario($codUsuAlterar, 1);
			//return redirect()->to(base_url('UsuarioController/listaCodUsuario'));
		}
		/*else if($alterando) {
			if($alterando == 1) {
				$data['msg'] = "Usuario alterado com sucesso";
				$data['cor'] = 'alert-success';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
					<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
				</svg>";
			}
			else {
				$data['msg'] = "Houve uma falha ao alterar o usuario";
				$data['cor'] = 'alert-danger';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
			}
		}
		else if($excluindo) 
		{
			if($excluindo == 1) {
				$data['msg'] = "Usuario excluido com sucesso";
				$data['cor'] = 'alert-success';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
					<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
				</svg>";
			}
			else {
				$data['msg'] = "Houve uma falha ao excluir o usuario";
				$data['cor'] = 'alert-danger';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
			}
		}*/

		if($searchMode == null) {
			echo view('header');
			echo view('buscaUsu');
			echo view('footer');
			return; 
		}

		$UsuarioModel = new \App\Models\UsuarioModel();

		if($searchMode == 2) // E-mail
			$registros = $UsuarioModel->Like('emailUsu', $emailUsu)->findAll();
		else // Codigo
			$registros = $UsuarioModel->find($codusuario);

		$data['searchModeRd'] = $searchMode;

		$qtdEncontrado = count((array)$registros);

		if($qtdEncontrado <= 0) {
			$data['msg'] = 'Usuário não encontrado';
			$data['cor'] = 'alert-warning';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
				<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
			</svg>";
		}
		else {
			$data['msg'] = "Foram encontrado(s) " . (($searchMode == 1 || $qtdEncontrado == 1) ? "1 usuário com sucesso!" : ($qtdEncontrado . " usuários com sucesso!")) ;
			$data['cor'] = 'alert-success';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
				<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
			</svg>";
		}


		$data['usuario'] = $registros;
		$data['searchModeRd'] = $searchMode;

		echo view('header', $data);
		echo view('buscaUsu', $data);
		echo view('footer');

		
	}
	public function alterarUsuario($codUsuAlterar=null, $page=null) {

		if($page == 1)
			$pageName = 'UsuarioController/listaCodUsuario';
		else
			$pageName = 'UsuarioController/todosUsuarios';

		if(is_null($codUsuAlterar)) {
			return redirect()->to(base_url($pageName));
		}
		$request = service('request');
		$emailUsu = $request->getPost('emailUsu');

		$UsuarioModel = new \App\Models\UsuarioModel();
		$registros = $UsuarioModel->find($codUsuAlterar);
	
		if($codUsuAlterar) {
			$registros->emailUsu = $emailUsu;

			$getSenha = $request->getPost('senhaUsu');
			if(isset($getSenha) && $getSenha != null) {
				$opcao = ['cost' => 8];
				$senhaUsu = password_hash($getSenha, PASSWORD_BCRYPT, $opcao);
				$registros->SenhaUsu = $senhaUsu;
			}

			if($UsuarioModel->update($codUsuAlterar, $registros)) {
				return redirect()->to(base_url($pageName . "?alterar=1"), 1, 'get');
			} else {
				return redirect()->to(base_url($pageName . "/?alterar=2"));
			}
		}
	}

	public function deletarUsuario($codusuario=null, $page=null) {
		if($page == 1)
			$pageName = 'UsuarioController/listaCodUsuario';
		else
			$pageName = 'UsuarioController/todosUsuarios';

		if(is_null($codusuario)) {
			return redirect()->to(base_url($pageName));
		}

		$UsuarioModel = new \App\Models\UsuarioModel();
		if($UsuarioModel->delete($codusuario)) {
			return redirect()->to(base_url($pageName . "/?delete=1"));
		} else {
			return redirect()->to(base_url($pageName . "/?delete=2"));
		}
	}

}

?>