<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \App\Models\Modelbarang;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | Toko Rifqi Putra',
            'menu' => 'dashboard'

        ];
        return view('dashboard', $data);
    }
}
