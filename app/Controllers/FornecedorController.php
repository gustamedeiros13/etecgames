<?php
namespace App\Controllers;

class FornecedorController extends BaseController {
	public function index()
	{
		echo view('header');
		echo view('cadFornecedor');
		echo view('footer');
	}

	public function inserirFornecedor()
	{
		$request = service('request');
		if($request -> getMethod() === 'post') {
			$FornecedorModelo = new \App\Models\FornecedorModel();

			$FornecedorModelo->set('nomeForn', $request->getPost('nomeForn'));
			$FornecedorModelo->set('emailForn', $request->getPost('emailForn'));
			$FornecedorModelo->set('foneForn', $request->getPost('foneForn'));

			if($FornecedorModelo->insert()) {
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

		echo view('cadForn');
		echo view('footer');
	}
	public function todosFornecedores() {
		$request = service('request');
		$codFornecedor = $request->getPost('codForn');
		$codFornAlterar = $request->getPost('codFornAlterar');
		if($codFornecedor) {
			$this->deletarFornecedor($codFornecedor, 0);
		}
		else if($codFornAlterar) {
			$this->alterarFornecedor($codFornAlterar, 0);
		}

		$FornecedorModel = new \App\Models\FornecedorModel();
		$registros = $FornecedorModel -> find();
		$data['fornecedores'] = $registros;

		echo view('header', $data);
		echo view('listaForn', $data);
		echo view('footer');
	}
	public function buscaFornecedor() {
		$request = service('request');
		$codFornecedor = $request->getPost('codForn');
		$nomeForn = $request->getPost('nomeForn');
		$emailForn = $request->getPost('emailForn');
		$foneForn = $request->getPost('foneForn');
		$codFornDel = $request->getPost('codFornDel');
		$codFornAlterar = $request->getPost('codFornAlterar');
		$searchMode = $request->getPost('searchMode');

		if($codFornDel) {
			$this->deletarFornecedor($codFornDel, 1);
		}
		else if($codFornAlterar) {
			$this->alterarFornecedor($codFornAlterar, 1);
		}
		if($searchMode == null) {
			echo view('header');
			echo view('buscaForn');
			echo view('footer');
			return; 
		}

		$FornecedorModel = new \App\Models\FornecedorModel();
		switch($searchMode) {
			case 2: // Nome
				$registros = $FornecedorModel->Like('nomeForn', $nomeForn)->findAll();
				break;
			case 3: // E-mail
				$registros = $FornecedorModel->Like('emailForn', $emailForn)->findAll();
				break;
			case 4: // Telefone
				$registros = $FornecedorModel->Like('foneForn', $foneForn)->findAll();
				break;
			default: // Codigo
				$registros = $FornecedorModel->find($codFornecedor);
				break;
		}

		$data['fornecedor'] = $registros;
		$data['searchModeRd'] = $searchMode;

		$qtdEncontrado = count((array)$registros);

		if($qtdEncontrado <= 0) {
			$data['msg'] = 'Fornecedor não encontrado';
			$data['cor'] = 'alert-warning';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
				<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
			</svg>";
		}
		else {
			$data['msg'] = "Foram encontrado(s) " . (($searchMode == 1 || $qtdEncontrado == 1) ? "1 Fornecedor com sucesso!" : ($qtdEncontrado . " Fornecedores com sucesso!")) ;
			$data['cor'] = 'alert-success';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
				<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
			</svg>";
		}

		echo view('header', $data);
		echo view('buscaForn', $data);
		echo view('footer');		
	}
	public function alterarFornecedor($codFornAlterar=null, $page=null) {

		if($page == 1)
			$pageName = 'FornecedorController/listaCodFornecedor';
		else
			$pageName = 'FornecedorController/todosFornecedores';

		if(is_null($codFornAlterar)) {
			return redirect()->to(base_url($pageName));
		}
		$request = service('request');
		$nomeForn = $request->getPost('nomeForn');
		$emailForn = $request->getPost('emailForn');
		$foneForn = $request->getPost('foneForn');

		$FornecedorModel = new \App\Models\FornecedorModel();
		$registros = $FornecedorModel->find($codFornAlterar);
	
		if($codFornAlterar) {
			$registros->nomeForn = $nomeForn;
			$registros->emailForn = $emailForn;
			$registros->foneForn = $foneForn;

			if($FornecedorModel->update($codFornAlterar, $registros)) {
				return redirect()->to(base_url($pageName));
			} else {
				return redirect()->to(base_url($pageName));
			}
		}
	}

	public function deletarFornecedor($codFornecedor=null, $page=null) {
		if($page == 1)
			$pageName = 'FornecedorController/listaCodFornecedor';
		else
			$pageName = 'FornecedorController/todosFornecedores';

		if(is_null($codFornecedor)) {
			return redirect()->to(base_url($pageName));
		}

		$FornecedorModel = new \App\Models\FornecedorModel();
		if($FornecedorModel->delete($codFornecedor)) {
			return redirect()->to(base_url($pageName));
		} else {
			return redirect()->to(base_url($pageName));
		}
	}

}

?>