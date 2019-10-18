<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PrintnodeController extends Controller
{
    public function cria_pdf(){
        $html = file_get_contents('https://formulasys.encontresuafranquia.com.br/pedido_impresso.php?cod_pedidos=368175');
        return PDF::loadFile('https://formulasys.encontresuafranquia.com.br/pedido_impresso.php?cod_pedidos=368175')->inline('github.pdf');
    }
}
