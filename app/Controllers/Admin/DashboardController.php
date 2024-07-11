<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController; //Memanggil class basecontroler

class DashboardController extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard/index');
    }
}
