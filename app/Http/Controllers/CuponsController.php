<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpiPedido;
use App\Models\IpiPedidosAdicionai;
use App\Models\IpiPedidoMinimo;
use App\Models\IpiPedidosBebida;
use App\Models\IpiPedidosBorda;
use App\Models\IpiPedidosCombo;
use App\Models\IpiPedidosDetalhesPg;
use App\Models\IpiPedidosFormasPg;
use App\Models\IpiPedidosFraco;
use App\Models\IpiPedidosInfo;
use App\Models\IpiPedidosIngrediente;
use App\Models\IpiPedidosIpiCupon;
use App\Models\IpiPedidosIpiEnquete;
use App\Models\IpiPedidosPagTemp;
use App\Models\IpiPedidosPizza;
use App\Models\IpiPedidosSituaco;
use App\Models\IpiPedidosTaxa;
use App\Models\IpiPedidosMotivoCancelamento;
use App\Models\IpiCaixaIpiPedido;

use App\Models\IpiPizzasIpiTamanho;
use App\Models\IpiPizza;

use App\Models\IpiBebida;
use App\Models\IpiBebidasIpiConteudo;

use App\Models\IpiTamanhosIpiAdicionai;
use App\Models\IpiTamanho;
use App\Models\IpiTamanhosIpiBorda;
use App\Models\IpiTamanhosIpiFraco;
use App\Models\IpiTamanhosIpiFracoesPreco;
use App\Models\IpiTamanhosIpiAdicionaisEstoque;
use App\Models\IpiTamanhosIpiBordasEstoque;
use App\Models\IpiTamanhosIpiOpcoesCorte;
use App\Models\IpiTamanhosIpiTipoMassa;

use App\Models\IpiIngredientesIpiTamanho;
use App\Models\IpiIngrediente;
use App\Models\IpiAdicionai;


class CuponsController extends Controller
{
    
    public function cupom_cozinha_ifood($cod_pedido)
    { 
        $pedidos = IpiPedido::find($cod_pedido);
        $json = $pedidos->pedido_ifood_json;
        if (empty($json)) {
			exit;
		}
		$json = str_replace(array("\r", "\n"), '', $json);
		$json = json_decode($json, true);
		$order = $json['order'];
		$merchant = $order['merchant'];
		$payments = $order['payments'];
		$customer = $order['customer'];
		$items = $order['items'];
		$subtotal = $order['subTotal'];
		$totalPrice = $order['totalPrice'];
		$deliveryFee = $order['deliveryFee'];
		$deliveryAddress = $order['deliveryAddress'];
		$html = "<!DOCTYPE html>";
		$html .= "<html>";
		$html .= "<head>";
		$html .= '<meta charset="utf-8" />';
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$html .= '<title>Pedido - Fórmula Pizzaria</title>';
		$html .= '<style>';
		$html .= 'body{min-height:auto;}';
		$html .= 'body table{max-width: 320px; margin: auto; font-family: sans-serif;}';
		$html .= '@media print {body{width:100%;margin:1px;}table{/*width:143.9999% !important;*/width:100% !important;margin:1px;}}@page{margin:1px;}';
		$html .= '</style>';
		$html .= "</head>";
		$html .= "<body>";
		$html .= "<table align='center' style='font-family:sans-serif;'>";
		$html .= "<tr>";
		$html .= "<td align='left' colspan='2'><strong>COD PEDIDO <span style='font-size:40px;'><br />" . $pedidos->cod_pedidos . "</span></strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='left' colspan='2'>ORIGEM IFOOD</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td colspan='2'>HORÁRIO: " . date('d/m/Y H:i:s', strtotime($order['createdAt'])) . "</td>";
		$html .= "</tr>";
		if ($pedidos->cod_pizzarias == 23) {
			$html .= "<tr>";
			$html .= "<td colspan='2'>CLIENTE: " . $customer['name'] . "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
			$html .= "<td colspan='2'>ID IFOOD: " . $order['shortReference'] . "</td>";
			$html .= "</tr>";
		}
		$conta = 1;
		foreach ($items as $ki => $vi) {
			if ($this->contemString($this->Utf8_ansi($vi['name'])) == false) {
				for ($i = 0; $i < $vi['quantity']; $i++) {
					# code...
					$html .= "<tr>";
					$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
					$html .= "</tr>";
					$html .= "<tr>";
					$html .= "<td align='center' colspan='2'><strong>" . $conta . " - Pedido</strong></td>";
					$html .= "</tr>";
					$html .= "<tr>";
					$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
					$html .= "</tr>";
					$html .= "<tr>";
					$html .= "<td>" . $this->Utf8_ansi($vi['name']) . "</td>";
					$html .= "<td></td>";
					$html .= "</tr>";
					if (isset($vi['subItems'])) {
						foreach ($vi['subItems'] as $ksi => $vsi) {
							if ($this->contemString($this->Utf8_ansi($vsi['name'])) == false) {
								$html .= "<tr>";
								$html .= "<td> -- " . $this->Utf8_ansi($vsi['name']) . "</td>";
								$html .= "<td style=' width: 75px; text-align: right; '> QTD " . $vsi['quantity'] . "</td>";
								$html .= "</tr>";
								if (isset($vsi["observations"])) {
									$html .= "<tr>";
									$html .= "<td>OBSERVAÇÕES: </td>";
									$html .= "<td>" . $this->Utf8_ansi($vsi["observations"]) . "</td>";
									$html .= "</tr>";
								}
							}
						}
					}
					if (isset($vi["observations"])) {
						$html .= "<tr>";
						$html .= "<td>OBSERVAÇÕES: </td>";
						$html .= "<td>" . $this->Utf8_ansi($vi["observations"]) . "</td>";
						$html .= "</tr>";
					}
					$conta++;
				}
			}
		}
		$html .= "</table>";
		$html .= "</body>";
		$html .= "</html>";
		return $html;
    }

