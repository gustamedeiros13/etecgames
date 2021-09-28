<?php

namespace App\Controllers;

class FornecedorController extends BaseController
{

    public function index()
    {
        echo view('header');
        echo view('cadFornecedor');
        echo view('footer');
    }

    public function inserirFornecedor()
    {
        $data['msg'] = '';
        $request = service('request');
        if ($request->getMethod() === 'post') {
            $FornecedorModelo = new \App\Models\FornecedorModel();

            $FornecedorModelo->set('nomeforn', $request->getPost('nomeforn'));
            $FornecedorModelo->set('emailforn', $request->getPost('emailforn'));
            $FornecedorModelo->set('foneforn', $request->getPost('foneforn'));

            if ($FornecedorModelo->insert()) {
                $data['msg'] = "Informações cadastradas com sucesso";
            } else {
                $data['msg'] = "Informações não cadastradas";
            }
        }

        echo view('header');
        echo view('cadFornecedor', $data);
        echo view('footer');
    }

    public function todosFornecedores()
    {
        $FornecedorModel = new \App\Models\FornecedorModel();
        $registros = $FornecedorModel->find();
        $data['fornecedores'] = $registros;

        $request = service('request');
        $codfornecedor = $request->getPost('codForn');
        $codFornAlterar = $request->getPost('codFornAlterar');

        if ($codfornecedor) {
            $this->deletarFornecedor($codfornecedor);
            return redirect()->to(base_url('FornecedorController/todosFornecedores/'));
        }

        if ($codFornAlterar) {
            return $this->alterarFornecedor();
        }
        

        echo view('header');
        echo view('listaFornecedor', $data);
        echo view('footer');
    }

    public function listaCodForn()
    {
        $request = service('request');
        $FornecedorModel = new \App\Models\FornecedorModel();
        $codfornecedor = $request->getPost('codForn');
        $registros = $FornecedorModel->find($codfornecedor);

        $data['fornecedor'] = $registros;

        $codFornAlterar = $request->getPost('codFornAlterar');
        $codFornDel = $request->getPost('codFornDel');


        if ($codFornDel) {
            $this->deletarFornecedor($codFornDel);
            return redirect()->to(base_url('FornecedorController/listaCodFornecedor/'));
        }

        if ($codFornAlterar) {
            return $this->alterarFornecedorCod();
        }

        echo view('header');
        echo view('listaCodForn', $data);
        echo view('footer');
    }

    public function alterarFornecedor()
    {               
        $request = service('request');
        $codFornAlterar = $request->getPost('codFornAlterar');
        $nomeForn = $request->getPost('nomeForn');
        $emailForn = $request->getPost('emailForn');
        $foneForn = $request->getPost('foneForn');

        $FornecedorModel = new \App\Models\FornecedorModel();
        $registros = $FornecedorModel->find($codFornAlterar);          

        if ($nomeForn OR $emailForn OR $foneForn) {
            $registros->nomeforn = $nomeForn;
            $registros->emailforn = $emailForn;
            $registros->foneforn = $foneForn;

            $FornecedorModel->update($codFornAlterar,$registros);

            return redirect()->to(base_url('FornecedorController/todosFornecedores/'));
        }        
        
        $data['fornecedor'] = $registros;

        echo view('header');
        echo view('alterarFormFornecedor', $data);
        echo view('footer');
    }

    public function alterarFornecedorCod()
    {        
        $request = service('request');
        $codFornAlterar = $request->getPost('codFornAlterar');
        $nomeForn = $request->getPost('nomeForn');
        $emailForn = $request->getPost('emailForn');
        $foneForn = $request->getPost('foneForn');
        $FornecedorModel = new \App\Models\FornecedorModel();
        $registros = $FornecedorModel->find($codFornAlterar);  

        if ($nomeForn OR $emailForn OR $foneForn) {
            $registros->nomeforn = $nomeForn;
            $registros->emailforn = $emailForn;
            $registros->foneforn = $foneForn;

            $FornecedorModel->update($codFornAlterar,$registros);

            return redirect()->to(base_url('FornecedorController/listaCodForn/'));
        }   

        $data['fornecedor'] = $registros;

        echo view('header');
        echo view('alterarFormFornecedor', $data);
        echo view('footer');
    }

    public function deletarFornecedor($codfornecedor = null)
    {
        if (is_null($codfornecedor)) {
            return redirect()->to(base_url('FornecedorController/todosFornecedores/'));
        }

        $FornecedorModel = new \App\Models\FornecedorModel();
        if ($FornecedorModel->delete($codfornecedor)) {
            return redirect()->to(base_url('FornecedorController/todosFornecedores/'));
        } else {
            return redirect()->to(base_url('FornecedorController/todosFornecedores/'));
        }
        return redirect()->to(base_url('FornecedorController/todosFornecedores/'));
    }

}