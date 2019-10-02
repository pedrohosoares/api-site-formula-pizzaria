<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedido
 * 
 * @property int $cod_pedidos
 * @property int $cod_pedidos_motivo_cancelamento
 * @property int $cod_clientes
 * @property int $cod_pizzarias
 * @property int $cod_entregadores
 * @property int $cod_usuarios_pedido
 * @property int $cod_usuarios_cancelamento
 * @property int $cod_usuarios_envio
 * @property int $cod_usuarios_liberacao_captura
 * @property int $cod_usuarios_liberacao_fiscal
 * @property int $cod_caixas_fisicos
 * @property string $apelido
 * @property \Carbon\Carbon $data_hora_pedido
 * @property \Carbon\Carbon $data_hora_baixa
 * @property \Carbon\Carbon $data_hora_cancelamento
 * @property \Carbon\Carbon $data_hora_envio
 * @property float $valor
 * @property float $valor_entrega
 * @property float $valor_comissao_frete
 * @property float $desconto
 * @property int $pontos_fidelidade_total
 * @property float $valor_total
 * @property string $forma_pg
 * @property string $situacao
 * @property int $cod_pedidos_reenvio
 * @property int $cod_pedidos_repetido
 * @property string $nome_cliente
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $edificio
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep
 * @property string $telefone_1
 * @property string $telefone_2
 * @property string $referencia_endereco
 * @property string $referencia_cliente
 * @property string $obs_endereco
 * @property \Carbon\Carbon $horario_agendamento
 * @property string $tipo_entrega
 * @property bool $agendado
 * @property bool $reimpressao
 * @property string $cupom_existe
 * @property string $origem_pedido
 * @property string $obs_pedido
 * @property \Carbon\Carbon $data_hora_inicial
 * @property \Carbon\Carbon $data_hora_final
 * @property int $numero_cupom_fiscal
 * @property bool $impressao_fiscal
 * @property int $impressao_cancelado
 * @property \Carbon\Carbon $data_captura_manual
 * @property \Carbon\Carbon $data_fiscal_manual
 * @property string $software_impressao
 * @property bool $ifood
 * @property int $integracao_ecf
 * @property string $cpf
 * @property string $arquivo_nota_pdf
 * @property array $arquivo_json
 * @property string $ref_nota_fiscal
 * @property array $cancelamento_json
 * @property string $ifood_polling
 * @property array $pedido_ifood_json
 * @property string $status_nota
 * @property string $ifood_status
 * 
 * @property \App\Models\IpiCliente $ipi_cliente
 * @property \Illuminate\Database\Eloquent\Collection $ipi_caixas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_bebidas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_detalhes_pgs
 * @property \Illuminate\Database\Eloquent\Collection $ipi_cupons
 * @property \Illuminate\Database\Eloquent\Collection $ipi_enquetes
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_pizzas
 * @property \Illuminate\Database\Eloquent\Collection $ipi_pedidos_situacos
 *
 * @package App\Models
 */
