<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzasIpiTamanho
 * 
 * @property int $cod_pizzas
 * @property int $cod_tamanhos
 * @property float $preco
 * @property float $valor_imposto
 * @property int $pontos_fidelidade
 * @property int $cod_pizzarias
 * @property int $cod_impressoras
 * @property bool $pizza_semana
 * @property bool $pizza_dia
 * 
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiPizza $ipi_pizza
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 * @property \App\Models\IpiImpressora $ipi_impressora
 *
 * @package App\Models
 */
class IpiPizzasIpiTamanho extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzas' => 'int',
		'cod_tamanhos' => 'int',
		'preco' => 'float',
		'valor_imposto' => 'float',
		'pontos_fidelidade' => 'int',
		'cod_pizzarias' => 'int',
		'cod_impressoras' => 'int',
		'pizza_semana' => 'bool',
		'pizza_dia' => 'bool'
	];

	protected $fillable = [
		'preco',
		'valor_imposto',
		'pontos_fidelidade',
		'cod_impressoras',
		'pizza_semana',
		'pizza_dia'
	];

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPizza::class, 'cod_pizzas');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}

	public function ipi_impressora()
	{
		return $this->belongsTo(\App\Models\IpiImpressora::class, 'cod_impressoras');
	}
}
