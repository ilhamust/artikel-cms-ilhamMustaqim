<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; //Memanggil class basecontroler

class LoginController extends BaseController
{
    public function index(): string
    {
        return view('admin/login');
    }
}