    public function cupom_pedido_ifood($cod_pedido)
    {
        $pedidos = IpiPedido::find($cod_pedido);
        $json = $pedidos->pedido_ifood_json;
        if (empty($json)) {
            exit;
        }
        $dataPedido = date('d/m/Y H:i:s', strtotime($pedidos->data_hora_inicial));
        $apenasData = date('d/m/Y', strtotime($pedidos->data_hora_inicial));
        $json = str_replace(array("\r", "\n"), '', $json);
        $json = json_decode($json, true);
        $order = $json['order'];
        $merchant = $order['merchant'];
        $payments = $order['payments'];
        $customer = $order['customer'];
        $items = $order['items'];
        $subtotal = $order['subTotal'];
        $totalPrice = $order['totalPrice'];
        $deliveryFee = $order['deliveryFee'];
        $deliveryAddress = $order['deliveryAddress'];
        $valor = 0;
        $html = "<!DOCTYPE html>";
        $html .= "<html>";
        $html .= "<head>";
        $html .= '<meta charset="utf-8" />';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= '<title>Pedido - Fórmula Pizzaria</title>';
        $html .= '<style>';
        $html .= 'body{min-height:auto;}';
        $html .= 'body table{max-width: 320px; margin: auto; font-family: sans-serif;}';
        $html .= '@media print {body{width:100%;margin:1px;}table{/*width:143.9999% !important;*/width:100% !important;margin:1px;}}@page{margin:1px;}';
        $html .= '</style>';
        $html .= "</head>";
        $html .= "<body>";
        $html .= "<table align='center' style='font-family:sans-serif;'>";
        $html .= "<tr>";
        $html .= "<td align='left' colspan='2'><strong>COD PEDIDO <span style='font-size:40px;'>" . $pedidos->cod_pedidos . "</span></strong></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='left' colspan='2'>ORIGEM IFOOD</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='left' colspan='2'>HORÁRIO " . $dataPedido . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $count = 1;
        foreach ($items as $ki => $vi) {
            for ($i = 0; $i < $vi['quantity']; $i++) {
                $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td align='center' colspan='2'><strong>" . $count . " - PEDIDO</strong></td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= "<td>" . $this->Utf8_ansi($vi['name']) . "</td>";
                $html .= "<td><span style='font-size: 21px;font-weight: 600;'> - R$" . $vi['price'] . "</td>";
                $html .= "</tr>";
                $valor += ($vi['quantity'] * $vi['price']);
                if (isset($vi['subItems'])) {
                    foreach ($vi['subItems'] as $ksi => $vsi) {
                        $valor += ($vsi['quantity'] * $vsi['price']);
                        $html .= "<tr>";
                        $html .= "<td>" . $this->Utf8_ansi($vsi['name']) . "</td>";
                        $html .= "<td>QTD: " . $vsi['quantity'] . " - R$" . number_format($vsi['price'], 2) . "</td>";
                        $html .= "</tr>";
                    }
                }
                if (isset($vi["observations"])) {
                    $html .= "<tr>";
                    $html .= "<td>OBSERVAÇÕES: </td>";
                    $html .= "<td>" . $this->Utf8_ansi($vi["observations"]) . "</td>";
                    $html .= "</tr>";
                }
                $count++;
            }
        }
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='center' colspan='2'><strong>CLIENTE</strong></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        foreach ($customer as $kc => $vc) {
            if ($kc == 'id') {
                $html .= "<tr>";
                $html .= "<td>ID CLIENTE: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vc) . "</td>";
                $html .= "</tr>";
            }
            if ($kc == 'phone') {
                $html .= "<tr>";
                $html .= "<td>TELEFONE: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vc) . "</td>";
                $html .= "</tr>";
            }
            if ($kc == 'name') {
                $html .= "<tr>";
                $html .= "<td>NOME: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vc) . "</td>";
                $html .= "</tr>";
            }
            if ($kc == 'taxPayerIdentificationNumber') {
                if (strlen($vc) == 14) {
                    $doc = "CNPJ";
                } else {
                    $doc = "CPF";
                }
                $html .= "<tr>";
                $html .= "<td>" . $doc . ": </td>";
                $html .= "<td>" . $this->Utf8_ansi($vc) . "</td>";
                $html .= "</tr>";
            }
        }
        foreach ($deliveryAddress as $kd => $vd) {
            if ($kd == 'formattedAddress') {
                $html .= "<tr>";
                $html .= "<td>RUA: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vd) . "</td>";
                $html .= "</tr>";
            }
            if ($kd == 'neighborhood') {
                $html .= "<tr>";
                $html .= "<td>BAIRRO: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vd) . "</td>";
                $html .= "</tr>";
            }
            if ($kd == 'city') {
                $html .= "<tr>";
                $html .= "<td>CIDADE: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vd) . "</td>";
                $html .= "</tr>";
            }
            if ($kd == 'postalCode') {
                $html .= "<tr>";
                $html .= "<td>CEP: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vd) . "</td>";
                $html .= "</tr>";
            }
            if ($kd == 'reference') {
                $html .= "<tr>";
                $html .= "<td>REFERÊNCIA: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vd) . "</td>";
                $html .= "</tr>";
            }
            if ($kd == 'complement') {
                $html .= "<tr>";
                $html .= "<td>COMPLEMENTO: </td>";
                $html .= "<td>" . $this->Utf8_ansi($vd) . "</td>";
                $html .= "</tr>";
            }
        }
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='center' colspan='2'><strong>PAGAMENTO</strong></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $valorPrePago = 0.00;
        foreach ($payments as $kp => $vp) {
            $html .= "<tr>";
            $html .= "<td>MEIO: </td>";
            $html .= "<td>" . $this->Utf8_ansi($vp['name']) . "</td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td>VALOR: </td>";
            $html .= "<td>R$" . number_format($vp['value'], 2) . "</td>";
            $html .= "</tr>";
            $html .= "<tr>";
            $html .= "<td>PRÉ-PAGO: </td>";
            $vp['prepaid'] = $vp['prepaid'] == false ? "Não" : "Sim";
            if ($vp['prepaid'] == 'Sim') {
                $valorPrePago += number_format($vp['value'], 2);
                $valor = $valor - $valorPrePago;
            }
            $vp['prepaid'] = $vp['prepaid'] == 'Sim' ? "<strong>PAGO PELO IFOOD</strong>" : "<strong>NÃO PAGO</strong>";
            $html .= "<td>" . $vp['prepaid'] . "</td>";
            $html .= "</tr>";
            $troco = isset($vp['changeFor']) ? $vp['changeFor'] : "";
            if (!empty($troco)) {
                $html .= "<tr>";
                $html .= "<td>TROCO PARA: </td>";
                $html .= "<td>R$" . $troco . "</td>";
                $html .= "</tr>";
            }
        }
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='center' colspan='2'><strong>TOTAL</strong></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>TAXA DE ENTREGA: </td>";
        $taxa_entrega = number_format($deliveryFee, 2);
        $html .= "<td>R$" . number_format($deliveryFee, 2) . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>SUB-TOTAL: </td>";
        $html .= "<td>R$" . number_format($subtotal, 2) . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>PREÇO TOTAL: </td>";
        $html .= "<td>R$" . number_format($totalPrice, 2) . "</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='2'><strong style='font-size:22px;'>VALOR A PAGAR: R$" . number_format($totalPrice - $valorPrePago, 2) . "</strong></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='center' colspan='2'>https://formulapizzaria.com.br</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td align='center' colspan='2'>- A cada mordida uma experiência -</td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td>COD PEDIDO: </td>";
		$html .= "<td>" . $pedidos->cod_pedidos . "</td>";
		$html .= "</tr>";
		$html .= "<td>PREÇO ENTREGA: </td>";
		$html .= "<td>R$" . number_format($taxa_entrega, 2) . "</td>";
		$html .= "</tr>";
		$html .= "</table>";
		$html .= "</body>";
		$html .= "</html>";
		return $html;
    }

