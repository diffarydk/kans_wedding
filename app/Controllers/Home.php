<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function home()
    {
        return view('home');
    }

    public function masuk()
    {  
        return view('login');
        
    }

    public function daftar()
    {  
        return view('daftar');
    }

    public function save()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman form dengan pesan kesalahan
            return redirect()->to('daftar')->withInput()->with('errors', $validation->getErrors());
        }

       
        $userModel = new UserModel();
        $userData = [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        

        $userModel->insert($userData);

        
        return redirect()->to('login');
    }
}
