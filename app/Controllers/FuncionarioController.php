<?php

namespace App\Controllers;

class FuncionarioController extends BaseController
{
public function index()
    {
        echo view('header');
        echo view('cadFuncionario');
        echo view('footer');
    }
    public function inserirFuncionario()
    {
        $data['msg'] = '';

        $request = service('request');
        
        if ($request->getMethod() === 'post') {
            $FuncionarioModelo = new \App\Models\FuncionarioModel();

            $FuncionarioModelo->set('codusu_FK', $request->getPost('codUsu'));
            $FuncionarioModelo->set('nomeFun', $request->getPost('nomeFun'));
            $FuncionarioModelo->set('foneFun', $request->getPost('foneFun'));

            if ($FuncionarioModelo->insert()) {
                $data['msg'] = "Informações cadastradas com sucesso";
            } else {
                $data['msg'] = "Informações não cadastradas";
            }
        }
    }

    public function listaCodFuncionario()
    {
        $request = service('request');
        $data['usuario'] = "";

        if($request->getPost('codUsu')){
        $codusuario = $request->getPost('codUsu');
        $UsuarioModel = new \App\Models\UsuarioModel();
        $registros = $UsuarioModel->find($codusuario);
        $data['usuario'] = $registros;

        }

        if($request->getPost('nomeFun') && $request->getPost('foneFun')){
            $this->inserirFuncionario();
        }

        echo view('header');
        echo view('cadFuncionario', $data);
        echo view('footer');
    }

    public function buscaPrincipalFuncionarioCod(){
    
        $request = service('request');
        $FuncionarioModel = new \App\Models\FuncionarioModel();
        $codfuncionario = $request->getPost('codFun');
        $registros = $FuncionarioModel->find($codfuncionario); 
        
        
        $data['funcionario'] = $registros;
        
        if ($request->getPost('codFunDeletar')){
            $this->funcionarioExcluir($request->getPost('codFunDeletar'));
            return redirect()->to(base_url('UsuarioController/todosUsuarios'));
        }

        if ($request->getPost('codFunAlterar')){
            return $this->funcionarioAlterar();
        }
        echo view('header');
        echo view('buscaCodigoFuncionario', $data);
        echo view('footer');
    }

    public function buscaPrincipalFuncionarioNome(){
        

    }

    public function funcionarioAlterar(){
        $request = service('request');
        $codFunAlterar = $request->getPost('codFunAlterar');
        $nomeFun = $request->getPost('nomeFun');
        $foneFun = $request->getPost('foneFun');

        $FuncionarioModel = new \App\Models\FuncionarioModel();
        $registros = $FuncionarioModel->find($codFunAlterar);  

        if ($request->getPost('nomeFun') && $request->getPost('foneFun')) {
            $registros->nomeFun = $nomeFun;
            $registros->foneFun = $foneFun;
            $FuncionarioModel->update($codFunAlterar,$registros);

           return redirect()->to(base_url('home'));
        }

        $data['funcionario'] = $registros;

        echo view('header');
        echo view('home', $data);
        echo view('footer');
    }

    public function funcionarioExcluir($codFunDeletar){
        if (is_null($codFunDeletar)) {
            return redirect()->to(base_url('Usuarios/todosUsuarios'));
        }

        $FuncionarioModel = new \App\Models\FuncionarioModel();

        if ($FuncionarioModel->delete($codFunDeletar));{

        }
    }

}