<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\core\Funcoes;

class Dashboard extends BaseController
{
    function __construct()
    {
        session_start();
        if (!Funcoes::funcionarioLogado()) :
            Funcoes::redirect("home");
        endif;
    }

    public function index()
    {
        $this->view('dashboardVendedor/index');
    }
}
