<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:33 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCpv
 * 
 * @property int $cod_cpv
 * @property int $cod_pizzarias
 * @property int $cod_tamanhos
 * @property int $cod_pizzas
 * @property \Carbon\Carbon $data_registro
 * @property float $preco_venda
 * @property float $cpv_real
 * @property float $cpv_teorico
 * 
 * @property \App\Models\IpiPizza $ipi_pizza
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiCpv extends Eloquent
{
	protected $table = 'ipi_cpv';
	protected $primaryKey = 'cod_cpv';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_tamanhos' => 'int',
		'cod_pizzas' => 'int',
		'preco_venda' => 'float',
		'cpv_real' => 'float',
		'cpv_teorico' => 'float'
	];

	protected $dates = [
		'data_registro'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_tamanhos',
		'cod_pizzas',
		'data_registro',
		'preco_venda',
		'cpv_real',
		'cpv_teorico'
	];

	public function ipi_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPizza::class, 'cod_pizzas');
	}

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