class IpiPedido extends Eloquent
{
	protected $primaryKey = 'cod_pedidos';
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos_motivo_cancelamento' => 'int',
		'cod_clientes' => 'int',
		'cod_pizzarias' => 'int',
		'cod_entregadores' => 'int',
		'cod_usuarios_pedido' => 'int',
		'cod_usuarios_cancelamento' => 'int',
		'cod_usuarios_envio' => 'int',
		'cod_usuarios_liberacao_captura' => 'int',
		'cod_usuarios_liberacao_fiscal' => 'int',
		'cod_caixas_fisicos' => 'int',
		'valor' => 'float',
		'valor_entrega' => 'float',
		'valor_comissao_frete' => 'float',
		'desconto' => 'float',
		'pontos_fidelidade_total' => 'int',
		'valor_total' => 'float',
		'cod_pedidos_reenvio' => 'int',
		'cod_pedidos_repetido' => 'int',
		'agendado' => 'bool',
		'reimpressao' => 'bool',
		'numero_cupom_fiscal' => 'int',
		'impressao_fiscal' => 'bool',
		'impressao_cancelado' => 'int',
		'ifood' => 'bool',
		'integracao_ecf' => 'int',
		'arquivo_json' => 'json',
		'cancelamento_json' => 'json'
		#'pedido_ifood_json' => 'json'
	];

	protected $dates = [
		'data_hora_pedido',
		'data_hora_baixa',
		'data_hora_cancelamento',
		'data_hora_envio',
		'horario_agendamento',
		'data_hora_inicial',
		'data_hora_final',
		'data_captura_manual',
		'data_fiscal_manual'
	];

	protected $fillable = [
		'cod_pedidos_motivo_cancelamento',
		'cod_clientes',
		'cod_pizzarias',
		'cod_entregadores',
		'cod_usuarios_pedido',
		'cod_usuarios_cancelamento',
		'cod_usuarios_envio',
		'cod_usuarios_liberacao_captura',
		'cod_usuarios_liberacao_fiscal',
		'cod_caixas_fisicos',
		'apelido',
		'data_hora_pedido',
		'data_hora_baixa',
		'data_hora_cancelamento',
		'data_hora_envio',
		'valor',
		'valor_entrega',
		'valor_comissao_frete',
		'desconto',
		'pontos_fidelidade_total',
		'valor_total',
		'forma_pg',
		'situacao',
		'cod_pedidos_reenvio',
		'cod_pedidos_repetido',
		'nome_cliente',
		'endereco',
		'numero',
		'complemento',
		'edificio',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'telefone_1',
		'telefone_2',
		'referencia_endereco',
		'referencia_cliente',
		'obs_endereco',
		'horario_agendamento',
		'tipo_entrega',
		'agendado',
		'reimpressao',
		'cupom_existe',
		'origem_pedido',
		'obs_pedido',
		'data_hora_inicial',
		'data_hora_final',
		'numero_cupom_fiscal',
		'impressao_fiscal',
		'impressao_cancelado',
		'data_captura_manual',
		'data_fiscal_manual',
		'software_impressao',
		'ifood',
		'integracao_ecf',
		'cpf',
		'arquivo_nota_pdf',
		'arquivo_json',
		'ref_nota_fiscal',
		'cancelamento_json',
		'ifood_polling',
		'pedido_ifood_json',
		'status_nota',
		'ifood_status'
	];

	public function ipi_pizzaria(){
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pizzarias');
	}

	public function ipi_cliente()
	{
		return $this->belongsTo(\App\Models\IpiCliente::class, 'cod_clientes');
	}

	public function ipi_caixas()
	{
		return $this->belongsToMany(\App\Models\IpiCaixa::class, 'ipi_caixa_ipi_pedidos', 'cod_pedidos', 'cod_caixa');
	}

	public function ipi_pedidos_bebidas()
	{
		return $this->hasMany(\App\Models\IpiPedidosBebida::class, 'cod_pedidos','cod_pedidos');
	}

	public function ipi_pedidos_detalhes_pgs()
	{
		return $this->hasMany(\App\Models\IpiPedidosDetalhesPg::class, 'cod_pedidos');
	}

	public function ipi_cupons()
	{
		return $this->belongsToMany(\App\Models\IpiCupon::class, 'ipi_pedidos_ipi_cupons', 'cod_pedidos', 'cod_cupons');
	}

	public function ipi_enquetes()
	{
		return $this->belongsToMany(\App\Models\IpiEnquete::class, 'ipi_pedidos_ipi_enquetes', 'cod_pedidos', 'cod_enquetes')
					->withPivot('data_hora_gravacao');
	}

	public function ipi_pedidos_pizzas()
	{
		return $this->hasMany(\App\Models\IpiPedidosPizza::class, 'cod_pedidos');
	}

	public function ipi_pedidos_situacos()
	{
		return $this->hasMany(\App\Models\IpiPedidosSituaco::class, 'cod_pedidos');
	}
}
