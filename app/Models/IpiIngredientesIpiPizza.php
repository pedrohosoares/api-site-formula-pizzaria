<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesIpiPizza
 * 
 * @property int $cod_ingredientes
 * @property int $cod_pizzas
 * 
 * @property \App\Models\IpiIngrediente $ipi_ingrediente
 * @property \App\Models\IpiPizza $ipi_pizza
 *
 * @package App\Models
 */
class IpiIngredientesIpiPizza extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_ingredientes' => 'int',
		'cod_pizzas' => 'int'
	];

	public function ipi_ingrediente()
	{
		return $this->belongsTo(\App\Models\IpiIngrediente::class, 'cod_ingredientes');
	}

	public function ipi_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPizza::class, 'cod_pizzas');
	}
}
