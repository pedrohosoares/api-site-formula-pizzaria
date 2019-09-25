<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesIpiTamanho
 * 
 * @property int $cod_ingredientes
 * @property int $cod_tamanhos
 * @property int $cod_pizzarias
 * @property float $preco
 * @property float $valor_imposto
 * @property float $preco_troca
 * @property int $pontos_fidelidade
 * @property int $quantidade_estoque_extra
 * 
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiIngrediente $ipi_ingrediente
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiIngredientesIpiTamanho extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_ingredientes' => 'int',
		'cod_tamanhos' => 'int',
		'cod_pizzarias' => 'int',
		'preco' => 'float',
		'valor_imposto' => 'float',
		'preco_troca' => 'float',
		'pontos_fidelidade' => 'int',
		'quantidade_estoque_extra' => 'int'
	];

	protected $fillable = [
		'preco',
		'valor_imposto',
		'preco_troca',
		'pontos_fidelidade',
		'quantidade_estoque_extra'
	];

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_ingrediente()
	{
		return $this->belongsTo(\App\Models\IpiIngrediente::class, 'cod_ingredientes');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
