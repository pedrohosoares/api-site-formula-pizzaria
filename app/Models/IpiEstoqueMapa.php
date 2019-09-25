<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiEstoqueMapa
 * 
 * @property int $cod_pizzarias
 * @property int $cod_ingredientes
 * @property int $cod_bebidas_ipi_conteudos
 * @property \Carbon\Carbon $data_movimentacao
 * @property float $quantidade_teorico
 * @property float $quantidade_compras
 * @property float $quantidade_vendas
 * @property float $quantidade_ajuste
 * @property \Carbon\Carbon $ultima_compra_data
 * @property float $ultima_compra_valor
 * @property float $ultima_compra_quantidade
 * @property float $ultima_compra_preco_grama
 * @property float $saldo_inicial
 * @property float $saldo_final
 * @property float $quantidade_fidelidade
 * @property float $quantidade_combo
 * @property float $quantidade_lanche
 * @property float $quantidade_promocao
 * 
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiEstoqueMapa extends Eloquent
{
	protected $table = 'ipi_estoque_mapa';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_ingredientes' => 'int',
		'cod_bebidas_ipi_conteudos' => 'int',
		'quantidade_teorico' => 'float',
		'quantidade_compras' => 'float',
		'quantidade_vendas' => 'float',
		'quantidade_ajuste' => 'float',
		'ultima_compra_valor' => 'float',
		'ultima_compra_quantidade' => 'float',
		'ultima_compra_preco_grama' => 'float',
		'saldo_inicial' => 'float',
		'saldo_final' => 'float',
		'quantidade_fidelidade' => 'float',
		'quantidade_combo' => 'float',
		'quantidade_lanche' => 'float',
		'quantidade_promocao' => 'float'
	];

	protected $dates = [
		'data_movimentacao',
		'ultima_compra_data'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_ingredientes',
		'cod_bebidas_ipi_conteudos',
		'data_movimentacao',
		'quantidade_teorico',
		'quantidade_compras',
		'quantidade_vendas',
		'quantidade_ajuste',
		'ultima_compra_data',
		'ultima_compra_valor',
		'ultima_compra_quantidade',
		'ultima_compra_preco_grama',
		'saldo_inicial',
		'saldo_final',
		'quantidade_fidelidade',
		'quantidade_combo',
		'quantidade_lanche',
		'quantidade_promocao'
	];

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