    public function cupom_cozinha_tel($cod_pedido)
    {
        $pedidos = IpiPedido::find($cod_pedido);
        $dataPedido = date('d/m/Y H:i:s', strtotime($pedidos->data_hora_inicial));
        $apenasData = date('d/m/Y', strtotime($pedidos->data_hora_inicial));
        $html = '<html>';
        $html .= '<head>';
        $html .= '<meta charset="utf-8" />';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= '<title>Pedido - Fórmula Pizzaria</title>';
        $html .= '<style>';
        $html .= 'body{min-height:auto;}';
        $html .= 'body table{max-width: 375px; margin: auto; font-family: sans-serif;}';
        $html .= '@media print {body{width:100%;margin:1px;}table{/*width:143.9999% !important;*/width:100% !important;margin:1px;}}@page{margin:1px;}';
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body style="min-height:auto;">';
        $html .= '<table style="margin: auto; font-family: sans-serif;">';
        $html .= '<tr>';
        $html .= '<td colspan="2"><strong>COD PEDIDO </strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2" style="font-size: 40px;"><strong>' . $pedidos->cod_pedidos . '</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2">ORIGEM TEL </td>';
        $html .= '</tr>';
        if ($pedidos->agendado == 1) {
            $html .= '<tr>';
            $html .= '<td><strong>PEDIDO AGENDADO PARA</strong> </td>';
            $html .= '<td><strong>' . $apenasData . ' ' . $pedidos->horario_agendamento . '</strong></td>';
            $html .= '</tr>';
        } else {
            $html .= '<tr>';
            $html .= '<td>HORÁRIO: </td>';
            $html .= '<td>' . $dataPedido . '</td>';
            $html .= '</tr>';
        }
        if (!empty($pedidos->obs_pedido)) {
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;">&nbsp;</td>';
            $html .= '</tr>';
            $html .= "<tr>";
            $html .= "<td>OBS PEDIDO:</td>";
            $html .= "<td>" . $pedidos->obs_pedido . "</td>";
            $html .= "</tr>";
        }
        foreach ($pedidos->ipi_pedidos_pizzas as $i => $v) {
            $numeropizza = $i + 1;
            $html .= '<tr>';
            $html .= '<td style="border-top:2px dotted #000;border-bottom:2px dotted #000;" colspan="2" align="center"><strong>' . $numeropizza . ' - Pedido</strong></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><strong>TAMANHO</strong>: </td>';
            $html .= '<td>' . $v->ipi_tamanho->tamanho . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>MASSA: </td>';
            $html .= '<td>' . $v->ipi_tipo_massa->tipo_massa . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>CORTE: </td>';
            $html .= '<td>' . $v->ipi_opcoes_corte->opcao_corte . '</td>';
            $html .= '</tr>';
            foreach ($v->ipi_pedidos_bordas as $iborda => $vborda) {
                $html .= '<tr>';
                $html .= '<td>BORDA: </td>';
                $html .= '<td>' . $vborda->borda . '</td>';
                $html .= '</tr>';
            }
            $fracoes = $v->ipi_pedidos_fracos;
            $totalFracao = count($fracoes);
            foreach ($fracoes as $fi => $fracao) {
                $numeroFracao = $fi + 1;
                $html .= '<tr>';
                $html .= '<td>PIZZA: ' . $numeroFracao . ' / ' . $totalFracao . '</td>';
                $promocional = $fracao->ipi_pedidos_pizza_unico->promocional == 1 ? " (Grátis) " : "";
                $html .= '<td>SABOR: ' . $fracao->ipi_pizza->pizza . ' '  . $promocional . '</td>';
                $html .= '</tr>';
                if (!empty($fracao->obs_fracao)) {
                    $html .= '<tr>';
                    $html .= '<td>OBS: </td>';
                    $html .= '<td>' . $fracao->obs_fracao . '</td>';
                    $html .= '</tr>';
                }
                if (!empty($fracao->obs_ifood)) {
                    $html .= '<tr>';
                    $html .= '<td>OBS IFOOD: </td>';
                    $html .= '<td>' . $fracao->ifood . '</td>';
                    $html .= '</tr>';
                }
                $ingredientesNaoRemovidos = Controller::ingredientesNaoInclusos(
                    $cod_pedido,
                    $fracao->ipi_pedidos_pizza_unico->cod_pedidos_pizzas,
                    $fracao->cod_pedidos_fracoes,
                    $fracao->ipi_pizza->cod_pizzas
                );
                if (!empty($ingredientesNaoRemovidos)) {
                    $html .= '<tr>';
                    $html .= '<td colspan="2"><strong> INGREDIENTES INCLUÍDOS</strong></td>';
                    $html .= '</tr>';
                    $html .= '<tr><td>';
                    foreach ($ingredientesNaoRemovidos as $keyii => $valueii) {
                        $html .= ' - ' . $valueii->ingrediente . ' - ';
                    }
                    $html .= '</td></tr>';
                }
                $ingredientesRemovidos = Controller::ingredientesInclusos(
                    $cod_pedido,
                    $fracao->ipi_pedidos_pizza_unico->cod_pedidos_pizzas,
                    $fracao->cod_pedidos_fracoes,
                    $fracao->ipi_pizza->cod_pizzas
                );
                if (!empty($ingredientesRemovidos)) {
                    $html .= '<tr>';
                    $html .= '<td colspan="2"><strong> INGREDIENTES REMOVIDOS</strong></td>';
                    $html .= '</tr>';
                    $html .= '<tr><td colspan="2">';
                    foreach ($ingredientesRemovidos as $keyr => $valuer) {
                        $html .= ' - ' . $valuer->ingrediente . ' - ';
                    }
                    $html .= '</td></tr>';
                }
            }
        }
        return $html;
    }

