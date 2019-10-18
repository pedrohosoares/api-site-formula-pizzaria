<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPedidosBebida
 * 
 * @property int $cod_pedidos_bebidas
 * @property int $cod_pedidos
 * @property int $cod_pedidos_combos
 * @property int $cod_bebidas_ipi_conteudos
 * @property int $cod_usuarios_inclusao
 * @property int $cod_colaboradores_inclusao
 * @property \Carbon\Carbon $data_hora_inclusao
 * @property float $preco
 * @property int $pontos_fidelidade
 * @property int $quantidade
 * @property bool $promocional
 * @property bool $fidelidade
 * @property bool $combo
 * @property int $cod_combos_produtos
 * @property float $preco_inteiro
 * @property int $cod_motivo_promocoes
 * @property int $cod_colaboradores_cancelamento
 * @property \Carbon\Carbon $data_hora_cancelamento
 * @property string $situacao_pedidos_bebidas
 * 
 * @property \App\Models\IpiPedido $ipi_pedido
 * @property \App\Models\IpiBebidasIpiConteudo $ipi_bebidas_ipi_conteudo
 *
 * @package App\Models
 */
class IpiPedidosBebida extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'cod_pedidos' => 'int',
		'cod_pedidos_combos' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int',
		'cod_usuarios_inclusao' => 'int',
		'cod_colaboradores_inclusao' => 'int',
		'preco' => 'float',
		'pontos_fidelidade' => 'int',
		'quantidade' => 'int',
		'promocional' => 'bool',
		'fidelidade' => 'bool',
		'combo' => 'bool',
		'cod_combos_produtos' => 'int',
		'preco_inteiro' => 'float',
		'cod_motivo_promocoes' => 'int',
		'cod_colaboradores_cancelamento' => 'int'
	];

	protected $dates = [
		'data_hora_inclusao',
		'data_hora_cancelamento'
	];

	protected $fillable = [
		'cod_pedidos_combos',
		'cod_bebidas_ipi_conteudos',
		'cod_usuarios_inclusao',
		'cod_colaboradores_inclusao',
		'data_hora_inclusao',
		'preco',
		'pontos_fidelidade',
		'quantidade',
		'promocional',
		'fidelidade',
		'combo',
		'cod_combos_produtos',
		'preco_inteiro',
		'cod_motivo_promocoes',
		'cod_colaboradores_cancelamento',
		'data_hora_cancelamento',
		'situacao_pedidos_bebidas'
	];

	public function ipi_pedido()
	{
		return $this->belongsTo(\App\Models\IpiPedido::class, 'cod_pedidos');
	}

	public function ipi_bebidas_ipi_conteudo()
	{
		return $this->belongsTo(\App\Models\IpiBebidasIpiConteudo::class, 'cod_bebidas_ipi_conteudos');
	}

	
}
