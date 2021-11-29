<?php

namespace App\Controllers;

class CatJogoController extends BaseController {
	public function index()
	{
		echo view('header');
		echo view('cadCatJogo');
		echo view('footer');
	}

	public function inserirCatJogo()
	{
		$request = service('request');

		if($request -> getMethod() === 'post') {
			$CatJogoModelo = new \App\Models\CatJogoModel();
			$CatJogoModelo->set('nomeCatjogo', $request->getPost('nomeCatjogo'));

			if($CatJogoModelo->insert()) {
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
			
		echo view('cadCatJogo');
		echo view('footer');
	}
	public function todosCatJogo() {
		$request = service('request');
		$codcatjogo = $request->getPost('codCat');
		$codCatAlterar = $request->getPost('codCatAlterar');

		if($codcatjogo) {
			$this->deletarCatJogo($codcatjogo, 0);
		}
		else if($codCatAlterar) {
			$this->alterarCatJogo($codCatAlterar, 0);
		}
        $CatJogoModel = new \App\Models\CatJogoModel();
		$registros = $CatJogoModel -> find();
		$data['categorias'] = $registros;

		echo view('header');
		echo view('listaCatJogo', $data);
		echo view('footer');
	}
	public function buscaCatJogo() {
		$request = service('request');
		$codcatjogo = $request->getPost('codcatjogo');
		$codCatDel = $request->getPost('codCatDel');
		$codCatAlterar = $request->getPost('codCatAlterar');
		$searchMode = $request->getPost('searchMode');
		$nomeCatjogo = $request->getPost('nomeCatjogo');

		//$alterando = $request->getPost('alterar');
		//$excluindo = $request->getPost('delete');

		if($codCatDel) {
			$this->deletarCatJogo($codCatDel, 1);
		}
		else if($codCatAlterar) {
			$this->alterarCatJogo($codCatAlterar, 1);
		}
		
		if($searchMode == null) {
			echo view('header');
			echo view('buscaCatJogo');
			echo view('footer');
			return; 
		}

		$CatJogoModel = new \App\Models\CatJogoModel();

		if($searchMode == 2) // Nome da Categoria
			$registros = $CatJogoModel->Like('nomeCatjogo', $nomeCatjogo)->findAll();
		else // Codigo
			$registros = $CatJogoModel->find($codcatjogo);

		$data['searchModeRd'] = $searchMode;

		$qtdEncontrado = count((array)$registros);

		if($qtdEncontrado <= 0) {
			$data['msg'] = 'Categoria não encontrado';
			$data['cor'] = 'alert-warning';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
				<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
			</svg>";
		}
		else {
			$data['msg'] = "Foram encontrado(s) " . (($searchMode == 1 || $qtdEncontrado == 1) ? "1 categoria com sucesso!" : ($qtdEncontrado . " categorias com sucesso!")) ;
			$data['cor'] = 'alert-success';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
				<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
			</svg>";
		}


		$data['categoria'] = $registros;
		$data['searchModeRd'] = $searchMode;

		echo view('header', $data);
		echo view('buscaCatJogo', $data);
		echo view('footer');

		
	}
	public function alterarCatJogo($codCatAlterar=null, $page=null) {

		if($page == 1)
			$pageName = 'CatJogoController/listaCodCatJogo';
		else
			$pageName = 'CatJogoController/todosCatJogos';

		if(is_null($codCatAlterar)) {
			return redirect()->to(base_url($pageName));
		}
		$request = service('request');
		$nomeCatjogo = $request->getPost('nomeCatjogo');

		$CatJogoModel = new \App\Models\CatJogoModel();
		$registros = $CatJogoModel->find($codCatAlterar);
	
		if($codCatAlterar) {
			$registros->nomeCatjogo = $nomeCatjogo;

			if($CatJogoModel->update($codCatAlterar, $registros)) {
				return redirect()->to(base_url($pageName . "?alterar=1"), 1, 'get');
			} else {
				return redirect()->to(base_url($pageName . "/?alterar=2"));
			}
		}
	}

	public function deletarCatJogo($codcatjogo=null, $page=null) {
		if($page == 1)
			$pageName = 'CatJogoController/listaCodCatJogo';
		else
			$pageName = 'CatJogoController/todosCatJogos';

		if(is_null($codcatjogo)) {
			return redirect()->to(base_url($pageName));
		}

		$CatJogoModel = new \App\Models\CatJogoModel();
		if($CatJogoModel->delete($codcatjogo)) {
			return redirect()->to(base_url($pageName . "/?delete=1"));
		} else {
			return redirect()->to(base_url($pageName . "/?delete=2"));
		}
	}

}

?>