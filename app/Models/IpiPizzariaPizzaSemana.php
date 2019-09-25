<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 11 Sep 2019 18:39:35 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IpiPizzariaPizzaSemana
 * 
 * @property int $cod_pizzarias
 * @property int $cod_pizzas
 * @property int $cod_tamanhos
 * @property int $ordem
 * @property int $dia_semana
 * @property string $status
 * @property float $preco_pizza_semana
 * @property float $preco_antigo
 *
 * @package App\Models
 */
class IpiPizzariaPizzaSemana extends Eloquent
{
	protected $table = 'ipi_pizzaria_pizza_semana';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'cod_pizzarias' => 'int',
		'cod_pizzas' => 'int',
		'cod_tamanhos' => 'int',
		'ordem' => 'int',
		'dia_semana' => 'int',
		'preco_pizza_semana' => 'float',
		'preco_antigo' => 'float'
	];

	protected $fillable = [
		'cod_pizzarias',
		'cod_pizzas',
		'cod_tamanhos',
		'ordem',
		'dia_semana',
		'status',
		'preco_pizza_semana',
		'preco_antigo'
	];
}