    public function cupom_pedido_tel($cod_pedido)
    {
        $pedidos = IpiPedido::find($cod_pedido);
        $dataPedido = date('d/m/Y H:i:s', strtotime($pedidos->data_hora_inicial));
        $apenasData = date('d/m/Y', strtotime($pedidos->data_hora_inicial));
        $html = '<html>';
        $html .= '<head>';
        $html .= '<meta charset="utf-8" />';
        $html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $html .= '<title>Pedido - Fórmula Pizzaria</title>';
        $html .= '<style>';
        $html .= 'body{min-height:auto;}';
        $html .= 'body table{max-width: 375px; margin: auto; font-family: sans-serif;}';
        $html .= '@media print {body{width:100%;margin:1px;}table{/*width:143.9999% !important;*/width:100% !important;margin:1px;}}@page{margin:1px;}';
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body style="min-height:auto;">';
        $html .= '<table style="margin: auto; font-family: sans-serif;">';
        $html .= '<tr>';
        $html .= '<td align="left" colspan="2"><strong>COD PEDIDO </strong><strong style="font-size:40px;">' . $pedidos->cod_pedidos . '</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2">ORIGEM ' . $pedidos->origem_pedido . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $tipo_entrega = $pedidos->tipo_entrega == 'Balcão' ? '<strong>Retirar no Balcão</strong>' : "<strong>Para entregar</strong>";
        $html .= '<td colspan="2">' . $tipo_entrega . '</td>';
        $html .= '</tr>';
        if ($pedidos->agendado == 1) {
            $html .= '<tr>';
            $html .= '<td><strong>PEDIDO AGENDADO PARA</strong> </td>';
            $html .= '<td><strong>' . $apenasData . ' ' . $pedidos->horario_agendamento . '</strong></td>';
            $html .= '</tr>';
        } else {
            $html .= '<tr>';
            $html .= '<td>HORÁRIO: </td>';
            $html .= '<td>' . $dataPedido . '</td>';
            $html .= '</tr>';
        }
        if (!empty($pedidos->obs_pedido)) {
            $html .= "<tr>";
            $html .= "<td>OBS PEDIDO:</td>";
            $html .= "<td>" . $pedidos->obs_pedido . "</td>";
            $html .= "</tr>";
        }
        foreach ($pedidos->ipi_pedidos_pizzas as $i => $v) {
            $numeropizza = $i + 1;
            $html .= '<tr>';
            $html .= '<td style="border-top:2px dotted #000;border-bottom:2px dotted #000;" colspan="2" align="center"><strong>' . $numeropizza . ' - PEDIDO</strong></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><strong>TAMANHO</strong>: </td>';
            $html .= '<td>' . $v->ipi_tamanho->tamanho . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>MASSA: </td>';
            $html .= '<td>' . $v->ipi_tipo_massa->tipo_massa . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>CORTE: </td>';
            $html .= '<td>' . $v->ipi_opcoes_corte->opcao_corte . '</td>';
            $html .= '</tr>';
            foreach ($v->ipi_pedidos_bordas as $iborda => $vborda) {
                $html .= '<tr>';
                $html .= '<td>BORDA: </td>';
                $html .= '<td>' . $vborda->borda . '</td>';
                $html .= '</tr>';
            }
            $fracoes = $v->ipi_pedidos_fracos;
            $totalFracao = count($fracoes);
            foreach ($fracoes as $fi => $fracao) {
                $numeroFracao = $fi + 1;
                $html .= '<tr>';
                $html .= '<td>PIZZA: ' . $numeroFracao . ' / ' . $totalFracao . '</td>';
                $promocional = $fracao->ipi_pedidos_pizza_unico->promocional == 1 ? " (Grátis) " : "";
                $html .= '<td>SABOR: ' . $fracao->ipi_pizza->pizza . ' '  . $promocional . '</td>';
                $html .= '</tr>';
                if (!empty($fracao->obs_fracao)) {
                    $html .= '<tr>';
                    $html .= '<td>OBS: </td>';
                    $html .= '<td>' . $fracao->obs_fracao . '</td>';
                    $html .= '</tr>';
                }
                if (!empty($fracao->obs_ifood)) {
                    $html .= '<tr>';
                    $html .= '<td>OBS IFOOD: </td>';
                    $html .= '<td>' . $fracao->ifood . '</td>';
                    $html .= '</tr>';
                }
                $ingredientesNaoRemovidos = Controller::ingredientesNaoInclusos(
                    $cod_pedido,
                    $fracao->ipi_pedidos_pizza_unico->cod_pedidos_pizzas,
                    $fracao->cod_pedidos_fracoes,
                    $fracao->ipi_pizza->cod_pizzas
                );
                if (!empty($ingredientesNaoRemovidos)) {
                    $html .= '<tr>';
                    $html .= '<td colspan="2"><strong> INGREDIENTES REMOVIDOS</strong></td>';
                    $html .= '</tr>';
                    $html .= '<tr><td>';
                    foreach ($ingredientesNaoRemovidos as $keyii => $valueii) {
                        $html .= ' - ' . $valueii->ingrediente . ' - ';
                    }
                    $html .= '</td></tr>';
                }
                $ingredientesRemovidos = Controller::ingredientesInclusos(
                    $cod_pedido,
                    $fracao->ipi_pedidos_pizza_unico->cod_pedidos_pizzas,
                    $fracao->cod_pedidos_fracoes,
                    $fracao->ipi_pizza->cod_pizzas
                );
                if (!empty($ingredientesRemovidos)) {
                    $html .= '<tr>';
                    $html .= '<td colspan="2"><strong> INGREDIENTES INCLUÍDOS</strong></td>';
                    $html .= '</tr>';
                    $html .= '<tr><td colspan="2">';
                    foreach ($ingredientesRemovidos as $keyr => $valuer) {
                        $html .= ' - ' . $valuer->ingrediente . ' - ';
                    }
                    $html .= '</td></tr>';
                }
            }
        }
        $bebidas = $pedidos->ipi_pedidos_bebidas;
        if (isset($bebidas[0])) {
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><strong>BEBIDAS</strong> </td>';
            $html .= '</tr>';
        }
        $sobremesas = array();
        foreach ($bebidas as $ib => $vb) {
            if ($vb->cod_bebidas == "40" or $vb->cod_bebidas == "42" or $vb->cod_bebidas == "41") {
                $sobremesas[] = $bebidas[$ib];
            } else {
                $html .= '<tr>';
                $html .= '<td>' . $vb->quantidade . '  ' . $vb->ipi_bebidas_ipi_conteudo->ipi_bebida->bebida . ' </td>';
                $html .= '<td> ' . $vb->ipi_bebidas_ipi_conteudo->ipi_conteudo->conteudo . '</td>';
                $html .= '</tr>';
            }
        }
        if (!empty($bebidas)) {
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
            $html .= '</tr>';
        }
        if (!empty($sobremesas)) {
            $html .= '<tr>';
            $html .= '<td><strong>SOBREMESAS</strong> </td>';
            $html .= '<td></td>';
            $html .= '<tr>';
        }
        foreach ($sobremesas as $kbb => $vbb) {
            $html .= '<tr>';
            $html .= '<td>' . $vbb->quantidade . '  ' . $vbb->bebida . ' </td>';
            $html .= '<td> ' . $vbb->conteudo . '</td>';
            $html .= '</tr>';
        }
        if (!empty($sobremesas)) {
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
            $html .= '</tr>';
            $html .= '<tr>';
        }
        $html .= '<tr>';
        $html .= '<td colspan="2" align="center"><strong>CLIENTE</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<tr>';
        $html .= '<td>NOME: </td>';
        $html .= '<td>' . $pedidos->nome_cliente . '</td>';
        $html .= '</tr>';
        $detalhes_pg = $pedidos->ipi_pedidos_detalhes_pgs;
        foreach ($detalhes_pg as $dkey => $dvalue) {
            if ($dvalue['chave'] == 'TROCO') {
                $troco = $dvalue->conteudo;
            } else {
                $html .= '<tr>';
                $chave = str_replace('CPF_NOTA_PAULISTA', 'CPF', $dvalue->chave);
                $html .= '<td>' . $chave . ': </td>';
                $html .= '<td>' . $dvalue->conteudo . '</td>';
                $html .= '</tr>';
            }
        }
        if (!empty($pedidos->telefone_1)) {
            $html .= '<tr>';
            $html .= '<td>TEL 1: </td>';
            $html .= '<td>' . $pedidos->telefone_1 . '</td>';
            $html .= '</tr>';
        }
        if (!empty($pedidos->telefone_2)) {
            $html .= '<tr>';
            $html .= '<td>TEL 2: </td>';
            $html .= '<td>' . $pedidos->telefone_2 . '</td>';
            $html .= '</tr>';
        }
        if (!empty($pedidos->referencia_cliente)) {
            $html .= '<tr>';
            $html .= '<td>REFERÊNCIA CLIENTE: </td>';
            $html .= '<td>' . $pedidos->referencia_cliente . '</td>';
            $html .= '</tr>';
        }
        $html .= '<tr>';
        $html .= '<td>ENDEREÇO: </td>';
        $html .= '<td>' . $pedidos->endereco . ', ' . $pedidos->numero . ', ' . $pedidos->complemento . ', BAIRRO: ' . $pedidos->bairro . ', CIDADE: ' . $pedidos->cidade . ', UF: ' . $pedidos->estado . ', N°: ' . $pedidos->numero . ', REF: ' . $pedidos->referencia_endereco . ' ' . $pedidos->referencia_cliente . ' ' . $pedidos->edificio . '</td>';
        $html .= '</tr>';
        $valorVoucher = array();
        if (isset($detalhes_pg[0]->pagamento_json) and !empty($detalhes_pg[0]->pagamento_json)) {
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;">&nbsp;</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan="2"><strong>PAGAMENTO: </strong></td>';
            $html .= '</tr>';
            $pagamento = json_decode($detalhes_pg[0]->pagamento_json, true);
            foreach ($pagamento as $key => $value) {
                if (isset($value['prepaid'])) {
                    if ($value['prepaid'] == 'true' or $value['prepaid'] == true) {
                        $valorVoucher[] = array($value['value'], "PRÉ-PAGO " . $value['name'] . " ");
                        $value['prepaid'] = "Sim";
                    } else {
                        $value['prepaid'] = "Não";
                    }
                    $key_ = "Pré-pago";
                    $html .= '<tr>';
                    $html .= '<td>' . $key_ . ': </td>';
                    $html .= '<td>' . $value['prepaid'] . '</td>';
                    $html .= '</tr>';
                }
                if (isset($value['name'])) {
                    $nomePrePagamento = $value['name'];
                    $key_ = "Nome";
                    $html .= '<tr>';
                    $value['name'] = str_replace('u00c9', 'É', $value['name']);
                    $value['name'] = str_replace('u00c1', 'Á', $value['name']);
                    $value['name'] = str_replace('u2022u2022u2022u2022', '******', $value['name']);
                    $html .= '<td>' . $key_ . ': </td>';
                    $html .= '<td>' . $value['name'] . '</td>';
                    $html .= '</tr>';
                }
                if (isset($value['value'])) {
                    $key_ = "Valor";
                    $value['value'] = "R$" . $value['value'];
                    $html .= '<tr>';
                    $html .= '<td>' . $key_ . ': </td>';
                    $html .= '<td>' . $value['value'] . '</td>';
                    $html .= '</tr>';
                }
            }

            $html .= '<tr>';
            $html .= '<td>Desconto: </td>';
            $html .= '<td>R$' . $pedidos->desconto . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>Taxa de Entrega: </td>';
            $html .= '<td>R$' . $pedidos->valor_entrega . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;">&nbsp;</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan="2"><strong style="font-size:22px;">VALOR A PAGAR: R$' . number_format($pedidos->valor_total, 2) . '</strong> </td>';
            $html .= '</tr>';
            if (isset($troco)) {
                $html .= '<tr>';
                $html .= '<td><strong>TROCO PARA:</strong> </td>';
                $html .= '<td>R$' . number_format($troco, 2) . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $html .= '<td><strong>TROCO:</strong> </td>';
                $troco = $troco - $pedidos->valor_total;
                $html .= '<td>R$' . number_format($troco, 2) . '</td>';
                $html .= '</tr>';
            }
            $valorPrePagoTotal = 0.00;
            foreach ($valorVoucher as $vvi => $vvv) {
                $vvv[1] = str_replace('u2022u2022u2022u2022', '******', $vvv[1]);
                $html .= '<tr>';
                $html .= '<td><strong>' . $vvv[1] . '</strong>:</td>';
                $html .= '<td>R$' . number_format($vvv[0], 2) . '</td>';
                $html .= '</tr>';
                $valorPrePagoTotal += $vvv[0];
            }
            if (!empty($valorVoucher)) {
                $valorAPagar = $pedidos->valor_total - number_format($valorPrePagoTotal, 2);
                $html .= '<tr>';
                $html .= '<td><strong>VALOR A PAGAR: R$' . $valorAPagar . '</strong></td>';
                $html .= '</tr>';
            }
        } else {
            $html .= '<tr>';
            $html .= '<td>Desconto: </td>';
            $html .= '<td>R$' . number_format($pedidos->desconto, 2) . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>Taxa de Entrega: </td>';
            $html .= '<td>R$' . number_format($pedidos->valor_entrega, 2) . '</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan="2" align="center"><strong>PAGAMENTO</strong>: </td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
            $html .= '</tr>';
            $formaPg = $pedidos->ipi_pedidos_formas_pg;
            foreach ($formaPg as $key => $valueFormaPG) {
                $html .= '<tr>';
                $html .= '<td>MEIO:</td>';
                $html .= '<td>' . $valueFormaPG->ipi_formas_pgs->forma_pg . '</td>';
                $html .= '</tr>';
            }
            $html .= '<tr>';
            $html .= '<td colspan="2"><strong style="font-size:22px;">VALOR A PAGAR: R$' . number_format($pedidos->valor_total, 2) . '</strong> </td>';
            $html .= '</tr>';
            if (isset($troco)) {
                $html .= '<tr>';
                $html .= '<td><strong>TROCO PARA:</strong> </td>';
                $html .= '<td>R$' . $troco . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                $troco = $troco - $pedidos->valor_total;
                $html .= '<td><strong>TROCO:</strong> </td>';
                $html .= '<td>R$' . number_format($troco,2) . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '<tr>';
        $html .= '<td colspan="2" style="border-top:2px dotted #000;"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2" align="center">https://formulapizzaria.com.br</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2" align="center"> - A cada mordida uma experiência - </td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2" style="border-top:2px dotted #000;">&nbsp;</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>COD PEDIDO: </td>';
        $html .= '<td>' . $pedidos->cod_pedidos . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>Valor entrega: </td>';
        $html .= '<td>R$' . number_format($pedidos->valor_entrega, 2) . '</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan="2" style="border-top:2px dotted #000;">&nbsp;</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';

        return $html;
    }

    public function cupom_cancelado($cod_pedido)
    { 
        $pedidos = IpiPedido::find($cod_pedido);
		$json = $pedidos->pedido_ifood_json;
		$cancelamento_json = $pedidos->cancelamento_json;
        $dataHora = $pedidos->data_hora_cancelamento;
		$dataPedido = date('d/m/Y H:i:s', strtotime($pedidos->data_hora_inicial));
        $apenasData = date('d/m/Y', strtotime($pedidos->data_hora_inicial));
        $origem = $pedidos->origem_pedido;
		if (!empty($json)) {
			$json = str_replace(array("\r", "\n"), '', $json);
			$json = json_decode($json, true);
		}
		$html = "<!DOCTYPE html>";
		$html .= "<html>";
		$html .= "<head>";
		$html .= '<meta charset="utf-8" />';
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$html .= '<title>Pedido - Fórmula Pizzaria</title>';
		$html .= '<style>';
		$html .= 'body{min-height:auto;}';
		$html .= 'body table{max-width: 375px; margin: auto; font-family: sans-serif;}';
		$html .= '@media print {body{width:100%;margin:1px;}table{/*width:143.9999% !important;*/width:100% !important;margin:1px;}}@page{margin:1px;}';
		$html .= '</style>';
		$html .= "</head>";
		$html .= "<body>";
		$html .= "<table align='center' style='font-family:sans-serif;'>";
		$html .= "<tr>";
		$html .= "<td align='left' colspan='2'><strong>COD PEDIDO <span style='font-size:40px;'>" . $pedidos->cod_pedidos . "</span></strong></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='left' colspan='2'>PEDIDO CANCELADO</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='left' colspan='2'>ORIGEM " . $origem . "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='left' colspan='2'>HORÁRIO " . $dataHora . "</td>";
		$html .= "</tr>";
		if (!empty($cancelamento_json['justificativa']) and isset($cancelamento_json['justificativa'])) {
			$html .= "<tr>";
			$html .= "<td align='left' colspan='2'><strong>JUSTIFICATIVA:</strong></td>";
			$html .= "</tr>";
			$html .= "<tr>";
			$html .= "<td align='left' colspan='2'>" . $cancelamento_json['justificativa'] . "</td>";
			$html .= "</tr>";
		}
		$html .= "<tr>";
		$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='center' colspan='2'><strong>PEDIDO CANCELADO</strong></td>";
		$html .= "</tr>";
		if (!empty($json)) {
			foreach ($json['order']['payments'] as $key => $value) {
				if (isset($value['prepaid'])) {
					if ($value['prepaid'] == true) {
						$vetor['prepago'][] = $value;
					} else {
						$vetor['pospago'][] = $value;
					}
				}
			}
			if (!empty($vetor['prepago']) and isset($vetor['prepago'])) {
				$html .= "<tr>";
				$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
				$html .= "</tr>";
				$html .= "<tr>";
				$html .= "<td align='left' colspan='2'><strong>VALORES JÁ PAGOS</strong></td>";
				$html .= "</tr>";
			}
			if (isset($vetor['prepago'])) {
				foreach ($vetor['prepago'] as $key => $value) {
					$html .= "<tr>";
					$html .= "<td align='left' colspan='2'>R$" . number_format($value['value'],2) . "</td>";
					$html .= "</tr>";
				}
			}
			if (!empty($vetor['pospago']) and isset($vetor['pospago'])) {
				$html .= "<tr>";
				$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
				$html .= "</tr>";
				$html .= "<tr>";
				$html .= "<td align='left' colspan='2'><strong>VALORES NÃO PAGOS</strong></td>";
				$html .= "</tr>";
			}
			if (isset($vetor['pospago'])) {
				foreach ($vetor['pospago'] as $key => $value) {
					$html .= "<tr>";
					$html .= "<td align='left' colspan='2'>R$" . number_format($value['value'],2) . "</td>";
					$html .= "</tr>";
				}
			}
			$html .= "<tr>";
			$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
			$html .= "</tr>";
			$html .= "<tr>";
			$html .= "<td align='left' colspan='2'>TOTAL PEDIDO R$" . number_format($json['order']['totalPrice'],2) . "</td>";
			$html .= "</tr>";
		} else {
			$html .= "<tr>";
			$html .= "<td colspan='2' style='border-top:2px dotted #000;'></td>";
			$html .= "</tr>";
			$html .= "<tr>";
			$html .= "<td align='left' colspan='2'>TOTAL PEDIDO R$" . number_format($pedidos->valor_total,2) . "</td>";
			$html .= "</tr>";
		}
		$html .= "</table>";
		$html .= "</body>";
        $html .= "</html>";
        return $html;
    }
}
