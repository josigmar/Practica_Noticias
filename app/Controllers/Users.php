<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CategoriesModel;

class Users extends BaseController {
    public function loginForm($error=null) {
        helper('form');
        $model_cat = model(CategoriesModel::class);
        $data['categories'] = $model_cat->findAll();

        if ($error == null) {
            return view('frontend/templates/header', $data)
            . view('frontend/users/login',['title' => 'Private Acces', 'error' => ''])
            .view('frontend/templates/footer');
        } else {
            return view('frontend/templates/header', $data)
            . view('frontend/users/login',['title' => 'Private Acces', 'error' => 'Credenciales incorrectas'])
            .view('frontend/templates/footer');
        }
    }

    public function checkUser() {
        helper('form');
        //IF de validación
        if (! $this->validate([
            'username' => 'required|max_length[255]|min_length[4]',
            'password' => 'required|max_length[5000]|min_length[4]'
        ])) {
            //Si la validación falla, volvemos al formulario
            return $this->loginForm();
        }

        //Obtenemos los datos validados
        $post = $this->validator->getValidated();

        $model = model(UserModel::class);

        $model_cat = model(CategoriesModel::class);
        $data['categories'] = $model_cat->findAll();

        //Comprobamos si existe el usuario y contraseña en la BBDD
        if ($data['user'] = $model->checkUser($post['username'], $post['password'])) {
            $session = session();
            $session->set('user', $post['username']);

            return redirect()->to(base_url('backend'));
        } else {
            return $this->loginForm("Error");
        }
    }

    public function closeSession() {
        $session = session();

        //Eliminar la variable de sesión específica
        $session->remove('user');

        //Eliminar toda la información d ela sesión
        $session->destroy();

        return redirect()->to(base_url('admin'));
    }
}