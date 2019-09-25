<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:32 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiCardapio
 * 
 * @property int $cod_cardapios
 * @property int $cod_pizzarias
 * @property int $cod_pizzas
 * @property string $situacao
 * 
 * @property \App\Models\IpiPizza $ipi_pizza
 * @property \App\Models\IpiPizzaria $ipi_pizzaria
 *
 * @package App\Models
 */
class IpiCardapio extends Eloquent
{
	protected $primaryKey = 'cod_cardapios';
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_pizzas' => 'int'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_pizzas',
		'situacao'
	];

	public function ipi_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPizza::class, 'cod_pizzas');
	}

	public function ipi_pizzaria()
	{
		return $this->belongsTo(\App\Models\IpiPizzaria::class, 'cod_pizzarias');
	}
}
