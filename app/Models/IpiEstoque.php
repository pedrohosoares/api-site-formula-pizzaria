<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoque
 * 
 * @property int $cod_estoque
 * @property int $cod_colaboradores_prejuizo
 * @property int $cod_pedidos
 * @property int $cod_pedidos_ingredientes
 * @property int $cod_pedidos_bebidas
 * @property int $cod_pedidos_bordas
 * @property int $cod_pedidos_pizzas
 * @property int $cod_pedidos_fracoes
 * @property int $cod_estoque_entrada_itens
 * @property int $cod_estoque_tipo_lancamento
 * @property int $cod_usuarios
 * @property int $cod_pizzarias
 * @property int $cod_bebidas_ipi_conteudos
 * @property int $cod_ingredientes
 * @property float $quantidade
 * @property string $tipo_estoque
 * @property \Carbon\Carbon $data_hora_lancamento
 * @property string $obs_estoque
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiEstoqueTipoLancamento $ipi_estoque_tipo_lancamento
 *
 * @package App\Models
 */
class IpiEstoque extends Eloquent
{
	protected $table = 'ipi_estoque';
	protected $primaryKey = 'cod_estoque';
	public $timestamps = false;

	protected $casts = [
		'cod_colaboradores_prejuizo' => 'int',
		'cod_pedidos' => 'int',
		'cod_pedidos_ingredientes' => 'int',
		'cod_pedidos_bebidas' => 'int',
		'cod_pedidos_bordas' => 'int',
		'cod_pedidos_pizzas' => 'int',
		'cod_pedidos_fracoes' => 'int',
		'cod_estoque_entrada_itens' => 'int',
		'cod_estoque_tipo_lancamento' => 'int',
		'cod_usuarios' => 'int',
		'cod_pizzarias' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int',
		'cod_ingredientes' => 'int',
		'quantidade' => 'float'
	];

	protected $dates = [
		'data_hora_lancamento'
	];

	protected $fillable = [
		'cod_colaboradores_prejuizo',
		'cod_pedidos',
		'cod_pedidos_ingredientes',
		'cod_pedidos_bebidas',
		'cod_pedidos_bordas',
		'cod_pedidos_pizzas',
		'cod_pedidos_fracoes',
		'cod_estoque_entrada_itens',
		'cod_estoque_tipo_lancamento',
		'cod_usuarios',
		'cod_pizzarias',
		'cod_bebidas_ipi_conteudos',
		'cod_ingredientes',
		'quantidade',
		'tipo_estoque',
		'data_hora_lancamento',
		'obs_estoque',
		'situacao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_estoque_tipo_lancamento()
	{
		return $this->belongsTo(\App\Models\IpiEstoqueTipoLancamento::class, 'cod_estoque_tipo_lancamento');
	}
}
