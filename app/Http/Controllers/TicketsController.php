<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\IpiComunicacaoCategoria;
use App\Models\IpiComunicacaoCronograma;
use App\Models\IpiComunicacaoNovidade;
use App\Models\IpiComunicacaoNovidadesArquivo;
use App\Models\IpiComunicacaoNovidadesIpiUsuario;
use App\Models\IpiComunicacaoSituaco;
use App\Models\IpiComunicacaoSubcategoria;
use App\Models\IpiComunicacaoSubcategoriasSituaco;
use App\Models\IpiComunicacaoTicket;
use App\Models\IpiComunicacaoTicketsArquivo;
use App\Models\IpiComunicacaoTicketsComentario;
use App\Models\IpiComunicacaoTicketsIpiPizzaria;
use App\Models\IpiComunicacaoTicketsLog;

class TicketsController extends Controller
{
    private $cod_tickets;
    private $cod_usuarios;
    private $cod_ticket_subcategorias;
    private $titulo;
    private $data_hora_ticket;
    private $data_prevista;
    private $data_prevista_analise;
    private $cod_pizzarias;

    public function recuperaTicket(){
        
        $ticket = new IpiComunicacaoTicket();
        if(!empty($this->cod_tickets)){
            $ticket = $ticket->where('cod_tickets',$this->cod_tickets);
        }
        if(!empty($this->cod_usuarios)){
            $ticket = $ticket->where('cod_usuarios',$this->cod_usuarios);
        }
        if(!empty($this->cod_ticket_subcategorias)){
            $ticket = $ticket->where('cod_ticket_subcategorias',$this->cod_ticket_subcategorias);
        }
        if(!empty($this->titulo)){
            $ticket = $ticket->where('titulo','LIKE',$this->cod_ticket_subcategorias.'%');
        }
        if(!empty($this->data_hora_ticket)){
            $ticket = $ticket->where('data_hora_ticket','LIKE',$this->data_hora_ticket.'%');
        }
        if(!empty($this->data_prevista_analise)){
            $ticket = $ticket->where('data_prevista','LIKE',$this->data_prevista_analise.'%');
        }
        if(!empty($this->data_prevista)){
            $ticket = $ticket->where('data_prevista','LIKE',$this->data_prevista.'%');
        }
        //$ticket = $ticket->paginate(15);
        return $ticket;

    }

    public function retornaCategoria(){
        $categoriaTicket = IpiComunicacaoCategoria::get();
        return $categoriaTicket;
    }

    public function retornaSituacoes(){
        $situacaoTicket = IpiComunicacaoSituaco::get();
        return $situacaoTicket;
    }

    public function insereTicket(Request $request){
        $IpiComunicaoTickets = IpiComunicacaoTicket::create($request->all());
    }
    
    public function insereTicketPizzaria(Request $request){
        $IpiComunicaoTickets = IpiComunicacaoTicketsIpiPizzaria::create($request->all());
    }

    public function insereComentario(Request $request){
        $IpiComunicaoTickets = IpiComunicacaoTicketsComentario::create($request->all());
    }


    public function alteraCategoria(Request $request,$cod_categorias){
        $IpiComunicaoTickets = IpiComunicacaoCategoria::find($cod_categorias)->fill($request->all());
        $IpiComunicaoTickets->save();
    }


    
}
