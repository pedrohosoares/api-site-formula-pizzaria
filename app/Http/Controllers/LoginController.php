<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public $resposta = '';

    public function login_formula(Request $request){
        if($request->isMethod('POST')){
            try {
                $email = $request->email;
                $this->resposta = DB::table('nuc_usuarios')
                ->leftJoin('ipi_pizzarias_nuc_usuarios','nuc_usuarios.cod_usuarios','ipi_pizzarias_nuc_usuarios.cod_usuarios')
                ->leftJoin('ipi_pizzarias','ipi_pizzarias_nuc_usuarios.cod_pizzarias','ipi_pizzarias.cod_pizzarias')
                ->where('nuc_usuarios.senha',md5($request->senha))
                ->where(function($query) use ($email){
                    $query->where('nuc_usuarios.email',$email)
                    ->orWhere('nuc_usuarios.usuario',$email);
                })
                ->get();
                
            } catch (\Throwable $th) {
                $this->resposta = '';
            }
            
        }
        return $this->resposta;        
    }
}
