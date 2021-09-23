<?php

namespace App\Controllers;

class UsuarioController extends BaseController
{

    public function index()
    {
        echo view('header');
        echo view('cadUsuario');
        echo view('footer');
    }

    public function inserirUsuario()
    {
        $data['msg'] = '';
        $request = service('request');
        if ($request->getMethod() === 'post') {
            $UsuarioModelo = new \App\Models\UsuarioModel();

            $opcao = ['cost' => 8];

            $senhaCrip = password_hash($request->getPost('senhausu'), PASSWORD_BCRYPT, $opcao);

            $UsuarioModelo->set('emailusu', $request->getPost('emailusu'));
            $UsuarioModelo->set('senhausu', $senhaCrip);

            if ($UsuarioModelo->insert()) {
                $data['msg'] = "Informações cadastradas com sucesso";
            } else {
                $data['msg'] = "Informações não cadastradas";
            }
        }

        echo view('header');
        echo view('cadUsuario', $data);
        echo view('footer');
    }

    public function todosUsuarios()
    {
        $UsuarioModel = new \App\Models\UsuarioModel();
        $registros = $UsuarioModel->find();
        $data['usuarios'] = $registros;

        $request = service('request');
        $codusuario = $request->getPost('codUsu');
        $codUsuAlterar = $request->getPost('codUsuAlterar');

        if ($codusuario) {
            $this->deletarUsuario($codusuario);
            return redirect()->to(base_url('UsuarioController/todosUsuarios/'));
        }

        if ($codUsuAlterar) {
            return $this->alterarUsuario();
        }

        echo view('header');
        echo view('listaUsuario', $data);
        echo view('footer');
    }

    public function listaCodUsuario()
    {
        $request = service('request');
        $UsuarioModel = new \App\Models\UsuarioModel();
        $codusuario = $request->getPost('codUsu');
        $registros = $UsuarioModel->find($codusuario);

        $data['usuario'] = $registros;

        $codUsuAlterar = $request->getPost('codUsuAlterar');
        $codUsuDel = $request->getPost('codUsuDel');


        if ($codUsuDel) {
            $this->deletarUsuario($codUsuDel);
            return redirect()->to(base_url('UsuarioController/listaCodUsuario/'));
        }

        if ($codUsuAlterar) {
            return $this->alterarUsuarioCod();
        }

        echo view('header');
        echo view('listaCodUsu', $data);
        echo view('footer');
    }

    public function alterarUsuario()
    {        
        $request = service('request');
        $codUsuAlterar = $request->getPost('codUsuAlterar');
        $emailUsu = $request->getPost('emailUsu');

        $UsuarioModel = new \App\Models\UsuarioModel();
        $registros = $UsuarioModel->find($codUsuAlterar);  

        if ($request->getPost('emailUsu')) {
            $registros->emailusu = $emailUsu;
            $UsuarioModel->update($codUsuAlterar,$registros);

            return redirect()->to(base_url('UsuarioController/todosUsuarios/'));
        }

        $data['usuario'] = $registros;

        echo view('header');
        echo view('alterarFormUsuario', $data);
        echo view('footer');
    }

    public function alterarUsuarioCod()
    {        
        $request = service('request');
        $codUsuAlterar = $request->getPost('codUsuAlterar');
        $emailUsu = $request->getPost('emailUsu');

        $UsuarioModel = new \App\Models\UsuarioModel();
        $registros = $UsuarioModel->find($codUsuAlterar);  

        if ($request->getPost('emailUsu')) {
            $registros->emailusu = $emailUsu;
            $UsuarioModel->update($codUsuAlterar,$registros);

            return redirect()->to(base_url('UsuarioController/listaCodUsuario/'));
        }

        $data['usuario'] = $registros;

        echo view('header');
        echo view('alterarFormUsuario', $data);
        echo view('footer');
    }

    public function formAlterar(){

    }


    public function deletarUsuario($codusuario = null)
    {
        if (is_null($codusuario)) {
            return redirect()->to(base_url('UsuarioController/todosUsuarios'));
        }

        $UsuarioModel = new \App\Models\UsuarioModel();
        if ($UsuarioModel->delete($codusuario)) {
            return redirect()->to(base_url('UsuarioController/todosUsuarios'));
        } else {
            return redirect()->to(base_url('UsuarioController/todosUsuarios'));
        }
        return redirect()->to(base_url('UsuarioController/todosUsuarios'));
    }

    public function deletarUsuarioCod($codusuario = null)
    {
        if (is_null($codusuario)) {
            return redirect()->to(base_url('UsuarioController/listaCodUsuario'));
        }

        $UsuarioModel = new \App\Models\UsuarioModel();
        if ($UsuarioModel->delete($codusuario)) {
            return redirect()->to(base_url('UsuarioController/listaCodUsuario'));
        } else {
            return redirect()->to(base_url('UsuarioController/listaCodUsuario'));
        }
    }
}