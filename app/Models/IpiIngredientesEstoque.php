<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:34 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiIngredientesEstoque
 * 
 * @property int $cod_ingredientes_estoque
 * @property int $cod_ingredientes
 * @property int $cod_tamanhos
 * @property int $cod_pizzas
 * @property float $quantidade_estoque_ingrediente
 * 
 * @property \App\Models\IpiPizza $ipi_pizza
 * @property \App\Models\IpiTamanho $ipi_tamanho
 * @property \App\Models\IpiIngrediente $ipi_ingrediente
 *
 * @package App\Models
 */
class IpiIngredientesEstoque extends Eloquent
{
	protected $table = 'ipi_ingredientes_estoque';
	protected $primaryKey = 'cod_ingredientes_estoque';
	public $timestamps = false;

	protected $casts = [
		'cod_ingredientes' => 'int',
		'cod_tamanhos' => 'int',
		'cod_pizzas' => 'int',
		'quantidade_estoque_ingrediente' => 'float'
	];

	protected $fillable = [
		'cod_ingredientes',
		'cod_tamanhos',
		'cod_pizzas',
		'quantidade_estoque_ingrediente'
	];

	public function ipi_pizza()
	{
		return $this->belongsTo(\App\Models\IpiPizza::class, 'cod_pizzas');
	}

	public function ipi_tamanho()
	{
		return $this->belongsTo(\App\Models\IpiTamanho::class, 'cod_tamanhos');
	}

	public function ipi_ingrediente()
	{
		return $this->belongsTo(\App\Models\IpiIngrediente::class, 'cod_ingredientes');
	}
}
