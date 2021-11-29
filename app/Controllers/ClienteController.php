<?php
namespace App\Controllers;

class ClienteController extends BaseController {
	public function index()
	{
		return redirect()->to(base_url("ClienteController/inserirCliente"));
	}

	public function inserirCliente()
	{
		$request = service('request');
		$ClienteModelo = new \App\Models\ClienteModel();
		$UsuarioModel = new \App\Models\UsuarioModel();
		if($request -> getMethod() === 'post') 
		{			
			$codusuario = $request->getPost('codUsuBusca');
			$registros = $UsuarioModel->find($codusuario);
	
			if(!isset($registros->codusu) && $codusuario!=null) {
				$data['msg'] = 'Usuario não encontrado';
				$data['cor'] = 'alert-warning';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
			}
			elseif ($codusuario==null) {
				$ClienteModelo->set('codusu_FK', $request->getPost('codusu_FK'));
				$ClienteModelo->set('CpfCli', $request->getPost('CpfCli'));
				$ClienteModelo->set('nomeCli', $request->getPost('nomeCli'));
				$ClienteModelo->set('foneCli', $request->getPost('foneCli'));
				

				if($ClienteModelo->insert()) {
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
			else {
				$data['usuario'] = $registros;
			}
			
		}

		if(isset($data)) {
			echo view('header', $data);
			echo view('cadCli', $data);
		}
		else {
			echo view('header');
			echo view('cadCli');
		}

		echo view('footer');
	}
	public function todosClientes() {
		$request = service('request');
		$CpfCli = $request->getPost('CpfCli');
		$CpfCliAlterar = $request->getPost('CpfCliAlterar');
		if($CpfCli) {
			$this->deletarCliente($CpfCli, 0);
		}
		else if($CpfCliAlterar) {
			$this->alterarCliente($CpfCliAlterar, 0);
		}

		$ClienteModel = new \App\Models\ClienteModel();
		$registros = $ClienteModel -> find();
		$data['clientes'] = $registros;

		echo view('header', $data);
		echo view('listaCli', $data);
		echo view('footer');
	}
	public function buscaCliente() {
		$request = service('request');
		$searchMode = $request->getPost('searchMode');
		$CpfCli = $request->getPost('CpfCli');
		$nomeCli = $request->getPost('nomeCli');
		$foneCli = $request->getPost('foneCli');
		$CpfCliDel = $request->getPost('CpfCliDel');
		$CpfCliAlterar = $request->getPost('CpfCliAlterar');

		if($CpfCliDel) {
			$this->deletarCliente($CpfCliDel, 1);
		}
		else if($CpfCliAlterar) {
			$this->alterarCliente($CpfCliAlterar, 1);
		}

		if($searchMode == null) {
			echo view('header');
			echo view('buscaCli');
			echo view('footer');
			return; 
		}

		$ClienteModel = new \App\Models\ClienteModel();

		switch($searchMode) {
			case 2: // Nome
				$registros = $ClienteModel->Like('nomeCli', $nomeCli)->findAll();
				break;
			case 3: // Telefone
				$registros = $ClienteModel->Like('foneCli', $foneCli)->findAll();
				break;
			default: // Cpf
				$registros = $ClienteModel->Like('CpfCli', $CpfCli)->findAll();
				break;
		}


		$data['clientes'] = $registros;
		$data['searchModeRd'] = $searchMode;

		$qtdEncontrado = count((array)$registros);

		if($qtdEncontrado <= 0) {
			$data['msg'] = 'Cliente não encontrado';
			$data['cor'] = 'alert-warning';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
				<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
			</svg>";
		}
		else {
			$data['msg'] = "Foram encontrado(s) " . (($searchMode == 1 || $qtdEncontrado == 1) ? "1 cliente com sucesso!" : ($qtdEncontrado . " clientes com sucesso!")) ;
			$data['cor'] = 'alert-success';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
				<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
			</svg>";
		}

		echo view('header', $data);
		echo view('buscaCli', $data);
		echo view('footer');	
	}
	public function alterarCliente($CpfCliAlterar=null, $page=null) {

		if($page == 1)
			$pageName = 'ClienteController/listaCpfCli';
		else
			$pageName = 'ClienteController/todosClientes';

		if(is_null($CpfCliAlterar)) {
			return redirect()->to(base_url($pageName));
		}
		$request = service('request');
		$nomeCli = $request->getPost('nomeCli');
		$foneCli = $request->getPost('foneCli');

		$ClienteModel = new \App\Models\ClienteModel();
		$registros = $ClienteModel->find($CpfCliAlterar);
	
		if($CpfCliAlterar) {
			$registros->nomeCli = $nomeCli;
			$registros->foneCli = $foneCli;

			if($ClienteModel->update($CpfCliAlterar, $registros)) {
				return redirect()->to(base_url($pageName));
			} else {
				return redirect()->to(base_url($pageName));
			}
		}
	}

	public function deletarCliente($CpfCli=null, $page=null) {
		if($page == 1)
			$pageName = 'ClienteController/listaCpfCli';
		else
			$pageName = 'ClienteController/todosClientes';

		if(is_null($CpfCli)) {
			return redirect()->to(base_url($pageName));
		}

		$ClienteModel = new \App\Models\ClienteModel();
		if($ClienteModel->delete($CpfCli)) {
			return redirect()->to(base_url($pageName));
		} else {
			return redirect()->to(base_url($pageName));
		}
	}

}

?>